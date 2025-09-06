### Ejecución del proyecto:
- Ejecutar el script sql ubicado en **Database>recursos.sql**.
- Abrir la ruta http://biblioteca.test' .


# 📚 Sistema de Gestión de Biblioteca Digital

## Descripción
Sistema web desarrollado en **CodeIgniter 4** para la gestión completa de recursos bibliográficos, con administración de libros físicos/digitales, categorías, editoriales y sistema de ubicación geográfica.

## 🚀 Características
- ✅ Gestión completa de recursos bibliográficos
- ✅ Sistema de categorías y subcategorías
- ✅ Administración de editoriales
- ✅ Control de ubicación geográfica (departamentos, provincias, distritos)
- ✅ Soporte para libros físicos y digitales
- ✅ Interface responsive con Bootstrap 5
- ✅ Validaciones avanzadas y confirmaciones con SweetAlert2

## 🛠️ Tecnologías
- **Backend:** CodeIgniter 4, PHP, MySQL
- **Frontend:** Bootstrap 5, SweetAlert2, Font Awesome
- **JavaScript:** AJAX, Validaciones personalizadas

## 📝 Requisitos del sistema
- PHP >= 7.4
- MySQL >= 5.7
- Servidor local (XAMPP, Laragon, WAMP o similar)
- Composer instalado para la gestión de dependencias de CodeIgniter

## ⚡ Instalación y ejecución
1. Clonar o descargar el repositorio en tu entorno local.
2. Ejecutar el script SQL ubicado en **Database/recursos.sql** para crear la base de datos y sus tablas.
3. Configurar la conexión a la base de datos en `app/Config/Database.php`.
4. Abrir el proyecto en el navegador: [http://biblioteca.test](http://biblioteca.test)
5. Acceder a las secciones de **Recursos, Categorías, Subcategorías y Editoriales** para empezar a gestionar la biblioteca.

## 🔒 Validaciones y seguridad
- Validación obligatoria de campos en formularios antes de enviar datos.
- Integridad referencial en la base de datos (categorías, subcategorías, editoriales).
- Confirmaciones de registro, actualización y eliminación mediante alertas interactivas.
- Manejo de errores con feedback claro al usuario.

