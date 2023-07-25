URL del código: https://github.com/kennitromero/ps-notes-backend

## Bitácora del proyecto

- Modifiqué los accesos para la base de datos en el archivo .env, se debe modificar el DB_USERNAME y DB_PASSWORD por el nombre de usuario y la contraseña de tu base de datos
- Ejecuté las migraciones a través del comando php artisan migrate:fresh


## Taras de Dashboard

- Creación de productos a través de un comando CLI (Commnd Line Interface), debemos partir de la definición de producto, un objeto que tiene una identificación, nombre, imagen, precio, fecha de creación y fecha de actualización.
    - Crear mi base de datos para este proyecto
    - Configurar las variables de entorno (.env) con las credenciales de mi base de datos
    - Crear la migración
    - Ejecutaré la migración creada para que cree la tabla

    - Crear el modelo para conectar la tabla creada por la migración con las funciones del ORM para poder crear, actualizar, eliminar y leer
    - Crear un repositorio para emvolver el modelo (para luego testear más fácil y separar la lógica de datos respecto a la lógica de aplicación)

    - Comando para crear producto `app/Console/Commands/Products/CreateProductCommand.php`
    - Comando para listar (visualizar) todos los productos `app/Console/Commands/Products/ListProductsCommand.php`
    - Comando para actualizar un producto `app/Console/Commands/Products/UpdateProductCommand.php`
    - Comando para eliminar un producto `app/Console/Commands/Products/DeleteProductCommand.php`
- Creación de cuenta
    - Visualización del formulario (o la vista) `app/Http/Controllers/Web/Auth/RegisterController.php`
    - La creación de la cuenta luego de diligenciar el formulario de la vista `app/Http/Controllers/Web/Auth/CreateAccountController.php`
- Inicio de Sesión
    - Visualización del formulario (o vista) `app/Http/Controllers/Web/Auth/LoginController.php`
    - La autenticación, luego de diligenciar el formulario `app/Http/Controllers/Web/Auth/AuthenticationController.php`
- Cerrar sesión
    - El cerrar sesión `app/Http/Controllers/Web/Auth/LogoutController.php`
- Home `app/Http/Controllers/Web/HomeController.php`
    - Visualización de usuario logueado
    - Visualización de productos con su nombre, imagen, precio y botón para seleccionar.