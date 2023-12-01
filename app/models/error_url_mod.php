<?php

namespace mvc;

class error_url_mod {

    public $controller; // массив с объектами
    public $error_is_mod;
    public $views;
                
    function __construct($param) {
        $this->controller = $param;
    }

    public function in_err_num() {
        $error_page_num = $this->controller['url_error_controll']->error_page_num;
        $error_is_mod = $this->error_is_mod;
        $this->views['page_error_4xx']->page_wiew($error_page_num, $error_is_mod);
        // выбрать подходящий вид
        return $this->views['page_error_4xx']->check_view;
    }

}
