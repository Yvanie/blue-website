<?php

namespace BleuWebsite\Controllers;

class ServiceController extends Controller
{
    public function setRender()
    {
        return $this->render("Frontend/service", [], ['Public/js/script']);
    }

}
