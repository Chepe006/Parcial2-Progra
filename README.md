# README - Sistema de Inventario VIDRID

## Integrantes

- Nombre 1:Luis Alexander Rivera Alvarez
- Nombre 2: Walter Jose Ramirez Perez

## Credenciales de acceso

- Correo: `admin@vidrid.com`
- Contraseña: `admin123`

---

## Respuestas

### 1. ¿Cómo manejan la conexión a la BD y qué pasa si algunos de los datos son incorrectos? Justifiquen la manera de validación de la conexión.

La conexión a la base de datos se maneja mediante un archivo llamado `db.php`, en el cual se definen el host, el nombre de la base de datos, el usuario y la contraseña.  
En este archivo se usa PDO para conectarse a MySQL.

Además, la conexión está dentro de un bloque `try-catch`, lo que permite detectar errores.  
Si alguno de los datos es incorrecto, por ejemplo el nombre de la base de datos o el usuario, el sistema muestra un mensaje de error y detiene la ejecución.  
Esto permite validar la conexión de forma segura y evitar que la aplicación continúe sin acceso a la base de datos.

### 2. ¿Cuál es la diferencia entre $_GET y $_POST en PHP? ¿Cuándo es más apropiado usar cada uno? Da un ejemplo real de tu proyecto.

`$_GET` se usa para enviar datos por medio de la URL, por lo que la información queda visible en la barra del navegador.  
Se utiliza normalmente para búsquedas, filtros o parámetros simples.

`$_POST` se usa para enviar datos de formularios sin mostrarlos en la URL.  
Es más apropiado cuando se trabaja con información sensible o con formularios de registro.

En este proyecto se usa `$_POST` en el login para enviar el correo y la contraseña del usuario.  
También se usa `$_POST` en el formulario del dashboard para registrar nuevos productos en el inventario.  
Un ejemplo de `$_GET` en el proyecto es cuando se redirige con mensajes como `dashboard.php?ok=1` o `dashboard.php?error=1`.

### 3. Tu app va a usarse en una empresa de la zona oriental. ¿Qué riesgos de seguridad identificas en una app web con BD que maneja datos de los usuarios? ¿Cómo los mitigarían?

Un riesgo importante es la inyección SQL.  
Esto puede ocurrir cuando un usuario envía datos maliciosos en formularios.  
Para mitigarlo, se usan consultas preparadas con PDO.

Otro riesgo es el acceso no autorizado al sistema.  
Esto se reduce utilizando login y validación de sesión, para que solo usuarios autenticados puedan ingresar datos.

También existe el riesgo de registrar datos incorrectos o incompletos.  
Por eso se aplican validaciones en los formularios, por ejemplo campos obligatorios, control de precios mayores que cero y stock no negativo.

Como mejora futura, también se podrían cifrar las contraseñas con `password_hash`, usar HTTPS y manejar diferentes roles de usuario.

---

## Diccionario de datos

### Nombre tabla: usuarios

| Columna    | Tipo de dato | Límite de caracteres | ¿Es nulo? | Descripción |
|-----------|--------------|----------------------|-----------|-------------|
| id_usuario | INT | No aplica | No | Identificador único del usuario |
| nombre | VARCHAR | 100 | No | Nombre del usuario administrador |
| correo | VARCHAR | 100 | No | Correo electrónico del usuario |
| clave | VARCHAR | 255 | No | Contraseña del usuario |
| rol | VARCHAR | 20 | No | Rol asignado al usuario |

### Nombre tabla: productos

| Columna | Tipo de dato | Límite de caracteres | ¿Es nulo? | Descripción |
|--------|--------------|----------------------|-----------|-------------|
| id_producto | INT | No aplica | No | Identificador único del producto |
| nombre | VARCHAR | 100 | No | Nombre del producto |
| categoria | VARCHAR | 50 | No | Categoría del producto |
| precio | DECIMAL(10,2) | 10 dígitos | No | Precio del producto |
| stock | INT | No aplica | No | Cantidad disponible en inventario |
| estado | VARCHAR | 20 | No | Estado del producto |
| descripcion | VARCHAR | 255 | Sí | Descripción opcional del producto |
| fecha_registro | TIMESTAMP | No aplica | No | Fecha de registro del producto |
| id_usuario | INT | No aplica | Sí | Usuario que registró el producto |

---
