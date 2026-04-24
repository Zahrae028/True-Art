<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ArtistController;
use App\Models\User;
use App\Models\Commission;
use App\Models\Message;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

use App\Models\PortfolioPost;

// Public Routes
Route::get('/', function () {
    $showcase = PortfolioPost::with('artist')->latest()->take(6)->get();
    return view('home', compact('showcase'));
});

Route::get('/explore', [PortfolioController::class, 'index']);

Route::get('/artists', [ArtistController::class, 'index']);

Route::get('/artist/{id}', function ($id) {
    $artist = User::where('id', $id)->where('role', 'artist')->with('profile')->firstOrFail();
    return view('artist-profile', compact('artist'));
});


Route::get('/register', fn() => view('register'));
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


Route::middleware(['auth'])->group(function () {
    
    
    Route::get('/dashboard', function () {
        $commissions = Commission::where('client_id', auth()->id())->get();
        return view('dashboard', compact('commissions'));
    });

    Route::get('/dashboard/artist', function () {
        $commissions = Commission::where('artist_id', auth()->id())->get();
        return view('dashboard-artist', compact('commissions'));
    });

    
    Route::get('/messages', function (Illuminate\Http\Request $request) {
        $user = auth()->user();
        
        
        $commissions = Commission::where('client_id', $user->id)
            ->orWhere('artist_id', $user->id)
            ->with(['client', 'artist'])
            ->get();

            
        $activeId = $request->query('id');
        $activeCommission = $activeId 
            ? $commissions->where('id', $activeId)->first() 
            : null;

            
        $messages = $activeCommission 
            ? Message::where('commission_id', $activeCommission->id)->with('sender')->orderBy('created_at')->get() 
            : collect();

        return view('messages', [
            'commissions' => $commissions,
            'activeCommission' => $activeCommission,
            'messages' => $messages,
        ]);
    });

    Route::get('/messages/artist', fn() => redirect('/messages'));

    
    Route::get('/commissions/manage', function () {
        $commissions = Commission::where('artist_id', auth()->id())->get();
        return view('commissions-manage', compact('commissions'));
    });

    Route::get('/commission/request/{artist_id}', function ($artist_id) {
        $artist = User::findOrFail($artist_id);
        return view('commission-request', compact('artist'));
    });

    Route::get('/commission/{id}', function ($id) {
        $commission = Commission::with(['client', 'artist', 'milestones'])->findOrFail($id);
        return view('commission-details', compact('commission'));
    });

    // Profiles
    Route::get('/profile', function () {
        $user = auth()->user();
        return view('profile-client', compact('user'));
    });

    Route::get('/profile/artist', function () {
        $user = auth()->user();
        return view('profile-artist', compact('user'));
    });

    Route::post('/profile/update', [ProfileController::class, 'update']);

    
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index']);
        Route::get('/users', [AdminController::class, 'users']);
        Route::get('/commissions', [AdminController::class, 'commissions']);
        Route::post('/user/{id}/toggle-ban', [AdminController::class, 'toggleBan']);
        Route::post('/user/{id}/promote-admin', [AdminController::class, 'promoteAdmin']);
    });

    
    Route::prefix('portfolio')->group(function () {
        Route::get('/create', [PortfolioController::class, 'create']);
        Route::post('/', [PortfolioController::class, 'store']);
        Route::delete('/{id}', [PortfolioController::class, 'destroy']);
    });

    // Commission Actions
    Route::post('/commission', [CommissionController::class, 'store']);
    Route::post('/commission/{id}/accept', [CommissionController::class, 'accept']);
    Route::post('/commission/{id}/approve-quote', [CommissionController::class, 'approveQuote']);
    Route::post('/commission/{id}/decline-quote', [CommissionController::class, 'declineQuote']);
    Route::post('/commission/{id}/pay-deposit', [CommissionController::class, 'payDeposit']);
    Route::post('/commission/{id}/refund-deposit', [CommissionController::class, 'refundDeposit']);
    Route::post('/commission/{id}/pay-final', [CommissionController::class, 'payFinal']);
    Route::post('/commission/{id}/complete', [CommissionController::class, 'complete']);

    // Milestone Actions
    Route::post('/milestone', [MilestoneController::class, 'store']);
    Route::post('/milestone/{id}/approve', [MilestoneController::class, 'approve']);
    Route::post('/milestone/{id}/reject', [MilestoneController::class, 'reject']);

    // Message Actions
    Route::post('/message', [MessageController::class, 'send']);
});
