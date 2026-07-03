<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? 'Admin') ?> - <?= e(site_config('site_name', 'Punta Cana BR')) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= asset('css/admin.css') ?>" rel="stylesheet">
</head>
<body class="admin-body">
    <div class="d-flex">
        <!-- Sidebar -->
        <?php include VIEWS_PATH . '/partials/admin-sidebar.php'; ?>

        <!-- Main Content -->
        <div class="admin-main flex-grow-1">
            <!-- Top Navbar -->
            <nav class="navbar navbar-light bg-white border-bottom px-4 py-2">
                <div class="d-flex align-items-center">
                    <button class="btn btn-link text-dark d-lg-none me-2" id="sidebarToggle">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <span class="text-muted small">Olá, <?= e($_SESSION['user_name'] ?? 'Admin') ?></span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= base_url() ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-box-arrow-up-right"></i> Ver Site
                    </a>
                    <a href="<?= base_url('admin/logout') ?>" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-box-arrow-right"></i> Sair
                    </a>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="p-4">
                <?= $content ?? '' ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= asset('js/admin.js') ?>"></script>
</body>
</html>
