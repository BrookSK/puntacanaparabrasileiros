<aside class="admin-sidebar bg-dark text-white" id="adminSidebar">
    <div class="p-3 border-bottom border-secondary">
        <a href="<?= base_url('admin') ?>" class="text-white text-decoration-none">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-tropical-storm"></i> PuntaCana BR
            </h5>
            <small class="text-muted">Painel Administrativo</small>
        </a>
    </div>

    <nav class="mt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('admin') ?>">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>

            <?php if (in_array($_SESSION['user_role'] ?? '', ['superadmin', 'admin'])): ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('admin/passeios') ?>">
                    <i class="bi bi-map"></i> Passeios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('admin/transfers') ?>">
                    <i class="bi bi-car-front"></i> Transfers
                </a>
            </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('admin/pedidos') ?>">
                    <i class="bi bi-receipt"></i> Pedidos
                </a>
            </li>

            <?php if (in_array($_SESSION['user_role'] ?? '', ['superadmin', 'admin'])): ?>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('admin/blog') ?>">
                    <i class="bi bi-journal-text"></i> Blog
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('admin/afiliados') ?>">
                    <i class="bi bi-people"></i> Afiliados
                </a>
            </li>
            <?php endif; ?>

            <?php if (($_SESSION['user_role'] ?? '') === 'superadmin'): ?>
            <li class="nav-item mt-3 border-top border-secondary pt-3">
                <small class="text-muted px-3 text-uppercase">Super Admin</small>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="<?= base_url('admin/usuarios') ?>">
                    <i class="bi bi-person-gear"></i> Usuários
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-warning" href="<?= base_url('admin/configuracoes') ?>">
                    <i class="bi bi-gear"></i> Configurações
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</aside>
