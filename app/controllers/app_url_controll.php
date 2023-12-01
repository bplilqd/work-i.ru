<?php

namespace mvc;

class app_url_controll {

    public $in_dir_url; // входящий запрос без ретуши
    public $arr_dir_url; // массив запрошеных директорий и хвостов
    public $page_url; // запрошеная страница
    public $dir_url; // запрошеные директории
    public $count_dir; // уровень или количество директорий углублений
    public $scan_dir_str; // строка, путь для сканирования директории
    public $scan_dir_arr; // масив после сканирования запрошенной директории
    public $is_dir_check_true; // есть такая директория, существует физически ли
    public $is_file_check_true; // есть такой файл, существует физически ли
    static $name;

    function __construct() {
        $this->name[] = __METHOD__;
        $this->req_url();
        $this->exp_req();
        $this->page_search();
        $this->dir_check();
        $this->count_dir = count($this->dir_url);
        $this->scan_dir_check_page();
        $this->scandir_str();
        $this->is_dir_check();
        $this->is_file_check();
    }

    // входящий запрос url
    public function req_url() {
        $this->name[] = __METHOD__;
        $this->in_dir_url = $_SERVER['REQUEST_URI'];
    }

    // разбиваем строку
    protected function exp_req() {
        $this->name[] = __METHOD__;
        $str = $this->in_dir_url;
        $arr = explode('/', $str);
        $this->arr_dir_url = $arr;
    }

    // вырезаем имя и расширение страницы
    protected function page_search() {
        $this->name[] = __METHOD__;
        $arr = $this->arr_dir_url;
        foreach ($arr as $val) {
            if (preg_match('/(.*\..*)\?|.*/i', $val, $result)) {
                $this->page_set_search($result);
            }
        }
    }

    // ставим страницу
    protected function page_set_search($arr) {
        $this->name[] = __METHOD__;
        foreach ($arr as $v) {
            if (preg_match('/[^\?]\./i', $v)) {
                $this->page_url = $v;
            }
        }
    }

    // находим только директории
    protected function dir_check() {
        $this->name[] = __METHOD__;
        $arr = $this->arr_dir_url;
        foreach ($arr as $val) {
            if ($val && !preg_match('/.*\..*/i', $val)) {
                $arr_result[] = $val;
            }
        }
        $this->dir_url = $arr_result;
    }

    // ставим строку для сканирования директорий, путь
    public function scan_dir_check_page() {
        $this->name[] = __METHOD__;
        $arr = $this->dir_url;
        $result = implode('/', $arr);
        $this->scan_dir_str = $result;
    }

    public function scandir_str() {
        $this->name[] = __METHOD__;
        $str = $this->scan_dir_str;
        $arr_result = scandir($str);
        $this->scan_dir_arr = $arr_result;
    }

    public function is_dir_check() {
        $this->name[] = __METHOD__;
        $str = $this->scan_dir_str;
        $result = is_dir($str);
        $this->is_dir_check_true = $result;
    }

    public function is_file_check() {
        $this->name[] = __METHOD__;
        if ($this->scan_dir_str) {
            $scan_dir_str = $this->scan_dir_str . '/';
        }
        $page_url = $this->page_url;
        $result = is_file($scan_dir_str . $page_url);
        $this->is_file_check_true = $result;
    }

}
