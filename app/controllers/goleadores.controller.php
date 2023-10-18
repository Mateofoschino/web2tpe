<?php

require_once './app/models/goleadores.model.php';
require_once './app/views/goleadores.view.php';

class GoleadoresController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new GoleadoresModel();
        $this->view = new GoleadoresView();
    }

    public function showClubes() {
        $clubes = $this->model->getClubes();
        $this->view->showClubes($clubes);
        
    }
   

    public function showGoleadores() {
        $goleadores = $this->model->getGoleadores();
        
        $this->view->showGoleadores($goleadores);
        
    }
    public function showDetails($id_goleadores){
        $detailsGoleadores = $this->model->getDetailsById($id_goleadores);
        $this->view->showDetails($detailsGoleadores);
    }
    public function addGoleador(){
        AuthHelper::verify();
        $nombre = $_POST['Nombre'];
        $club = $_POST['Club'];
        $goles = $_POST['Goles'];
        $pj = $_POST['PJ'];
        
        

    $this->model->insertGoleador($nombre, $club, $goles, $pj);
        header('Location: ' . BASE_URL);
    }

    public function addClub(){
        AuthHelper::verify();
        $club = $_POST['Club'];
        $liga = $_POST['Liga'];
        
        
        $this->model->insertClub($club, $liga);
        header('Location: ' . BASE_URL);
    }

    public function removeClub ($id) {
        $this->model->deleteClub($id);
        header('Location: ' . BASE_URL . 'clubes');
    }


    public function removeGoleador ($id_goleadores) {
        $this->model->deleteGoleador($id_goleadores);
        header('Location: ' . BASE_URL);
    }

    /*public function editJugador($id_jugador) {
        AuthHelper::verify();
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $this->view->showEdit($id_jugador);
        } else if($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['Nombre'];
            $club = $_POST['Club'];
            $goles = $_POST['Goles'];
            $pj = $_POST['PJ']; 

            $this->model->modifyGoleador($nombre, $club, $goles, $pj,$id_jugador);
            header('Location: ' . BASE_URL);
        }
       
        
    }*/

    public function showEditClub($club_ID){
        
        $this->view->showEditClub($club_ID);
    }

    public function showEdit($id_goleadores){
        
        $this->view->showEdit($id_goleadores);
    }

    public function editJugador($Jugador_ID){
        AuthHelper::verify();
        $this->view->showEdit($Jugador_ID);
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['Nombre'];
            $club = $_POST['Club'];
            $goles = $_POST['Goles'];
            $pj = $_POST['PJ'];
        }
        if (empty($nombre) || empty($club) || empty($goles) || empty($pj)) {
            header('Location: ' . BASE_URL); //si no completas los campos te devuelve a home
        }
        else{
            $this->model->modifyGoleador($nombre, $club, $goles, $pj,$Jugador_ID);
            header('Location: ' . BASE_URL);
        }
    }

    public function editClub($club_ID){
        AuthHelper::verify();
        $this->view->showEditClub($club_ID);
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['Nombre'];
            $liga = $_POST['Liga'];
            
        }
        if (empty($nombre) || empty($liga)) {
            header('Location: ' . BASE_URL . 'clubes'); //si no completas los campos te devuelve a home
        }
        else{
            $this->model->modifyClub($nombre, $liga,$club_ID);
            header('Location: ' . BASE_URL . 'clubes');
        }
    }

    public function showBuscarPorClub($id){
        $goleadores = $this->model->getJugadoresByClub($id);
        $club = $this->model->getClub($id);
        $this->view->showJugadoresByClub($goleadores, $club);
    }

    
}