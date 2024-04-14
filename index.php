<?php
require_once 'controllers/UserController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$userController = new UserController();

switch ($action) {
    case 'login':
        $userController->login();
        break;
    case 'register':
        $userController->register();
        break;
    case 'dashboard':
        $userController->dashboard();
        break;
    case 'logout':
        $userController->logout();
        break;
    case 'deposit': // Agregar este caso para manejar la acción de depósito
        $userController->handleDeposit(); // Llama al método handleDeposit en lugar de dashboard
        break;
    case 'withdrawal': // Agregar este caso para manejar la acción de retiro
        $userController->handleWithdrawal(); // Llama al método handleWithdrawal en lugar de dashboard
        break;
    case 'transfer': // Agregar este caso para manejar la acción de transferencia
        $userController->handleTransfer(); // Llama al método handleTransfer en lugar de dashboard
            break;
    case 'balance': // Agregar este caso para manejar la acción de transferencia
        $userController->handleBalance(); // Llama al método handleTransfer en lugar de dashboard
            break;
    case 'historial';
        $userController->viewTransferHistory();
            break;    
    default:
        $userController->index();
        break;
}
?>
