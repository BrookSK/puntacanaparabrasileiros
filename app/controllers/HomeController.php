<?php
class HomeController extends Controller
{
    public function index()
    {
        require_once VIEWS_PATH . '/site/home-wp.php';
    }

    public function sobreNos()
    {
        require_once VIEWS_PATH . '/site/sobre-nos-wp.php';
    }

    public function contato()
    {
        require_once VIEWS_PATH . '/site/contato-wp.php';
    }

    public function enviarContato()
    {
        if (!$this->isPost()) { $this->redirect('contato'); return; }
        if (!verify_csrf($this->input('csrf_token'))) { flash('error', 'Token inválido.'); $this->redirect('contato'); return; }
        $name = trim($this->input('name', ''));
        $email = trim($this->input('email', ''));
        $phone = trim($this->input('phone', ''));
        $subject = trim($this->input('subject', ''));
        $message = trim($this->input('message', ''));
        if (empty($name) || empty($email) || empty($message)) { flash('error', 'Preencha os campos obrigatórios.'); $this->redirect('contato'); return; }
        $stmt = $this->db->prepare("INSERT INTO contact_messages (name, email, phone, subject, message, created_at) VALUES (:name, :email, :phone, :subject, :message, NOW())");
        $stmt->execute([':name'=>$name, ':email'=>$email, ':phone'=>$phone, ':subject'=>$subject, ':message'=>$message]);
        flash('success', 'Mensagem enviada com sucesso!');
        $this->redirect('contato');
    }
}
