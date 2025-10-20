<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class PasswordResetController extends Controller
{
    /**
     * Muestra el formulario de "Olvidé mi contraseña"
     */
    public function forgotPassword()
    {
        // Si es POST, procesar el envío
        if ($this->request->getMethod() === 'post') {
            return $this->sendResetLink();
        }

        // Si es GET, mostrar el formulario
        return view('auth/forgot');
    }

    /**
     * Envía el email con el link de recuperación
     */
    public function sendResetLink()
    {
        $email = $this->request->getPost('email');

        if (empty($email)) {
            return redirect()->back()->with('error', 'El correo electrónico es requerido.');
        }

        // Buscar usuario por email en auth_identities (así es como Shield almacena emails)
        $db = \Config\Database::connect();
        $identity = $db->table('auth_identities')
            ->where('type', 'email_password')
            ->where('secret', $email)
            ->get()
            ->getRowArray();

        if (!$identity) {
            // Por seguridad, no revelamos si el usuario existe o no
            return redirect()->back()->with('message', 'Si el correo existe en nuestro sistema, recibirás un enlace de recuperación en breve.');
        }

        // Generar token único
        $token = bin2hex(random_bytes(32));
        
        // Guardar token en la base de datos
        try {
            $builder = $db->table('auth_identities_reset');
            
            // Eliminar tokens antiguos del usuario
            $builder->where('email', $email)->delete();
            
            // Insertar nuevo token
            $builder->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Exception $e) {
            log_message('error', 'Error guardando token: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al procesar la solicitud. Por favor, inténtalo de nuevo.');
        }

        // Enviar email
        $this->sendPasswordResetEmail($email, $token);

        return redirect()->back()->with('message', 'Si el correo existe en nuestro sistema, recibirás un enlace de recuperación en breve.');
    }

    /**
     * Envía el email con el link
     */
    protected function sendPasswordResetEmail($email, $token)
    {
        $emailService = \Config\Services::email();
        
        $resetLink = site_url("reset-password?token={$token}&email=" . urlencode($email));
        
        $message = "Hola,<br><br>";
        $message .= "Has solicitado restablecer tu contraseña. Haz clic en el siguiente enlace para continuar:<br><br>";
        $message .= "<a href='{$resetLink}' style='display: inline-block; padding: 12px 24px; background-color: #667eea; color: white; text-decoration: none; border-radius: 5px;'>Restablecer Contraseña</a><br><br>";
        $message .= "O copia y pega este enlace en tu navegador:<br>";
        $message .= $resetLink . "<br><br>";
        $message .= "Este enlace expirará en 1 hora.<br><br>";
        $message .= "Si no solicitaste este cambio, puedes ignorar este correo.<br><br>";
        $message .= "Saludos,<br>";
        $message .= "Instituto Académico";

        $emailService->setTo($email);
        $emailService->setSubject('Recuperación de Contraseña - Instituto Académico');
        $emailService->setMessage($message);

        try {
            $emailService->send();
        } catch (\Exception $e) {
            log_message('error', 'Error enviando email de recuperación: ' . $e->getMessage());
        }
    }

    /**
     * Muestra el formulario para establecer nueva contraseña
     */
    public function resetPassword()
    {
        // Si es POST, procesar el cambio de contraseña
        if ($this->request->getMethod() === 'post') {
            return $this->updatePassword();
        }

        // Si es GET, mostrar el formulario
        $token = $this->request->getGet('token');
        $email = $this->request->getGet('email');
        
        if (empty($token) || empty($email)) {
            return redirect()->to('forgot-password')->with('error', 'Token inválido o expirado.');
        }

        return view('auth/reset', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    /**
     * Procesa el cambio de contraseña
     */
    public function updatePassword()
    {
        $token = $this->request->getPost('token');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');

        // Validar campos
        if (empty($token) || empty($email) || empty($password) || empty($passwordConfirm)) {
            return redirect()->back()->with('error', 'Todos los campos son requeridos.');
        }

        if ($password !== $passwordConfirm) {
            return redirect()->back()->withInput()->with('error', 'Las contraseñas no coinciden.');
        }

        if (strlen($password) < 8) {
            return redirect()->back()->withInput()->with('error', 'La contraseña debe tener al menos 8 caracteres.');
        }

        // Verificar token
        $db = \Config\Database::connect();
        $builder = $db->table('auth_identities_reset');
        $reset = $builder->where('email', $email)->where('token', $token)->get()->getRowArray();

        if (!$reset) {
            return redirect()->to('forgot-password')->with('error', 'Token inválido o expirado.');
        }

        // Verificar que el token no tenga más de 1 hora
        $createdAt = strtotime($reset['created_at']);
        if (time() - $createdAt > 3600) {
            $builder->where('email', $email)->delete();
            return redirect()->to('forgot-password')->with('error', 'El token ha expirado. Por favor, solicita uno nuevo.');
        }

        // Actualizar contraseña
        // Buscar el identity del usuario
        $identity = $db->table('auth_identities')
            ->where('type', 'email_password')
            ->where('secret', $email)
            ->get()
            ->getRowArray();

        if (!$identity) {
            return redirect()->to('forgot-password')->with('error', 'Usuario no encontrado.');
        }

        // Obtener el usuario
        $users = model('UserModel');
        $user = $users->find($identity['user_id']);

        if (!$user) {
            return redirect()->to('forgot-password')->with('error', 'Usuario no encontrado.');
        }

        // Actualizar la contraseña
        $user->password = $password;
        $users->save($user);

        // Eliminar token usado
        $builder->where('email', $email)->delete();

        return redirect()->to('login')->with('message', 'Contraseña restablecida exitosamente. Ya puedes iniciar sesión.');
    }
}
