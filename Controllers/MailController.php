<?php

namespace BleuWebsite\Controllers;

use BleuWebsite\Models\Newsletters;
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
            $dataSanit['confirmtoken'] = $this->generate_uuid();
        }
        $dataSanit['createAt']= date('Y-m-d H:i:s');
        if($this->instance->hydrated($dataSanit)->Create()){
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
                    $mail->addAddress($dataSanit['email']);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = '📩 Confirmez votre adresse e-mail';  
                $mail->Body = 'Bonjour, <br><br>  
                Merci de vous être inscrit ! 🎉 Pour finaliser votre inscription et accéder à toutes nos nouveautés, veuillez confirmer votre adresse e-mail. 📧<br><br>  
                Cliquez sur le lien ci-dessous pour activer votre compte :<br><br>  
                👉 <a href="'.URL.'/index.php?p=confirm&token='.$dataSanit['confirmtoken'].'">Confirmer mon e-mail</a> 👈<br><br>  
                Si vous n’avez pas fait cette demande, ignorez simplement ce message. <br><br>  
                À bientôt ! 🚀';  

                $mail->send();
            } catch (Exception $e) {
            }
            $data = ['type'=>'success', 'message'=> "Vérifier votre boite mail pour confirmer votre inscription"];
        }
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
        
        
      //je ne peux pas parler.
      //nous etions au niveau du single page de la partie blog, vous etes la?
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
    

}
