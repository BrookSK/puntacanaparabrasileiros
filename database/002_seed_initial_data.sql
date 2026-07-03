-- ================================================
-- Migration 002: Dados iniciais do sistema
-- Inserir configurações padrão e superadmin
-- ================================================

USE puntacana_db;

-- ================================================
-- Usuário SuperAdmin (senha: admin123 - MUDE APÓS O PRIMEIRO LOGIN!)
-- ================================================
INSERT INTO users (name, email, password, phone, role, status, created_at) VALUES
('Super Admin', 'admin@puntacanaparabrasileiros.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+18294582170', 'superadmin', 'active', NOW());

-- ================================================
-- Configurações padrão do sistema
-- ================================================
INSERT INTO system_configs (config_key, config_value) VALUES
-- Geral
('site_name', 'Punta Cana para Brasileiros'),
('site_description', 'A melhor agência especializada em viagens para Punta Cana com atendimento personalizado para brasileiros.'),
('site_keywords', 'punta cana, passeios, transfer, brasileiros, caribe, república dominicana'),
('admin_email', 'contato@puntacanaparabrasileiros.com'),
('phone_primary', '+1 (829) 458-2170'),
('phone_whatsapp', '18294582170'),
('address', 'Avenida Barceló, nº 01, Local 7 - Plaza Arrecife'),
('city', 'Verón - Punta Cana'),
('country', 'República Dominicana'),
('postal_code', '23000'),
('company_name', 'Punta Cana para Brasileiros Oliveira & Ramos SRL'),
('company_rnc', '133287765'),
('currency', 'USD'),
('timezone', 'America/Santo_Domingo'),
('instagram_url', 'https://www.instagram.com/puntacanaparabrasileiros'),
('threads_url', 'https://www.threads.com/@puntacanaparabrasileiros'),
('facebook_url', ''),

-- SMTP (preencher na tela de configurações)
('smtp_host', ''),
('smtp_port', '587'),
('smtp_user', ''),
('smtp_pass', ''),
('smtp_encryption', 'tls'),
('smtp_from_name', 'Punta Cana para Brasileiros'),
('smtp_from_email', 'contato@puntacanaparabrasileiros.com'),

-- APIs (preencher na tela de configurações)
('openai_api_key', ''),
('openai_model', 'gpt-4'),
('paypal_client_id', ''),
('paypal_client_secret', ''),
('paypal_mode', 'sandbox'),
('google_analytics_id', ''),
('google_maps_key', ''),
('recaptcha_site_key', ''),
('recaptcha_secret_key', ''),

-- Afiliados
('affiliate_commission_percent', '10'),
('affiliate_min_payout', '50'),
('affiliate_cookie_days', '30'),
('affiliate_auto_approve', '0'),
('affiliate_paypal_enabled', '1'),

-- Checkout
('checkout_terms_required', '1'),
('checkout_guest_enabled', '0'),
('checkout_min_advance_hours', '24'),
('voucher_logo_url', ''),
('voucher_footer_text', 'Punta Cana para Brasileiros - Obrigado pela preferência!'),
('voucher_contact_info', 'WhatsApp: +1 (829) 458-2170 | Email: contato@puntacanaparabrasileiros.com'),

-- Aparência
('logo_url', ''),
('favicon_url', ''),
('primary_color', '#0d6efd'),
('secondary_color', '#198754'),
('hero_title', 'Punta Cana espera por você!'),
('hero_subtitle', 'Descubra o paraíso caribenho com os melhores pacotes exclusivos para brasileiros. Praias paradisíacas, resorts all-inclusive e uma experiência inesquecível.'),
('hero_image_url', ''),
('footer_text', '© Copyright 2025 | Desenvolvido por LRV Web'),
('custom_css', ''),
('custom_js', '');

-- ================================================
-- Categorias de Passeios
-- ================================================
INSERT INTO tour_categories (name, slug, description, sort_order) VALUES
('Passeios Aquáticos', 'passeios-aquaticos', 'Aventuras no mar e praias paradisíacas', 1),
('Aventura', 'aventura', 'Atividades radicais e adrenalina', 2),
('Cultural', 'cultural', 'Conheca a história e cultura dominicana', 3),
('Noturno', 'noturno', 'Vida noturna e entretenimento', 4),
('Gastronomia', 'gastronomia', 'Experiências gastronômicas', 5),
('Relaxamento', 'relaxamento', 'Spa, praias e descanso', 6);

-- ================================================
-- Categorias do Blog
-- ================================================
INSERT INTO blog_categories (name, slug, description) VALUES
('Geral', 'geral', 'Posts gerais sobre Punta Cana'),
('Passeio', 'passeio', 'Detalhes sobre passeios'),
('Dicas de Viagem', 'dicas-de-viagem', 'Dicas para quem vai viajar'),
('Gastronomia', 'gastronomia', 'Restaurantes e culinária'),
('Cultura', 'cultura', 'Cultura e história dominicana');
