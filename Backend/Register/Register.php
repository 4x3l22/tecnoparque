<?php

require_once "../../Conex/ConexBd.php";
require_once "../Datos/DataRegister.php";

use Conex\ConexBd;
use Datos\DataRegister;

class Register
{
    private $db;

    public function __construct()
    {
        $this->db = ConexBd::getInstance();
    }

    public function registerUser(DataRegister $data)
    {
        try {
            $pdo = $this->db->getConex();

            $stmt = $pdo->prepare("INSERT INTO register (
                                    nombre, 
                                    correo, 
                                    contrasena,    
                                    fecha_creacion,
                                    fecha_modificacion,
                                    fecha_eliminacion,
                                    rol
                                ) VALUES (
                                    :name,
                                    :email,
                                    :password,
                                    NOW(),
                                    NULL,
                                    NULL,
                                    :rol
                                )");

            // Almacenar valores en variables primero
            $name = $data->getName();
            $email = $data->getEmail();
            $password = password_hash($data->getPassword(), PASSWORD_BCRYPT);
            $rol = $data->getRol();

            // Bind de parámetros usando las variables
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->bindParam(":rol", $rol, PDO::PARAM_STR);

            // Ejecutar y verificar
            if($stmt->execute()) {
                return $stmt->rowCount() > 0;
            }
            return false;

        } catch (PDOException $e) {
            error_log("Error en Register: " . $e->getMessage());
            return false;
        }
    }
}