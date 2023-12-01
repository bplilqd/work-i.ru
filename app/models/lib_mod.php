<?php

namespace mvc;

class lib_mod {

    function fore_arr($arr, $type) {
        foreach ($arr as $k => $v) {
            if ($type == $k) {
                return $v;
            }
        }
    }

    // список ошибок url
    public function lib_error($type) {
        $arr = [
            404 => 'Not Found (Нет такой страницы)',
            400 => 'Bad Request'
        ];
        $result = $this->fore_arr($arr, $type);
        return $result;
    }

}
