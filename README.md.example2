# 🌊 Abyssal Catch Co. (Proyecto-Fish)

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

Plataforma web de comercio electrónico especializada en la venta y gestión de peces exóticos con fines gastronómicos y ornamentales. Desarrollada como proyecto académico para la materia WEB II (Centro de Enseñanza Técnica Industrial).

## 📋 Descripción del Proyecto

Abyssal Catch Co. es un sistema B2C que permite a los usuarios explorar un catálogo dinámico, gestionar un carrito de compras, guardar favoritos y realizar pedidos. Además, cuenta con un robusto panel de administración para gestionar el inventario, procesar las órdenes, auditar usuarios y responder mensajes de contacto.

### 🚀 Características Principales

**Para Clientes (Tripulación):**
* Exploración de catálogo con filtros (ornamentales y consumo).
* Carrito de compras y sistema de "Checkout" de pedidos.
* Gestión de perfil de usuario (carga de Avatar dinámico).
* Sección de testimonios (CRUD de reseñas propias).
* Formulario de contacto integrado.

**Para Administradores (Comandantes):**
* Dashboard interactivo para la gestión de inventario (CRUD de productos).
* Actualización rápida de stock y estatus de pedidos.
* Gestión de usuarios (Promoción a roles administrativos y baneos mediante `SoftDeletes`).
* Bandeja de entrada del Centro de Comunicaciones (Lectura y purga de mensajes).

---

## 🛠️ Stack Tecnológico

* **Backend:** PHP 8.3, Laravel Framework
* **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
* **Base de Datos:** MySQL 8.0 (Eloquent ORM)
* **Autenticación:** Laravel Breeze
* **Testing:** Pest PHP

---

## ⚙️ Requisitos Previos

Antes de instalar el proyecto, asegúrate de tener instalado en tu entorno local:
* [PHP >= 8.3](https://www.php.net/downloads)
* [Composer](https://getcomposer.org/)
* [Node.js y npm](https://nodejs.org/)
* [MySQL](https://www.mysql.com/) (o XAMPP/Laragon)
* Git

---

## 💻 Guía de Instalación

Sigue estos pasos para desplegar la plataforma en tu entorno de desarrollo local:

**1. Clonar el repositorio**
```bash
git clone <URL_DEL_REPOSITORIO>
cd proyecto-fish
**2. Instalar dependencias de PHP (Backend)**
```bash
composer install
**3. Instalar dependencias de Node (Frontend)**
```bash
npm install
npm run build
**4. Configurar variables de entorno**
**Copia el archivo de ejemplo para crear tu propio archivo de configuración:**
```bash
cp .env.example .env
**Abre el archivo .env recién creado y configura las credenciales de tu base de datos MySQL:**
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
**5. Generar la clave de la aplicacion**
```bash
php artisan key:generate
**6. Migrar la base de datos y generar datos semilla (Seeders)**
**Este comando creará todas las tablas y las poblará con productos, usuarios, reseñas y mensajes de prueba utilizando nuestros Factories.**
```bash
php artisan migrate --seed
**7. Enlazar el almacenamiento público (Storage)**
**Crucial para que las imágenes de los productos y los avatares de los usuarios se visualicen correctamente en el navegador.**
```bash
php artisan storage:link
**8. Iniciar el servidor de desarrollo**
**Levanta el servidor interno de Laravel:**
```bash
php artisan serve
**(Opcional) Si necesitas compilar cambios de Tailwind/Alpine en tiempo real en otra terminal ejecuta:**
```bash
npm run dev

🌐 ¡Listo! La aplicación estará disponible en http://localhost:8000.

---

## 📁 Estructura del Proyecto
Una vista simplificada de los componentes clave de la arquitectura MVC implementada:

 * app/Http/Controllers/: Lógica de negocio (Ej. AdminDashboardController, ProductoController, ReviewController).

 * app/Models/: Modelos de Eloquent con relaciones y Accessors (Ej. Producto, User, Review).

 * database/migrations/: Estructura de las tablas y llaves foráneas.

 * database/factories/: Generadores de datos ficticios para pruebas.

 * resources/views/: Interfaces gráficas divididas en admin, auth, layouts y componentes públicos.

 * routes/web.php: Mapa de rutas HTTP protegidas por middlewares (auth, admin).

 * public/img/: Almacenamiento físico de assets estáticos, avatares e imágenes del catálogo.

---

## 👨‍💻 Autor y Créditos
 * Desarrollador: Alex Ruiz Jordan (24110097)

 * Institución: Centro de Enseñanza Técnica Industrial (CETI)

 * Materia: WEB II

 * Proyecto desarrollado con pasión, aplicando estándares de Clean Code, MVC y buenas prácticas de Experiencia de Usuario (UX).