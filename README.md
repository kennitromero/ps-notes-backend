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

    - Voy a crear el comando para crear un contacto