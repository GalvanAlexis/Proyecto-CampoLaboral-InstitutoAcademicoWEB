# Configuración de Recuperación de Contraseña por Email

## Sistema Implementado

Se ha implementado un sistema completo de recuperación de contraseña por email que incluye:

### Componentes Creados:

1. **Vista de Solicitud de Recuperación** (`app/views/auth/forgot.php`)
   - Formulario para ingresar email
   - Diseño moderno y responsivo

2. **Vista de Reseteo de Contraseña** (`app/views/auth/reset.php`)
   - Formulario para ingresar nueva contraseña
   - Validación de confirmación

3. **Vista de Login Personalizada** (`app/views/auth/login.php`)
   - Incluye enlace "¿Olvidaste tu contraseña?"
   - Diseño consistente con las otras vistas
   - Registro público deshabilitado (solo admin crea usuarios)

4. **Controlador** (`app/Controllers/PasswordResetController.php`)
   - Maneja el envío de emails con tokens únicos
   - Valida tokens y expira después de 1 hora
   - Actualiza la contraseña de forma segura
   - Busca usuarios en `auth_identities` (estructura de Shield)

5. **Base de Datos** 
   - Tabla `auth_identities_reset` para almacenar tokens temporales
   - **Ver instrucciones de instalación en**: `INSTALACION_BD.md`
   - **Script SQL completo en**: `Script_SQL`

## Configuración de Base de Datos

### Opción 1: Ejecutar Migración (Automático)
```bash
php spark migrate
```

### Opción 2: Ejecutar SQL Manual
Si tus compañeros necesitan solo la tabla de recuperación:
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

**Más detalles**: Ver archivo `INSTALACION_BD.md`

## Configuración de Gmail SMTP

Para que el sistema funcione, necesitas configurar una **Contraseña de Aplicación de Gmail**:

### Paso 1: Habilitar la Verificación en Dos Pasos

1. Ve a tu cuenta de Google: https://myaccount.google.com/
2. En el menú lateral, selecciona **Seguridad**
3. Busca "Verificación en dos pasos" y actívala si no está activada
4. Sigue las instrucciones para configurarla

### Paso 2: Generar Contraseña de Aplicación

1. Una vez habilitada la verificación en dos pasos, vuelve a **Seguridad**
2. Busca "Contraseñas de aplicaciones" (puede estar en "Cómo inicias sesión en Google")
3. Haz clic en "Contraseñas de aplicaciones"
4. Es posible que te pida verificar tu identidad
5. En "Selecciona la app", elige **Correo**
6. En "Selecciona el dispositivo", elige **Otro (nombre personalizado)**
7. Escribe "Instituto Académico" o el nombre que prefieras
8. Haz clic en **Generar**
9. Google te mostrará una contraseña de 16 caracteres (ej: `abcd efgh ijkl mnop`)

### Paso 3: Configurar en el Proyecto

1. Abre el archivo `app/Config/Email.php`
2. Busca la línea que dice:
   ```php
   public string $SMTPPass = 'tu_contraseña_de_aplicacion_aqui';
   ```
3. Reemplaza `'tu_contraseña_de_aplicacion_aqui'` con la contraseña generada **sin espacios**:
   ```php
   public string $SMTPPass = 'abcdefghijklmnop';
   ```
4. Verifica que el email esté correcto:
   ```php
   public string $SMTPUser = 'tiki24calahorra@gmail.com';
   ```

### Configuración Actual en Email.php:

```php
public string $protocol = 'smtp';
public string $SMTPHost = 'smtp.gmail.com';
public string $SMTPUser = 'tiki24calahorra@gmail.com';
public string $SMTPPass = 'tu_contraseña_de_aplicacion_aqui'; // ⚠️ CAMBIAR ESTO
public int $SMTPPort = 587;
public string $SMTPCrypto = 'tls';
public string $mailType = 'html';
```

## Flujo de Uso

### Para el Usuario:

1. En la página de login, hacer clic en **"¿Olvidaste tu contraseña?"**
2. Ingresar su email y hacer clic en **"Enviar Enlace de Recuperación"**
3. Revisar su correo electrónico (puede tardar 1-2 minutos)
4. Hacer clic en el enlace del email (válido por 1 hora)
5. Ingresar la nueva contraseña (mínimo 8 caracteres)
6. Confirmar la nueva contraseña
7. Hacer clic en **"Restablecer Contraseña"**
8. Iniciar sesión con la nueva contraseña

### Seguridad Implementada:

- ✅ Tokens únicos generados con `random_bytes(32)`
- ✅ Tokens almacenados en base de datos
- ✅ Expiración de tokens después de 1 hora
- ✅ Tokens eliminados después de ser usados
- ✅ Validación de coincidencia de contraseñas
- ✅ Longitud mínima de contraseña (8 caracteres)
- ✅ Mensajes genéricos para no revelar si un email existe

## Rutas Creadas:

- `GET /auth/a/show` - Muestra formulario de recuperación
- `POST /auth/a/handle` - Envía email o procesa reseteo
- `GET /auth/a/show?action=reset&token=XXX&email=YYY` - Formulario de nueva contraseña

## Configuración Aplicada:

1. **Auth.php**: `$allowMagicLinkLogins = false` (deshabilitado magic link)
2. **Auth.php**: Vista de login personalizada
3. **Email.php**: Configuración SMTP para Gmail
4. **Routes.php**: Rutas personalizadas para recuperación

## Pruebas

Para probar el sistema:

1. Asegúrate de tener XAMPP corriendo (Apache y MySQL)
2. Configura la contraseña de aplicación de Gmail
3. Ve a: `http://localhost/Proyecto-CampoLaboral-InstitutoAcademicoWEB/public/login`
4. Haz clic en "¿Olvidaste tu contraseña?"
5. Ingresa un email de un usuario existente
6. Revisa el email (bandeja de entrada o spam)

## Solución de Problemas

### Email no llega:

1. Verifica que la contraseña de aplicación esté correcta (sin espacios)
2. Revisa la carpeta de spam
3. Verifica que la verificación en dos pasos esté activada en Gmail
4. Revisa los logs de CodeIgniter: `writable/logs/log-[fecha].log`

### Error de SMTP:

```
Error enviando email de recuperación: Failed to authenticate
```
- Solución: Verifica la contraseña de aplicación

### Token expirado:

- Los tokens expiran después de 1 hora
- Solicita un nuevo enlace de recuperación

## Notas Importantes:

⚠️ **NUNCA** commits la contraseña de aplicación a Git
⚠️ Considera usar variables de entorno para producción
⚠️ Los emails pueden tardar 1-2 minutos en llegar
