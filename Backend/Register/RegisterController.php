<?php
require_once '../Datos/DataRegister.php';
require_once 'Register.php';
require_once '../../Conex/ConexBd.php';

use Datos\DataRegister;

header('Content-Type: application/json');

try {
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        http_response_code(405);
        echo json_encode(["error" => "Method Not Allowed"]);
        exit;
    }

    $jsonInput = file_get_contents('php://input');
    $input = json_decode($jsonInput, true);

    // Log para depuración
    file_put_contents('debug.log', "Input recibido: " . print_r($input, true) . "\n", FILE_APPEND);

    if ($input === null) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid JSON"]);
        exit;
    }

    if (!isset($input['name'], $input['email'], $input['password'], $input['rol'])) {
        http_response_code(400);
        echo json_encode(["error" => "Missing required fields"]);
        exit;
    }

    $data = new DataRegister();
    $data->setName($input['name']);
    $data->setEmail($input['email']);
    $data->setPassword($input['password']);
    $data->setRol($input['rol']);

    $register = new Register();
    $result = $register->registerUser($data);

    if ($result) {
        http_response_code(200);
        echo json_encode(["success" => "Registration Successful"]);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Registration Failed"]);
    }
} catch (Throwable $e) {
    // Log del error
    file_put_contents('error.log', "Error: " . $e->getMessage() . "\n", FILE_APPEND);
    http_response_code(500);
    echo json_encode([
        "error" => "Internal Server Error",
        "message" => $e->getMessage() // Solo para desarrollo, no en producción
    ]);
}