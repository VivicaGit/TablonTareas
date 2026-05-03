<?php

class UsuarioController {

    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function alta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $usuario = new Usuario($_POST['email'], $hash);
            $this->gestor->registrarUsuario($usuario);
            header("Location: index.php?accion=login");
            exit;
        }
        $colorFondo = $_COOKIE['colorFondo'] ?? '#ffffff';
        include "views/alta.php";
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = $this->gestor->buscarUsuarioPorEmail($_POST['email']);

            if ($usuario && password_verify($_POST['password'], $usuario->getPassword())) {
                $_SESSION['usuario_id'] = $usuario->getId();
                $_SESSION['usuarioEmail'] = $usuario->getEmail();

                // cookie de recordarme
                if (isset($_POST['recordarme'])) {
                    $token = base64_encode($usuario->getEmail());
                    setcookie('usuario_login', $token, [
                        'expires'  => time() + (86400 * 30),
                        'path'     => '/',
                        'httponly' => true,
                        'samesite' => 'Strict'
                    ]);
                }

                header("Location: index.php");
                exit;
            } else {
                $error = "Credenciales incorrectas.";
            }
        }
        $colorFondo = $_COOKIE['colorFondo'] ?? '#ffffff';
        include "views/login.php";
    }

    public function logout() {
        session_unset();
        session_destroy();

        if (isset($_COOKIE['usuario_login'])) {
            setcookie('usuario_login', '', time() - 3600, '/');
        }

        header("Location: index.php?accion=login");
        exit;
    }

    public function preferencias() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $color = $_POST['colorFondo'] ?? '#ffffff';
            setcookie('colorFondo', $color, [
                'expires'  => time() + (86400 * 30),
                'path'     => '/',
                'httponly' => false, // el CSS la puede leer si hace falta
                'samesite' => 'Strict'
            ]);

            header("Location: index.php");
            exit;
        }
        $colorFondo = $_COOKIE['colorFondo'] ?? '#ffffff';
        include "views/preferencias.php";
    }
}
