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
- Carrito de compras
    - ¿Dónde se va a guardar la información del carrito de compras? vamos a guardar el carrito de cada usuario en la base de datos
    - Si vamos a guardar en la base de datos ¿qué necesitamos hacer? necesitamos hacer una tabla a través de una migración, la vamos a llamar carts
    - Ahora, debemos definir qué campos vamos a poner en nuestra tabla. Los campos/columnas que vamos a guardar:
        - ID Producto (nombre, precio e imagen)
        - Cantidad
        - ID del usuario (a quién pertenece el producto de este carrito)
    - Debemos crear el modelo para poder conectarnos con la tabla que acabamos de crear para poder crear o eliminar registros.
    - Necesitamos crear un controlador dos controladores
        - Controlador que nos permitan aumentar la cantidad de un producto o agregar un producto al carrito
            - Nos toca revisar si ya existe en el carrito el producto que el usuario intenta agregar
        - Controlador que nos permite eliminar la cantidad de un producto o eliminar un producto del carrito
    - Agregué dos botones por cada producto para asociar las rutas de agregar o eliminar un producto del carrito

    - Lo queremos lograr es que un usuario logueado pueda 
        - Agregar productos de un carrito.
        - Eliminar productos de un carrito.
- Visualización del carrito de compras, necesito visualizar qué productos tengo en el carrito, con sus respectivas cantidades, el sub total por cada producto y el total de la compra
    - Crear una vista donde se consolida la información
    - Crear el controlador donde sumamos las cantidades, el precio sub total y total
    - Crear un enlace entre el catálogo y la página del resumen del carrito
- Visualización de la vista de checkout
    - Visualizar el sub total de los productos comprados, es decir, la sumatoria de las cantidads * precio unitario    
    - Visualizar el valor del IVA del 19%
    - Visualizar el valor del domicilio, que será calculado según el sub total de la compra + IVA
    - Crear un enlace entre el catálogo y la página del resumen del carrito
- Creación de la compra (orden)
    - Se debería guardar en la base de datos
        - Los productos que el usuario compró con sus respectivos precios, cantidades y sub totales
        - Los totales de la compra, IVA, valor del domicilio y total de la compra, se deberían guardar las fechas en las cuales se hizo el pedido, los datos del cliente que realizó la compra y el estado de la compra, si fue "pendiente", "completada" o "cancelada".
    - ¿Qué se debe hacer técnicamente para cumplir con los requerimientos anteriormente mencionados?
        - Debemos crear unas tablas para guardar la información de la compra.
        - Vamos a crear la tabla orders y order con productos para guardar la información respectiva.
- Visualización del histórico de órdenes con sus respectivos datos. Se mostrará la siguiente información: Código de la orden, el total de la orden, el estado, la fecha de creación de la orden y cuántos productos compró.
- Necesitamos solicitar y guardar la información para crear la orden de pago en la pasarela de pagos.
    - ¿Qué información necesitamos solicitar al usuario?
        - Información del comprador
            - contactPhone
            - dniNumber
            - address
            - city
            - state
        - Información del pagador
            - fullName
            - emailAddress
            - contactPhone
            - dniNumber
            - address
            - city
            - state
    - Realizar la petición de pago a la API de Payu y redireccionamos al usuario a la URL que PayU nos devolvió.
    - ¿Qué información voy a guardar en la base de datos respecto a la transacción?
        - Código de la transacción de PayU = transactionId
        - Código de referencia => referenceCode
        - Método de pago => lapPaymentMethod
        - Estado de la transacción => lapTransactionState (PENDGIN/DECLINED)
        - Banco => pseBank
        - Firma de seguridad => signature
        - fullName
        - emailAddress
        - contactPhone
        - dniNumber
        - address
        - city
        - state
    - Se debe crear una URL de confirmación de transacción, con el fin de saber si la transacción fue aprobado o delinada, para con ello, poder actualizar el estado de la transacción guardada de nuestra base de datos y saber si podemos modificar el estado de la orden, es decir, moverlo de Pending a Complete.