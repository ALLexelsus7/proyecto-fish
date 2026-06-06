# 🌊 Abyssal Catch Co. (Proyecto-Fish)

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

**Abyssal Catch Co.** es una plataforma de comercio electrónico especializada en la venta y gestión de peces exóticos con fines gastronómicos y ornamentales. Desarrollada como proyecto académico de excelencia para la materia **WEB II** del Centro de Enseñanza Técnica Industrial (CETI), implementando estándares profesionales de arquitectura MVC, Clean Code y experiencia de usuario moderna.

## 📋 Descripción General

**Abyssal Catch Co.** es un sistema de comercio electrónico B2C que permite a los usuarios finales explorar un catálogo dinámico de peces, gestionar un carrito de compras, guardar favoritos y completar pedidos de forma segura. Paralelamente, cuenta con un **panel de administración robusto** para gestionar inventario, procesar órdenes, auditar usuarios y gestionar comunicaciones.

El proyecto fue desarrollado con especial énfasis en la **escalabilidad**, **seguridad de datos** y **experiencia de usuario intuitiva**.

### 🎯 Características Principales

#### 👥 Para Clientes (Tripulación)

- 🐟 **Exploración de Catálogo**: Filtrado avanzado por categoría (ornamentales y consumo)
- 🛒 **Carrito de Compras**: Gestión completa con actualización en tiempo real
- ❤️ **Sistema de Favoritos**: Guardar productos para compras futuras
- ⭐ **Reseñas y Testimonios**: CRUD completo de comentarios propios
- 👤 **Perfil de Usuario**: Gestión de datos personales y carga de avatar dinámico
- 📞 **Formulario de Contacto**: Comunicación directa con soporte

#### 👨‍💼 Para Administradores (Comandantes)

- 📊 **Dashboard Interactivo**: Visualización de métricas y estadísticas en tiempo real
- 📦 **Gestión de Inventario**: CRUD completo de productos con control de stock
- 📋 **Procesamiento de Órdenes**: Actualización rápida de estado de pedidos
- 👥 **Auditoría de Usuarios**: Promoción a roles administrativos, gestión de permisos y baneos con `SoftDeletes`
- 📧 **Centro de Comunicaciones**: Bandeja de entrada para mensajes de contacto con lectura y purga

---

## 🛠️ Stack Tecnológico

| Componente | Tecnología | Versión |
|-----------|-----------|---------|
| **Backend** | PHP + Laravel Framework | PHP 8.3, Laravel 13.7 |
| **Frontend** | Blade Templates + Tailwind CSS + Alpine.js | Última |
| **Base de Datos** | MySQL con Eloquent ORM | 8.0+ |
| **Autenticación** | Laravel Breeze | 2.4+ |
| **Testing** | Pest PHP | 4.7+ |
| **Build Tool** | Vite | Integrado |

---

## ⚙️ Requisitos Previos

Antes de instalar el proyecto, asegúrate de tener instalado en tu entorno local:

