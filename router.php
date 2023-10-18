<?php

require_once './app/controllers/goleadores.controller.php';
require_once './app/controllers/auth.controller.php';


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$action = 'home'; // accion por defecto
if (!empty($_GET['action'])) {
  $action = $_GET['action'];
}

// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
  case 'home':
    $jugadorController = new GoleadoresController();
    $jugadorController->showGoleadores();
    break;
  case 'login':
    $AuthController = new AuthController();
    $AuthController->showLogin();
    break;
  case 'validate':
    $AuthController = new AuthController();
    $AuthController->auth();
    break;
  case 'logout':
    $AuthController = new AuthController();
    $AuthController->logout();
    break;
  case 'details':
    $jugadorController = new GoleadoresController();
    $jugador = $params[1];
    $jugadorController->showDetails($jugador);
    break;
  case 'add':
    $jugadorController = new GoleadoresController();
    $jugadorController->addGoleador();
    break;
  case 'addClub':
    $jugadorController = new GoleadoresController();
    $jugadorController->addClub();
    break;
  case 'delete':
    $jugadorController = new GoleadoresController();
    $jugador = $params[1];
    $jugadorController->removeGoleador($jugador);
    break;
  case 'deleteClub':
    $jugadorController = new GoleadoresController();
    $club = $params[1];
    $jugadorController->removeClub($club);
    break;
  case 'preModifyClub':
    $jugadorController = new GoleadoresController();
    $club = $params[1];
    $jugadorController->showEditClub($club);
    break;

  case 'preModify':
    $jugadorController = new GoleadoresController();
    $jugador = $params[1];
    $jugadorController->showEdit($jugador);
    break;
  case 'modify':
    $jugadorController = new GoleadoresController();
    $jugador = $params[1];
    $jugadorController->editJugador($jugador);
    break;
  case 'modifyClub':
    $jugadorController = new GoleadoresController();
    $club = $params[1];
    $jugadorController->editClub($club);
    break;
    case 'buscarJugadoresPorClub':
      $jugadorController = new GoleadoresController();
      $club = $params[1];
      $jugadorController->showBuscarPorClub($club);
      break;
  case 'clubes':
    $jugadorController = new GoleadoresController();
    $jugadorController->showClubes();
    break;
  default:
    echo "404 Page Not Found"; // corregir esto
    break;
}
