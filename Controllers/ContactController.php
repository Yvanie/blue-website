<?php

namespace BleuWebsite\Controllers;

use BleuWebsite\Models\Contact;

class ContactController extends Controller
{

    public function __construct(){
        $this->instance = new Contact();
    }
    public function lireAll(){
        $array['data']=[];
        $getContact=$this->instance->lireTout();
        if($getContact){
            foreach($getContact as $value){
                array_push($array['data'], $value);
            }
        }
        return $array;
    }
    public function lireOne(int $id): array{
        $array=[];
        $getContact=$this->instance->lireOne($id);
        if($getContact){
            $array[]=$getContact;
        }
        return $array;
    }
    public function lireBy(array $criteres){
        $array['data']=[];
        $getContact=$this->instance->lireBy($criteres);
        if($getContact){
            foreach($getContact as $value){
                array_push($array['data'], $value);
            }
        }
        return $array;
       
    }

    public function create(){
        $data=[];
        if($_POST){
            $dataSanit = [];
            foreach($_POST as $cle => $valeur){
                if(empty($valeur)){
                    $data = ['type'=>'error', 'message'=> "Veuillez remplir tous les champs"];
                    return $data;
                    exit;
                }
                $dataSanit[$cle] = htmlspecialchars($valeur);
            }
            $dataSanit['createAt']= date('Y-m-d H:i:s');
            $this->instance->hydrated($dataSanit)->Create();
            $data=['type'=> 'success', 'message'=> "L'information a bien été ajouté"];
        }
        return $data;
    }

    public function delete(int $id){
        $data=[];
            $this->instance->delete($id);
            $data=['type'=>'success', 'message'=>"contact a bien été supprimé"];
        return $data;
    }
    public function setRender()
    {    
        $myjs=[];
        
        if(isset($_SESSION['id'])){
            $myjs[]='Public/js/owner/contact';
            return $this->render("Backend/contact", [], $myjs , 'app');
        }else{
            $mycss=[];
            $myjs[]='Public/js/owner/contact-front';
            return $this->render("Frontend/contacts", $mycss, $myjs);
        }
        
    }

}
