# BancoDigital

revisionInstrucciones para la Preparación del Ambiente de Pruebas
Requisitos Previos
•	PHP >= 7.0 instalado en el sistema.
•	Servidor web local (por ejemplo, Apache o XAMPP) configurado y en funcionamiento.
•	Gestor de bases de datos MySQL o MariaDB instalado y configurado.
Pasos para la Preparación del Ambiente
1.	Descarga del Código Fuente
•	Descargar el código fuente de la aplicación desde el repositorio.
2.	Configuración del Servidor Web
•	Copiar los archivos del código fuente en el directorio raíz del servidor web local.
•	Asegurarse de que la configuración del servidor web permite la ejecución de scripts PHP.
3.	Configuración de la Base de Datos
•	Crear una nueva base de datos en tu servidor MySQL o MariaDB.
•	Importar el archivo de estructura de la base de datos jcbanck_bd proporcionado en el directorio database del código fuente.
4.	Inicio del Servidor Web
•	Iniciar el servidor web local para que la aplicación esté accesible desde un navegador.
5.	Acceso a la Aplicación
•	Abrir un navegador web e ingresa la URL de la aplicación (por ejemplo, http://localhost/Banco-Digital).
6.	Prueba de Funcionalidades
•	Registrar una cuenta de usuario.
•	Iniciar sesión con la cuenta creada.
•	Realizar transacciones de depósito, retiro y transferencia para verificar la funcionalidad de la aplicación.
•	Confirma que los datos se almacenan correctamente en la base de datos y que las operaciones se realizan según lo esperado.

Datos de Prueba
•	Realizar el registro de dos usuarios utilizando con los siguientes datos: 

Usuario n°1:
•	Numero de documento: 11111
•	Nombre: Pedro Pascal
•	Correo electrónico: pedrop@hotmail.com
•	Contraseña: pedro123456
Usuario n°2:
•	Numero de documento: 2222
•	Nombre: María Martínez
•	Correo electrónico: mariam@gmail.com
•	Contraseña: maria123456

•	Iniciar sesión con los datos del Usuario n°1:

•	Realizar un depósito de dinero (Selección libre).
•	Realizar el retiro de dinero (Teniendo en cuenta de que solo se puede retirar un valor menor o igual al disponible en la cuenta).
•	Realizar un segundo depósito de dinero (Selección libre).
•	Realizar una transferencia usando cono número de documento destino: 2222 ; y seleccionando una cantidad de dinero disponible (Teniendo en cuenta de que solo se puede transferir un valor menor o igual al disponible en la cuenta).
•	Verificar si el saldo de la cuenta se actualizo.
•	Cerrar sesión de la cuenta.

•	Iniciar sesión con los datos del Usuario n°2:

•	Verificar si el saldo de la cuenta se actualizo.
•	Cerrar sesión.
