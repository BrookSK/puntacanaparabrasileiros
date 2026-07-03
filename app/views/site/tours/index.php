<?php ob_start(); ?>

<!-- Hero -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center">
            <h1 class="display-5 fw-bold">Passeios e Experiências</h1>
            <p class="lead text-muted">Descubra os melhores passeios em Punta Cana com atendimento em português.</p>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Filtros (Sidebar) -->
            <div class="col-lg-3 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Filtros</h5>
                        <form action="<?= base_url('experiencias') ?>" method="GET">
                            <!-- Categoria -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Categoria</label>
                                <select name="category" class="form-select form-select-sm">
                                    <option value="">Todas</option>
                                    <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= ($filters['category'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                                        <?= e($cat['name']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Preço -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Preço (USD)</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="number" name="price_min" class="form-control form-control-sm" placeholder="Min" value="<?= e($filters['price_min'] ?? '') ?>">
                                    </div>
                                    <div class="col-6">
                                        <input type="number" name="price_max" class="form-control form-control-sm" placeholder="Max" value="<?= e($filters['price_max'] ?? '') ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- Duração -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Duração (dias)</label>
                                <select name="days" class="form-select form-select-sm">
                                    <option value="">Todos</option>
                                    <option value="0" <?= ($filters['duration_days'] ?? '') === '0' ? 'selected' : '' ?>>Menos de 1 dia</option>
                                    <option value="1" <?= ($filters['duration_days'] ?? '') === '1' ? 'selected' : '' ?>>1 dia</option>
                                    <option value="2" <?= ($filters['duration_days'] ?? '') === '2' ? 'selected' : '' ?>>2 dias</option>
                                </select>
                            </div>
                            <!-- Busca -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Buscar</label>
                                <input type="text" name="q" class="form-control form-control-sm" placeholder="Nome do passeio..." value="<?= e($filters['search'] ?? '') ?>">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm w-100">Filtrar</button>
                            <a href="<?= base_url('experiencias') ?>" class="btn btn-outline-secondary btn-sm w-100 mt-2">Limpar</a>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Grid de Passeios -->
            <div class="col-lg-9">
                <?php if (empty($tours)): ?>
                <div class="text-center py-5">
                    <i class="bi bi-search fs-1 text-muted"></i>
                    <h4 class="mt-3">Nenhum passeio encontrado</h4>
                    <p class="text-muted">Tente alterar os filtros de busca.</p>
                </div>
                <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($tours as $tour): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card tour-card h-100 border-0 shadow-sm">
                            <div class="position-relative">
                                <img src="<?= e($tour['image_url'] ?: asset('img/tour-placeholder.jpg')) ?>" 
                                     class="card-img-top" alt="<?= e($tour['name']) ?>" style="height:200px;object-fit:cover;">
                                <?php if ($tour['discount_percent'] > 0): ?>
                                <span class="badge bg-danger position-absolute top-0 end-0 m-2"><?= (int)$tour['discount_percent'] ?>% Off</span>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <span class="badge bg-primary-subtle text-primary small"><?= e($tour['category_name'] ?? '') ?></span>
                                <h6 class="card-title fw-bold mt-2">
                                    <a href="<?= base_url('passeio/' . $tour['slug']) ?>" class="text-decoration-none text-dark"><?= e($tour['name']) ?></a>
                                </h6>
                                <p class="card-text text-muted small"><?= e(str_limit($tour['description'] ?? '', 80)) ?></p>
                            </div>
                            <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                                <span class="small text-muted">
                                    <?php if ($tour['duration_hours']): ?>
                                    <i class="bi bi-clock"></i> <?= (int)$tour['duration_hours'] ?>h
                                    <?php endif; ?>
                                </span>
                                <span class="fw-bold text-primary"><?= format_money($tour['price_from']) ?></span>
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
                            <a class="page-link" href="<?= base_url('experiencias?page=' . $i) ?>"><?= $i ?></a>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
                <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
