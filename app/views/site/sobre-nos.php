<?php ob_start(); ?>

<!-- Hero -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center" data-aos="fade-up">
            <h1 class="display-5 fw-bold">Nossa História</h1>
            <p class="lead text-muted">Conheça o casal apaixonado por Punta Cana que dedica sua vida a criar experiências únicas e memoráveis para brasileiros.</p>
        </div>
    </div>
</section>

<!-- Sobre -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <img src="<?= asset('img/sobre-nos.jpg') ?>" alt="Anna e Danilo" class="img-fluid rounded-4 shadow">
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <h2 class="fw-bold">Anna & Danilo</h2>
                <p class="text-primary fw-semibold">Feita por quem conhece Punta Cana e os brasileiros!</p>
                <p class="text-muted">A Punta Cana para Brasileiros é uma empresa dominicana, criada com amor por um casal — ela, uma brasileira naturalizada dominicana, com dupla nacionalidade; ele, um dominicano que viveu no Brasil por cinco anos, fala português, e se apaixonou pela nossa alegria.</p>
                <p class="text-muted">Nasceu da vontade de transformar a experiência dos brasileiros no Caribe, após perceber que muitos voltavam da viagem insatisfeitos por contratarem passeios com agências que não conheciam tão bem o destino.</p>
                <p class="text-muted">Atendemos exclusivamente turistas brasileiros que viajam a Punta Cana, oferecendo um serviço personalizado e atendimento 100% em português.</p>
                <p class="text-muted">Aqui, cada passeio é escolhido com cuidado e propósito. Nada de pacotes genéricos: indicamos experiências que combinam com o seu estilo de viagem.</p>
                <p class="fst-italic text-primary">Quem conhece Punta Cana e entende os brasileiros sabe: o paraíso fica ainda melhor quando falamos a mesma língua!</p>
                <div class="d-flex gap-4 mt-3">
                    <div><strong>Casados há 7 anos</strong></div>
                    <div><strong>Morando em Punta Cana desde 2018</strong></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Destaques -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold">Experiências em Destaque</h2>
            <p class="text-muted">Proporcionar experiências autênticas e memoráveis para brasileiros em Punta Cana.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="card border-0 shadow-sm text-center p-4 h-100">
                    <i class="bi bi-heart fs-1 text-primary mb-3"></i>
                    <h5 class="fw-bold">Atendimento Pessoal</h5>
                    <p class="text-muted small">Cuidamos pessoalmente de cada cliente</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm text-center p-4 h-100">
                    <i class="bi bi-stars fs-1 text-primary mb-3"></i>
                    <h5 class="fw-bold">Paixão pelo que Fazemos</h5>
                    <p class="text-muted small">Amor por Punta Cana e pelo Brasil</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card border-0 shadow-sm text-center p-4 h-100">
                    <i class="bi bi-headset fs-1 text-primary mb-3"></i>
                    <h5 class="fw-bold">Suporte em Português</h5>
                    <p class="text-muted small">24/7 durante sua estadia</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5 text-center">
    <div class="container" data-aos="fade-up">
        <h2 class="fw-bold">Vamos Planejar sua Viagem Juntos?</h2>
        <p class="text-muted mb-4">Entre em contato e nossa equipe vai te ajudar a criar a viagem perfeita.</p>
        <a href="<?= base_url('contato') ?>" class="btn btn-primary btn-lg">Fale Conosco</a>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
