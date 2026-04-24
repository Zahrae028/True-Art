<?php
$viewsDir = 'resources/views';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsDir));
$styles = [];

foreach ($iterator as $file) {
    if (!$file->isFile() || !str_ends_with($file->getFilename(), '.blade.php')) continue;
    $content = file_get_contents($file->getPathname());
    preg_match_all('/style="([^"]+)"/', $content, $matches);
    foreach ($matches[1] as $style) {
        $props = explode(';', $style);
        foreach ($props as $prop) {
            $prop = trim($prop);
            if (!empty($prop)) {
                if (!isset($styles[$prop])) $styles[$prop] = 0;
                $styles[$prop]++;
            }
        }
    }
}

arsort($styles);
echo "Most Common Inline Style Properties:\n";
$i = 0;
foreach ($styles as $prop => $count) {
    echo "[$count] $prop\n";
    if (++$i >= 40) break;
}
