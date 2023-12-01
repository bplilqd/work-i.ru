<?php

namespace mvc;

class app {

    static $controllers; // массив объектов
    static $models; // массив объектов
    public $views;
    public $dir; // дириктория от текущего файла обработчика например index.php
    public $error_page_print;
    static $name;

    function __construct($arr_class, $dir) {
        $this->name[] = __METHOD__;
        $this->dir = $dir;
        $this->new_object_controllers($arr_class);
        $this->chek_url_set_error();
        $this->error_page_verification();
        
    }

    // установка объектов и путей к ним для controllers
    public function new_object_controllers($arr_class) {
        $this->name[] = __METHOD__;
        foreach ($arr_class as $val) {
            // проверяем был ли установлен объект ранее
            if (!$this->controllers[$val] && in_array($val, $arr_class)) {
                require __DIR__ . '/' . $val . '.php';
                $str_new = 'mvc\\'.$val;
                $this->controllers[$val] = new $str_new;
            }
        }
    }

    // установка классов группы models $this->new_models('app_url_physical_mod');
    // где 'app_url_physical_mod' = название имени файла
    public function new_models($class, $param = false) {
        $this->name[] = __METHOD__;
        if (!$this->models[$class]) {
            require $this->dir . '/app/models/' . $class . '.php';
            $str_new = 'mvc\\'.$class;
            $this->models[$class] = new $str_new($param);
        }
    }

    public function new_views($class, $param = false) {
        $this->name[] = __METHOD__;
        if (!$this->views[$class]) {
            require $this->dir . '/app/views/' . $class . '.php';
            $str_new = 'mvc\\'.$class;
            $this->views[$class] = new $str_new($param);
        }
    }

    // разъяснение ошибки по номеру
    public function search_lib_number_uri_error($key) {
        $this->name[] = __METHOD__;
        $this->new_models('lib_mod');
        return $this->models['lib_mod']->lib_error($key);
    }

    // поставить новую url ошибку
    public function error_set($num_error, $str_error = false) {
        $this->name[] = __METHOD__;
        $this->new_object_controllers(['url_error_controll']);
        $this->controllers['url_error_controll']->error_set($num_error, $str_error);
    }

    public function error_page_verification() {
        $this->name[] = __METHOD__;
        if ($this->controllers['url_error_controll']->error_page_num) {
            $error_page_num = $this->controllers['url_error_controll']->error_page_num;
            $this->new_models('error_url_mod', $this->controllers);
            $this->new_models('lib_mod');
            $this->new_views('page_error_4xx');
            $this->models['error_url_mod']->views = $this->views;
            $this->models['error_url_mod']->error_is_mod = $this->models['lib_mod']->lib_error($error_page_num);
            $this->error_page_print = $this->models['error_url_mod']->in_err_num();
        }
    }

    public function chek_url_set_error() {
        $this->name[] = __METHOD__;
        // запрос не разобран исключаем все кроме a-zА-Я0-9-_ 
        if ($this->controllers['app_url_controll']->dir_url) {
            foreach ($this->controllers['app_url_controll']->dir_url as $value) {
                if (!preg_match('/^[a-zа-я0-9-_ ]+$/siu', urldecode($value))) {
                    $this->error_set(400);
                }
            }
        }
        if ($this->controllers['app_url_controll']->page_url) {
            if (!$this->controllers['app_url_controll']->is_file_check_true) {
                $this->error_set(404, '404 Not Found');
            }
        }
    }

}
