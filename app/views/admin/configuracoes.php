<?php ob_start(); ?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold">
            <i class="bi bi-gear"></i> Configurações do Sistema
        </h1>
    </div>

    <?php if (has_flash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= flash('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>
    <?php if (has_flash('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= flash('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Tabs de configurações -->
    <ul class="nav nav-tabs" id="configTabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#tab-general">Geral</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-smtp">SMTP / Email</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-api">APIs</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-affiliate">Afiliados</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-checkout">Checkout / Voucher</a></li>
        <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab-appearance">Aparência</a></li>
    </ul>

    <div class="tab-content mt-4">

        <!-- Tab Geral -->
        <div class="tab-pane fade show active" id="tab-general">
            <form action="<?= base_url('admin/configuracoes/salvar') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="config_group" value="general">
                <div class="card">
                    <div class="card-header"><h5 class="mb-0">Informações Gerais</h5></div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nome do Site</label>
                                <input type="text" name="site_name" class="form-control" 
                                    value="<?= e($configs['site_name'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email do Admin</label>
                                <input type="email" name="admin_email" class="form-control" 
                                    value="<?= e($configs['admin_email'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Descrição do Site</label>
                                <textarea name="site_description" class="form-control" rows="2"><?= e($configs['site_description'] ?? '') ?></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Palavras-chave (SEO)</label>
                                <input type="text" name="site_keywords" class="form-control" 
                                    value="<?= e($configs['site_keywords'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telefone Principal</label>
                                <input type="text" name="phone_primary" class="form-control" 
                                    value="<?= e($configs['phone_primary'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">WhatsApp (só números)</label>
                                <input type="text" name="phone_whatsapp" class="form-control" 
                                    value="<?= e($configs['phone_whatsapp'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Endereço</label>
                                <input type="text" name="address" class="form-control" 
                                    value="<?= e($configs['address'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Cidade</label>
                                <input type="text" name="city" class="form-control" 
                                    value="<?= e($configs['city'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">País</label>
                                <input type="text" name="country" class="form-control" 
                                    value="<?= e($configs['country'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Código Postal</label>
                                <input type="text" name="postal_code" class="form-control" 
                                    value="<?= e($configs['postal_code'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nome da Empresa</label>
                                <input type="text" name="company_name" class="form-control" 
                                    value="<?= e($configs['company_name'] ?? '') ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">RNC</label>
                                <input type="text" name="company_rnc" class="form-control" 
                                    value="<?= e($configs['company_rnc'] ?? '') ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Moeda</label>
                                <select name="currency" class="form-select">
                                    <option value="USD" <?= ($configs['currency'] ?? '') === 'USD' ? 'selected' : '' ?>>USD (Dólar)</option>
                                    <option value="BRL" <?= ($configs['currency'] ?? '') === 'BRL' ? 'selected' : '' ?>>BRL (Real)</option>
                                    <option value="DOP" <?= ($configs['currency'] ?? '') === 'DOP' ? 'selected' : '' ?>>DOP (Peso)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Instagram URL</label>
                                <input type="url" name="instagram_url" class="form-control" 
                                    value="<?= e($configs['instagram_url'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Threads URL</label>
                                <input type="url" name="threads_url" class="form-control" 
                                    value="<?= e($configs['threads_url'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Facebook URL</label>
                                <input type="url" name="facebook_url" class="form-control" 
                                    value="<?= e($configs['facebook_url'] ?? '') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar Configurações Gerais</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tab SMTP -->
        <div class="tab-pane fade" id="tab-smtp">
            <form action="<?= base_url('admin/configuracoes/salvar') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="config_group" value="smtp">
                <div class="card">
                    <div class="card-header"><h5 class="mb-0">Configurações de Email (SMTP)</h5></div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label class="form-label">Host SMTP</label>
                                <input type="text" name="smtp_host" class="form-control" 
                                    value="<?= e($configs['smtp_host'] ?? '') ?>" placeholder="smtp.gmail.com">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Porta</label>
                                <input type="number" name="smtp_port" class="form-control" 
                                    value="<?= e($configs['smtp_port'] ?? '587') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Usuário SMTP</label>
                                <input type="text" name="smtp_user" class="form-control" 
                                    value="<?= e($configs['smtp_user'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Senha SMTP</label>
                                <input type="password" name="smtp_pass" class="form-control" 
                                    value="<?= e($configs['smtp_pass'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Criptografia</label>
                                <select name="smtp_encryption" class="form-select">
                                    <option value="tls" <?= ($configs['smtp_encryption'] ?? '') === 'tls' ? 'selected' : '' ?>>TLS</option>
                                    <option value="ssl" <?= ($configs['smtp_encryption'] ?? '') === 'ssl' ? 'selected' : '' ?>>SSL</option>
                                    <option value="" <?= ($configs['smtp_encryption'] ?? '') === '' ? 'selected' : '' ?>>Nenhuma</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nome do Remetente</label>
                                <input type="text" name="smtp_from_name" class="form-control" 
                                    value="<?= e($configs['smtp_from_name'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email do Remetente</label>
                                <input type="email" name="smtp_from_email" class="form-control" 
                                    value="<?= e($configs['smtp_from_email'] ?? '') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar SMTP</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tab APIs -->
        <div class="tab-pane fade" id="tab-api">
            <form action="<?= base_url('admin/configuracoes/salvar') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="config_group" value="api">
                <div class="card">
                    <div class="card-header"><h5 class="mb-0">Chaves de API</h5></div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12"><h6 class="text-primary">OpenAI / ChatGPT</h6></div>
                            <div class="col-md-8">
                                <label class="form-label">API Key do OpenAI</label>
                                <input type="password" name="openai_api_key" class="form-control" 
                                    value="<?= e($configs['openai_api_key'] ?? '') ?>" placeholder="sk-...">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Modelo</label>
                                <select name="openai_model" class="form-select">
                                    <option value="gpt-4" <?= ($configs['openai_model'] ?? '') === 'gpt-4' ? 'selected' : '' ?>>GPT-4</option>
                                    <option value="gpt-4o" <?= ($configs['openai_model'] ?? '') === 'gpt-4o' ? 'selected' : '' ?>>GPT-4o</option>
                                    <option value="gpt-3.5-turbo" <?= ($configs['openai_model'] ?? '') === 'gpt-3.5-turbo' ? 'selected' : '' ?>>GPT-3.5 Turbo</option>
                                </select>
                            </div>
                            <div class="col-12"><hr><h6 class="text-primary">PayPal</h6></div>
                            <div class="col-md-6">
                                <label class="form-label">Client ID</label>
                                <input type="text" name="paypal_client_id" class="form-control" 
                                    value="<?= e($configs['paypal_client_id'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Client Secret</label>
                                <input type="password" name="paypal_client_secret" class="form-control" 
                                    value="<?= e($configs['paypal_client_secret'] ?? '') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Modo</label>
                                <select name="paypal_mode" class="form-select">
                                    <option value="sandbox" <?= ($configs['paypal_mode'] ?? '') === 'sandbox' ? 'selected' : '' ?>>Sandbox (Testes)</option>
                                    <option value="live" <?= ($configs['paypal_mode'] ?? '') === 'live' ? 'selected' : '' ?>>Live (Produção)</option>
                                </select>
                            </div>
                            <div class="col-12"><hr><h6 class="text-primary">Google</h6></div>
                            <div class="col-md-6">
                                <label class="form-label">Google Analytics ID</label>
                                <input type="text" name="google_analytics_id" class="form-control" 
                                    value="<?= e($configs['google_analytics_id'] ?? '') ?>" placeholder="G-XXXXXXXXXX">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Google Maps API Key</label>
                                <input type="text" name="google_maps_key" class="form-control" 
                                    value="<?= e($configs['google_maps_key'] ?? '') ?>">
                            </div>
                            <div class="col-12"><hr><h6 class="text-primary">reCAPTCHA</h6></div>
                            <div class="col-md-6">
                                <label class="form-label">Site Key</label>
                                <input type="text" name="recaptcha_site_key" class="form-control" 
                                    value="<?= e($configs['recaptcha_site_key'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Secret Key</label>
                                <input type="password" name="recaptcha_secret_key" class="form-control" 
                                    value="<?= e($configs['recaptcha_secret_key'] ?? '') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar APIs</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tab Afiliados -->
        <div class="tab-pane fade" id="tab-affiliate">
            <form action="<?= base_url('admin/configuracoes/salvar') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="config_group" value="affiliate">
                <div class="card">
                    <div class="card-header"><h5 class="mb-0">Configurações de Afiliados</h5></div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Comissão Padrão (%)</label>
                                <input type="number" name="affiliate_commission_percent" class="form-control" step="0.5"
                                    value="<?= e($configs['affiliate_commission_percent'] ?? '10') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Valor Mínimo para Saque ($)</label>
                                <input type="number" name="affiliate_min_payout" class="form-control" step="1"
                                    value="<?= e($configs['affiliate_min_payout'] ?? '50') ?>">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Duração do Cookie (dias)</label>
                                <input type="number" name="affiliate_cookie_days" class="form-control"
                                    value="<?= e($configs['affiliate_cookie_days'] ?? '30') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Aprovação Automática</label>
                                <select name="affiliate_auto_approve" class="form-select">
                                    <option value="0" <?= ($configs['affiliate_auto_approve'] ?? '0') === '0' ? 'selected' : '' ?>>Não (Aprovação Manual)</option>
                                    <option value="1" <?= ($configs['affiliate_auto_approve'] ?? '0') === '1' ? 'selected' : '' ?>>Sim (Automática)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pagamento via PayPal</label>
                                <select name="affiliate_paypal_enabled" class="form-select">
                                    <option value="1" <?= ($configs['affiliate_paypal_enabled'] ?? '1') === '1' ? 'selected' : '' ?>>Habilitado</option>
                                    <option value="0" <?= ($configs['affiliate_paypal_enabled'] ?? '1') === '0' ? 'selected' : '' ?>>Desabilitado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar Afiliados</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tab Checkout/Voucher -->
        <div class="tab-pane fade" id="tab-checkout">
            <form action="<?= base_url('admin/configuracoes/salvar') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="config_group" value="checkout">
                <div class="card">
                    <div class="card-header"><h5 class="mb-0">Checkout e Voucher</h5></div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Termos Obrigatórios</label>
                                <select name="checkout_terms_required" class="form-select">
                                    <option value="1" <?= ($configs['checkout_terms_required'] ?? '1') === '1' ? 'selected' : '' ?>>Sim</option>
                                    <option value="0" <?= ($configs['checkout_terms_required'] ?? '1') === '0' ? 'selected' : '' ?>>Não</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Compra como Visitante</label>
                                <select name="checkout_guest_enabled" class="form-select">
                                    <option value="0" <?= ($configs['checkout_guest_enabled'] ?? '0') === '0' ? 'selected' : '' ?>>Não (Login obrigatório)</option>
                                    <option value="1" <?= ($configs['checkout_guest_enabled'] ?? '0') === '1' ? 'selected' : '' ?>>Sim</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Antecedência Mínima (horas)</label>
                                <input type="number" name="checkout_min_advance_hours" class="form-control"
                                    value="<?= e($configs['checkout_min_advance_hours'] ?? '24') ?>">
                            </div>
                            <div class="col-12"><hr><h6>Configurações do Voucher</h6></div>
                            <div class="col-12">
                                <label class="form-label">URL do Logo no Voucher</label>
                                <input type="url" name="voucher_logo_url" class="form-control" 
                                    value="<?= e($configs['voucher_logo_url'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Texto do Rodapé do Voucher</label>
                                <input type="text" name="voucher_footer_text" class="form-control" 
                                    value="<?= e($configs['voucher_footer_text'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Info de Contato no Voucher</label>
                                <input type="text" name="voucher_contact_info" class="form-control" 
                                    value="<?= e($configs['voucher_contact_info'] ?? '') ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar Checkout</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tab Aparência -->
        <div class="tab-pane fade" id="tab-appearance">
            <form action="<?= base_url('admin/configuracoes/salvar') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="config_group" value="appearance">
                <div class="card">
                    <div class="card-header"><h5 class="mb-0">Aparência do Site</h5></div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">URL do Logo</label>
                                <input type="url" name="logo_url" class="form-control" 
                                    value="<?= e($configs['logo_url'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">URL do Favicon</label>
                                <input type="url" name="favicon_url" class="form-control" 
                                    value="<?= e($configs['favicon_url'] ?? '') ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Cor Primária</label>
                                <input type="color" name="primary_color" class="form-control form-control-color w-100" 
                                    value="<?= e($configs['primary_color'] ?? '#0d6efd') ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Cor Secundária</label>
                                <input type="color" name="secondary_color" class="form-control form-control-color w-100" 
                                    value="<?= e($configs['secondary_color'] ?? '#198754') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Imagem Hero (URL)</label>
                                <input type="url" name="hero_image_url" class="form-control" 
                                    value="<?= e($configs['hero_image_url'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Título do Hero</label>
                                <input type="text" name="hero_title" class="form-control" 
                                    value="<?= e($configs['hero_title'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Subtítulo do Hero</label>
                                <input type="text" name="hero_subtitle" class="form-control" 
                                    value="<?= e($configs['hero_subtitle'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Texto do Footer</label>
                                <input type="text" name="footer_text" class="form-control" 
                                    value="<?= e($configs['footer_text'] ?? '') ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label">CSS Customizado</label>
                                <textarea name="custom_css" class="form-control font-monospace" rows="4"><?= e($configs['custom_css'] ?? '') ?></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">JavaScript Customizado</label>
                                <textarea name="custom_js" class="form-control font-monospace" rows="4"><?= e($configs['custom_js'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar Aparência</button>
                    </div>
                </div>
            </form>
        </div>

    </div><!-- /tab-content -->
</div>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/admin.php'; ?>
