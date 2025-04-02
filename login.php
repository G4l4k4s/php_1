<?php
session_start();

// Definición del array de usuarios (debe ser el mismo que en index.php)
$users = [
    [
        'id' => 1,
        'name' => 'Ana Martínez',
        'email' => 'ana@example.com',
        'password' => password_hash('password123', PASSWORD_DEFAULT), // Para login
    ],
    [
        'id' => 2,
        'name' => 'Carlos Gómez',
        'email' => 'carlos@example.com',
        'password' => password_hash('qwerty456', PASSWORD_DEFAULT),
    ],
    [
        'id' => 3,
        'name' => 'Laura Rodríguez',
        'email' => 'laura@example.com',
        'password' => password_hash('abc12345', PASSWORD_DEFAULT),
    ],
    [
        'id' => 4,
        'name' => 'David Torres',
        'email' => 'david@example.com',
        'password' => password_hash('pass7890', PASSWORD_DEFAULT),
    ],
    [
        'id' => 5,
        'name' => 'María López',
        'email' => 'maria@example.com',
        'password' => password_hash('mypass321', PASSWORD_DEFAULT),
    ]
]; // Aquí va el array de usuarios proporcionado

// Función para autenticar usuario
function authenticateUser($email, $password, $users) {
    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            return $user;
        }
    }
    return null;
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = authenticateUser($email, $password, $users);

    if ($user) {
        $_SESSION['user'] = $user; // Guardar datos en sesión
        header("Location: index.php"); // Redirigir a la página principal
        exit;
    } else {
        $_SESSION['error'] = "Credenciales incorrectas";
        header("Location: index.php"); // Volver al formulario con mensaje de error
        exit;
    }
}
