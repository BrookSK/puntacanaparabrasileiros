<?php
/**
 * Controller de Autenticação (login público do cliente)
 */
class AuthController extends Controller
{
    public function login()
    {
        if ($this->isLoggedIn()) {
            $this->redirect('minha-conta');
            return;
        }

        $this->wpView('site/auth/login', [
            'pageTitle' => 'Login - Punta Cana para Brasileiros',
        ]);
    }

    public function authenticate()
    {
        if (!$this->isPost()) {
            $this->redirect('login');
            return;
        }

        if (!verify_csrf($this->input('csrf_token'))) {
            flash('error', 'Token de segurança inválido.');
            $this->redirect('login');
            return;
        }

        $email = trim($this->input('email', ''));
        $password = $this->input('password', '');

        if (empty($email) || empty($password)) {
            flash('error', 'Por favor, preencha todos os campos.');
            $this->redirect('login');
            return;
        }

        $userModel = new UserModel($this->db);
        $user = $userModel->verifyPassword($email, $password);

        if (!$user) {
            flash('error', 'Email ou senha incorretos.');
            $this->redirect('login');
            return;
        }

        if ($user['status'] !== 'active') {
            flash('error', 'Sua conta está desativada. Entre em contato com o suporte.');
            $this->redirect('login');
            return;
        }

        // Criar sessão
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];

        // Redirecionar conforme role
        if (in_array($user['role'], ['superadmin', 'admin', 'support'])) {
            $this->redirect('admin');
        } else {
            $this->redirect('minha-conta');
        }
    }

    public function register()
    {
        if ($this->isLoggedIn()) {
            $this->redirect('minha-conta');
            return;
        }

        $this->wpView('site/auth/register', [
            'pageTitle' => 'Criar Conta - Punta Cana para Brasileiros',
        ]);
    }

    public function store()
    {
        if (!$this->isPost()) {
            $this->redirect('registro');
            return;
        }

        if (!verify_csrf($this->input('csrf_token'))) {
            flash('error', 'Token de segurança inválido.');
            $this->redirect('registro');
            return;
        }

        $name = trim($this->input('name', ''));
        $email = trim($this->input('email', ''));
        $phone = trim($this->input('phone', ''));
        $password = $this->input('password', '');
        $passwordConfirm = $this->input('password_confirm', '');

        // Validações
        if (empty($name) || empty($email) || empty($password)) {
            flash('error', 'Por favor, preencha todos os campos obrigatórios.');
            $this->redirect('registro');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash('error', 'Por favor, insira um email válido.');
            $this->redirect('registro');
            return;
        }

        if (strlen($password) < 6) {
            flash('error', 'A senha deve ter pelo menos 6 caracteres.');
            $this->redirect('registro');
            return;
        }

        if ($password !== $passwordConfirm) {
            flash('error', 'As senhas não conferem.');
            $this->redirect('registro');
            return;
        }

        $userModel = new UserModel($this->db);

        // Verificar se email já existe
        if ($userModel->findByEmail($email)) {
            flash('error', 'Este email já está cadastrado.');
            $this->redirect('registro');
            return;
        }

        // Criar usuário
        $userId = $userModel->create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'role' => 'client',
            'status' => 'active',
        ]);

        // Login automático
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = 'client';

        flash('success', 'Conta criada com sucesso! Bem-vindo(a)!');
        $this->redirect('minha-conta');
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('');
    }
}
