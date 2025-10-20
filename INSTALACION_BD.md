# Instrucciones de Instalación de Base de Datos

## Método 1: Ejecutar Script SQL Completo (Recomendado para nueva instalación)

Si estás configurando el proyecto por primera vez:

1. Abre **phpMyAdmin** o **MySQL Workbench**
2. Ejecuta el archivo completo `Script_SQL`
3. Esto creará:
   - La base de datos `instituto`
   - Todas las tablas principales (Alumnos, Profesores, Categorías, Carreras, Turnos, Inscripciones)
   - La relación `alumnos.user_id` → `auth_identities.id`
   - La tabla `auth_identities_reset` para recuperación de contraseñas

## Método 2: Ejecutar Migraciones de CodeIgniter (Para actualizar base existente)

Si ya tienes el proyecto configurado y solo necesitas la tabla nueva:

```bash
php spark migrate
```

Esto ejecutará:
- La migración de Shield (tablas de autenticación)
- La migración de Settings (configuraciones)
- La migración `AddPasswordResetTable` (recuperación de contraseña)

## Verificar Estado de Migraciones

Para ver qué migraciones se han ejecutado:

```bash
php spark migrate:status
```

## Tablas Creadas

### Tablas Principales del Sistema:
- `alumnos` - Datos de estudiantes
- `profesores` - Datos de docentes
- `categorias` - Categorías de carreras
- `carreras` - Carreras disponibles
- `turnos` - Turnos (Mañana, Tarde, Noche) con profesor y carrera asignados
- `inscripciones` - Inscripciones de alumnos a carreras/turnos

### Tablas de Shield (Autenticación):
- `users` - Usuarios del sistema
- `auth_identities` - Credenciales (email/contraseña)
- `auth_logins` - Registro de inicios de sesión
- `auth_token_logins` - Tokens de autenticación
- `auth_remember_tokens` - Tokens "Recordarme"
- `auth_groups_users` - Relación usuarios-grupos (admin, alumno, profesor)
- `auth_permissions_users` - Permisos de usuarios

### Tabla Nueva para Recuperación de Contraseña:
- `auth_identities_reset` - Tokens temporales para resetear contraseña

## Solo Tabla de Recuperación de Contraseña

Si solo necesitas agregar la tabla `auth_identities_reset` a tu base de datos existente:

```sql
USE instituto;

CREATE TABLE auth_identities_reset (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    created_at DATETIME NULL,
    INDEX idx_email (email),
    INDEX idx_token (token)
) ENGINE=InnoDB;
```

## Notas Importantes

1. **Relación Alumnos-Usuarios**: 
   - La columna `user_id` en la tabla `alumnos` vincula cada alumno con su cuenta de usuario en `auth_identities`
   - Esta relación se usa para el flujo de "Completar perfil"

2. **Tokens de Recuperación**:
   - Los tokens expiran después de 1 hora
   - Se eliminan automáticamente después de ser usados
   - Un usuario solo puede tener un token activo a la vez

3. **Configuración Requerida**:
   - Archivo `.env` con datos de conexión a BD
   - Contraseña de aplicación de Gmail configurada en `app/Config/Email.php`

## Solución de Problemas

### Error: "Table doesn't exist"
```bash
# Ejecutar migraciones
php spark migrate
```

### Error: "Unknown database 'instituto'"
```sql
-- Crear la base de datos primero
CREATE DATABASE instituto CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

### Error: "Duplicate column name 'user_id'"
La columna ya existe, puedes omitir esa parte del script.
