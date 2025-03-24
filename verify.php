<?php

$mdp=12345;

echo password_hash($mdp, PASSWORD_BCRYPT);


/* <?php

namespace BleuWebsite\Controllers;

use BleuWebsite\Models\Blogs;

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
   
     * Retrieve a single blog post by its ID.
     *
     * @param int $id The ID of the blog post to retrieve.
     * @return array The blog post data as an associative array, or an empty array if not found.
    

    public function lireOne(int $id): array{
        $array=[];
        $getBlog=$this->instance->lireOne($id);
        if($getBlog){
            $array[]=$getBlog;
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
            
            $this->instance->hydrated($dataSanit)->Create();
            $data=['type'=>'success', 'message'=>"Le blog a bien été ajouté"];
        }
        return $data;
    }
    public function update(){
        $data=[];
        if($_POST){
            $dataSanit=[];
            foreach($_POST as $cle => $valeur){
                $dataSanit[$cle]=htmlentities(trim($valeur));
        }
        $this->instance->hydrated($dataSanit)->Update($dataSanit['idBlogs']);
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
        $myjs[]='Public/js/owner/blogs';
        
        return $this->render("Backend/blogs", [], $myjs, 'app');
    }


}*/
 