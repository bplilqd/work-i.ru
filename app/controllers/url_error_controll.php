<?php

namespace mvc;

class url_error_controll {

    static $error_echo; // массив с ошибками
    static $error_number; // массив с номерами ошибок
    static $error_num_and_comment;
    public $error_page_num; // 

    public function error_set($num_error, $str_error) {
        if (!$this->error_page_num) {
            $this->error_page_num = $num_error;
        }
        $this->error_number[] = $num_error;
        $this->error_echo[] = $str_error;
        $this->error_num_and_comment[$num_error] = $str_error;
    }

}
