<?php

class Database
{
    private $host = DB_HOST;
    private $db = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        // Configurar conexión a la DB
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
        $opt = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        //Crea una instancia de PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $opt);
            $this->dbh->exec('set names utf8');
        } catch (PDOException $e) {
            throw new Exception("Error en la conexión a la base de datos: " . $e->getMessage());
        }
    }
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($parametro, $valor, $tipo = null)
    {
        if (is_null($tipo)) {
            switch (true) {
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                    break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                    break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                    break;
                default:
                    $tipo = PDO::PARAM_STR;
                    break;
            }
        }
        $this->stmt->bindValue($parametro, $valor, $tipo);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function getRegistros()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getRegistro()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getRowCountReg()
    {
        return $this->stmt->RowCount();
    }
}
