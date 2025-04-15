<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="text-center mb-4">Registro</h2>
                    <form id="formRegistro">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Registrarse</button>
                    </form>
                    <div class="text-center mt-3">
                        <p>¿Ya tienes una cuenta? <a href="../index.html">Inicia sesión aquí</a></p>
                    </div>
                    <!-- Mensaje de respuesta -->
                    <div id="responseMessage" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('formRegistro').addEventListener('submit', async (e) => {
        e.preventDefault();

        // Validar contraseñas
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        if (password !== confirmPassword) {
            document.getElementById('responseMessage').innerHTML =
                '<div class="alert alert-danger">Las contraseñas no coinciden</div>';
            return;
        }

        // Crear objeto con los datos
        const data = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            password: password,
            rol: "u"
        };

        try {
            const response = await fetch('Backend/Register/RegisterController.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                document.getElementById('responseMessage').innerHTML =
                    '<div class="alert alert-success">Registro exitoso</div>';
                // Redirigir después de 2 segundos
                setTimeout(() => {
                    window.location.href = '../index.html';
                }, 2000);
            } else {
                document.getElementById('responseMessage').innerHTML =
                    `<div class="alert alert-danger">${result.error || 'Error en el registro'}</div>`;
            }
        } catch (error) {
            console.error('Error:', error);
            document.getElementById('responseMessage').innerHTML =
                '<div class="alert alert-danger">Error al conectar con el servidor</div>';
        }
    });
</script>
</body>
</html>