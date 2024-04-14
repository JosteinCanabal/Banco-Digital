CREATE DATABASE IF NOT EXISTS jcbank_bd;

USE jcbank_bd;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    idUser INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    correo VARCHAR(100),
    contraseña VARCHAR(100)
);

-- Tabla de cuentas
CREATE TABLE IF NOT EXISTS cuentas (
    idCuenta INT AUTO_INCREMENT PRIMARY KEY,
    monto INT,
    idUser INT,
    FOREIGN KEY (idUser) REFERENCES usuarios(idUser)
);

-- Tabla de transacciones
CREATE TABLE IF NOT EXISTS transacciones (
    idTransaccion INT AUTO_INCREMENT PRIMARY KEY,
    idCuentaOrigen INT,
    idCuentaDestino INT,
    monto INT, -- Agregamos la columna 'monto' para almacenar el monto de la transacción
    fechaTransaccion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idCuentaOrigen) REFERENCES cuentas(idCuenta),
    FOREIGN KEY (idCuentaDestino) REFERENCES cuentas(idCuenta)
);

