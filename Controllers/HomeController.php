<?php

namespace BleuWebsite\Controllers;

class HomeController extends Controller
{
    public function setRender()
    {
        $myjs=[];
        $mycss=[];
        $myjs[]='Public/js/script';
        $myjs[]='Public/js/owner/home';
        return $this->render("Frontend/home", [], $myjs);
    }

}
