<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Punta Cana para Brasileiros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #0d6efd 0%, #0a3d91 100%); min-height: 100vh; }
        .login-card { max-width: 420px; margin: auto; margin-top: 10vh; }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-card">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="bi bi-tropical-storm fs-1 text-primary"></i>
                        <h4 class="fw-bold mt-2">Painel Administrativo</h4>
                        <p class="text-muted small">Punta Cana para Brasileiros</p>
                    </div>

                    <?php if (has_flash('error')): ?>
                    <div class="alert alert-danger small"><?= flash('error') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/login/autenticar') ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-box-arrow-in-right"></i> Entrar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
