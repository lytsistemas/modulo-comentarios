# Comentario Module

## Descripción

Este módulo proporciona funcionalidad para gestionar comentarios en una aplicación web. Permite crear, leer, actualizar y eliminar comentarios.

## Características

* Creación de comentarios con texto y autor
* Lectura de comentarios con paginación
* Actualización de comentarios existentes
* Eliminación de comentarios
* Validación de datos de entrada

## Requisitos

* PHP 7.2 o superior
* Laminas Framework 3.x
* MySQL o base de datos compatible

## Instalación

1. Clona el repositorio en tu directorio de módulos de Laminas
2. Ejecuta el comando `composer install` para instalar las dependencias
3. Configura la base de datos en el archivo `config/autoload/global.php`
4. Ejecuta el comando `php bin/laminas migration run` para crear las tablas de la base de datos

## Uso

* Accede a la ruta `/comentario` para ver la lista de comentarios
* Accede a la ruta `/comentario/create` para crear un nuevo comentario
* Accede a la ruta `/comentario/{id}` para ver un comentario específico
* Accede a la ruta `/comentario/{id}/edit` para editar un comentario existente
* Accede a la ruta `/comentario/{id}/delete` para eliminar un comentario

## Capturas de pantalla


## Licencia

Este módulo está licenciado bajo la licencia MIT. Ver el archivo [LICENSE](LICENSE) para más detalles.

