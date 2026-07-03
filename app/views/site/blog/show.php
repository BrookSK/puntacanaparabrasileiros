<?php ob_start(); ?>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-3">
                    <ol class="breadcrumb small">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('blog') ?>">Blog</a></li>
                        <li class="breadcrumb-item active"><?= e(str_limit($post['title'], 40)) ?></li>
                    </ol>
                </nav>

                <span class="badge bg-primary-subtle text-primary"><?= e($post['category_name'] ?? 'Geral') ?></span>
                <h1 class="fw-bold mt-2"><?= e($post['title']) ?></h1>
                <p class="text-muted small">
                    Por <?= e($post['author_name'] ?? 'Equipe') ?> • <?= format_date($post['published_at']) ?>
                </p>

                <?php if ($post['image_url']): ?>
                <img src="<?= e($post['image_url']) ?>" class="img-fluid rounded-4 mb-4 w-100" style="max-height:400px;object-fit:cover;">
                <?php endif; ?>

                <div class="blog-content">
                    <?= $post['content'] ?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold">Posts Recentes</h5>
                        <ul class="list-unstyled">
                            <?php foreach ($recentPosts as $recent): ?>
                            <li class="mb-3 pb-3 border-bottom">
                                <a href="<?= base_url('blog/post/' . $recent['slug']) ?>" class="text-decoration-none text-dark fw-semibold small"><?= e($recent['title']) ?></a>
                                <br><small class="text-muted"><?= format_date($recent['published_at']) ?></small>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
