<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .auth-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 450px;
            width: 100%;
            padding: 40px;
        }
        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .auth-header i {
            font-size: 3rem;
            color: #667eea;
            margin-bottom: 15px;
        }
        .auth-header h2 {
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .auth-header p {
            color: #666;
            font-size: 0.95rem;
        }
        .form-label {
            font-weight: 500;
            color: #555;
        }
        .form-control {
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .password-requirements {
            font-size: 0.85rem;
            color: #666;
            margin-top: 8px;
        }
        .alert {
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-header">
            <i class="fas fa-lock-open"></i>
            <h2>Nueva Contraseña</h2>
            <p>Ingresa tu nueva contraseña</p>
        </div>

        <?php if (session('error') !== null) : ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-circle"></i> <?= session('error') ?>
            </div>
        <?php elseif (session('errors') !== null) : ?>
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-circle"></i>
                <?php if (is_array(session('errors'))) : ?>
                    <?php foreach (session('errors') as $error) : ?>
                        <?= $error ?><br>
                    <?php endforeach ?>
                <?php else : ?>
                    <?= session('errors') ?>
                <?php endif ?>
            </div>
        <?php endif ?>

        <form action="<?= site_url('reset-password') ?>" method="post">
            <?= csrf_field() ?>

            <input type="hidden" name="token" value="<?= esc($token) ?>">
            <input type="hidden" name="email" value="<?= esc($email ?? '') ?>">

            <div class="mb-3">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope me-1"></i> Correo Electrónico
                </label>
                <input type="email" 
                       class="form-control" 
                       id="email" 
                       name="email" 
                       placeholder="tu@email.com"
                       value="<?= old('email', $email ?? '') ?>" 
                       required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    <i class="fas fa-key me-1"></i> Nueva Contraseña
                </label>
                <input type="password" 
                       class="form-control" 
                       id="password" 
                       name="password" 
                       placeholder="••••••••"
                       required>
                <div class="password-requirements">
                    <i class="fas fa-info-circle"></i> Mínimo 8 caracteres
                </div>
            </div>

            <div class="mb-4">
                <label for="password_confirm" class="form-label">
                    <i class="fas fa-key me-1"></i> Confirmar Contraseña
                </label>
                <input type="password" 
                       class="form-control" 
                       id="password_confirm" 
                       name="password_confirm" 
                       placeholder="••••••••"
                       required>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-check me-2"></i> Restablecer Contraseña
            </button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
