<?php

namespace BleuWebsite\Controllers;

use BleuWebsite\Models\Newsletters;

class unsubscribeController extends MailController
{
    public function __construct()
    {
        parent::__construct();

    }
    public function unsubscribe($params) {
      $data = [];
      
      // Vérification du token de désabonnement
      if (!isset($params['token'])) {
          $data = ['type' => 'error', 'message' => "Lien de désabonnement invalide."];
          return $data;
      }
  
      $newsletter = $this->instance->lireBy(['confirmtoken' => $params['token']]);
      
      if ($newsletter && !empty($newsletter)) {
          if ($this->instance->delete($newsletter[0]->idNewsletters)) {
              $data = [
                  'type' => 'success', 
                  'message' => "Vous avez été désabonné avec succès de notre newsletter.",
                  'regret' => "Nous sommes sincèrement désolés de vous voir partir ! 😢 <br><br>
                             Nous espérons que nos newsletters vous ont été utiles jusqu'à présent. 
                             Si vous souhaitez nous faire part de vos suggestions d'amélioration, 
                             n'hésitez pas à nous contacter. <br><br>
                             Vous pouvez toujours vous réabonner à tout moment pour ne rien manquer 
                             de nos actualités et offres exclusives. <br><br>
                             À bientôt nous l'espérons ! 🤝"
              ];
          } else {
              $data = ['type' => 'error', 'message' => "Une erreur est survenue lors du désabonnement."];
          }
      } else {
          $data = ['type' => 'error', 'message' => "Lien de désabonnement invalide ou expiré."];
      }
      return $data;
  }

  public function Supprimer(){
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

    if($this->unsubscribe($_GET)['type']=="error"){
      header("index.php?p=home");
    }else{
      $myjs=[];
      $mycss=[];
      $myjs[]='Public/js/owner/confirm';
      return $this->render("Frontend/unsubscribe", $this->unsubscribe($_GET), $myjs, 'default'); 
    }
  }
}

