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
    $getInfo=$subscriber->lireBy(['confirmtoken'=>$_GET['token'], 'status'=>'disabled'])[0];
    if($getInfo){
      if($subscriber->setStatus('enabled')->update($getInfo->idNewsletters)){
        
        return ["email"=>$getInfo->email];
      }
    }else{
      return ["email"=>"error"];
    }
  }
  public function setRender(){

    if($this->enableMail($_GET['token'])['email']=="error"){
      header("index.php?p=home");
    }else{
      $myjs=[];
      $mycss=[];
      $myjs[]='Public/js/owner/confirm';
      return $this->render("Frontend/confirm", [], $myjs, 'default'); 
    }
  }
}

