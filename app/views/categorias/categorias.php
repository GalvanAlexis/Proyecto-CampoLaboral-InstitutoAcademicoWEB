<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Categorías</title>
    <!-- Solo Bootstrap, sin estilos personalizados -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header simplificado -->
    <header class="bg-primary text-white py-3 mb-4">
        <div class="container">
            <h1 class="h3"><i class="fas fa-tags me-2"></i>Gestión de Categorías</h1>
            <p class="mb-0">Sistema de administración para la tabla de categorías MySQL</p>
        </div>
    </header>

    <div class="container">
        <!-- Notificaciones simplificadas -->
        <div class="alert alert-success alert-dismissible fade" role="alert" id="successNotification">
            <span class="alert-message">Operación realizada con éxito!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <div class="alert alert-danger alert-dismissible fade" role="alert" id="errorNotification">
            <span class="alert-message">Error al realizar la operación!</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="row mb-4">
            <!-- Tarjeta de estadísticas simplificada -->
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Categorías</h5>
                        <div class="h3" id="totalCategories">0</div>
                    </div>
                </div>
            </div>
            
            <!-- Información de BD simplificada -->
            <div class="col-md-8">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-info-circle me-2"></i>Información de la Base de Datos</h5>
                        <p>Esta aplicación se conecta a la tabla <strong>Categorias</strong> en MySQL con la siguiente estructura:</p>
                        <ul class="mb-0">
                            <li><strong>ID_Categoria</strong>: INT AUTO_INCREMENT PRIMARY KEY</li>
                            <li><strong>Categoria</strong>: VARCHAR(100) NOT NULL UNIQUE</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Formulario simplificado -->
            <div class="col-md-5 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-plus-circle me-2"></i>Agregar Nueva Categoría</h5>
                        <form id="categoryForm">
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Nombre de Categoría</label>
                                <input type="text" class="form-control" id="categoryName" required placeholder="Ingrese el nombre de la categoría">
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i>Guardar Categoría</button>
                            <button type="button" id="btnCancel" class="btn btn-secondary ms-2 d-none"><i class="fas fa-times me-1"></i>Cancelar</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Tabla simplificada -->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-list me-2"></i>Lista de Categorías</h5>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre de Categoría</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="categoriesTable">
                                    <!-- Los datos se cargarán dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer simplificado -->
    <footer class="bg-light mt-5 py-3">
        <div class="container text-center">
            <p class="mb-0">Sistema de Gestión de Categorías &copy; 2023</p>
        </div>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript manteniendo la funcionalidad -->
    <script>
        // Variables globales
        let currentEditId = null;

        // Mostrar notificación
        function showNotification(message, isSuccess) {
            const notification = isSuccess ? 
                document.getElementById('successNotification') : 
                document.getElementById('errorNotification');
            
            // Actualizar mensaje
            const messageElement = notification.querySelector('.alert-message');
            if (messageElement) {
                messageElement.textContent = message;
            }
            
            // Mostrar notificación
            notification.classList.add('show');
            
            // Ocultar después de 3 segundos
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Cargar categorías desde el servidor
        async function loadCategories() {
            try {
                const response = await fetch('../../controllers/categorias/get_categories.php');
                const categories = await response.json();
                
                const tableBody = document.getElementById('categoriesTable');
                tableBody.innerHTML = '';
                
                document.getElementById('totalCategories').textContent = categories.length;
                
                categories.forEach(category => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${category.ID_Categoria}</td>
                        <td>${category.Categoria}</td>
                        <td>
                            <button class="btn btn-sm btn-warning me-1" onclick="editCategory(${category.ID_Categoria}, '${category.Categoria}')">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" onclick="deleteCategory(${category.ID_Categoria})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    `;
                    tableBody.appendChild(row);
                });
            } catch (error) {
                console.error('Error al cargar categorías:', error);
                showNotification('Error al cargar categorías', false);
            }
        }

        // Agregar o editar categoría
        async function saveCategory(categoryName, id = null) {
            try {
                const formData = new FormData();
                formData.append('categoryName', categoryName);
                if (id) formData.append('id', id);
                
                const endpoint = id ? '../../controllers/categorias/update_category.php' : '../../controllers/categorias/add_category.php';
                const response = await fetch(endpoint, {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showNotification(id ? 'Categoría actualizada con éxito' : 'Categoría agregada con éxito', true);
                    resetForm();
                    loadCategories();
                } else {
                    showNotification(result.message || 'Error al guardar la categoría', false);
                }
            } catch (error) {
                console.error('Error al guardar categoría:', error);
                showNotification('Error al guardar categoría', false);
            }
        }

        // Editar categoría
        function editCategory(id, name) {
            document.getElementById('categoryName').value = name;
            currentEditId = id;
            
            document.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-save me-1"></i>Actualizar Categoría';
            document.getElementById('btnCancel').classList.remove('d-none');
            
            document.getElementById('categoryName').focus();
        }

        // Eliminar categoría
        async function deleteCategory(id) {
            if (!confirm('¿Está seguro de que desea eliminar esta categoría?')) return;
            
            try {
                const formData = new FormData();
                formData.append('id', id);
                
                const response = await fetch('../../controllers/categorias/delete_category.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                if (result.success) {
                    showNotification('Categoría eliminada con éxito', true);
                    loadCategories();
                } else {
                    showNotification(result.message || 'Error al eliminar la categoría', false);
                }
            } catch (error) {
                console.error('Error al eliminar categoría:', error);
                showNotification('Error al eliminar categoría', false);
            }
        }

        // Resetear formulario
        function resetForm() {
            document.getElementById('categoryForm').reset();
            currentEditId = null;
            document.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-save me-1"></i>Guardar Categoría';
            document.getElementById('btnCancel').classList.add('d-none');
        }

        // Event listeners
        document.getElementById('categoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const categoryName = document.getElementById('categoryName').value.trim();
            
            if (categoryName) {
                saveCategory(categoryName, currentEditId);
            }
        });

        document.getElementById('btnCancel').addEventListener('click', resetForm);

        // Cargar categorías al iniciar
        document.addEventListener('DOMContentLoaded', loadCategories);
    </script>
</body>
</html>