<?php

namespace Workiru\mvc;

class page_error_4xx {

    public $check_view;

    public function page_wiew($num, $text) {
        $str = '<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  <title>' . $num .' '. $text . '</title>
 </head>
 <body>
  <p>' . $num .' '. $text . '</p>
 </body>
</html>';
        $this->check_view = $str;
    }

}
