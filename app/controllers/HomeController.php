<?php
/**
 * Controller da página inicial e páginas institucionais
 */
class HomeController extends Controller
{
    public function index()
    {
        // Buscar passeios em destaque
        $tourModel = new TourModel($this->db);
        $featuredTours = $tourModel->getFeatured(5);

        // Buscar posts recentes do blog
        $blogModel = new BlogModel($this->db);
        $recentPosts = $blogModel->getRecent(3);

        $this->view('site.home', [
            'pageTitle' => 'Punta Cana para Brasileiros - Passeios e Experiências',
            'featuredTours' => $featuredTours,
            'recentPosts' => $recentPosts,
        ]);
    }

    public function sobreNos()
    {
        $this->view('site.sobre-nos', [
            'pageTitle' => 'Sobre Nós - Punta Cana para Brasileiros',
        ]);
    }

    public function contato()
    {
        $this->view('site.contato', [
            'pageTitle' => 'Contato - Punta Cana para Brasileiros',
        ]);
    }

    public function enviarContato()
    {
        if (!$this->isPost()) {
            $this->redirect('contato');
            return;
        }

        // Verificar CSRF
        if (!verify_csrf($this->input('csrf_token'))) {
            flash('error', 'Token de segurança inválido.');
            $this->redirect('contato');
            return;
        }

        $name = trim($this->input('name', ''));
        $email = trim($this->input('email', ''));
        $phone = trim($this->input('phone', ''));
        $subject = trim($this->input('subject', ''));
        $message = trim($this->input('message', ''));

        // Validação
        if (empty($name) || empty($email) || empty($message)) {
            flash('error', 'Por favor, preencha todos os campos obrigatórios.');
            $this->redirect('contato');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            flash('error', 'Por favor, insira um email válido.');
            $this->redirect('contato');
            return;
        }

        // Salvar no banco
        $stmt = $this->db->prepare(
            "INSERT INTO contact_messages (name, email, phone, subject, message, created_at) 
             VALUES (:name, :email, :phone, :subject, :message, NOW())"
        );
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':phone' => $phone,
            ':subject' => $subject,
            ':message' => $message,
        ]);

        // Enviar email (usando configurações do banco)
        $this->sendContactEmail($name, $email, $subject, $message);

        flash('success', 'Mensagem enviada com sucesso! Entraremos em contato em breve.');
        $this->redirect('contato');
    }

    private function sendContactEmail($name, $email, $subject, $message)
    {
        $smtpHost = site_config('smtp_host');
        $smtpPort = site_config('smtp_port');
        $smtpUser = site_config('smtp_user');
        $smtpPass = site_config('smtp_pass');
        $adminEmail = site_config('admin_email', 'contato@puntacanaparabrasileiros.com');

        if (empty($smtpHost)) {
            return; // SMTP não configurado
        }

        // Usar PHPMailer ou mail() nativo - aqui vamos com mail() como fallback
        $headers = "From: {$name} <{$email}>\r\n";
        $headers .= "Reply-To: {$email}\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        $body = "<h3>Nova mensagem de contato</h3>";
        $body .= "<p><strong>Nome:</strong> {$name}</p>";
        $body .= "<p><strong>Email:</strong> {$email}</p>";
        $body .= "<p><strong>Assunto:</strong> {$subject}</p>";
        $body .= "<p><strong>Mensagem:</strong><br>{$message}</p>";

        @mail($adminEmail, "Contato: {$subject}", $body, $headers);
    }
}
