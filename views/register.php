<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="assets/css/style2.css">
</head>
<body>
    <div class="container">
        <h2>Registro de Usuario</h2>
        <form action="index.php?action=register" method="POST" class="register-form">
            <label for="cedula">Numero de documento:</label><br>
            <input type="text" id="cedula" name="cedula" required><br>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="correo">Correo:</label><br>
            <input type="email" id="correo" name="correo" required><br>
            <label for="contraseña">Contraseña:</label><br>
            <input type="password" id="contraseña" name="contraseña" required><br>
            <button type="submit">Registrar</button>
        </form>
    </div>
</body>
</html>

