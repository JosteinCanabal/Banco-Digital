<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/css/style1.css">
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="index.php?action=login" method="POST">
        <label for="correo">Correo:</label><br>
        <input type="email" id="correo" name="correo" required><br>
        <label for="contraseña">Contraseña:</label><br>
        <input type="password" id="contraseña" name="contraseña" required><br>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
