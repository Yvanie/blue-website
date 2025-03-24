<?php
namespace BleuWebsite\Core;
use BleuWebsite\Core\Database;

class Models extends Database {
    protected $db;
    protected $table;

    public function __construct()
    {
      parent::__construct();  
    }
    public function lireTout($limit = null){
        $sql= "select * from ".$this->table. " ORDER BY id".ucfirst($this->table)." DESC";
                $sql .=(isset($limit) )? " LIMIT ".$limit:'';
        $query=$this->requete($sql);
        return $query->fetchAll();
    }
    
    /**
     * Lecture des enregistrements en fonction de crit res 
     *
     * @param array $criteres Tableau associatif cle=>valeur des crit res de recherche
     * @return array Tableau des enregistrements trouver
     */
    public function lireBy(array $criteres): array
    {
        
        $champs=[];
        $valeurs=[];
        foreach ($criteres as $cle => $valeur) {
            $champs[] = "$cle=?";
            $valeurs[]=$valeur;
        }
        $champsImploded=implode(" AND ", $champs);
        return $this->requete("select * from ".$this->table. " where ".$champsImploded, $valeurs)->fetchAll();        
    }
    
    /**
     * Retrieve a single record by ID from the table.
     *
     * @param int $id The ID of the record to retrieve.
     * @return object The fetched record as an object.
     */

    public function lireOne(int $id): object
    {

       $sql= "select * from ".$this->table." where id". ucfirst($this->table)."=?";
        $query=$this->requete($sql,  [$id]);
        return $query->fetch();
    }

    public function lireLast(){
        $sql = "SELECT LAST_INSERT_ID() as id FROM ".$this->table;
        $query=$this->requete($sql);
        return $query->fetch();
    }
    public function Create(){
      $questionMark=[];
      $champs=[];
      $valeurs=[];
      
      foreach ($this as $cle => $valeur) {
        if($valeur!==null && $cle!=="table"){
            $champs[] = $cle;
        $valeurs[]=$valeur;
        $questionMark[]='?';

        }
        
      }
      $listChamps=implode(', ', $champs);
      $listQuestionMark=implode(', ', $questionMark);
      $sql="insert into " .$this->table. ' (' .$listChamps. ') VALUES (' .$listQuestionMark. ')';
      return $this->requete($sql, $valeurs);
    }

    /**
     * Update a record in the table.
     *
     * @param int $id The ID of the record to update.
     * @return object The updated record as an object.
     */
    public function Update(int $id){
        $champs=[];
        $valeurs=[];
        foreach($this as $cle => $valeur){
            if($cle!=="table" && $valeur!==null && $cle!=="db"){
            $champs[] = $cle."=?";
            $valeurs[] = $valeur;
            }
        }
        $listChamps=implode(', ', $champs);
        $sql="Update " .$this->table. ' SET ' .$listChamps. ' where id'.ucfirst($this->table). '='.$id;
        return $this->requete($sql, $valeurs);
    }
    public function Delete(int $id){
        $sql="delete from ".$this->table." where id".ucfirst($this->table). '=?';
        return $this->requete($sql, [$id]); 
    }

    /**
     * Exécute une requête SQL.
     *
     * @param string $sql La requête SQL.
     * @param array $attributs Les attributs à passer à la requête.
     * @return PDOStatement La requête exécutée.
     */
    private function requete($sql, $attributs=array()){
        $this->db = Database::getInstance();
        $argsToexecute=($attributs)? $attributs: array();
        $query = $this->db->prepare($sql);
        $query->execute($argsToexecute);
        return $query;
    }

    public function hydrated(array $datas)
    {
        
        foreach($datas as $cle => $valeur){
            $setter='set'. ucfirst($cle);
            if (method_exists($this, $setter)){
                $this->$setter($valeur);
            }

        }
        return $this;
    }

}

