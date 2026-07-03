<?php ob_start(); ?>

<section class="py-5 bg-light">
    <div class="container text-center">
        <h1 class="display-5 fw-bold">Blog de Viagem</h1>
        <p class="lead text-muted">Descubra roteiros, curiosidades e dicas práticas para Punta Cana.</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <!-- Filtro de categorias -->
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="<?= base_url('blog') ?>" class="btn btn-sm <?= empty($currentCategory) ? 'btn-primary' : 'btn-outline-primary' ?>">Todos</a>
            <?php foreach ($categories as $cat): ?>
            <a href="<?= base_url('blog?category=' . $cat['id']) ?>" class="btn btn-sm <?= $currentCategory == $cat['id'] ? 'btn-primary' : 'btn-outline-primary' ?>"><?= e($cat['name']) ?></a>
            <?php endforeach; ?>
        </div>

        <?php if (empty($posts)): ?>
        <div class="text-center py-5">
            <i class="bi bi-journal fs-1 text-muted"></i>
            <h4 class="mt-3">Nenhum post encontrado</h4>
        </div>
        <?php else: ?>
        <div class="row g-4">
            <?php foreach ($posts as $post): ?>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="<?= e($post['image_url'] ?: asset('img/blog-placeholder.jpg')) ?>" class="card-img-top" style="height:200px;object-fit:cover;">
                    <div class="card-body">
                        <span class="badge bg-primary-subtle text-primary small"><?= e($post['category_name'] ?? 'Geral') ?></span>
                        <h5 class="card-title fw-bold mt-2">
                            <a href="<?= base_url('blog/post/' . $post['slug']) ?>" class="text-decoration-none text-dark"><?= e($post['title']) ?></a>
                        </h5>
                        <p class="text-muted small"><?= e(str_limit($post['excerpt'] ?? '', 100)) ?></p>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <small class="text-muted"><?= e($post['author_name'] ?? 'Equipe') ?> • <?= format_date($post['published_at']) ?></small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Paginação -->
        <?php if ($totalPages > 1): ?>
        <nav class="mt-5">
            <ul class="pagination justify-content-center">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                    <a class="page-link" href="<?= base_url('blog?page=' . $i . ($currentCategory ? '&category=' . $currentCategory : '')) ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
            </ul>
        </nav>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