- ✅ **PHP >= 8.3** — [Descargar](https://www.php.net/downloads)
- ✅ **Composer** — [Descargar](https://getcomposer.org/)
- ✅ **Node.js y npm** — [Descargar](https://nodejs.org/)
- ✅ **MySQL 8.0+** (o **Laragon** / **XAMPP** / **WampServer**)
- ✅ **Git** — Para clonar el repositorio

### 📍 Configuración Recomendada

Se recomienda usar **Laragon** como servidor local, ya que proporciona:
- Instalación simplificada de Apache/Nginx
- MySQL preconfigurado
- Virtualhosts automáticos en formato `.test`
- Variable de entorno PATH para PHP y Composer

---

## 💻 Guía de Instalación

### Opción 1: Instalación Automática (Recomendado) 🚀

**El archivo `installer.php` automatiza completamente el proceso de configuración.**

#### Pasos:

**1. Clonar el repositorio**
```bash
git clone https://github.com/ALLexelsus7/proyecto-fish.git
cd proyecto-fish
```

**2. Configurar Laragon (si es la primera vez)**

Si aún no tienes Laragon ejecutándose:
```bash
# Descargar e instalar Laragon desde: https://laragon.org/
# Una vez instalado, abre Laragon y asegúrate de que:
# - Apache/Nginx está corriendo (botón Play)
# - MySQL está activo (debe mostrar un indicador verde)
```

**3. Ejecutar el instalador**
```bash
php installer.php
```

El script hará automáticamente:
- ✅ Crear archivo `.env` a partir de `.env.example` (si no existe)
- ✅ Crear base de datos MySQL (`proyecto_fish`)
- ✅ Instalar dependencias PHP con Composer
- ✅ Generar clave de encriptación Laravel
- ✅ Ejecutar migraciones y seeders (poblamiento de datos)
- ✅ Crear enlace simbólico para almacenamiento (imágenes)
- ✅ Instalar dependencias Node.js
- ✅ Compilar Tailwind CSS y Alpine.js

**4. Iniciar el servidor**
```bash
php artisan serve
```

¡Listo! Accede a **http://localhost:8000** 🎉

---

### Opción 2: Instalación Manual (Paso a Paso)

Si prefieres ejecutar cada comando manualmente, sigue estos pasos:

**1. Clonar el repositorio**
```bash
git clone https://github.com/ALLexelsus7/proyecto-fish.git
cd proyecto-fish
```

**2. Configurar archivo de entorno**
```bash
cp .env.example .env
```

Abre el archivo `.env` y configura tus credenciales de base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=proyecto_fish
DB_USERNAME=root
DB_PASSWORD=
```

**3. Instalar dependencias PHP**
```bash
composer install
```

**4. Generar clave de encriptación**
```bash
php artisan key:generate
```

**5. Crear base de datos y migrar datos**
```bash
# Crea las tablas y las puebla con datos de prueba
php artisan migrate:fresh --seed
```

**6. Enlazar almacenamiento (crítico para imágenes)**
```bash
php artisan storage:link
```

**7. Instalar dependencias frontend**
```bash
npm install
npm run build
```

**8. Iniciar servidor de desarrollo**
```bash
php artisan serve
```

Accede a **http://localhost:8000** ✨

---

## 🤖 Detalles sobre installer.php

El archivo **`installer.php`** es un script de despliegue táctil que automatiza la configuración completa del proyecto. Fue diseñado para facilitar la instalación en múltiples computadores sin necesidad de ejecución manual de comandos.

### ¿Qué hace el instalador?

| Paso | Acción | Descripción |
|------|--------|-------------|
| 1️⃣ | Crear `.env` | Clona `.env.example` si no existe |
| 2️⃣ | Verificar MySQL | Conecta a MySQL usando credenciales del `.env` |
| 3️⃣ | Crear BD | Genera la base de datos `proyecto_fish` si no existe |
| 4️⃣ | Composer Install | Instala dependencias PHP |
| 5️⃣ | Generar Key | Ejecuta `php artisan key:generate` |
| 6️⃣ | Migrar & Seed | Crea tablas y puebla con datos de prueba |
| 7️⃣ | Storage Link | Crea enlace simbólico para imágenes |
| 8️⃣ | NPM Install | Instala dependencias JavaScript |
| 9️⃣ | Build Assets | Compila Tailwind CSS y Alpine.js |

### Cómo usar installer.php

**Ejecución Simple:**
```bash
php installer.php
```

**El script verifica automáticamente:**
- ✔️ Si existen archivos requeridos
- ✔️ La conectividad a MySQL
- ✔️ Errores en cada paso y detiene en caso de fallo

### ⚠️ Requisitos Previos para el Instalador

Antes de ejecutar `installer.php`, asegúrate de:

1. **Laragon/XAMPP/WampServer activo**
   ```bash
   # En Laragon, presiona el botón Play para iniciar los servicios
   ```

2. **Variables de entorno correctas en `.env`**
   - `DB_HOST=127.0.0.1`
   - `DB_PORT=3306`
   - `DB_USERNAME=root` (por defecto en Laragon)
   - `DB_PASSWORD=` (vacío por defecto)

3. **PHP en el PATH del sistema** (para que funcione `php installer.php`)
   - En Laragon: Se configura automáticamente
   - En Windows: Agrega manualmente si es necesario

### 📝 Notas Importantes sobre el Instalador

- **No copia `vendor/` ni `node_modules/`**: Estos directorios se regeneran automáticamente
- **Preserva el historial Git**: No pierde commits ni ramas
- **Maneja Windows y Linux**: Detecta el SO y usa comandos apropiados
- **Tolerante a reintentos**: Si ejecutas dos veces, verifica si las tareas ya se completaron

### 🔍 Solución de Problemas

| Problema | Causa | Solución |
|----------|-------|----------|
| ❌ `ERROR CRÍTICO` en MySQ | MySQL no está corriendo | Abre Laragon y presiona Play |
| ❌ `Comando no reconocido` | PHP no en PATH | Reinicia PowerShell/CMD después de instalar Laragon |
| ❌ Las imágenes no aparecen | Storage link falló | Ejecuta `php artisan storage:link` manualmente |
| ❌ Estilos no aplicados | Assets no compilados | Ejecuta `npm run build` manualmente |

---

## 📁 Estructura del Proyecto

### Arquitectura MVC

```
proyecto-fish/
├── app/
│   ├── Http/
│   │   ├── Controllers/          # Lógica de negocio (AdminDashboardController, ProductoController, ReviewController)
│   │   └── Middleware/           # Protección de rutas (auth, admin, verificación de roles)
│   └── Models/                   # Modelos Eloquent (Producto, User, Review, Orden)
│
├── database/
│   ├── migrations/               # Estructura de tablas y relaciones
│   ├── factories/                # Generadores de datos ficticios para testing
│   └── seeders/                  # Poblamiento inicial de datos
│
├── resources/
│   ├── views/                    # Blade templates divididas en:
│   │   ├── admin/               # Panel de administración
│   │   ├── auth/                # Login, registro, recuperación de contraseña
│   │   ├── layouts/             # Plantillas base reutilizables
│   │   └── public/              # Vistas del catálogo y tienda
│   ├── css/                      # Tailwind CSS
│   └── js/                       # Alpine.js
│
├── routes/
│   └── web.php                   # Mapa de rutas HTTP (protegidas por middlewares)
│
├── storage/
│   └── app/public/               # Imágenes de productos y avatares de usuarios
│
├── public/
│   ├── img/                      # Assets estáticos
│   └── storage/                  # Enlace simbólico a storage/app/public
│
├── .env                          # Configuración del proyecto (gitignored)
├── .env.example                  # Plantilla de configuración
└── installer.php                 # Script de despliegue automático
```

---

## 🔑 Credenciales de Prueba

Después de ejecutar las migraciones y seeders, usa estas credenciales:

### Administrador
- **Email**: `admin@ejemplo.com`
- **Contraseña**: `password`

### Usuario Regular
- **Email**: `usuario@ejemplo.com`
- **Contraseña**: `password`

---

## 🚀 Comandos Útiles para Desarrollo

```bash
# Iniciar servidor de desarrollo
php artisan serve

# Compilar assets en tiempo real (en otra terminal)
npm run dev

# Compilar assets para producción
npm run build

# Ejecutar tests unitarios y de funcionalidad
npm run test

# Linting y formateo de código
composer run lint

# Crear nueva migración
php artisan make:migration nombre_migracion

# Crear nuevo modelo con migración
php artisan make:model NombreModelo -m

# Crear nuevo controlador
php artisan make:controller NombreController

# Deshacer migraciones y volver a ejecutar
php artisan migrate:fresh --seed
```

---

## 🧪 Testing

El proyecto incluye tests con **Pest PHP**. Para ejecutarlos:

```bash
# Ejecutar todos los tests
php artisan test

# Tests de una clase específica
php artisan test tests/Feature/ProductoTest.php

# Tests con salida detallada
php artisan test --verbose
```

---

## 📚 Características de Seguridad

✅ **Protección CSRF** — Tokens integrados en formularios  
✅ **Hash de Contraseñas** — Bcrypt para almacenamiento seguro  
✅ **Validación de Entrada** — Sanitización en servidor y cliente  
✅ **SoftDeletes** — Borrado lógico para auditoría  
✅ **Middlewares de Autorización** — Protección de rutas administrativas  
✅ **SQL Injection Prevention** — Uso de Eloquent ORM y query builder  

---

## 📞 Soporte y Contribuciones

Si encuentras bugs o tienes sugerencias:

1. 📝 Abre un **Issue** describiendo el problema
2. 🔀 Haz un **Fork** del repositorio
3. ✨ Crea una rama con tu feature: `git checkout -b feature/AmazingFeature`
4. 📤 Haz commit de tus cambios: `git commit -m 'Add AmazingFeature'`
5. 🚀 Push a la rama: `git push origin feature/AmazingFeature`
6. 🎉 Abre un **Pull Request**

---

## 📄 Información del Proyecto

### 👨‍💼 Autor

- **Nombre**: Alex Ruiz Jordan
- **Matrícula**: 24110097
- **Institución**: Centro de Enseñanza Técnica Industrial (CETI)
- **Materia**: WEB II
- **Año**: 2025

### 📜 Licencia

Este proyecto está licenciado bajo la **Licencia MIT** — ver archivo `LICENSE` para detalles.

### ❤️ Agradecimientos

- 🎓 Centro de Enseñanza Técnica Industrial (CETI) por la formación y apoyo
- 🛠️ Comunidad de Laravel por las herramientas y documentación excelente
- 🎨 Tailwind Labs por el framework CSS moderno
- 📦 Todos los contribuyentes de librerías de código abierto utilizadas

---

## 📞 Contacto

Para preguntas sobre el proyecto, contacta a través de:
- 📧 Email: `alex.ruiz@ejemplo.com`
- 🐙 GitHub: [@ALLexelsus7](https://github.com/ALLexelsus7)
- 💼 LinkedIn: [Alex Ruiz Jordan](https://www.linkedin.com/in/alexruizjordan/)

---

**Desarrollado con ❤️ y pasión por Clean Code, MVC y excelencia en Experiencia de Usuario**