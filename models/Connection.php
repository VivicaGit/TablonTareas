<?php

// gestiona la conexión a la bbdd mediante patrón singleton para asegurar 1 conexión y no saturar el servidor.
class Connection {
    private static $instancia = null; // guarda la conexión
    private $conn; // objeto que nos dejará hacer consultas
    private $archivoConfig = "conf.json";

    // PRIVADO: nadie puede instanciar esto desde fuera
    private function __construct() {
        $this->conectar();
    }

    // portero para entrar a la conexión (único punto de entrada)
    public static function getInstance() {
        if (self::$instancia === null) {
            self::$instancia = new self(); 
        }
        return self::$instancia;
    }

    private function conectar() {
        try {
            // convierte json en array asociativo (true)
            $datos = json_decode(file_get_contents($this->archivoConfig), true);
            // monta  conexión DSN
            $dsn = "mysql:host=" . $datos['host'] . ";dbname=" . $datos['db'];
            $this->conn = new PDO($dsn, $datos['userName'], $datos['password']);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function getConn() {
        return $this->conn;
    }

    // bloquean clonación y destrucción para proteger singleton
    private function __clone() {}
    public function __destruct() {
        $this->conn = null;
    }
}
