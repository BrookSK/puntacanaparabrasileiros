<?php
class HomeController extends Controller
{
    public function index()
    {
        // Buscar passeios em destaque para injetar na home
        $db = new \Database();
        $conn = $db->getConnection();
        $stmt = $conn->query("SELECT * FROM tours WHERE status = 'active' AND featured = 1 ORDER BY sort_order, created_at DESC LIMIT 6");
        $GLOBALS['featured_tours'] = $stmt->fetchAll();
        
        // Todos os passeios ativos para a seção de listagem
        $stmt = $conn->query("SELECT * FROM tours WHERE status = 'active' ORDER BY sort_order, created_at DESC LIMIT 12");
        $GLOBALS['all_tours'] = $stmt->fetchAll();
        
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
