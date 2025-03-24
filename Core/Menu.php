<?php
namespace BleuWebsite\Core;
class Menu {
    
    public static  function list($link, $icon, $text) {
        
        $getplink =explode('?p=', $link);
        $active = (isset($_GET['p']) && $_GET['p'] ==  $getplink[1]) ? 'active' : '';
        return '<li class="nav-item '.$active.'">
                    <a class="nav-link" href="'.$link.'" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-'.$icon.'"></i>
                    <span>'.$text.'</span></a>
                </li>';  
    }
}
?>