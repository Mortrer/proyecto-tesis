# Sistema de Gestión de Servicio Técnico

Sistema web para la gestión integral de órdenes de servicio técnico, presupuestos, clientes y equipos de hardware. Desarrollado con **Laravel 8** y **Bootstrap 5**, implementa un flujo completo de trabajo desde la recepción del equipo hasta la entrega al cliente.

---

## Tabla de Contenidos

- [Descripción General](#descripción-general)
- [Tecnologías Utilizadas](#tecnologías-utilizadas)
- [Arquitectura del Sistema](#arquitectura-del-sistema)
- [Requisitos Previos](#requisitos-previos)
- [Instalación de Prerrequisitos](#instalación-de-prerrequisitos)
- [Instalación](#instalación)
- [Configuración del Entorno](#configuración-del-entorno)
- [Base de Datos](#base-de-datos)
- [Compilación de Assets](#compilación-de-assets)
- [Ejecución del Proyecto](#ejecución-del-proyecto)
- [Uso de la Aplicación](#uso-de-la-aplicación)
  - [Roles y Permisos](#roles-y-permisos)
  - [Módulo de Órdenes](#módulo-de-órdenes)
  - [Módulo de Clientes](#módulo-de-clientes)
  - [Módulo de Hardware/Equipos](#módulo-de-hardwareequipos)
  - [Módulo de Presupuestos](#módulo-de-presupuestos)
  - [Módulo de Costos](#módulo-de-costos)
  - [Módulo de Usuarios](#módulo-de-usuarios)
  - [Módulo de Roles](#módulo-de-roles)
  - [Consulta Pública de Órdenes](#consulta-pública-de-órdenes)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Esquema de Base de Datos](#esquema-de-base-de-datos)
- [Usuarios de Prueba](#usuarios-de-prueba)

---

## Descripción General

Esta plataforma permite administrar el flujo completo de un servicio técnico de reparación de equipos:

1. **Recepción** del equipo del cliente y registro de la orden de servicio.
2. **Asignación** de la orden a un técnico.
3. **Diagnóstico y presupuesto** del costo de reparación.
4. **Aprobación/Rechazo** del presupuesto por parte del cliente.
5. **Reparación** del equipo por el técnico asignado.
6. **Entrega** del equipo reparado al cliente.

Cada etapa está controlada por un sistema de roles y permisos que garantiza que solo el personal autorizado pueda realizar las acciones correspondientes.

---

## Tecnologías Utilizadas

| Componente          | Tecnología                         |
|---------------------|------------------------------------|
| **Backend**         | PHP 7.3+ / 8.0+                   |
| **Framework**       | Laravel 8.x                        |
| **Base de Datos**   | MySQL                              |
| **Frontend**        | Bootstrap 5, Blade Templates       |
| **JavaScript**      | jQuery, Vue.js 3 (parcial)         |
| **Tablas de Datos** | DataTables                         |
| **Iconos**          | Bootstrap Icons 1.10.3             |
| **PDF**             | jsPDF, pdfmake                     |
| **Autenticación**   | Laravel UI (sesiones)              |
| **Roles/Permisos**  | Spatie Laravel Permission 5.x      |
| **Assets**          | Laravel Mix 6 (Webpack)            |
| **CSS**             | Sass                               |
| **HTTP Client**     | Axios, Guzzle                      |

---

## Arquitectura del Sistema

El proyecto sigue la arquitectura **MVC (Modelo-Vista-Controlador)** de Laravel:

```
app/
├── Http/Controllers/    → Controladores (lógica de negocio)
├── Models/              → Modelos Eloquent (acceso a datos)
├── Middleware/           → Middleware de autenticación y permisos
resources/views/         → Vistas Blade (interfaz de usuario)
routes/web.php           → Definición de rutas
database/migrations/     → Migraciones de base de datos
database/seeders/        → Datos iniciales (roles, usuarios, permisos)
```

### Controladores principales:
- **HomeController** — Dashboard principal
- **OrderController** — Gestión de órdenes de servicio
- **CustomerController** — Gestión de clientes
- **HardwareController** — Gestión de equipos/hardware
- **BudgetController** — Gestión de presupuestos
- **CostController** — Gestión de costos
- **UserController** — Administración de usuarios
- **RoleController** — Administración de roles y permisos

---

## Requisitos Previos

Antes de instalar el proyecto, asegúrate de tener instalado lo siguiente:

- **PHP** >= 7.3 (recomendado 8.0+)
  - Extensiones requeridas: `BCMath`, `Ctype`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PDO`, `pdo_mysql`, `Tokenizer`, `XML`
- **Composer** >= 2.x (gestor de dependencias de PHP)
- **Node.js** >= 14.x con **npm** >= 6.x
- **MySQL** >= 5.7 o **MariaDB** >= 10.3
- **Git**

### Herramientas recomendadas

- [XAMPP](https://www.apachefriends.org/) o [Laragon](https://laragon.org/) — incluyen PHP, MySQL y Apache en un solo paquete
- [Visual Studio Code](https://code.visualstudio.com/)

> **Nota:** Si usas XAMPP, PHP y MySQL ya vienen incluidos. Solo necesitas instalar Composer y Node.js por separado.

---

## Instalación de Prerrequisitos

Sigue esta sección **solo si no tienes instaladas** las herramientas. Instálalas en el orden indicado antes de continuar con la sección [Instalación](#instalación).

---

### Paso 0.1 — Instalar PHP + MySQL (vía XAMPP, recomendado en Windows)

XAMPP instala PHP, MySQL (MariaDB) y Apache en un solo paquete. Es la opción más sencilla en Windows.

1. Descarga el instalador de XAMPP para Windows desde:
	`https://www.apachefriends.org/download.html`
	_(elige la versión que incluya PHP 8.0 o superior)_

2. Ejecuta el instalador y sigue los pasos. Instala al menos los componentes:
	- **Apache**
	- **MySQL**
	- **PHP**

3. Una vez instalado, abre el **XAMPP Control Panel** e inicia los servicios **Apache** y **MySQL**.

4. Verifica que PHP esté disponible en la terminal. Abre PowerShell o CMD:

```bash
php -v
```
Deberías ver algo como:
```
PHP 8.1.x (cli) ...
```

5. Verifica que MySQL esté corriendo accediendo a:
	`http://localhost/phpmyadmin`

> **Alternativa:** Si prefieres [Laragon](https://laragon.org/download/), también incluye PHP, MySQL y Apache con configuración automática de virtual hosts.

> **Si ya tienes PHP instalado** (por otro medio), verifica que las extensiones requeridas estén habilitadas en tu `php.ini`:
> ```ini
> extension=bcmath
> extension=ctype
> extension=fileinfo
> extension=json
> extension=mbstring
> extension=openssl
> extension=pdo
> extension=pdo_mysql
> extension=tokenizer
> extension=xml
> ```
> En XAMPP el `php.ini` está en `C:\xampp\php\php.ini`.

---

### Paso 0.2 — Instalar Composer (gestor de dependencias PHP)

Composer es necesario para descargar Laravel y todos los paquetes PHP del proyecto.

**En Windows:**

1. Descarga el instalador desde:
	`https://getcomposer.org/Composer-Setup.exe`

2. Ejecuta `Composer-Setup.exe`. El instalador detectará PHP automáticamente y agregará `composer` al PATH del sistema.

3. Verifica la instalación abriendo una **nueva** ventana de PowerShell/CMD:

```bash
composer -V
```
Deberías ver:
```
Composer version 2.x.x ...
```

**Alternativa — Instalación manual en PowerShell:**
```powershell
# Descarga el instalador de Composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

# Instala Composer globalmente
php composer-setup.php --install-dir="C:\xampp\php" --filename=composer

# Limpia el instalador
php -r "unlink('composer-setup.php');"
```

---

### Paso 0.3 — Instalar Node.js y npm

Node.js incluye `npm`, que es necesario para instalar las dependencias del frontend (Bootstrap, jQuery, DataTables, etc.) y compilar los assets con Laravel Mix.

**En Windows:**

1. Descarga el instalador LTS (**Long Term Support**, recomendado) desde:
	`https://nodejs.org/en/download`
	_(elige "Windows Installer (.msi)" de 64 bits)_

2. Ejecuta el instalador. Acepta agregar Node.js al PATH del sistema cuando se te pida.

3. Verifica la instalación abriendo una **nueva** ventana de PowerShell/CMD:

```bash
node -v
```
```
v20.x.x
```

```bash
npm -v
```
```
10.x.x
```

> **Versión mínima requerida:** Node.js >= 14.x y npm >= 6.x.
> Se recomienda Node.js 18 LTS o 20 LTS.

---

### Paso 0.4 — Instalar Git

Git es necesario para clonar el repositorio del proyecto.

**En Windows:**

1. Descarga el instalador desde:
	`https://git-scm.com/download/win`

2. Ejecuta el instalador con las opciones predeterminadas.

3. Verifica la instalación:

```bash
git --version
```
```
git version 2.x.x.windows.x
```

---

### Verificación final de todos los prerrequisitos

Antes de continuar, ejecuta estos comandos para confirmar que todo esté instalado correctamente:

```bash
php -v           # PHP 7.3+  (recomendado 8.0+)
composer -V      # Composer 2.x
node -v          # Node.js 14+  (recomendado 18 o 20 LTS)
npm -v           # npm 6+
git --version    # Git 2.x
```

Si todos los comandos devuelven versiones, estás listo para continuar.

---

## Instalación

Sigue estos pasos **en orden** para instalar y configurar el proyecto:

### 1. Clonar el repositorio

```bash
git clone <URL_DEL_REPOSITORIO> proyecto-tesis
cd proyecto-tesis
```

### 2. Instalar dependencias de PHP (Laravel y paquetes)

Este comando descarga Laravel 8 y todas las librerías PHP del proyecto:

```bash
composer install
```

Esto instalará automáticamente:

| Paquete                        | Descripción                                        |
|--------------------------------|----------------------------------------------------|
| `laravel/framework` ^8.65     | Framework principal de Laravel                     |
| `laravel/ui` ^3.4             | Scaffolding de autenticación (login) con Bootstrap |
| `laravel/sanctum` ^2.11       | Autenticación de API por tokens                    |
| `spatie/laravel-permission` ^5.5 | Sistema de roles y permisos                     |
| `guzzlehttp/guzzle` ^7.0      | Cliente HTTP                                       |
| `fruitcake/laravel-cors` ^2.0 | Manejo de CORS                                     |
| `laravel/tinker` ^2.5         | Consola interactiva de Laravel                     |
| `twbs/bootstrap-icons` ^1.10  | Iconos de Bootstrap                                |

> **Si `composer install` falla**, verifica que tengas PHP y las extensiones requeridas habilitadas en tu `php.ini`.

### 3. Instalar dependencias de Node.js (frontend)

Este comando descarga las librerías de JavaScript y CSS:

```bash
npm install
```

Esto instalará automáticamente:

| Paquete                  | Descripción                            |
|--------------------------|----------------------------------------|
| `bootstrap` ^5.1.3      | Framework CSS principal                |
| `jquery` ^3.6.1         | Librería JavaScript para DOM           |
| `vue` ^3.2.36           | Framework JavaScript (uso parcial)     |
| `datatables.net-dt`     | Tablas interactivas con búsqueda/orden |
| `bootstrap-icons`       | Iconos de Bootstrap                    |
| `jspdf` / `pdfmake`    | Generación de PDFs desde el navegador  |
| `laravel-mix` ^6.0.49  | Compilador de assets (Webpack)         |
| `sass` / `sass-loader`  | Preprocesador de estilos CSS           |
| `axios`                  | Cliente HTTP para peticiones AJAX      |

### 4. Crear archivo de configuración del entorno

```bash
cp .env.example .env
```

> En **Windows (CMD o PowerShell)**:
> ```cmd
> copy .env.example .env
> ```

### 5. Generar clave de aplicación

Laravel necesita una clave única para encriptación y seguridad:

```bash
php artisan key:generate
```

### 6. Publicar configuración de Spatie Permission

Publica el archivo de configuración del paquete de roles y permisos:

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

> **Nota:** Si el archivo `config/permission.php` ya existe en el proyecto, este paso se puede omitir.

### 7. Crear enlace simbólico de storage (opcional)

Si la aplicación necesita servir archivos desde `storage/app/public`:

```bash
php artisan storage:link
```

### 8. Dar permisos a carpetas de escritura (Linux/Mac)

En sistemas Unix, Laravel necesita permisos de escritura en estas carpetas:

```bash
chmod -R 775 storage bootstrap/cache
```

> En **Windows** con XAMPP/Laragon este paso **no es necesario**.

---

## Configuración del Entorno

Edita el archivo `.env` en la raíz del proyecto. A continuación se detallan las variables más importantes:

### Configuración de la aplicación

```env
APP_NAME="Servicio Técnico"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost
```

### Configuración de la base de datos

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=servicio
DB_USERNAME=root
DB_PASSWORD=
```

> **Nota:** El nombre de base de datos por defecto es `servicio`. Puedes cambiarlo según tu preferencia.  
> Si usas **XAMPP**, el usuario por defecto es `root` sin contraseña.  
> Si usas **Laragon**, el usuario por defecto también es `root` sin contraseña.

### Configuración de sesión

```env
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### Archivo `.env` completo de ejemplo

```env
APP_NAME="Servicio Técnico"
APP_ENV=local
APP_KEY=              # Se genera con php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=servicio
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

---

## Base de Datos

### 1. Crear la base de datos

Accede a tu gestor de MySQL y crea la base de datos. Puedes hacerlo de varias formas:

**Opción A — Desde phpMyAdmin (XAMPP):**
1. Abre `http://localhost/phpmyadmin`
2. Haz clic en "Nueva" en el panel izquierdo
3. Escribe `servicio` como nombre, selecciona `utf8mb4_unicode_ci` como cotejamiento
4. Haz clic en "Crear"

**Opción B — Desde la terminal de MySQL:**
```sql
CREATE DATABASE servicio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**Opción C — Desde la terminal del sistema:**
```bash
mysql -u root -e "CREATE DATABASE servicio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### 2. Ejecutar migraciones

Esto creará todas las tablas necesarias en la base de datos:

```bash
php artisan migrate
```

Las tablas que se crearán son:

| Tabla                    | Descripción                              |
|--------------------------|------------------------------------------|
| `users`                  | Usuarios del sistema                     |
| `customers`              | Clientes                                 |
| `hardware`               | Equipos registrados                      |
| `orders`                 | Órdenes de servicio                      |
| `budgets`                | Ítems de presupuesto                     |
| `costs`                  | Costos totales por orden                 |
| `view_orders`            | Estados de vista de órdenes              |
| `roles`                  | Roles del sistema (Spatie)               |
| `permissions`            | Permisos del sistema (Spatie)            |
| `model_has_roles`        | Relación usuario-rol                     |
| `model_has_permissions`  | Relación usuario-permiso                 |
| `role_has_permissions`   | Relación rol-permiso                     |
| `password_resets`        | Tokens de restablecimiento de contraseña |
| `sessions`               | Sesiones activas                         |

### 3. Ejecutar seeders (datos iniciales)

Esto creará los roles, permisos y usuarios de prueba:

```bash
php artisan db:seed
```

O ejecutar migraciones y seeders juntos:

```bash
php artisan migrate --seed
```

> **Importante:** Los seeders crean 3 roles con sus permisos y 3 usuarios de prueba. Ver sección [Usuarios de Prueba](#usuarios-de-prueba).

---

## Compilación de Assets

El proyecto usa **Laravel Mix** (basado en Webpack) para compilar los archivos JavaScript y Sass. Los archivos fuente están en `resources/` y se compilan a `public/`:

- `resources/js/app.js` → `public/js/app.js` (incluye jQuery, Vue.js, Bootstrap JS)
- `resources/sass/app.scss` → `public/css/app.css` (incluye Bootstrap CSS, fuentes)

### Desarrollo (con sourcemaps)

```bash
npm run dev
```

### Desarrollo con recarga automática

Recompila automáticamente al guardar cambios:

```bash
npm run watch
```

### Producción (minificado y optimizado)

```bash
npm run production
```

> **Importante:** Debes compilar los assets al menos una vez (`npm run dev`) antes de usar la aplicación, de lo contrario los estilos y scripts no cargarán correctamente.

---

## Ejecución del Proyecto

### Opción 1: Servidor de desarrollo de Laravel (recomendado para desarrollo)

```bash
php artisan serve
```

La aplicación estará disponible en: **http://localhost:8000**

> Asegúrate de que MySQL esté corriendo antes de ejecutar este comando.

### Opción 2: Usando XAMPP

1. Coloca el proyecto dentro de `C:\xampp\htdocs\proyecto-tesis`
2. Inicia los servicios de **Apache** y **MySQL** desde el panel de XAMPP
3. Accede en el navegador a: `http://localhost/proyecto-tesis/public`

### Opción 3: Usando Laragon

1. Coloca el proyecto en `C:\laragon\www\proyecto-tesis`
2. Laragon detecta el proyecto automáticamente
3. Accede a: `http://proyecto-tesis.test` (si tienes auto virtual hosts habilitado)

### Verificar instalación

1. Abre el navegador y ve a la URL correspondiente según la opción elegida.
2. Deberías ver la **página de login**.
3. Inicia sesión con uno de los [usuarios de prueba](#usuarios-de-prueba).
4. Si ves errores de estilos, asegúrate de haber ejecutado `npm run dev`.

---

## Resumen Rápido de Instalación

Para referencia rápida, estos son todos los comandos en orden:

```bash
# --- PRERREQUISITOS (solo si no los tienes instalados) ---
# 1. Instalar XAMPP (PHP + MySQL): https://www.apachefriends.org/download.html
# 2. Instalar Composer:            https://getcomposer.org/Composer-Setup.exe
# 3. Instalar Node.js LTS:         https://nodejs.org/en/download
# 4. Instalar Git:                 https://git-scm.com/download/win

# Verifica que todo esté instalado:
php -v
composer -V
node -v
npm -v
git --version

# --- INSTALACIÓN DEL PROYECTO ---

# 5. Clonar e ingresar al proyecto
git clone <URL_DEL_REPOSITORIO> proyecto-tesis
cd proyecto-tesis

# 6. Instalar dependencias PHP (Laravel + Spatie + paquetes)
composer install

# 7. Instalar dependencias JS (Bootstrap, jQuery, DataTables, Vue, etc.)
npm install

# 8. Configurar entorno
copy .env.example .env          # Windows
# cp .env.example .env           # Linux/Mac

# 9. Generar clave de aplicación
php artisan key:generate

# 10. Publicar config de Spatie (si no existe config/permission.php)
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

# 11. Crear base de datos 'servicio' en MySQL (desde phpMyAdmin o terminal)
# mysql -u root -e "CREATE DATABASE servicio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 12. Ejecutar migraciones y seeders
php artisan migrate --seed

# 13. Compilar assets del frontend (Bootstrap, JS, CSS)
npm run dev

# 14. Iniciar el servidor de desarrollo
php artisan serve
# Abre en el navegador: http://localhost:8000
```

---

## Uso de la Aplicación

### Roles y Permisos

El sistema cuenta con **3 roles predefinidos**, cada uno con permisos específicos:

#### Administrador
Acceso completo a todas las funciones del sistema:
- Gestión de usuarios (crear, ver, editar)
- Gestión de roles y permisos
- Gestión de órdenes (crear, ver, editar, asignar, reparar, entregar)
- Gestión de clientes y hardware
- Gestión de presupuestos y costos
- Dashboard con estadísticas

#### Técnico
Enfocado en las tareas de reparación:
- Acceso al dashboard
- Ver órdenes asignadas
- Realizar reparaciones
- Gestionar presupuestos y costos
- Consultar clientes y hardware

#### Recepción
Enfocado en la atención al cliente:
- Acceso al dashboard
- Crear y ver órdenes de servicio
- Registrar clientes y equipos
- Asignar órdenes a técnicos
- Gestionar presupuestos y costos
- Imprimir órdenes

---

### Módulo de Órdenes

El módulo central del sistema. Gestiona todo el ciclo de vida de una orden de servicio.

#### Crear una orden
1. Navega a **Servicio Técnico → Órdenes → Crear**.
2. Primero busca o registra al **cliente** (por CUI o NIT).
3. Luego busca o registra el **equipo/hardware** (por número de serie).
4. Completa los datos de la orden: fecha estimada, comentarios, tipo de equipo.
5. Guarda la orden. Se generará un **número de orden** automáticamente.

#### Asignar una orden
1. Ve a **Órdenes → Asignar**.
2. Selecciona una orden sin asignar.
3. Asigna un **técnico** de la lista de usuarios disponibles.
4. El estado de la orden cambia a asignada.

#### Reparar una orden
1. El técnico accede a **Órdenes → Reparación**.
2. Selecciona la orden asignada.
3. Registra los trabajos realizados.
4. Finaliza la reparación.

#### Entregar una orden
1. Selecciona la orden completada.
2. Registra la entrega del equipo al cliente.
3. El estado cambia a entregado y se registra la fecha de egreso.

#### Imprimir orden
- Desde la vista de detalle de una orden, se puede generar una **hoja imprimible** con todos los datos.

#### Buscar órdenes
- Usa la función de **búsqueda** para localizar órdenes por número o datos del cliente.

#### Estados de una orden
| Estado       | Descripción                                    |
|--------------|------------------------------------------------|
| Creada       | Orden recién registrada                        |
| Asignada     | Orden asignada a un técnico                    |
| En reparación| El técnico está trabajando en el equipo        |
| Reparada     | La reparación ha sido completada               |
| Entregada    | El equipo fue devuelto al cliente              |

---

### Módulo de Clientes

Gestión de la información de los clientes del servicio técnico.

#### Registrar un cliente
1. Navega a **Clientes → Crear**.
2. Completa los campos:
	- **CUI** (DPI) — Identificación personal
	- **NIT** — Número de identificación tributaria
	- **Nombre** y **Apellidos**
	- **Correo electrónico**
	- **Número de celular**
3. Guarda el registro.

#### Buscar un cliente
- Utiliza la búsqueda por **CUI** o **NIT** para localizar clientes existentes.
- La búsqueda funciona mediante AJAX para resultados instantáneos.

---

### Módulo de Hardware/Equipos

Registro y gestión de los equipos que ingresan al servicio técnico.

#### Registrar un equipo
1. Navega a **Hardware → Registrar**.
2. Completa los campos:
	- **Número de serie** (identificador único del equipo)
	- **Tipo** — Escritorio, Laptop, Móvil, etc.
	- **Marca** y **Modelo**
	- **Detalles del hardware** (RAM, procesador, almacenamiento, etc.)
3. El equipo queda vinculado al cliente propietario.

#### Buscar un equipo
- Busca por **número de serie** para verificar si un equipo ya está registrado.

---

### Módulo de Presupuestos

Permite detallar los costos individuales de una reparación.

#### Crear un presupuesto
1. Desde una orden existente, accede a **Presupuesto → Crear**.
2. Agrega ítems al presupuesto:
	- **Nombre** del servicio o repuesto
	- **Costo** del ítem
	- **Detalle** descriptivo
	- **Tipo** (servicio/repuesto)
3. Puedes agregar múltiples ítems a un mismo presupuesto.
4. Los ítems se pueden eliminar individualmente.

#### Ver presupuestos
- Lista todos los presupuestos existentes con sus detalles y totales.

---

### Módulo de Costos

Consolida el costo total de una orden basándose en los ítems del presupuesto.

#### Generar un costo
1. Se genera automáticamente sumando los ítems del presupuesto de una orden.
2. Incluye:
	- **Precio total**
	- **Estado** (pendiente, aceptado, rechazado)
	- **Descripción** del trabajo
	- **Comentarios** adicionales

#### Aceptar/Rechazar presupuesto
- El cliente puede **aceptar** o **rechazar** el presupuesto propuesto.
- Esta acción se puede realizar desde la consulta pública o internamente.

---

### Módulo de Usuarios

Administración de los usuarios que acceden al sistema (solo **Administrador**).

#### Crear un usuario
1. Navega a **Usuarios → Crear**.
2. Completa los campos:
	- **Nombre de usuario** (para login)
	- **Nombre** y **Apellido**
	- **Contraseña**
	- **Rol** asignado (Administrador, Técnico o Recepción)
3. Guarda el usuario.

#### Ver/Editar usuarios
- Lista todos los usuarios registrados.
- Permite modificar datos y cambiar contraseñas.

---

### Módulo de Roles

Gestión de roles y asignación de permisos (solo **Administrador**).

#### Crear un rol
1. Navega a **Roles → Crear**.
2. Define el **nombre** del rol.
3. Selecciona los **permisos** que tendrá el rol de la lista disponible.
4. Guarda el rol.

#### Editar permisos de un rol
- Desde la vista de detalle de un rol, modifica los permisos asignados.

#### Eliminar un rol
- Elimina un rol existente (los usuarios perderán los permisos asociados).

---

### Consulta Pública de Órdenes

Existe una sección **pública** (no requiere autenticación) donde los clientes pueden:

1. Acceder a la URL: `/Empresa/consulta`
2. Ingresar el **número de orden**.
3. Ver el **estado actual** de su orden.
4. Consultar el **presupuesto** asociado.
5. **Aceptar o rechazar** el presupuesto directamente.

---

## Estructura del Proyecto

```
proyecto-tesis/
├── app/
│   ├── Console/              # Comandos Artisan personalizados
│   ├── Exceptions/           # Manejo de excepciones
│   ├── Http/
│   │   ├── Controllers/      # Controladores de la aplicación
│   │   │   ├── Auth/         # Controladores de autenticación
│   │   │   ├── BudgetController.php
│   │   │   ├── CostController.php
│   │   │   ├── CustomerController.php
│   │   │   ├── HardwareController.php
│   │   │   ├── HomeController.php
│   │   │   ├── OrderController.php
│   │   │   ├── RoleController.php
│   │   │   └── UserController.php
│   │   └── Middleware/       # Middleware (autenticación, CSRF, etc.)
│   ├── Models/               # Modelos Eloquent
│   │   ├── budget.php        # Presupuestos
│   │   ├── cost.php          # Costos
│   │   ├── Customer.php      # Clientes
│   │   ├── Hardware.php      # Equipos
│   │   ├── order.php         # Órdenes de servicio
│   │   ├── Role.php          # Roles
│   │   ├── User.php          # Usuarios
│   │   └── viewOrder.php     # Vista de órdenes
│   └── Providers/            # Proveedores de servicios
├── config/                   # Archivos de configuración
├── database/
│   ├── migrations/           # Migraciones de base de datos
│   └── seeders/              # Datos iniciales
├── public/                   # Archivos públicos (CSS, JS, imágenes)
│   ├── css/
│   ├── js/
│   ├── DataTables/           # Librería DataTables
│   ├── Images/               # Imágenes del sistema
│   └── bootstrap-icons-1.10.3/
├── resources/
│   ├── js/                   # JavaScript fuente
│   ├── sass/                 # Estilos Sass
│   └── views/                # Vistas Blade
│       ├── auth/             # Login, registro, recuperación
│       ├── consulta/         # Consulta pública
│       ├── costos/           # Vistas de costos
│       ├── layouts/          # Layouts principales
│       ├── nav/              # Barras de navegación
│       ├── orders/           # Vistas de órdenes
│       ├── presupuesto/      # Vistas de presupuestos
│       ├── roles/            # Vistas de gestión de roles
│       ├── slidebar/         # Sidebar y dashboard
│       └── users/            # Vistas de usuarios
├── routes/
│   └── web.php               # Definición de rutas web
├── storage/                  # Logs, caché, sesiones
└── tests/                    # Pruebas unitarias y de integración
```

---

## Esquema de Base de Datos

```
┌──────────────┐     ┌──────────────┐     ┌──────────────┐
│   customers  │     │   hardware   │     │    users     │
├──────────────┤     ├──────────────┤     ├──────────────┤
│ id (PK)      │◄──┐ │ serial (PK)  │     │ id (PK)      │
│ cui           │   │ │ id_cliente   │──►  │ usuario      │
│ nit           │   │ │ tipo         │     │ unombre      │
│ correo        │   │ │ marca        │     │ apellido     │
│ nombre        │   │ │ modelo       │     │ password     │
│ apellidos     │   │ │ h_detalles   │     │ roleName     │
│ ncelular      │   │ │ estado       │     └──────┬───────┘
└──────┬───────┘   │ └──────┬───────┘            │
		 │           │        │                     │
		 │           │  ┌─────┴─────────────────────┘
		 │           │  │
		 │     ┌─────┴──┴─────┐     ┌──────────────┐
		 │     │    orders     │     │    costs     │
		 │     ├──────────────┤     ├──────────────┤
		 └────►│ norden (PK)  │     │ id (PK)      │
				 │ id_cliente   │     │ id_orden      │
				 │ id_equipo    │──►  │ precio        │
				 │ estado       │     │ estado        │
				 │ fecha_estimada│    │ descripcion   │
				 │ fecha_egreso │     │ comentario    │
				 │ id_costo     │──►  └──────────────┘
				 │ id_user      │──►
				 │ comentarios  │
				 └──────┬───────┘
						  │
				 ┌──────┴───────┐
				 │   budgets    │
				 ├──────────────┤
				 │ id (PK)      │
				 │ id_norden    │
				 │ nombre       │
				 │ costo        │
				 │ detalle      │
				 │ tipo         │
				 └──────────────┘
```

---

## Usuarios de Prueba

Después de ejecutar los seeders, estarán disponibles los siguientes usuarios:

| Usuario   | Contraseña   | Rol            |
|-----------|-------------|----------------|
| `Admin`   | `123456789` | Administrador  |
| `tec1`    | `123456789` | Técnico        |
| `recep1`  | `123456789` | Recepción      |

> **Advertencia:** Cambia las contraseñas de los usuarios de prueba antes de utilizar el sistema en un entorno de producción.

---

## Comandos Útiles

```bash
# Limpiar caché de configuración
php artisan config:clear

# Limpiar caché de rutas
php artisan route:clear

# Limpiar caché general
php artisan cache:clear

# Limpiar caché de vistas
php artisan view:clear

# Regenerar autoload de Composer
composer dump-autoload

# Ver lista de rutas registradas
php artisan route:list

# Revertir migraciones y volver a ejecutar con seeders
php artisan migrate:fresh --seed
```

---

## Zona Horaria

El sistema está configurado con la zona horaria **America/Guatemala** (UTC-6). Si necesitas cambiarla, modifica el valor `timezone` en `config/app.php`.

---

## Solución de Problemas Comunes

### `composer install` falla con errores de extensiones

Verifica que las extensiones de PHP estén habilitadas. Edita el archivo `php.ini` (en XAMPP: `C:\xampp\php\php.ini`) y descomenta (quita el `;`) las líneas:

```ini
extension=bcmath
extension=mbstring
extension=pdo_mysql
extension=fileinfo
extension=openssl
```

Reinicia Apache después de los cambios.

### Error "No application encryption key has been specified"

Ejecuta:
```bash
php artisan key:generate
```

### Error "SQLSTATE[HY000] [1049] Unknown database 'servicio'"

La base de datos no existe. Créala desde phpMyAdmin o ejecuta:
```bash
mysql -u root -e "CREATE DATABASE servicio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### Error "SQLSTATE[42S01] Base table or view already exists"

Las tablas ya existen. Si quieres empezar desde cero:
```bash
php artisan migrate:fresh --seed
```

> **Cuidado:** Esto elimina TODAS las tablas y datos existentes.

### Los estilos o JavaScript no cargan (página sin formato)

Compila los assets del frontend:
```bash
npm run dev
```

### Error "Permission denied" en storage o bootstrap/cache (Linux/Mac)

```bash
chmod -R 775 storage bootstrap/cache
```

### Error al ejecutar seeders "There is no permission named X"

Limpia la caché del paquete de permisos:
```bash
php artisan permission:cache-reset
```

Y luego re-ejecuta:
```bash
php artisan db:seed
```

---

## Licencia

Este proyecto fue desarrollado como **trabajo de tesis** y se distribuye bajo la licencia MIT.
