# Surmotor - Aplicación Web en Laravel

Este repositorio contiene el código de la aplicación "Surmotor", desarrollada para el examen de recuperación.

## Requisitos Cumplidos

El proyecto implementa la siguiente lógica y funcionalidades requeridas:
- Definición de rutas con nombres, métodos y parámetros mediante recursos.
- Manipulación de la base de datos usando el modelo `Coche` a través de Eloquent ORM.
- Cumplimiento estricto de convenciones en los nombres de migraciones (`create_coches_table`), tablas (`coches`), modelos (`Coche`) y métodos de controlador.
- Implementación de vistas completas utilizando las directivas del motor de plantillas Blade.
- Lectura de un archivo local (`concesionarios.txt`) para alimentar los formularios.

## Rutas de la Aplicación

El controlador `CocheController` gestiona el recurso principal a través de las siguientes rutas generadas por `Route::resource`:

- `GET /` -> Redirección a la lista principal.
- `GET /coches` (`coches.index`) -> Muestra el listado de todos los coches ordenados.
- `GET /coches/create` (`coches.create`) -> Muestra el formulario para añadir un coche.
- `POST /coches` (`coches.store`) -> Procesa y guarda un nuevo registro en la base de datos.
- `GET /coches/{coche}/edit` (`coches.edit`) -> Muestra el formulario para editar un coche existente.
- `PUT/PATCH /coches/{coche}` (`coches.update`) -> Actualiza los datos del registro modificado.
- `DELETE /coches/{coche}` (`coches.destroy`) -> Elimina el registro de la base de datos.

## Enlaces de Entrega

- **Vídeo demostrativo:** [Pega aquí tu enlace de Google Drive]
- **Repositorio Github:** [Pega aquí el enlace a este repositorio público]

## Instrucciones de Despliegue Local

Para ejecutar este proyecto en un entorno local:

1. Clonar este repositorio.
2. Ejecutar el comando `composer install`.
3. Configurar las variables de entorno en el archivo `.env` para la conexión MySQL (Base de datos: `surmotor`).
4. Importar el archivo SQL adjunto en la entrega o ejecutar las migraciones con `php artisan migrate`.
5. Asegurarse de que el archivo `concesionarios.txt` se encuentra en la ruta `storage/app/`.
6. Levantar el servidor local con `php artisan serve`.