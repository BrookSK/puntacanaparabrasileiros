<?php ob_start(); ?>

<!-- Hero -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h1 class="display-5 fw-bold">Fale Conosco</h1>
            <p class="lead text-muted">Estamos prontos para ajudar você a planejar a viagem dos seus sonhos para Punta Cana.</p>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Info de Contato -->
            <div class="col-lg-5" data-aos="fade-right">
                <h3 class="fw-bold mb-4">Informações de Contato</h3>
                
                <div class="mb-4">
                    <h6 class="fw-bold"><i class="bi bi-geo-alt text-primary"></i> Endereço</h6>
                    <p class="text-muted"><?= e(site_config('address', 'Avenida Barceló, nº 01, Local 7 - Plaza Arrecife')) ?><br>
                    <?= e(site_config('city', 'Verón - Punta Cana')) ?><br>
                    <?= e(site_config('country', 'República Dominicana')) ?> - Código Postal <?= e(site_config('postal_code', '23000')) ?></p>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold"><i class="bi bi-envelope text-primary"></i> Email</h6>
                    <p class="text-muted">
                        Informações: <a href="mailto:contato@puntacanaparabrasileiros.com">contato@puntacanaparabrasileiros.com</a><br>
                        Reservas: <a href="mailto:reservas@puntacanaparabrasileiros.com">reservas@puntacanaparabrasileiros.com</a><br>
                        Suporte: <a href="mailto:suporte@puntacanaparabrasileiros.com">suporte@puntacanaparabrasileiros.com</a>
                    </p>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold"><i class="bi bi-telephone text-primary"></i> Telefone</h6>
                    <p class="text-muted">
                        República Dominicana: <?= e(site_config('phone_primary', '+1 (829) 458-2170')) ?><br>
                        WhatsApp: <?= e(site_config('phone_primary', '+1 (829) 458-2170')) ?>
                    </p>
                </div>

                <div class="mb-4">
                    <h6 class="fw-bold"><i class="bi bi-clock text-primary"></i> Horário de Atendimento</h6>
                    <p class="text-muted">
                        Segunda a Sexta: 8h às 18h<br>
                        Sábado: 8h às 16h<br>
                        Domingo: Apenas atendimento online
                    </p>
                </div>

                <div>
                    <h6 class="fw-bold"><i class="bi bi-share text-primary"></i> Redes Sociais</h6>
                    <div class="d-flex gap-3">
                        <?php if (site_config('instagram_url')): ?>
                        <a href="<?= e(site_config('instagram_url')) ?>" target="_blank" class="btn btn-outline-primary"><i class="bi bi-instagram"></i></a>
                        <?php endif; ?>
                        <?php if (site_config('threads_url')): ?>
                        <a href="<?= e(site_config('threads_url')) ?>" target="_blank" class="btn btn-outline-primary"><i class="bi bi-threads"></i></a>
                        <?php endif; ?>
                        <a href="https://api.whatsapp.com/send?phone=<?= e(site_config('phone_whatsapp', '18294582170')) ?>" target="_blank" class="btn btn-outline-success"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <!-- Formulário -->
            <div class="col-lg-7" data-aos="fade-left">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-4">Entre em contato</h4>
                        <form action="<?= base_url('contato/enviar') ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nome *</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Telefone</label>
                                    <input type="tel" name="phone" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Assunto</label>
                                    <select name="subject" class="form-select">
                                        <option value="">Selecione o Assunto</option>
                                        <option value="Informações Gerais">Informações Gerais</option>
                                        <option value="Reserva de Passeio">Reserva de Passeio</option>
                                        <option value="Transfer">Transfer</option>
                                        <option value="Cancelamento">Cancelamento</option>
                                        <option value="Programa de Afiliados">Programa de Afiliados</option>
                                        <option value="Outro">Outro</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Mensagem *</label>
                                    <textarea name="message" class="form-control" rows="5" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100">
                                        <i class="bi bi-send"></i> Enviar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
