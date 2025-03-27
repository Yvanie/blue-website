<?php

namespace BleuWebsite\Controllers;

use BleuWebsite\Models\Newsletters;
use BleuWebsite\Models\Blogs;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailController extends Controller
{

    public function __construct(){
        $this->instance = new Newsletters();
    }
    public function lireAll(){
        $array['data']=[];
        $getNewsletters=$this->instance->lireTout();
        if($getNewsletters){
            foreach ($getNewsletters as $value) {
                array_push($array['data'], $value);
        }
    }
    return $array;
}

public function lireOne(int $id): array{
    $array=[];
    $getNewsletters=$this->instance->lireOne($id);
    if($getNewsletters){
        $array[]=$getNewsletters;
    }
    return $array;
}
public function lireBy(array $criteres){
    $array['data']=[];
    $getNewsletters=$this->instance->lireBy($criteres);
    if($getNewsletters){
        foreach($getNewsletters as $value){
            array_push($array['data'], $value);
        }
    }
    return $array;
   
}

public function create(){
    $data = [];
    if($_POST){
        $dataSanit = [];
        foreach($_POST as $cle => $valeur){
            if(empty($valeur)){
                return ['type' => 'error', 'message' => "Veuillez remplir tous les champs"];
            }
            $dataSanit[$cle] = htmlspecialchars($valeur);
        }

        // Vérifier si l'email existe déjà
        $existingEmail = $this->instance->lireBy(['email' => $dataSanit['email']]);
        if($existingEmail && count($existingEmail) > 0) {
            return ['type' => 'error', 'message' => "Cette adresse email est déjà inscrite à la newsletter"];
        }

        // Si l'email n'existe pas, continuer avec l'inscription
        $dataSanit['confirmtoken'] = $this->generate_uuid();
        $dataSanit['createAt'] = date('Y-m-d H:i:s');
        
        if($this->instance->hydrated($dataSanit)->Create()){
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'nwouatouyvanienoelle@gmail.com';
                $mail->Password   = 'rkyy iewa ozhj uqek';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;

                //Recipients
                $mail->setFrom('nwouatouyvanienoelle@gmail.com', 'Blue Ocean Group');
                $mail->addAddress($dataSanit['email']);

                //Content
                $mail->isHTML(true);
                $mail->Subject = '📩 Confirmez votre adresse e-mail';
                $mail->Body = 'Bonjour, <br><br>  
                Merci de vous être inscrit ! 🎉 Pour finaliser votre inscription et accéder à toutes nos nouveautés, veuillez confirmer votre adresse e-mail. 📧<br><br>  
                Cliquez sur le lien ci-dessous pour activer votre compte :<br><br>  
                👉 <a href="'.URL.'/index.php?p=confirm&token='.$dataSanit['confirmtoken'].'">Confirmer mon e-mail</a> 👈<br><br>  
                Si vous n\'avez pas fait cette demande, ignorez simplement ce message. <br><br>  
                À bientôt ! 🚀';

                $mail->send();
                return ['type' => 'success', 'message' => "Vérifier votre boite mail pour confirmer votre inscription"];
            } catch (Exception $e) {
                return ['type' => 'error', 'message' => "Une erreur est survenue lors de l'envoi du mail"];
            }
        }
        return ['type' => 'error', 'message' => "Une erreur est survenue lors de l'inscription"];
    }
    return $data;
}
public function delete(int $id){
    $data=[];
        $this->instance->delete($id);
        $data=['type'=>'success', 'message'=>"Le mail a bien été supprimé"];
    return $data;
}
    public function setRender()
    { 
        $myjs=[];
        
        if(isset($_SESSION['id'])){
            $myjs[]='Public/js/owner/mail';
            return $this->render("Backend/mail", [], $myjs, 'app'); 
        }
        
        
      }

    private function generate_uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            // 16 bits for "time_mid"
            mt_rand( 0, 0xffff ),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand( 0, 0x0fff ) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand( 0, 0x3fff ) | 0x8000,
            // 48 bits for "node"
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
    

public function confirmEmail($token) {
    $data = [];
    $newsletter = $this->instance->lireBy(['confirmtoken' => $token]);
    
    if ($newsletter) {
        $updateData = [
            'status' => 'enabled',
            'confirmtoken' => null
        ];
        if ($this->instance->hydrated($updateData)->Update($newsletter[0]['idNewsletters'])) {
            $data = ['type' => 'success', 'message' => "Votre email a été confirmé avec succès !"];
        } else {
            $data = ['type' => 'error', 'message' => "Une erreur est survenue lors de la confirmation."];
        }
    } else {
        $data = ['type' => 'error', 'message' => "Token de confirmation invalide."];
    }
    return $data;
}

public function sendNewsletter() {
    $data = [];
    $blogs = new Blogs();
    $latestBlogs = $blogs->lireTout();
    
    $subscribers = $this->instance->lireBy(['status' => 'enabled']);
    
    if ($subscribers) {
        foreach ($subscribers as $subscriber) {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'nwouatouyvanienoelle@gmail.com';
                $mail->Password = 'rkyy iewa ozhj uqek';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                // Création d'un token de désabonnement unique
                $unsubscribeToken = $this->generate_uuid();
                
                // Mise à jour du token dans la base de données
                $this->instance->hydrated(['confirmtoken' => $unsubscribeToken])->Update($subscriber['idNewsletters']);

                // Content
                $mail->isHTML(true);
                $mail->Subject = '📰 Les dernières actualités de Blue Ocean Group';
                
                // Création du contenu HTML
                $htmlContent = '<div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">';
                $htmlContent .= '<h1 style="color: #1a73e8;">Les dernières actualités de Blue Ocean Group</h1>';
                $htmlContent .= '<p>Bonjour,</p>';
                $htmlContent .= '<p>Voici les dernières actualités de notre blog :</p>';
                
                foreach ($latestBlogs as $blog) {
                    $htmlContent .= '<div style="margin: 20px 0; padding: 15px; border: 1px solid #e0e0e0; border-radius: 5px;">';
                    $htmlContent .= '<h2 style="color: #333;">' . htmlspecialchars($blog['title']) . '</h2>';
                    $htmlContent .= '<p style="color: #666;">' . substr(htmlspecialchars($blog['content']), 0, 150) . '...</p>';
                    $htmlContent .= '<a href="' . URL . '/index.php?p=blog&id=' . $blog['idBlogs'] . '" style="color: #1a73e8; text-decoration: none;">Lire la suite →</a>';
                    $htmlContent .= '</div>';
                }
                
                // Ajout du footer avec lien de désabonnement sécurisé
                $htmlContent .= '<div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">';
                $htmlContent .= '<p style="color: #666; font-size: 14px; margin-bottom: 10px;">Vous recevez cet email car vous êtes abonné à notre newsletter.</p>';
                $htmlContent .= '<p style="color: #666; font-size: 14px;">Pour vous désabonner, <a href="' . URL . '/index.php?p=unsubscribe&token=' . $unsubscribeToken . '" style="color: #dc3545; text-decoration: underline;">cliquez ici</a>.</p>';
                $htmlContent .= '</div>';
                $htmlContent .= '</div>';
                
                $mail->Body = $htmlContent;
                $mail->send();
            } catch (Exception $e) {
                $data = ['type' => 'error', 'message' => "Erreur lors de l'envoi de la newsletter : " . $e->getMessage()];
            }
        }
        $data = ['type' => 'success', 'message' => "Newsletter envoyée avec succès !"];
    }
    return $data;
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
        if ($this->instance->delete($newsletter[0]['idNewsletters'])) {
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

}
