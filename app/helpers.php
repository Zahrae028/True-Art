<?php

use App\Models\User;

function authUser()
{
    return User::find(session('user_id'));
}