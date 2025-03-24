<?php

namespace BleuWebsite\Controllers;

use BleuWebsite\Models\Profile;

class ProfileController extends Controller
{
    public function __construct(){
        $this->instance = new Profile();
    }
    
    public function lireAll(){
        $array['data']=[];
        $getProfile=$this->instance->lireTout();
        if($getProfile){
            foreach($getProfile as $value){
                array_push($array['data'], $value);
            }
        }
        return $array;
    }
    public function lireOne(int $id): array{
        $array=[];
        $getProfile=$this->instance->lireOne($id);
        if($getProfile){
            $array[]=$getProfile;
        }
        return $array;
    }
    public function lireBy(array $criteres){
        $array['data']=[];
        $getProfile=$this->instance->lireBy($criteres);
        if($getProfile){
            foreach($getProfile as $value){
                array_push($array['data'], $value);
            }
        }
        return $array;
       
    }
    public function setRender()
    {
        return $this->render("Backend/profile", [], [], 'app');
    }

}