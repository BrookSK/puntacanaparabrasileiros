<?php ob_start(); ?>
<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-4"><i class="bi bi-heart"></i> Lista de Desejos</h1>
        <?php if (empty($tours)): ?>
        <div class="text-center py-5">
            <i class="bi bi-heart fs-1 text-muted"></i>
            <h4 class="mt-3">Sua lista de desejos está vazia</h4>
            <a href="<?= base_url('experiencias') ?>" class="btn btn-primary">Explorar Passeios</a>
        </div>
        <?php else: ?>
        <div class="row g-4">
            <?php foreach ($tours as $tour): ?>
            <div class="col-md-4">
                <div class="card tour-card h-100 border-0 shadow-sm">
                    <img src="<?= e($tour['image_url'] ?: asset('img/tour-placeholder.jpg')) ?>" class="card-img-top" style="height:200px;object-fit:cover;">
                    <div class="card-body">
                        <h5 class="fw-bold"><a href="<?= base_url('passeio/' . $tour['slug']) ?>" class="text-decoration-none text-dark"><?= e($tour['name']) ?></a></h5>
                        <span class="fw-bold text-primary"><?= format_money($tour['price_from']) ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
