# Gestor de Productos PHP

Un sencillo sistema de gestión de productos desarrollado en PHP puro con una base de datos MySQL. Permite a los usuarios ver, actualizar y organizar productos clasificados por familias. El proyecto cuenta con una interfaz web moderna y responsiva para una fácil interacción.

## Características Principales

-   **Listado de Productos:** Visualiza productos filtrados por familia en una tabla limpia y moderna.
-   **Selección Dinámica:** La lista de productos se actualiza automáticamente al seleccionar una familia.
-   **Edición de Productos:** Edita los detalles de un producto existente a través de un formulario intuitivo.
-   **Menú de Familias:** Al editar un producto, las familias se muestran en un menú desplegable para facilitar la asignación.
-   **Feedback de Actualización:** Muestra un estado claro del proceso de actualización (en progreso, finalizado, error) para una mejor experiencia de usuario.
-   **Diseño Moderno:** Interfaz de usuario profesional y responsiva para una apariencia actual y fácil de usar en cualquier dispositivo.

## Tecnologías Utilizadas

-   **Frontend:** HTML5, CSS3
-   **Backend:** PHP
-   **Base de Datos:** MySQL

## Requisitos

-   Un servidor web local como Apache o Nginx.
-   PHP 7.4 o superior.
-   Servidor de base de datos MySQL o MariaDB.

## Instalación

Sigue estos pasos para poner en marcha el proyecto en tu entorno local:

1.  **Clona o descarga el repositorio:**
    Coloca los archivos del proyecto en el directorio raíz de tu servidor web (ej. `htdocs` en XAMPP, `www` en WampServer).

2.  **Crea la Base de Datos:**
    -   Abre tu cliente de MySQL (como phpMyAdmin).
    -   Importa el archivo `bbdd.sql` que se encuentra en el proyecto. Esto creará la base de datos `dwes`, las tablas necesarias, y cargará los datos de ejemplo.
    -   El script también crea un usuario `ut3` con la contraseña `ut3` y le otorga todos los privilegios sobre la base de datos `dwes`.

3.  **Configura la Conexión a la Base de Datos:**
    Asegúrate de que los datos de conexión en los archivos PHP (`listado.php`, `editar.php`, `actualizar.php`, `testConexBBDD.php`) coincidan con tu configuración de MySQL. Se recomienda usar las credenciales creadas por el script `bbdd.sql`:
    -   **Usuario:** `ut3`
    -   **Contraseña:** `ut3`
    -   **Base de datos:** `dwes`
    -   **Host:** `127.0.0.1`

4.  **¡Listo para usar!**
    Abre tu navegador y navega a la URL donde alojaste el proyecto, empezando por `listado.php`.

## Descripción de los Archivos

-   `bbdd.sql`: Script SQL para crear la estructura de la base de datos, el usuario y poblarla con datos iniciales.
-   `listado.php`: Página principal que muestra la lista de productos filtrados por familia. Permite al usuario seleccionar una familia para ver los productos correspondientes.
-   `editar.php`: Formulario para modificar los detalles de un producto seleccionado. Carga los datos actuales del producto y permite al usuario realizar cambios.
-   `actualizar.php`: Script que procesa los datos enviados desde `editar.php`. Realiza la actualización en la base de datos y muestra un mensaje de estado sobre el resultado de la operación.
-   `testConexBBDD.php`: Un script simple para verificar si la conexión a la base de datos se puede establecer correctamente.

---
*Este README fue generado por Gemini.*