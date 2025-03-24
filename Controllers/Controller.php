<?php

namespace BleuWebsite\Controllers;

class Controller
{
    public $instance;
    public function render($filename, $mycss, $myjs, $template="default"){
        ob_start();
        include "Views/".$filename.'.php';
        $content = ob_get_clean();
        include "Views/Templates/".$template.'.php';
    }
}
