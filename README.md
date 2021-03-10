# Bolsa de Trabajo

## Tecnologías utilizadas

- PHP 7.3.19
- Symfony CLI 4.23.2
- MySQL 15.1

## Frameworks

- Symfony 5.2.4
- Bootsrap 5.0.0
- jQuery 3.5.1

## Instalación

Antes de comenzar es importante tener instalado una base de datos MySQL y Composer https://getcomposer.org/.

1. Instalar la última versión de Symfony https://symfony.com/download
2. Clonar el proyecto desde GitHub: git clone https://github.com/jgdimeglio/empleos
3. Posicionarse sobre el proyecto e instalar las dependencias: ```composer install```
4. En el archivo .env ubicado en el directorio raíz se debe configurar la URL de la base de datos MySQL ```DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/empleos"```
5. Crear la base de datos con el comando ```php bin/console doctrine:database:create```
6. Ejecutar las migraciones para crear las tablas, relaciones e insertar datos de prueba con el comando ```php bin/console doctrine:migration:migrate```
7. Finalmente iniciar el servidor ejecutando el comando ```symfony server:start``` e ingresar a http://localhost:8000/

## Datos de pruebas

Para probar el sistema se han creado tres tipos de usuarios con roles diferentes. Un usuario Admin, uno Company y otro Student. El usuario Admin está habilitado para aprobar los avisos de trabajo y a los estudiantes. El usuario Student solamente puede cargar su perfil, mientras que el usuario Company puede cargar su perfil y sus ofertas de trabajo. Cada usuario solamente tiene permisos para ingresar a sus respectivas páginas.

- Usuario admin: admin@gmail.com contraseña: 123456
- Usuario estudiante: estudiante@gmail.com contraseña: 123456
- Usuario empresa: empresa@gmail.com contraseña: 123456

De igual forma se pueden dar de alta nuevos usuarios estudiantes y empresas.
