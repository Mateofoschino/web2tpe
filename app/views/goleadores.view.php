<?php

class goleadoresView {
    function showGoleadores($goleadores) {
        require './templates/lista_goleadores.phtml';
    }

    function showClubes($clubes) {
        require './templates/clubes.phtml';
    }

    function showDetails($goleadores){
        require './templates/goleadores_detalles.phtml';
    }
    function showEdit($Jugador_ID){
        require './templates/modificar_goleadores.phtml';
    }
    function showEditClub($Club_ID){
        require './templates/modificar_club.phtml';
    }
    function showEditError($Jugador_ID,$error){
        require './templates/modificar_goleadores.phtml';
    }
    public function showError($error) {
        require './templates/error.phtml';
    }

    function showJugadoresByClub($goleadores,$club){
        require './templates/mostrarJugadoresPorClub';
    }
}