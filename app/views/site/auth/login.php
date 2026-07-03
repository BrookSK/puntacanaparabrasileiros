<?php ob_start(); ?>

<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h3 class="fw-bold">Entrar na sua conta</h3>
                            <p class="text-muted small">Acesse sua conta para gerenciar seus passeios e reservas</p>
                        </div>

                        <?php if (has_flash('error')): ?>
                        <div class="alert alert-danger small"><?= flash('error') ?></div>
                        <?php endif; ?>
                        <?php if (has_flash('success')): ?>
                        <div class="alert alert-success small"><?= flash('success') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('login/autenticar') ?>" method="POST">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Senha</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Entrar</button>
                        </form>

                        <div class="text-center">
                            <p class="small text-muted">
                                Não tem uma conta? <a href="<?= base_url('registro') ?>">Criar conta</a>
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
