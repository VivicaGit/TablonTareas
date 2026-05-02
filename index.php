<?php
require_once "autoload.php";
session_start();

$gestor = new GestorPDO();
$controladorTarea = new TareaController($gestor);
$controladorUsuario = new UsuarioController($gestor);

$accion = $_GET['accion'] ?? 'index';


if (!isset($_SESSION['usuario_id']) && isset($_COOKIE['usuario_login'])) {
    $emailRecuperado = base64_decode($_COOKIE['usuario_login']);
    $usuario = $gestor->buscarUsuarioPorEmail($emailRecuperado);

    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario->getId();
        $_SESSION['usuarioEmail'] = $usuario->getEmail();
    } else {
        setcookie('usuario_login', '', time() - 3600, '/');
    }
}


$colorFondo = $_COOKIE['colorFondo'] ?? '#ffffff';


switch ($accion) {

    case 'login':
        $controladorUsuario->login();
        break;

    case 'alta':
        $controladorUsuario->alta();
        break;

    case 'logout':
        $controladorUsuario->logout();
        break;

    case 'preferencias':
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?accion=login');
            exit;
        }
        $controladorUsuario->preferencias();
        break;

    case 'crear':
    case 'editar':
    case 'eliminar':
        // Estas acciones son solo para usuarios autenticados
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?accion=login');
            exit;
        }
        if ($accion === 'crear')   $controladorTarea->crear();
        if ($accion === 'editar')  $controladorTarea->editar();
        if ($accion === 'eliminar') $controladorTarea->eliminar();
        break;

    default:
        $controladorTarea->index();
}
