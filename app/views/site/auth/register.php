<?php ob_start(); ?>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold">Criar sua conta</h3>
                            <p class="text-muted small">Crie sua conta para agendar passeios e acompanhar suas reservas</p>
                        </div>

                        <?php if (has_flash('error')): ?>
                        <div class="alert alert-danger small"><?= flash('error') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('registro/criar') ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label class="form-label">Nome Completo *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Telefone / WhatsApp</label>
                                <input type="tel" name="phone" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Senha *</label>
                                    <input type="password" name="password" class="form-control" required minlength="6">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Confirmar Senha *</label>
                                    <input type="password" name="password_confirm" class="form-control" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Criar Conta</button>
                        </form>

                        <div class="text-center">
                            <p class="small text-muted">
                                Já tem uma conta? <a href="<?= base_url('login') ?>">Fazer login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
