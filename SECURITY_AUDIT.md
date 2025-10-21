# Reporte de Auditoría de Seguridad
**Fecha:** 21 de Octubre de 2025
**Proyecto:** Instituto Superior de Educación - Sistema de Gestión

---

## 🔴 VULNERABILIDADES CRÍTICAS ENCONTRADAS

### 1. **Falta de Validación de Entrada en Controladores CRUD**
**Severidad:** ALTA
**Ubicación:** Todos los controladores (alumnos, profesores, carreras, turnos, etc.)

**Problema:**
```php
// Ejemplo en alumnos.php línea 27-30
$model->insert([
    'Nombre_Completo' => $this->request->getPost('Nombre_Completo'),
    'DNI' => $this->request->getPost('DNI'),
    'Email'  => $this->request->getPost('email')
]);
```
- No hay validación de datos antes de insertar
- No hay verificación de tipos de datos
- No hay validación de longitud
- No hay sanitización de entrada

**Riesgo:** Inyección de datos maliciosos, XSS almacenado, datos corruptos

---

### 2. **Vulnerabilidad en métodos DELETE sin confirmación**
**Severidad:** ALTA
**Ubicación:** 
- `app/controllers/alumnos.php` línea 60
- `app/controllers/profesores.php` línea 59
- `app/controllers/carreras.php` línea 73
- `app/controllers/turnos.php` línea 78
- `app/controllers/categorias.php`

**Problema:**
```php
public function delete($id)
{
    $model->delete($id);
    return redirect()->to('/profesores');
}
```
- No valida que $id sea numérico
- No verifica que el registro exista
- No verifica permisos del usuario
- Vulnerable a CSRF si no está protegida la ruta

**Riesgo:** Eliminación no autorizada de datos

---

### 3. **Falta de Validación en verInscriptos (Profesores)**
**Severidad:** MEDIA-ALTA
**Ubicación:** `app/controllers/profesores.php` línea 286

**Problema:**
```php
public function verInscriptos($idTurno)
{
    $idProfesor = session()->get('ID_Profesor');
    
    $turno = $turnoModel->select(...)
                ->where('turnos.ID_Turno', $idTurno)  // $idTurno no validado
```
- $idTurno puede ser cualquier string
- No valida que sea un número entero
- Vulnerable a SQL injection si Query Builder falla

**Riesgo:** SQL Injection potencial, acceso no autorizado

---

### 4. **Vulnerabilidad en Password Reset Token**
**Severidad:** MEDIA
**Ubicación:** `app/controllers/PasswordResetController.php`

**Problema:**
```php
// Línea 133
$token = $this->request->getPost('token');
```
- No valida formato del token
- Tokens de 64 caracteres sin expiración visible en query
- No hay rate limiting para intentos

**Riesgo:** Fuerza bruta en tokens, tokens débiles

---

### 5. **Queries SQL Sin Preparación Adecuada**
**Severidad:** MEDIA
**Ubicación:** Varios controladores

**Problema:**
```php
// inscripciones línea 259-260
->where('ID_Alumno', $idAlumno)
->where('ID_Carrera', $idCarrera)
```
- Aunque Query Builder protege, los IDs no están validados previamente
- No hay verificación de tipo de dato

---

### 6. **Falta de Escape en Vistas**
**Severidad:** MEDIA
**Ubicación:** Varias vistas

**Problemas encontrados:**
- Algunos datos no usan `esc()` consistentemente
- Email en vistas puede contener XSS si no se valida en entrada

---

### 7. **Sesiones Sin Validación de Propiedad**
**Severidad:** MEDIA
**Ubicación:** 
- `alumnos.php` editarPerfil (línea 181)
- `profesores.php` editarPerfil (línea 181)

**Problema:**
```php
$idAlumno = session()->get('ID_Alumno');
$alumno = $model->find($idAlumno);
// No verifica que el alumno pertenezca al usuario autenticado
```
- Un usuario podría manipular la sesión
- No hay doble verificación de propiedad

---

### 8. **Falta de Validación de Tipo de Archivo (Si hay uploads)**
**Severidad:** MEDIA
**Ubicación:** A verificar si hay uploads
**Estado:** No detectado aún, pero crítico si existe

