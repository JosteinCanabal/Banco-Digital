<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <link rel="stylesheet" href="assets/css/style3.css">
</head>

<body>
    <div class="container">
        <h1>Panel de Control</h1>
        <p>Bienvenido, <?php echo $_SESSION['nombre']; ?></p> <!-- Mostrar el nombre del usuario aquí -->
        <?php $saldoUsuario = $this->userModel->getBalance($_SESSION['idUser']); ?>
        <p>Saldo en cuenta: <?php echo $saldoUsuario; ?></p> <!-- Mostrar el saldo del usuario aquí -->
        <a href="index.php?action=logout" class="logout-link">Cerrar Sesión</a>

        <div class="transaction">
            <h2>Depósito</h2>
            <form action="index.php?action=deposit" method="POST">
                <label for="monto">monto:</label><br>
                <input type="number" id="monto" name="monto" required><br>
                <button type="submit">Depositar</button>
            </form>
        </div>

        <div class="transaction">
            <h2>Retiro</h2>
            <form action="index.php?action=withdrawal" method="POST">
                <label for="vretiro">Monto:</label><br>
                <input type="number" id="vretiro" name="vretiro" required><br>
                <button type="submit">Retirar</button>
            </form>
        </div>

        <div class="transaction">
            <h2>Transferencia</h2>
            <form action="index.php?action=transfer" method="POST">
                <label for="idCuentaDestino">Numero de documento de la cuenta destino:</label><br>
                <input type="number" id="idUser" name="idUser" required><br>
                <label for="vtransferencia">Monto:</label><br>
                <input type="number" id="vtransferencia" name="vtransferencia" required><br>
                <button type="submit">Transferir</button>
            </form>
        </div>

    </div>
</body>

</html>
