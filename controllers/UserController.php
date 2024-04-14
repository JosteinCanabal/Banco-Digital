<?php
require_once 'models/UserModel.php';

class UserController
{
    private $userModel;

    public function __construct()
    {
        session_start(); // Iniciar la sesión una vez en el constructor
        $this->userModel = new UserModel();
    }

    public function index()
    {
        include 'views/home.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'];
            $contraseña = $_POST['contraseña'];

            $userData = $this->userModel->verifyUser($correo, $contraseña);

            if ($userData) {
                // Las credenciales son correctas, establecer los datos del usuario en la sesión
                $_SESSION['idUser'] = $userData['idUser'];
                $_SESSION['nombre'] = $userData['nombre'];
                $_SESSION['correo'] = $correo;
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                echo "Correo o contraseña incorrectos.";
            }
        } else {
            include 'views/login.php';
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cedula = $_POST['cedula'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $contraseña = $_POST['contraseña'];

            $result = $this->userModel->registerUser($cedula, $nombre, $correo, $contraseña);

            if ($result) {
                header('Location: index.php?action=login');
                exit;
            } else {
                echo "Error al registrar usuario.";
            }
        } else {
            include 'views/register.php';
        }
    }

    public function dashboard()
    {
        if (!isset($_SESSION['correo'])) {
            header('Location: index.php?action=login');
            exit;
        }

        include 'views/dashboard.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }

    public function handleDeposit()
    {
        // Verificar si la sesión está iniciada y si existe 'idUser'
        if (isset($_SESSION['idUser']) && isset($_POST['monto'])) {
            // Obtener el monto del formulario
            $monto = $_POST['monto'];

            // Obtener el ID del usuario desde la sesión
            $idUser = $_SESSION['idUser'];

            // Realizar el depósito en el modelo
            $result = $this->userModel->makeDeposit($idUser, $monto);

            if ($result) {
                
                header('Location: index.php?action=dashboard');
                echo '<script>alert("Transacción exitosa.");</script>';
                exit;
            } else {
                echo "Error al realizar el depósito.";
            }
        } else {
            // Si la sesión no está iniciada o 'idUser' no está definido
            echo "Sesión no iniciada o monto no definido.";
        }
    }

    public function handleWithdrawal()
    {
        // Verificar si se envió el formulario de retiro
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vretiro'])) {
            // Obtener el monto del formulario
            $vretiro = $_POST['vretiro'];

            // Realizar el retiro en el modelo
            $result = $this->userModel->makeWithdrawal($_SESSION['idUser'], $vretiro);

            if ($result) {
                // Redirigir a la página de confirmación
                header('Location: index.php?action=withdrawalConfirmation');
                exit;
            } else {
                echo "Error al realizar el retiro.";
            }
        }
    }

    public function handleTransfer()
    {
        // Verificar si se envió el formulario de transferencia
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idUser']) && isset($_POST['vtransferencia'])){
            // Obtener los datos del formulario
            $idCuentaDestino = $_POST['idUser'];
            $monto = $_POST['vtransferencia'];

            // Realizar la transferencia en el modelo
            $result = $this->userModel->makeTransfer($_SESSION['idUser'], $idCuentaDestino, $monto);

            if ($result) {
                echo '<script>alert("Transacción exitosa.");</script>';
                header('Location: index.php?action=dashboard');
                exit;
            } else {
                echo "Error al realizar la transferencia.";
            }
        }
    }

    public function handleBalance(){
        $saldoUsuario = $this->userModel->getBalance($_SESSION['idUser']);
        return $saldoUsuario;
    }

    public function viewTransferHistory()
    {
        // Aquí puedes agregar lógica para obtener el historial de transferencias desde el modelo
        // Por ejemplo, podrías llamar a un método en el modelo para obtener todas las transferencias realizadas por el usuario actual
        // Luego, puedes pasar los datos recuperados a la vista para que se muestren al usuario
        
        // Supongamos que tienes un método en el modelo llamado getAllTransfersByUserId que devuelve todas las transferencias realizadas por un usuario dado
        //$userId = $_SESSION['idUser'];
        //$transferHistory = $this->transactionModel->getAllTransfersByUserId($userId);

        // Luego, podrías cargar una vista que muestre el historial de transferencias
        // Aquí estoy asumiendo que tienes una vista llamada transfer_history.php en la carpeta views
        include 'views/transferencias.php';
    }
}
?>
