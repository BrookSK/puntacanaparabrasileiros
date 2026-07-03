<?php ob_start(); ?>
<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-4">Busca</h1>
        <form action="<?= base_url('busca') ?>" method="GET" class="mb-4">
            <div class="input-group input-group-lg">
                <input type="text" name="q" class="form-control" placeholder="Buscar passeios, blog..." value="<?= e($query) ?>">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
            </div>
        </form>
        <?php if (!empty($query)): ?>
        <p class="text-muted"><?= count($results) ?> resultado(s) para "<?= e($query) ?>"</p>
        <?php foreach ($results as $r): ?>
        <div class="card border-0 shadow-sm mb-3 p-3">
            <h5 class="fw-bold">
                <a href="<?= base_url(($r['type'] === 'tour' ? 'passeio/' : 'blog/post/') . $r['slug']) ?>" class="text-decoration-none text-dark"><?= e($r['name']) ?></a>
            </h5>
            <p class="text-muted small mb-0"><?= e(str_limit($r['description'] ?? '', 150)) ?></p>
            <span class="badge bg-<?= $r['type'] === 'tour' ? 'primary' : 'success' ?> mt-1"><?= $r['type'] === 'tour' ? 'Passeio' : 'Blog' ?></span>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>
<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
