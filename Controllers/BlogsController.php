<?php

namespace BleuWebsite\Controllers;

use BleuWebsite\Models\Blogs;
use BleuWebsite\Models\Newsletters;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class BlogsController extends Controller
{
    public function __construct(){
        $this->instance = new Blogs();
    }
    public function lireAll(){
       $array['data']=[];
       $getBlogs=$this->instance->lireTout();
        if($getBlogs){
            foreach($getBlogs as $value){
                array_push($array['data'], $value);
            }
        }
        return $array;
    }
    public function lireRecent(){
        $array['data']=[];
        $getBlogs=$this->instance->lireTout(4);
         if($getBlogs){
             foreach($getBlogs as $value){
                 array_push($array['data'], $value);
             }
         }
         return $array;
     }
    /**
     * Retrieve a single blog post by i
     * @param int $id The ID of the blog post to retrieve.
     * 
     */

    public function lireOne(int $id){
        $array=[];
        $getBlog=$this->instance->lireOne($id);
        if($getBlog){
            $getBlog->content=html_entity_decode($getBlog->content);
            $getBlog->title=html_entity_decode($getBlog->title);
            $array=$getBlog;
        }
        return $array;
    }
    public function lireBy(array $criteres){
        $array['data']=[];
        $getBlogs=$this->instance->lireBy($criteres);
        if($getBlogs){
            foreach($getBlogs as $value){
                array_push($array['data'], $value);
            }
        }
        return $array;
       
    }
    public function create(){
        $data=[];   
        if($_POST){
            $dataSanit=[];
            foreach($_POST as $cle => $valeur){
                if(empty($valeur)){
                    $data = ['type'=>'error', 'message'=>"Veuillez remplir tous les champs"];
    
                    return $data;
                    die();
                }
                if($cle != 'image'){
                    $dataSanit[$cle] = htmlspecialchars($valeur);
                }
              
            }
            $allowedExtension = ['jpg', 'jpeg', 'png', 'avif', 'webp'];
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);           
            
            if(!in_array($extension, $allowedExtension)){
                $data = ['type'=>'error', 'message'=>"L'extension de l'image n'est pas autorisée"];
                return $data;
                die();
            }
            $imagePath = 'Public/img/blogs/'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            $dataSanit['image'] = $imagePath;
            $dataSanit['createAt']=date('Y-m-d H:i:s');
            
            if($this->instance->hydrated($dataSanit)->Create()){
                $newsletter = new Newsletters;
                $getContact = $newsletter->lireTout();
                if($getContact  && count($getContact) > 0){
                $lastId = $this->instance->lireLast()->id;
                $mail = new PHPMailer(true);
            try {
                //Server settings
                                 //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'nwouatouyvanienoelle@gmail.com';                     //SMTP username
                $mail->Password   = 'rkyy iewa ozhj uqek';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('nwouatouyvanienoelle@gmail.com', 'Blue Ocean Group');
                foreach($getContact as $value){
                    $mail->addAddress($value->email);
                 

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'New Post';
                $mail->Body = '🎉 Nouveauté ! 🎉 <br><br>  
                    J’ai publié de nouveaux contenus passionnants que vous ne voudrez pas manquer ! 🔥 <br><br>  
                    Je peux même vous partager un extrait exclusif. 💡  
                    Découvrez les dernières mises à jour dès maintenant ! 🚀<br><br>  
                    👉 <a href="'.URL.'/index.php?p=blogs&id='.$lastId.'">Cliquez ici pour en savoir plus</a> 👈<br><br>
                    <p>Si vous ne voullez plus recevoir ces notifications, vous pouvez vous désabonner en cliquant sur le lien ci-dessous :
                        </p><br><br>
                    <a href="'.URL.'/index.php?p=unsubscribe&token='.$value->confirmtoken.'">Désabonner</a><br><br>
                    À très vite et merci pour votre soutien ! 💙';
                $mail->send();
            }
            } catch (Exception $e) {
            }}
                $data=['type'=>'success', 'message'=>"Le blog a bien été ajouté"];
            }
        }
        return $data;
    }
    public function update(){
        $data=[];   
        if($_POST){
            $dataSanit=[];
            foreach($_POST as $cle => $valeur){
                if(empty($valeur)){
                    if($cle !== 'image'){
                        continue;
                    }else{
                        $data = ['type'=>'error', 'message'=>"Veuillez remplir tous les champs"];
    
                    return $data;
                    die();
                        
                    }
                    
                }
                if($cle != 'image'){
                    $dataSanit[$cle] = htmlentities(trim($valeur));
                }
              
            }


            if(!empty($_FILES['image']['name'])){
                

            $allowedExtension = ['jpg', 'jpeg', 'png', 'avif', 'webp'];
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                     
            
            if(!in_array($extension, $allowedExtension)){
                $data = ['type'=>'error', 'message'=>"L'extension de l'image n'est pas autorisée"];
                return $data;
                die();
            }
            $imagePath = 'Public/img/blogs/'.$_FILES['image']['name'];
            
            if(move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)){
                $dataSanit['image'] = $imagePath;
                ($this->instance->lireOne($_POST['idBlogs'])->image) ? unlink($this->instance->lireOne($_POST['idBlogs'])->image) : '';
                

            }else{ 
                return ['type'=>'error', 'message'=>"Une erreur s'est produite lors de l'upload de l'image"];
                exit;
            }
            
        }
        
            $dataSanit['updateAt']=date('Y-m-d H:i:s');
                        
            $this->instance->hydrated($dataSanit);
            $this->instance->update($dataSanit['idBlogs']);
            $data=['type'=>'success', 'message'=>"Le blog a bien été modifié"];
        }
        return $data;
    }
    public function delete(int $id){
        $data=[];
            $this->instance->delete($id);
            $data=['type'=>'success', 'message'=>"Le blog a bien été supprimé"];
        return $data;
    }
    public function setRender()
    {

        $myjs=[];
        if(isset($_SESSION['id'])){
            $myjs[]='Public/js/owner/blogs';
            return $this->render("Backend/blogs", [], $myjs, 'app');
        }else{
            $myjs[]='Public/js/script';
        $myjs[]='Public/js/owner/blog';
        $filename=(isset($_GET['id']))? 'Frontend/single_post': 'Frontend/blog';
        return $this->render($filename, [],  $myjs);
        }
        
        
    }


}
