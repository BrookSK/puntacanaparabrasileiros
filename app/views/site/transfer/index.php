<?php ob_start(); ?>

<!-- Hero -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h1 class="display-5 fw-bold">Transfer em Punta Cana</h1>
        <p class="lead text-white-50">Reserve seu transfer do aeroporto ou hotel com conforto e segurança.</p>
    </div>
</section>

<!-- Formulário de Busca -->
<section class="py-5">
    <div class="container">
        <div class="card border-0 shadow-lg p-4">
            <form action="<?= base_url('transfer/buscar') ?>" method="GET" id="transferForm">
                <!-- Tabs de Tipo -->
                <ul class="nav nav-pills mb-4 justify-content-center" id="tripTypeTabs">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" data-trip="roundtrip" onclick="setTripType('roundtrip')">
                            <i class="bi bi-arrow-left-right"></i> Ida e Volta
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" data-trip="oneway" onclick="setTripType('oneway')">
                            <i class="bi bi-arrow-right"></i> Somente Ida
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" data-trip="multiple" onclick="setTripType('multiple')">
                            <i class="bi bi-plus-circle"></i> Múltiplos
                        </button>
                    </li>
                </ul>

                <input type="hidden" name="trip_type" id="tripType" value="roundtrip">

                <div id="transferFields">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Origem</label>
                            <select name="origin_id" class="form-select" required>
                                <option value="">Selecione a origem</option>
                                <?php foreach ($locations as $loc): ?>
                                <option value="<?= $loc['id'] ?>"><?= e($loc['name']) ?> (<?= ucfirst($loc['type']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Destino</label>
                            <select name="destination_id" class="form-select" required>
                                <option value="">Selecione o destino</option>
                                <?php foreach ($locations as $loc): ?>
                                <option value="<?= $loc['id'] ?>"><?= e($loc['name']) ?> (<?= ucfirst($loc['type']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Data de Chegada</label>
                            <input type="date" name="departure_date" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Hora de Chegada</label>
                            <input type="time" name="departure_time" class="form-control" required>
                        </div>
                        <div class="col-md-3 return-fields">
                            <label class="form-label fw-semibold">Data de Partida</label>
                            <input type="date" name="return_date" class="form-control">
                        </div>
                        <div class="col-md-3 return-fields">
                            <label class="form-label fw-semibold">Hora de Partida</label>
                            <input type="time" name="return_time" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Adultos</label>
                            <input type="number" name="adults" class="form-control" value="1" min="1">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Crianças</label>
                            <input type="number" name="children" class="form-control" value="0" min="0">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Bebês</label>
                            <input type="number" name="babies" class="form-control" value="0" min="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Tipo de Serviço</label>
                            <select name="service_type" class="form-select">
                                <option value="">Todos</option>
                                <option value="private">Privado</option>
                                <option value="shared">Coletivo</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Container para múltiplos transfers -->
                <div id="multipleTransfers" style="display:none;" class="mt-3">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Adicione múltiplos transfers ao seu itinerário.
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Info de Transfers -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-4">
                <i class="bi bi-shield-check fs-1 text-primary"></i>
                <h5 class="fw-bold mt-3">Segurança</h5>
                <p class="text-muted small">Motoristas experientes e veículos inspecionados regularmente.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-clock fs-1 text-primary"></i>
                <h5 class="fw-bold mt-3">Pontualidade</h5>
                <p class="text-muted small">Monitoramos seu voo para garantir que estaremos lá no horário.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-chat-dots fs-1 text-primary"></i>
                <h5 class="fw-bold mt-3">Suporte em Português</h5>
                <p class="text-muted small">Atendimento 100% em português durante todo o trajeto.</p>
            </div>
        </div>
    </div>
</section>

<script>
function setTripType(type) {
    document.getElementById('tripType').value = type;
    document.querySelectorAll('#tripTypeTabs .nav-link').forEach(btn => btn.classList.remove('active'));
    document.querySelector(`[data-trip="${type}"]`).classList.add('active');
    
    const returnFields = document.querySelectorAll('.return-fields');
    const multipleDiv = document.getElementById('multipleTransfers');
    
    if (type === 'oneway') {
        returnFields.forEach(el => el.style.display = 'none');
        multipleDiv.style.display = 'none';
    } else if (type === 'multiple') {
        returnFields.forEach(el => el.style.display = 'none');
        multipleDiv.style.display = 'block';
    } else {
        returnFields.forEach(el => el.style.display = 'block');
        multipleDiv.style.display = 'none';
    }
}
</script>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
