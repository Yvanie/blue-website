<?php

namespace BleuWebsite\Controllers;

class DashboardController extends Controller
{
    public function setRender()
    {
        if(isset($_SESSION['id'])){
            return $this->render("Backend/dashboard", [], [], 'app');
        }else{
            header('Location: index.php?p=login');

        }
    }

}
