<?php ob_start(); ?>

<section class="py-4">
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('experiencias') ?>">Passeios</a></li>
                <li class="breadcrumb-item active"><?= e($tour['name']) ?></li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Conteúdo Principal -->
            <div class="col-lg-8">
                <!-- Imagem -->
                <div class="position-relative mb-4">
                    <img src="<?= e($tour['image_url'] ?: asset('img/tour-placeholder.jpg')) ?>" 
                         class="img-fluid rounded-4 w-100" alt="<?= e($tour['name']) ?>" style="max-height:450px;object-fit:cover;">
                    <?php if ($tour['discount_percent'] > 0): ?>
                    <span class="badge bg-danger fs-6 position-absolute top-0 end-0 m-3"><?= (int)$tour['discount_percent'] ?>% Off</span>
                    <?php endif; ?>
                </div>

                <h1 class="fw-bold"><?= e($tour['name']) ?></h1>
                
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <?php if ($tour['duration_hours']): ?>
                    <span class="badge bg-light text-dark"><i class="bi bi-clock"></i> <?= (int)$tour['duration_hours'] ?> Horas</span>
                    <?php endif; ?>
                    <span class="badge bg-light text-dark"><i class="bi bi-tag"></i> <?= e($tour['category_name'] ?? '') ?></span>
                    <?php if (!$tour['pregnant_allowed']): ?>
                    <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle"></i> Não permitido para gestantes</span>
                    <?php endif; ?>
                </div>

                <!-- Visão Geral / Descrição -->
                <div class="mb-4">
                    <h4 class="fw-bold">Visão Geral</h4>
                    <div class="text-muted"><?= nl2br(e($tour['overview'] ?: $tour['description'])) ?></div>
                </div>

                <!-- Destaques -->
                <?php if ($tour['highlights']): ?>
                <div class="mb-4">
                    <h4 class="fw-bold">Destaques</h4>
                    <div class="text-muted"><?= nl2br(e($tour['highlights'])) ?></div>
                </div>
                <?php endif; ?>

                <!-- O que inclui / O que não inclui -->
                <div class="row g-4 mb-4">
                    <?php if ($tour['inclusions']): ?>
                    <div class="col-md-6">
                        <h5 class="fw-bold text-success"><i class="bi bi-check-circle"></i> O que inclui</h5>
                        <div class="text-muted"><?= nl2br(e($tour['inclusions'])) ?></div>
                    </div>
                    <?php endif; ?>
                    <?php if ($tour['exclusions']): ?>
                    <div class="col-md-6">
                        <h5 class="fw-bold text-danger"><i class="bi bi-x-circle"></i> O que não inclui</h5>
                        <div class="text-muted"><?= nl2br(e($tour['exclusions'])) ?></div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- O que levar -->
                <?php if ($tour['what_to_bring']): ?>
                <div class="mb-4">
                    <h5 class="fw-bold"><i class="bi bi-backpack"></i> O que levar</h5>
                    <div class="text-muted"><?= nl2br(e($tour['what_to_bring'])) ?></div>
                </div>
                <?php endif; ?>

                <!-- Restrições -->
                <?php if ($tour['restrictions']): ?>
                <div class="mb-4">
                    <h5 class="fw-bold"><i class="bi bi-exclamation-triangle"></i> Restrições</h5>
                    <div class="text-muted"><?= nl2br(e($tour['restrictions'])) ?></div>
                </div>
                <?php endif; ?>

                <!-- Documentos Obrigatórios -->
                <?php if (!empty($documents)): ?>
                <div class="mb-4">
                    <h5 class="fw-bold"><i class="bi bi-file-earmark-text"></i> Documentos Obrigatórios</h5>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($documents as $doc): ?>
                        <li class="list-group-item px-0">
                            <strong><?= e($doc['name']) ?></strong>
                            <?php if ($doc['required']): ?><span class="badge bg-danger small">Obrigatório</span><?php endif; ?>
                            <?php if ($doc['description']): ?><p class="small text-muted mb-0"><?= e($doc['description']) ?></p><?php endif; ?>
                            <small class="text-muted">Enviar: <?= $doc['submission_time'] === 'checkout' ? 'No checkout' : ($doc['submission_time'] === 'before_tour' ? 'Antes do passeio' : 'No local') ?></small>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- FAQ -->
                <?php if (!empty($faqs)): ?>
                <div class="mb-4">
                    <h4 class="fw-bold">Perguntas Frequentes</h4>
                    <div class="accordion" id="tourFaq">
                        <?php foreach ($faqs as $i => $faq): ?>
                        <div class="accordion-item border-0 mb-2">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq<?= $i ?>">
                                    <?= e($faq['question']) ?>
                                </button>
                            </h2>
                            <div id="faq<?= $i ?>" class="accordion-collapse collapse" data-bs-parent="#tourFaq">
                                <div class="accordion-body text-muted"><?= e($faq['answer']) ?></div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Avaliações -->
                <?php if (!empty($reviews)): ?>
                <div class="mb-4">
                    <h4 class="fw-bold">Avaliações</h4>
                    <?php foreach ($reviews as $review): ?>
                    <div class="card border-0 bg-light mb-2 p-3">
                        <div class="d-flex justify-content-between">
                            <strong><?= e($review['user_name'] ?? 'Anônimo') ?></strong>
                            <div class="text-warning">
                                <?php for ($s = 0; $s < $review['rating']; $s++): ?><i class="bi bi-star-fill"></i><?php endfor; ?>
                            </div>
                        </div>
                        <p class="text-muted small mb-0 mt-1"><?= e($review['comment']) ?></p>
                        <small class="text-muted"><?= format_date($review['created_at']) ?></small>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Formulário de Consulta -->
                <div class="card border-0 shadow-sm p-4 mb-4">
                    <h5 class="fw-bold">Envie sua consulta</h5>
                    <p class="text-muted small">Você pode enviar sua consulta através do formulário abaixo.</p>
                    <form action="<?= base_url('contato/enviar') ?>" method="POST">
                        <?= csrf_field() ?>
                        <input type="hidden" name="subject" value="Consulta: <?= e($tour['name']) ?>">
                        <div class="row g-2">
                            <div class="col-md-6"><input type="text" name="name" class="form-control" placeholder="Nome" required></div>
                            <div class="col-md-6"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
                            <div class="col-12"><textarea name="message" class="form-control" rows="3" placeholder="Mensagem" required></textarea></div>
                            <div class="col-12"><button type="submit" class="btn btn-primary">Enviar Consulta</button></div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar - Reserva -->
            <div class="col-lg-4">
                <div class="card border-0 shadow sticky-top" style="top: 100px;">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <span class="fs-4 fw-bold text-primary"><?= format_money($tour['price_from']) ?></span>
                            <span class="text-muted small">/ por pessoa</span>
                        </div>

                        <form action="<?= base_url('carrinho/adicionar') ?>" method="POST">
                            <?= csrf_field() ?>
                            <input type="hidden" name="item_type" value="tour">
                            <input type="hidden" name="item_id" value="<?= $tour['id'] ?>">

                            <!-- Pacote -->
                            <?php if (!empty($packages)): ?>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pacote</label>
                                <select name="package_id" class="form-select" id="packageSelect">
                                    <?php foreach ($packages as $pkg): ?>
                                    <option value="<?= $pkg['id'] ?>"><?= e($pkg['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <?php endif; ?>

                            <!-- Data -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Data</label>
                                <input type="date" name="date" class="form-control" required min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                            </div>

                            <!-- Passageiros -->
                            <?php if (!empty($packages)): ?>
                                <?php foreach ($packages as $pkg): ?>
                                    <?php if (!empty($pkg['age_groups'])): ?>
                                    <div class="package-ages" data-package="<?= $pkg['id'] ?>">
                                        <?php foreach ($pkg['age_groups'] as $ag): ?>
                                        <div class="d-flex justify-content-between align-items-center mb-2 p-2 bg-light rounded">
                                            <div>
                                                <strong class="small"><?= e($ag['label']) ?></strong>
                                                <br><small class="text-muted"><?= $ag['min_age'] ?>-<?= $ag['max_age'] ?> anos | <?= format_money($ag['price']) ?></small>
                                            </div>
                                            <input type="number" name="qty_age_<?= $ag['id'] ?>" class="form-control form-control-sm" style="width:70px" value="0" min="0">
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Adultos</label>
                                <input type="number" name="adults" class="form-control" value="1" min="1">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Crianças</label>
                                <input type="number" name="children" class="form-control" value="0" min="0">
                            </div>
                            <?php endif; ?>

                            <button type="submit" class="btn btn-primary w-100 btn-lg mt-3">
                                <i class="bi bi-cart-plus"></i> Adicionar ao Carrinho
                            </button>
                            <button type="submit" formaction="<?= base_url('checkout') ?>" class="btn btn-outline-primary w-100 mt-2">
                                Ir para Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Passeios Relacionados -->
        <?php if (!empty($relatedTours)): ?>
        <div class="mt-5">
            <h3 class="fw-bold mb-4">Passeios Relacionados</h3>
            <div class="row g-4">
                <?php foreach ($relatedTours as $related): ?>
                <div class="col-md-3">
                    <div class="card tour-card h-100 border-0 shadow-sm">
                        <img src="<?= e($related['image_url'] ?: asset('img/tour-placeholder.jpg')) ?>" class="card-img-top" style="height:150px;object-fit:cover;">
                        <div class="card-body">
                            <h6 class="fw-bold"><a href="<?= base_url('passeio/' . $related['slug']) ?>" class="text-decoration-none text-dark"><?= e($related['name']) ?></a></h6>
                            <span class="fw-bold text-primary"><?= format_money($related['price_from']) ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
