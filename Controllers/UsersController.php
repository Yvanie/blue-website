<?php

namespace BleuWebsite\Controllers;

use BleuWebsite\Models\Users;

class UsersController extends Controller{

    public function __construct(){
        $this->instance=new Users;
    }



    public function lireAll(){
        
        $datas=[];
        $getDatas=$this->instance->lireTout();
        if($getDatas)
            $datas['data']=$getDatas;
        
        return $datas;      
    }

    public function lireBy(array $criterias){
        $datas=[];
        $datas['data']=[];
        $getDatas=$this->instance->lireBy($criterias);
        if($getDatas)
            foreach($getDatas as $valeur)
                array_push($datas['data'],$valeur);         
        return $datas;
    }
     public function lireone(int $id){
        $getDatas=$this->instance->lireOne($id);
        if($getDatas)
            return $getDatas;
     }

     public function delete(int $id){
        $data=[];
            $this->instance->delete($id);
            $data=['type'=>'success', 'message'=>"L'utilisareur a bien été supprimé"];
        return $data;
    }

     public function setrender(){

        $myjs[]='Public/js/owner/users';
        return $this->render("Backend/utilisateurs", [], $myjs, 'app');
     }


}