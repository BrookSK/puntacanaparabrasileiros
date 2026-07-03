<?php ob_start(); ?>

<section class="py-5">
    <div class="container">
        <h2 class="fw-bold mb-4">Resultados de Transfer</h2>
        <p class="text-muted mb-4">
            <?php if (!empty($results)): ?>
                <?= count($results) ?> veículo(s) encontrado(s)
            <?php endif; ?>
        </p>

        <?php if (empty($results)): ?>
        <div class="alert alert-warning text-center py-5">
            <i class="bi bi-exclamation-triangle fs-1"></i>
            <h4 class="mt-3">Veículo indisponível para a rota selecionada</h4>
            <p class="text-muted">Tente mudar os parâmetros da busca ou entre em contato conosco.</p>
            <a href="<?= base_url('transfer') ?>" class="btn btn-primary me-2">Nova Busca</a>
            <a href="<?= base_url('contato') ?>" class="btn btn-outline-primary">Entre em Contato</a>
        </div>
        <?php else: ?>

        <?php foreach ($results as $route): ?>
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row align-items-center g-3">
                    <div class="col-md-2">
                        <?php if ($route['vehicle_image']): ?>
                        <img src="<?= e($route['vehicle_image']) ?>" class="img-fluid rounded" alt="<?= e($route['vehicle_name']) ?>">
                        <?php else: ?>
                        <div class="bg-light rounded p-3 text-center">
                            <i class="bi bi-car-front fs-1 text-primary"></i>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <h5 class="fw-bold"><?= e($route['vehicle_name']) ?></h5>
                        <span class="badge bg-<?= $route['service_type'] === 'private' ? 'primary' : 'success' ?>">
                            <?= $route['service_type'] === 'private' ? 'Privado' : 'Coletivo' ?>
                        </span>
                        <div class="mt-2 small text-muted">
                            <p class="mb-1"><i class="bi bi-geo-alt"></i> <strong>Saída:</strong> <?= e($route['origin_name']) ?></p>
                            <p class="mb-1"><i class="bi bi-geo-alt-fill"></i> <strong>Chegada:</strong> <?= e($route['destination_name']) ?></p>
                            <p class="mb-1"><i class="bi bi-calendar"></i> <?= e($searchParams['departure_date'] ?? '') ?></p>
                        </div>
                        <div class="d-flex gap-3 mt-2">
                            <span class="small"><i class="bi bi-people"></i> Até <?= $route['max_passengers'] ?> passageiros</span>
                            <span class="small"><i class="bi bi-luggage"></i> <?= $route['max_luggage'] ?> malas</span>
                            <span class="small"><i class="bi bi-clock"></i> ~<?= $route['duration_minutes'] ?> min</span>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <?php if ($searchParams['trip_type'] === 'roundtrip'): ?>
                        <p class="small text-muted mb-0">Ida e volta</p>
                        <h3 class="fw-bold text-primary"><?= format_money($route['round_trip_price']) ?></h3>
                        <?php else: ?>
                        <p class="small text-muted mb-0">Somente ida</p>
                        <h3 class="fw-bold text-primary"><?= format_money($route['one_way_price']) ?></h3>
                        <?php endif; ?>
                        
                        <form action="<?= base_url('carrinho/adicionar') ?>" method="POST" class="d-inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="item_type" value="transfer">
                            <input type="hidden" name="route_id" value="<?= $route['id'] ?>">
                            <input type="hidden" name="item_id" value="<?= $route['id'] ?>">
                            <input type="hidden" name="trip_type" value="<?= e($searchParams['trip_type']) ?>">
                            <input type="hidden" name="date" value="<?= e($searchParams['departure_date']) ?>">
                            <input type="hidden" name="time_slot" value="<?= e($searchParams['departure_time']) ?>">
                            <input type="hidden" name="adults" value="<?= $searchParams['adults'] ?>">
                            <input type="hidden" name="children" value="<?= $searchParams['children'] ?>">
                            <input type="hidden" name="babies" value="<?= $searchParams['babies'] ?>">
                            <button type="submit" class="btn btn-primary mt-2">
                                <i class="bi bi-cart-plus"></i> Adicionar ao Carrinho
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <?php endif; ?>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
