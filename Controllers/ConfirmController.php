<?php

namespace BleuWebsite\Controllers;

use BleuWebsite\Models\Newsletters;

class ConfirmController extends MailController
{
    public function __construct()
    {
        parent::__construct();
    }

  public function enableMail($tokenconfirm){
    $subscriber=new Newsletters();   
    $id=$subscriber->lireBy(['tokenconfirm'=>$tokenconfirm])[0]->idNewsletter;
    $subscriber->setStatus('enabled')->update();
  }

    public function setRender()
    { 
        $myjs=[];
        
        if(isset($_SESSION['id'])){
            $myjs[]='Public/js/owner/confirm';
            return $this->render("Frontend/confirm", [], $myjs, 'app'); 
        }
    }
}

