<?php

require __DIR__ . '/app/function.php';

// обязательный контроллер app_url_controll
$app_url_controll = new Workiru\mvc\app(['app_url_controll'], __DIR__);


//список разрешенныых виртуальных файлов
//список разрешенных виртуальных директорий
print_r($app_url_controll->name);
print_r($app_url_controll->controllers['app_url_controll']->name);
if ($app_url_controll->error_page_print) {
    echo $app_url_controll->error_page_print;
    exit();
}



print_r($app_url_controll->controllers['url_error_controll']->error_num_and_comment);
//echo $app->models['error_url_mod']->in_err_num();
//foreach ($app->controllers['app_url_controll']->dir_url as $val) {
//    echo ' ' . urldecode($val);
//}
//echo ' ' . $app->controllers['app_url_controll']->page_url;
echo " <center><p> " . Memory_mb(memory_get_usage()) . " <br> " . Time_sec($time_start, microtime(true)) . "</p></center>";
