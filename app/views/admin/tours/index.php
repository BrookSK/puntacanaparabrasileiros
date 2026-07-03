<?php ob_start(); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold"><i class="bi bi-map"></i> Passeios</h1>
        <a href="<?= base_url('admin/passeios/criar') ?>" class="btn btn-primary"><i class="bi bi-plus"></i> Novo Passeio</a>
    </div>

    <?php if (has_flash('success')): ?>
    <div class="alert alert-success"><?= flash('success') ?></div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Categoria</th>
                            <th>Preço</th>
                            <th>Status</th>
                            <th>Destaque</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tours as $tour): ?>
                        <tr>
                            <td><img src="<?= e($tour['image_url'] ?: asset('img/tour-placeholder.jpg')) ?>" width="60" height="40" class="rounded" style="object-fit:cover;"></td>
                            <td><strong><?= e($tour['name']) ?></strong></td>
                            <td><?= e($tour['category_name'] ?? '-') ?></td>
                            <td><?= format_money($tour['price_from']) ?></td>
                            <td><span class="badge bg-<?= $tour['status'] === 'active' ? 'success' : 'secondary' ?>"><?= ucfirst($tour['status']) ?></span></td>
                            <td><?= $tour['featured'] ? '<i class="bi bi-star-fill text-warning"></i>' : '-' ?></td>
                            <td>
                                <a href="<?= base_url('admin/passeios/editar?id=' . $tour['id']) ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <a href="<?= base_url('admin/passeios/excluir?id=' . $tour['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Tem certeza?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/admin.php'; ?>
