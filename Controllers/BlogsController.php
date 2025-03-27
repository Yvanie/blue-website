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
                // Décode le contenu HTML
                $content = html_entity_decode($value->content);
                // Nettoie les balises HTML
                $cleanContent = strip_tags($content);
                // Limite le contenu à 150 caractères et ajoute "..."
                $value->content = mb_strlen($cleanContent) > 150 ? 
                    mb_substr($cleanContent, 0, 150) . '...' : 
                    $cleanContent;
                
                // Décode aussi le titre
                $value->title = html_entity_decode($value->title);
                
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
                // Décode le contenu HTML
                $content = html_entity_decode($value->content);
                // Nettoie les balises HTML
                $cleanContent = strip_tags($content);
                // Limite le contenu à 150 caractères
                $value->content = mb_strlen($cleanContent) > 150 ? 
                    mb_substr($cleanContent, 0, 150) . '...' : 
                    $cleanContent;
                
                // Décode aussi le titre
                $value->title = html_entity_decode($value->title);
                
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
        if(!$_POST) {
            return ['type' => 'error', 'message' => "Aucune donnée reçue"];
        }

        $dataSanit = [];
        foreach($_POST as $cle => $valeur) {
            if(empty($valeur) && $cle !== 'image') {
                return ['type' => 'error', 'message' => "Veuillez remplir tous les champs"];
            }
            if($cle !== 'image') {
                $dataSanit[$cle] = htmlspecialchars($valeur);
            }
        }

        // Récupérer l'image depuis le champ caché
        if(!empty($_POST['image'])) {
            $dataSanit['image'] = $_POST['image'];
        } else {
            return ['type' => 'error', 'message' => "L'image est obligatoire"];
        }

        $dataSanit['createAt'] = date('Y-m-d H:i:s');
        
        if($this->instance->hydrated($dataSanit)->Create()) {
            // Gestion des newsletters
            $this->sendNewsletterNotification();
            return ['type' => 'success', 'message' => "Le blog a bien été ajouté"];
        }

        return ['type' => 'error', 'message' => "Erreur lors de l'ajout du blog"];
    }
    public function update(){
        if(!$_POST) {
            return ['type' => 'error', 'message' => "Aucune donnée reçue"];
        }

        $dataSanit = [];
        foreach($_POST as $cle => $valeur) {
            if(empty($valeur) && $cle !== 'image') {
                continue;
            }
            if($cle !== 'image') {
                $dataSanit[$cle] = htmlentities(trim($valeur));
            }
        }

        // Gestion de l'image
        if(!empty($_POST['image'])) {
            $dataSanit['image'] = $_POST['image'];
            // Supprimer l'ancienne image si elle existe
            $oldBlog = $this->instance->lireOne($_POST['idBlogs']);
            if($oldBlog && $oldBlog->image && file_exists($oldBlog->image)) {
                unlink($oldBlog->image);
            }
        }

        $dataSanit['updateAt'] = date('Y-m-d H:i:s');
        
        if($this->instance->hydrated($dataSanit)->update($dataSanit['idBlogs'])) {
            return ['type' => 'success', 'message' => "Le blog a bien été modifié"];
        }

        return ['type' => 'error', 'message' => "Erreur lors de la modification du blog"];
    }
    public function delete(int $id){
        $data=[];
            $this->instance->delete($id);
            $data=['type'=>'success', 'message'=>"Le blog a bien été supprimé"];
        return $data;
    }
    public function setRender()
    {
        $mycss=[];
        $myjs=[];
        if(isset($_SESSION['id'])){
            $mycss[]="https://unpkg.com/dropzone@5/dist/min/dropzone.min";
            $myjs[]="https://unpkg.com/dropzone@5/dist/min/dropzone.min";
            $myjs[]='https://cdn.tiny.cloud/1/f1y7v7150ns3o85ca97imus6o7g98tojv2da2ezc4u8v78ov/tinymce/7/tinymce.min';
            $myjs[]='Public/js/owner/blogs';
            return $this->render("Backend/blogs", $mycss, $myjs, 'app');
        }else{
            $myjs[]='Public/js/script';
        $myjs[]='Public/js/owner/blog';
        $filename=(isset($_GET['id']))? 'Frontend/single_post': 'Frontend/blog';
        return $this->render($filename, [],  $myjs);
        }
        
        
    }
    public function uploadImage() {
        $response = ['success' => false, 'filename' => ''];
        
        if(isset($_FILES['image'])) {
            $allowedExtension = ['jpg', 'jpeg', 'png', 'avif', 'webp'];
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            
            if(in_array($extension, $allowedExtension)) {
                $filename = uniqid() . '.' . $extension;
                $imagePath = 'Public/img/blogs/' . $filename;
                
                if(move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                    return [
                        'type' => 'success',
                        'filename' => $imagePath
                    ];
                }
            }
        }
        return [
            'type' => 'error',
            'message' => "L'upload de l'image a échoué"
        ];
    }

    private function sendNewsletterNotification() {
        try {
            $newsletter = new Newsletters;
            $getContact = $newsletter->lireBy(['status' => 'enabled']);
            if(!$getContact || count($getContact) === 0) {
                return;
            }

            $lastId = $this->instance->lireLast()->id;
            $mail = new PHPMailer(true);

            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'nwouatouyvanienoelle@gmail.com';
            $mail->Password = 'rkyy iewa ozhj uqek';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Configuration de l'expéditeur
            $mail->setFrom('nwouatouyvanienoelle@gmail.com', 'Blue Ocean Group');
            
            // Contenu du mail
            $mail->isHTML(true);
            $mail->Subject = 'New Post';
            
            foreach($getContact as $value) {
                $mail->addAddress($value->email);
                $mail->Body = $this->getNewsletterTemplate($lastId, $value->confirmtoken);
                $mail->send();
                $mail->clearAddresses();
            }
        } catch (Exception $e) {
            // Gérer silencieusement l'erreur d'envoi de newsletter
            return;
        }
    }

    private function getNewsletterTemplate($lastId, $confirmToken) {
        return '🎉 Nouveauté ! 🎉 <br><br>
            J\'ai publié de nouveaux contenus passionnants que vous ne voudrez pas manquer ! 🔥 <br><br>
            Je peux même vous partager un extrait exclusif. 💡
            Découvrez les dernières mises à jour dès maintenant ! 🚀<br><br>
            👉 <a href="'.URL.'/index.php?p=blogs&id='.$lastId.'">Cliquez ici pour en savoir plus</a> 👈<br><br>
            <p>Si vous ne voulez plus recevoir ces notifications, vous pouvez vous désabonner en cliquant sur le lien ci-dessous :</p><br><br>
            <a href="'.URL.'/index.php?p=unsubscribe&token='.$confirmToken.'">Désabonner</a><br><br>
            À très vite et merci pour votre soutien ! 💙';
    }
}
