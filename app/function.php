<?php

$time_start = microtime(true); // для вычеслений, внимание - не менять эту строку!
// функция время выполнения скрипта в начале, обязательно microtime(true), типа так: $time_start = microtime(true);

function Time_sec($t_start, $t_end) {
    $time_s = 'Время выполнения ';
    $t = $t_end - $t_start;
    $time_s .= round($t, 3);
    return $time_s .= ' сек.';
}

// функция вычесления объема требуемой памяти
function Memory_mb($a) {
    $memory = 'Объем памяти ';
    $a = $a / 1024 / 1024;
    $memory .= round($a, 2);
    return $memory .= ' mb';
}
require __DIR__ . '/controllers/app.php';