---

### 9. **Falta de Rate Limiting**
**Severidad:** BAJA-MEDIA
**Ubicación:** Login, Password Reset
**Problema:** No hay límite de intentos de login o reset de contraseña

---

### 10. **Email No Validado en Inscripciones**
**Severidad:** BAJA
**Problema:** Los emails en perfil de alumno/profesor no se validan con filter_var

---

## ✅ CORRECCIONES RECOMENDADAS

### Prioridad 1 (CRÍTICO - Implementar Inmediato):

1. **Agregar Validación en todos los métodos store/update**
2. **Validar IDs numéricos en métodos delete/edit**
3. **Agregar confirmación para delete con token CSRF**
4. **Validar ownership en editar perfil**

### Prioridad 2 (IMPORTANTE - Implementar Esta Semana):

5. **Implementar validación de emails con filter_var**
6. **Agregar rate limiting en login y password reset**
7. **Mejorar validación de tokens de reset**

### Prioridad 3 (RECOMENDADO - Implementar Este Mes):

8. **Auditar todas las vistas para uso consistente de esc()**
9. **Agregar logging de acciones críticas (delete, update)**
10. **Implementar validación de longitud de campos**

---

## 📋 CHECKLIST DE IMPLEMENTACIÓN

- [ ] Validación de entrada en Alumnos controller
- [ ] Validación de entrada en Profesores controller
- [ ] Validación de entrada en Carreras controller
- [ ] Validación de entrada en Turnos controller
- [ ] Validación de entrada en Categorías controller
- [ ] Validación de entrada en Inscripciones controller
- [ ] Validar IDs numéricos en todos los métodos
- [ ] Agregar confirmación en métodos delete
- [ ] Validar ownership en editarPerfil (alumnos/profesores)
- [ ] Implementar rate limiting
- [ ] Auditar escape en vistas
- [ ] Validación de emails
- [ ] Mejorar seguridad de tokens

---

## 🛠️ EJEMPLO DE CÓDIGO SEGURO

### Validación Correcta en Store:
```php
public function store()
{
    // Validación
    $validation = \Config\Services::validation();
    $validation->setRules([
        'Nombre_Completo' => 'required|min_length[3]|max_length[255]',
        'DNI' => 'required|numeric|min_length[7]|max_length[8]|is_unique[alumnos.DNI]',
        'email' => 'required|valid_email|max_length[255]'
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $model = new AlumnoModel();
    $model->insert([
        'Nombre_Completo' => $this->request->getPost('Nombre_Completo'),
        'DNI' => $this->request->getPost('DNI'),
        'Email' => $this->request->getPost('email')
    ]);

    return redirect()->to('/alumnos')->with('message', 'Alumno creado exitosamente');
}
```

### Delete Seguro:
```php
public function delete($id)
{
    // Validar que ID sea numérico
    if (!is_numeric($id)) {
        return redirect()->to('/alumnos')->with('error', 'ID inválido');
    }

    $model = new AlumnoModel();
    
    // Verificar que existe
    $alumno = $model->find($id);
    if (!$alumno) {
        return redirect()->to('/alumnos')->with('error', 'Alumno no encontrado');
    }

    // Verificar que no tenga inscripciones
    $db = \Config\Database::connect();
    $inscripciones = $db->table('inscripciones')->where('ID_Alumno', $id)->countAllResults();
    if ($inscripciones > 0) {
        return redirect()->to('/alumnos')->with('error', 'No se puede eliminar: tiene inscripciones');
    }

    $model->delete($id);
    return redirect()->to('/alumnos')->with('message', 'Alumno eliminado');
}
```

---

## 📊 RESUMEN DE IMPACTO

**Total de Vulnerabilidades:** 10
- Críticas: 2
- Altas: 2
- Medias: 5
- Bajas: 1

**Archivos Afectados:** ~10 controladores
**Tiempo Estimado de Corrección:** 8-12 horas de desarrollo
**Prioridad:** URGENTE para producción

---

**Nota:** Este reporte debe ser tratado de manera confidencial y las correcciones deben implementarse antes de deployment en producción.
