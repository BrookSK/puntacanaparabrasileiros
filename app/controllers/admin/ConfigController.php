<?php
namespace Admin;

/**
 * Controller de Configurações do Sistema (SuperAdmin)
 * Todas as configs ficam no banco de dados
 */
class ConfigController extends \Controller
{
    public function index()
    {
        $this->requireSuperAdmin();

        $configModel = new \ConfigModel($this->db);
        $configs = $configModel->getAll();

        $this->view('admin.configuracoes', [
            'pageTitle' => 'Configurações do Sistema',
            'configs' => $configs,
        ]);
    }

    public function save()
    {
        $this->requireSuperAdmin();

        if (!$this->isPost()) {
            $this->redirect('admin/configuracoes');
            return;
        }

        if (!verify_csrf($this->input('csrf_token'))) {
            flash('error', 'Token de segurança inválido.');
            $this->redirect('admin/configuracoes');
            return;
        }

        $configModel = new \ConfigModel($this->db);

        // Grupo de configurações que estamos salvando
        $group = $this->input('config_group', 'general');

        $configsToSave = [];

        switch ($group) {
            case 'general':
                $configsToSave = [
                    'site_name' => $this->input('site_name', ''),
                    'site_description' => $this->input('site_description', ''),
                    'site_keywords' => $this->input('site_keywords', ''),
                    'admin_email' => $this->input('admin_email', ''),
                    'phone_primary' => $this->input('phone_primary', ''),
                    'phone_whatsapp' => $this->input('phone_whatsapp', ''),
                    'address' => $this->input('address', ''),
                    'city' => $this->input('city', ''),
                    'country' => $this->input('country', ''),
                    'postal_code' => $this->input('postal_code', ''),
                    'company_name' => $this->input('company_name', ''),
                    'company_rnc' => $this->input('company_rnc', ''),
                    'currency' => $this->input('currency', 'USD'),
                    'timezone' => $this->input('timezone', 'America/Santo_Domingo'),
                    'instagram_url' => $this->input('instagram_url', ''),
                    'threads_url' => $this->input('threads_url', ''),
                    'facebook_url' => $this->input('facebook_url', ''),
                ];
                break;

            case 'smtp':
                $configsToSave = [
                    'smtp_host' => $this->input('smtp_host', ''),
                    'smtp_port' => $this->input('smtp_port', '587'),
                    'smtp_user' => $this->input('smtp_user', ''),
                    'smtp_pass' => $this->input('smtp_pass', ''),
                    'smtp_encryption' => $this->input('smtp_encryption', 'tls'),
                    'smtp_from_name' => $this->input('smtp_from_name', ''),
                    'smtp_from_email' => $this->input('smtp_from_email', ''),
                ];
                break;

            case 'api':
                $configsToSave = [
                    'openai_api_key' => $this->input('openai_api_key', ''),
                    'openai_model' => $this->input('openai_model', 'gpt-4'),
                    'paypal_client_id' => $this->input('paypal_client_id', ''),
                    'paypal_client_secret' => $this->input('paypal_client_secret', ''),
                    'paypal_mode' => $this->input('paypal_mode', 'sandbox'),
                    'google_analytics_id' => $this->input('google_analytics_id', ''),
                    'google_maps_key' => $this->input('google_maps_key', ''),
                    'recaptcha_site_key' => $this->input('recaptcha_site_key', ''),
                    'recaptcha_secret_key' => $this->input('recaptcha_secret_key', ''),
                ];
                break;

            case 'affiliate':
                $configsToSave = [
                    'affiliate_commission_percent' => $this->input('affiliate_commission_percent', '10'),
                    'affiliate_min_payout' => $this->input('affiliate_min_payout', '50'),
                    'affiliate_cookie_days' => $this->input('affiliate_cookie_days', '30'),
                    'affiliate_auto_approve' => $this->input('affiliate_auto_approve', '0'),
                    'affiliate_paypal_enabled' => $this->input('affiliate_paypal_enabled', '1'),
                ];
                break;

            case 'checkout':
                $configsToSave = [
                    'checkout_terms_required' => $this->input('checkout_terms_required', '1'),
                    'checkout_guest_enabled' => $this->input('checkout_guest_enabled', '0'),
                    'checkout_min_advance_hours' => $this->input('checkout_min_advance_hours', '24'),
                    'voucher_logo_url' => $this->input('voucher_logo_url', ''),
                    'voucher_footer_text' => $this->input('voucher_footer_text', ''),
                    'voucher_contact_info' => $this->input('voucher_contact_info', ''),
                ];
                break;

            case 'appearance':
                $configsToSave = [
                    'logo_url' => $this->input('logo_url', ''),
                    'favicon_url' => $this->input('favicon_url', ''),
                    'primary_color' => $this->input('primary_color', '#0d6efd'),
                    'secondary_color' => $this->input('secondary_color', '#198754'),
                    'hero_title' => $this->input('hero_title', ''),
                    'hero_subtitle' => $this->input('hero_subtitle', ''),
                    'hero_image_url' => $this->input('hero_image_url', ''),
                    'footer_text' => $this->input('footer_text', ''),
                    'custom_css' => $this->input('custom_css', ''),
                    'custom_js' => $this->input('custom_js', ''),
                ];
                break;
        }

        if ($configModel->setMany($configsToSave)) {
            flash('success', 'Configurações salvas com sucesso!');
        } else {
            flash('error', 'Erro ao salvar configurações. Tente novamente.');
        }

        $this->redirect('admin/configuracoes');
    }
}
