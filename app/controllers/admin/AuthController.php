<?php
namespace Admin;

/**
 * Controller de Autenticação do Admin
 */
class AuthController extends \Controller
{
    public function login()
    {
        if ($this->isAdmin()) {
            $this->redirect('admin');
            return;
        }

        $this->view('admin.login', [
            'pageTitle' => 'Login Admin - Punta Cana para Brasileiros',
        ]);
    }

    public function authenticate()
    {
        if (!$this->isPost()) {
            $this->redirect('admin/login');
            return;
        }

        if (!verify_csrf($this->input('csrf_token'))) {
            flash('error', 'Token de segurança inválido.');
            $this->redirect('admin/login');
            return;
        }

        $email = trim($this->input('email', ''));
        $password = $this->input('password', '');

        if (empty($email) || empty($password)) {
            flash('error', 'Por favor, preencha todos os campos.');
            $this->redirect('admin/login');
            return;
        }

        $userModel = new \UserModel($this->db);
        $user = $userModel->verifyPassword($email, $password);

        if (!$user) {
            flash('error', 'Email ou senha incorretos.');
            $this->redirect('admin/login');
            return;
        }

        // Verificar se tem permissão de admin
        if (!in_array($user['role'], ['superadmin', 'admin', 'support'])) {
            flash('error', 'Você não tem permissão para acessar o painel administrativo.');
            $this->redirect('admin/login');
            return;
        }

        if ($user['status'] !== 'active') {
            flash('error', 'Sua conta está desativada.');
            $this->redirect('admin/login');
            return;
        }

        // Criar sessão
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        $this->redirect('admin');
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('admin/login');
    }
}
