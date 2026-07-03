<?php ob_start(); ?>
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold"><?= $tour ? 'Editar Passeio' : 'Novo Passeio' ?></h1>
        <a href="<?= base_url('admin/passeios') ?>" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
    </div>

    <form action="<?= base_url($tour ? 'admin/passeios/atualizar' : 'admin/passeios/salvar') ?>" method="POST">
        <?= csrf_field() ?>
        <?php if ($tour): ?><input type="hidden" name="id" value="<?= $tour['id'] ?>"><?php endif; ?>

        <div class="row g-4">
            <div class="col-lg-8">
                <!-- Info básica -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header"><h5 class="mb-0">Informações Básicas</h5></div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label">Nome do Passeio *</label>
                                <input type="text" name="name" class="form-control" value="<?= e($tour['name'] ?? '') ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Descrição Curta</label>
                                <textarea name="description" class="form-control" rows="2"><?= e($tour['description'] ?? '') ?></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Visão Geral (Descrição Completa)</label>
                                <textarea name="overview" class="form-control" rows="5"><?= e($tour['overview'] ?? '') ?></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Destaques</label>
                                <textarea name="highlights" class="form-control" rows="3"><?= e($tour['highlights'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- O que inclui/exclui -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header"><h5 class="mb-0">Inclusões e Exclusões</h5></div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-success">O que Inclui</label>
                                <textarea name="inclusions" class="form-control" rows="4" placeholder="Um item por linha"><?= e($tour['inclusions'] ?? '') ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-danger">O que Não Inclui</label>
                                <textarea name="exclusions" class="form-control" rows="4" placeholder="Um item por linha"><?= e($tour['exclusions'] ?? '') ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">O que Pode Levar</label>
                                <textarea name="what_to_bring" class="form-control" rows="3"><?= e($tour['what_to_bring'] ?? '') ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Restrições</label>
                                <textarea name="restrictions" class="form-control" rows="3"><?= e($tour['restrictions'] ?? '') ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Configurações -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header"><h5 class="mb-0">Configurações</h5></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Categoria</label>
                            <select name="category_id" class="form-select">
                                <option value="">Sem categoria</option>
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= ($tour['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>><?= e($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Preço a partir de (USD) *</label>
                            <input type="number" name="price_from" class="form-control" step="0.01" value="<?= e($tour['price_from'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Desconto (%)</label>
                            <input type="number" name="discount_percent" class="form-control" step="0.5" value="<?= e($tour['discount_percent'] ?? '0') ?>">
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label">Duração (horas)</label>
                                <input type="number" name="duration_hours" class="form-control" step="0.5" value="<?= e($tour['duration_hours'] ?? '') ?>">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Duração (dias)</label>
                                <input type="number" name="duration_days" class="form-control" value="<?= e($tour['duration_days'] ?? '0') ?>">
                            </div>
                        </div>
                        <div class="mb-3 mt-3">
                            <label class="form-label">Gestante Permitida?</label>
                            <select name="pregnant_allowed" class="form-select">
                                <option value="1" <?= ($tour['pregnant_allowed'] ?? 1) == 1 ? 'selected' : '' ?>>Sim</option>
                                <option value="0" <?= ($tour['pregnant_allowed'] ?? 1) == 0 ? 'selected' : '' ?>>Não</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" <?= ($tour['status'] ?? '') === 'active' ? 'selected' : '' ?>>Ativo</option>
                                <option value="inactive" <?= ($tour['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inativo</option>
                            </select>
                        </div>
                        <div class="form-check mb-3">
                            <input type="checkbox" name="featured" value="1" class="form-check-input" <?= ($tour['featured'] ?? 0) ? 'checked' : '' ?>>
                            <label class="form-check-label">Passeio em Destaque</label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">URL da Imagem</label>
                            <input type="url" name="image_url" class="form-control" value="<?= e($tour['image_url'] ?? '') ?>">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 btn-lg">
                    <i class="bi bi-check-lg"></i> <?= $tour ? 'Salvar Alterações' : 'Criar Passeio' ?>
                </button>
            </div>
        </div>
    </form>
</div>
<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/admin.php'; ?>
