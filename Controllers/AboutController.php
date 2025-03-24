<?php

namespace BleuWebsite\Controllers;

class AboutController extends Controller
{
    public function setRender()
    {
        return $this->render("Frontend/about", [], []);
    }

}
