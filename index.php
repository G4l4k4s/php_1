<?php
session_start();

// Definición de usuarios y posts (no modificar)
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
];

$posts = [
    [
        'id' => 1,
        'title' => 'Bienvenidos al blog',
        'description' => 'Este es el primer post de prueba.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 1,
        'created_at' => '2025-03-28 10:00:00',
        'status' => 'published'
    ],
    [
        'id' => 2,
        'title' => 'Tips para programar en PHP',
        'description' => 'Consejos útiles para escribir mejor código en PHP.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 2,
        'created_at' => '2025-03-28 11:30:00',
        'status' => 'published'
    ],
    [
        'id' => 3,
        'title' => 'Mi experiencia con Laravel',
        'description' => 'Compartiendo lo aprendido trabajando con Laravel.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 3,
        'created_at' => '2025-03-28 13:00:00',
        'status' => 'draft'
    ],
    [
        'id' => 4,
        'title' => 'Aprender JavaScript desde cero',
        'description' => 'Recursos y estrategias para aprender JS.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 1,
        'created_at' => '2025-03-28 14:20:00',
        'status' => 'published'
    ],
    [
        'id' => 5,
        'title' => 'Desarrollo web moderno',
        'description' => '¿Qué herramientas deberías conocer hoy en día?',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 4,
        'created_at' => '2025-03-28 15:00:00',
        'status' => 'published'
    ],
    [
        'id' => 6,
        'title' => 'Cómo hacer un blog con PHP',
        'description' => 'Guía paso a paso para crear tu propio blog.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 2,
        'created_at' => '2025-03-28 16:00:00',
        'status' => 'draft'
    ],
    [
        'id' => 7,
        'title' => 'Seguridad en aplicaciones web',
        'description' => 'Evita ataques comunes como XSS y SQL Injection.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 5,
        'created_at' => '2025-03-28 17:30:00',
        'status' => 'published'
    ],
    [
        'id' => 8,
        'title' => 'Ventajas de usar frameworks',
        'description' => 'Por qué deberías usar Laravel, Symfony, etc.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 3,
        'created_at' => '2025-03-28 18:00:00',
        'status' => 'published'
    ],
    [
        'id' => 9,
        'title' => 'Diseño responsive',
        'description' => 'Cómo hacer que tu web se vea bien en todos los dispositivos.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 1,
        'created_at' => '2025-03-28 19:00:00',
        'status' => 'draft'
    ],
    [
        'id' => 10,
        'title' => 'Usando APIs con PHP',
        'description' => 'Aprende a consumir y crear APIs RESTful.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 4,
        'created_at' => '2025-03-28 20:00:00',
        'status' => 'published'
    ]
];


// Verificar si hay un error de login
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Blog con Sesiones en PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>

<body>

    <?php if (isset($_SESSION['user'])): ?>
        <p class="border">Bienvenido, <?= htmlspecialchars($_SESSION['user']['name']) ?>!</p>
        <a href="logout.php">Cerrar sesión</a>

        <h2>Publicaciones</h2>
        <ul>
            <?php foreach ($posts as $post): ?>
                <?php if ($post['status'] === 'published'): ?>

                    <li>
                        <h3><?= htmlspecialchars($post['title']) ?></h3>
                        <p><?= htmlspecialchars($post['description']) ?></p>
                        <img src="<?= htmlspecialchars($post['image']) ?>" alt="Imagen del post" width="300">
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>

    <?php else: ?>

        <?php if ($error): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <div class="container vh-100 d-flex justify-content-center align-items-center">
            <div class="card shadow border rounded p-4 w-25">
                <h3 class="text-center mb-3">Iniciar Sesión</h3>

                <?php if ($error): ?>
                    <div class="alert alert-danger text-center">
                        <?= htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" required placeholder="Correo Electrónico">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" required class="form-control" placeholder="Contraseña">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Recordarme</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Ingresar</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

</body>

</html>