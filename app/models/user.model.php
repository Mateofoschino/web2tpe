<?php
class UserModel extends Model {
    protected $db;

function __construct(){
    $this->db = new PDO('mysql:host=localhost;dbname=goleadores;charset=utf8', 'root', '');
}

    public function getByUsername ($username){
        $query= $this->db->prepare('SELECT * FROM usuarios WHERE username = ?');
        $query->execute([$username]);
        
    return $query->fetch(PDO::FETCH_OBJ);
    }
}

