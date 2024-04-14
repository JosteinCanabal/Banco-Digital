<?php
require_once 'includes/db.php';

class UserModel
{
    public function registerUser($cedula, $nombre, $correo, $contraseña)
    {
        global $db;

        try {
            // Hash de la contraseña antes de almacenarla en la base de datos (mejora la seguridad)
            $hashContraseña = password_hash($contraseña, PASSWORD_DEFAULT);

            // Insertar el nuevo usuario en la base de datos
            $stmt = $db->prepare("INSERT INTO usuarios (idUser, nombre, correo, contraseña) VALUES (?, ?, ?, ?)");
            $stmt->execute([$cedula, $nombre, $correo, $hashContraseña]);

            // Crear automáticamente una cuenta bancaria para el usuario
            $this->createBankAccount($cedula);

            return true;
        } catch (PDOException $e) {
            echo "Error al registrar usuario: " . $e->getMessage();
            return false;
        }
    }

    public function verifyUser($correo, $contraseña)
    {
        global $db;

        try {
            // Obtener la contraseña almacenada y el nombre del usuario para el correo proporcionado
            $stmt = $db->prepare("SELECT idUser, nombre, contraseña FROM usuarios WHERE correo = ?");
            $stmt->execute([$correo]);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData && password_verify($contraseña, $userData['contraseña'])) {
                // Las credenciales son correctas, devolver los datos del usuario
                return $userData;
            } else {
                // Las credenciales son incorrectas
                return false;
            }
        } catch (PDOException $e) {
            echo "Error al verificar usuario: " . $e->getMessage();
            return false;
        }
    }

    private function createBankAccount($idUser)
    {
        global $db;

        try {
            // Insertar una nueva cuenta bancaria para el usuario
            $stmt = $db->prepare("INSERT INTO cuentas (monto, idUser) VALUES (?, ?)");
            $stmt->execute([0, $idUser]);
        } catch (PDOException $e) {
            echo "Error al crear cuenta bancaria: " . $e->getMessage();
        }
    }

    public function makeDeposit($idUser, $monto)
    {
        global $db;

        // Verificar si $idUser es un valor válido
        if (!is_numeric($idUser) || $idUser <= 0) {
            echo "ID de usuario no válido.";
            return false;
        }

        // Verificar si $monto es un número positivo
        if (!is_numeric($monto) || $monto <= 0) {
            echo "Monto no válido.";
            return false;
        }

        try {
            // Actualizar el monto en la cuenta del usuario
            $stmt = $db->prepare("UPDATE cuentas SET monto = monto + ? WHERE idUser = ?");
            $stmt->execute([$monto, $idUser]);

            // Registrar la transacción en la tabla de transacciones
           /* $this->logTransaction($idUser, $idUser, $monto);*/
           

            return true;
        } catch (PDOException $e) {
            echo "Error al realizar el depósito: " . $e->getMessage();
            return false;
        }
    }

    public function makeWithdrawal($idUser, $monto)
    {
        global $db;

        // Verificar si $idUser es un valor válido
        if (!is_numeric($idUser) || $idUser <= 0) {
            echo "ID de usuario no válido.";
            return false;
        }

        // Verificar si $monto es un número positivo
        if (!is_numeric($monto) || $monto <= 0) {
            echo "Monto no válido.";
            return false;
        }

        try {
            // Verificar que el saldo sea suficiente para el retiro
            $stmt = $db->prepare("SELECT monto FROM cuentas WHERE idUser = ?");
            $stmt->execute([$idUser]);
            $saldo = $stmt->fetchColumn();

            if ($saldo >= $monto) {
                // Realizar el retiro
                $stmt = $db->prepare("UPDATE cuentas SET monto = monto - ? WHERE idUser = ?");
                $stmt->execute([$monto, $idUser]);

                // Registrar la transacción en la tabla de transacciones
                $this->logTransaction($idUser, null, -$monto);

                return true;
            } else {
                echo "Saldo insuficiente.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Error al realizar el retiro: " . $e->getMessage();
            return false;
        }
    }

    public function makeTransfer($idUserOrigen, $idCuentaDestino, $vtransferencia)
    {
        global $db;

        try {
            // Verificar que el saldo sea suficiente para la transferencia
            $stmt = $db->prepare("SELECT monto FROM cuentas WHERE idUser = ?");
            $stmt->execute([$idUserOrigen]);
            $saldo = $stmt->fetchColumn();

            if ($saldo >= $vtransferencia) {
                // Realizar la transferencia
                $stmt = $db->prepare("UPDATE cuentas SET monto = monto - ? WHERE idUser = ?");
                $stmt->execute([$vtransferencia, $idUserOrigen]);

                $stmt = $db->prepare("UPDATE cuentas SET monto = monto + ? WHERE idUser = ?");
                $stmt->execute([$vtransferencia, $idCuentaDestino]);

                // Registrar la transacción en la tabla de transacciones
                $this->logTransaction($idUserOrigen, $idCuentaDestino, -$vtransferencia);
                $this->logTransaction($idUserOrigen, $idCuentaDestino, $vtransferencia);

                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error al realizar la transferencia: " . $e->getMessage();
            return false;
        }
    }

    public function logTransaction($idUserOrigen, $idCuentaDestino, $monto)
{
    global $db;

    try {
        // Insertar la transacción en la tabla de transacciones
        $stmt = $db->prepare("INSERT INTO transacciones (idCuentaOrigen, idCuentaDestino, monto, fechaTransaccion) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$idUserOrigen, $idCuentaDestino, $monto]);
    } catch (PDOException $e) {
        echo '<script>alert("Error al realizar la transaccion.");</script>';
        
    }
}

public function getBalance($idUser)
{
    global $db;

    try {
        // Obtener el saldo de la cuenta del usuario
        $stmt = $db->prepare("SELECT monto FROM cuentas WHERE idUser = ?");
        $stmt->execute([$idUser]);
        $saldo = $stmt->fetchColumn();

        return $saldo;
    } catch (PDOException $e) {
        echo "Error al obtener el saldo: " . $e->getMessage();
        return false;
    }
}



}
?>
