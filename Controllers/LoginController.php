<?php

namespace BleuWebsite\Controllers;
use BleuWebsite\Models\Users;

class LoginController extends Controller
{
    public function auth(){
        $data=[];
        $email=htmlentities(trim($_POST['email']));
        $password=htmlentities(trim($_POST['password']));
        if (empty($email) || empty($password)) {
            return [
                'type'=>"error",
                'message'=>"Veuillez remplir tous les champs"
            ];
            die();
        } 
        $user=new Users();
        $getUsers=$user->lireBy(['email'=>$email]);
        if($getUsers){
            $passwordVerify=password_verify($password, $getUsers[0]->password);
            if($passwordVerify){
                $_SESSION['id']=$getUsers[0]->idUsers;
                return [
                    'type'=>"success",
                    'message'=>"Vous êtes connecté"
                ];
            }else{
                return [
                    'type'=>"error",
                    'message'=>"Mot de passe ou email est incorrect"
                ];
            }
        }
        else{
            return[
                 'type'=>"error",
                    'message'=>"Mot de passe ou email est incorrect"
            ];
        }
    }
    public function setRender()
    {
        if(isset($_SESSION['id'])){
            session_destroy();
            unset($_SESSION['id']);
        }
        
        $filename="Backend/login";
        return $this->render($filename, [], ['Public/js/owner/login'], 'app');
    }

    public function logout(){
        session_destroy();
        unset($_SESSION['id']);
        header('Location: index.php?p=login');
    }


}

