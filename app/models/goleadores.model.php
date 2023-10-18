<?php
require_once './database/model.php';
class goleadoresModel extends Model{
    protected $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=goleadores;charset=utf8', 'root', '');
    }

    function getClubes() {
        $query = $this->db->prepare('SELECT * FROM clubes');
        $query->execute();
        $clubes = $query->fetchAll(PDO::FETCH_OBJ);

        return $clubes;
    }

    function getGoleadores() {
        $query = $this->db->prepare('SELECT * FROM goleadores');
        $query->execute();
        $goleadores = $query->fetchAll(PDO::FETCH_OBJ);

        return $goleadores;
    }

    public function getClub($id) {
        $query= $this->db->prepare('SELECT * FROM clubes  WHERE Club_ID = ?');
        $query->execute([$id]);
        $club= $query->fetch(PDO::FETCH_OBJ);

        return $club;
    }

    function getDetailsById($Jugador_ID) {
        $query = $this->db->prepare('SELECT * FROM goleadores where Jugador_ID = ?');
        $query->execute([$Jugador_ID]);
        $details = $query->fetchAll(PDO::FETCH_OBJ);
        return $details;
    }

    function getJugadoresByClub($Jugador_ID) {
        $query = $this->db->prepare('SELECT * FROM goleadores where Club = ?');
        $query->execute([$Jugador_ID]);
        $jugadores = $query->fetchAll(PDO::FETCH_OBJ);
        return $jugadores;
    }

    function insertGoleador($nombre, $club, $goles, $pj) {
        $query = $this->db->prepare('INSERT INTO goleadores (nombre, club, goles, pj) VALUES (?, ?, ?, ?)');
        $query->execute([$nombre, $club, $goles, $pj]);
        return $this->db->lastInsertId();
    }

    function insertClub($club, $liga) {
        $query = $this->db->prepare('INSERT INTO clubes (Nombre, Liga) VALUES (?, ?)');
        $query->execute([$club, $liga]);
        return $this->db->lastInsertId();
    }

    function deleteGoleador($id_goleadores) {
        $query = $this->db->prepare('DELETE FROM goleadores WHERE Jugador_ID = ?');
        $query->execute([$id_goleadores]);
    
    }

    function deleteClub($id) {
        $query = $this->db->prepare('DELETE FROM clubes WHERE Club_ID = ?');
        $query->execute([$id]);
    
    }

    function modifyGoleador ($nombre, $club, $goles, $pj, $Jugador_ID){
        $query = $this->db->prepare('UPDATE goleadores SET Nombre = ?, Club = ?, Goles = ?, PJ = ? WHERE Jugador_ID = ?');
        $query->execute([$nombre, $club, $goles, $pj, $Jugador_ID]);   
        return $query;
    }
    function modifyClub ($nombre, $liga, $club_ID){
        $query = $this->db->prepare('UPDATE clubes SET Nombre = ?, Liga = ? WHERE Club_ID = ?');
        $query->execute([$nombre, $liga, $club_ID]);   
        return $query;
    }
}