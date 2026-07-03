<?php ob_start(); ?>

<!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden">
    <div class="hero-bg"></div>
    <div class="container position-relative z-1">
        <div class="row min-vh-75 align-items-center">
            <div class="col-lg-7" data-aos="fade-right">
                <span class="badge bg-primary-subtle text-primary mb-3">Caribe Dominicano</span>
                <h1 class="display-4 fw-bold text-white mb-3">
                    <?= e(site_config('hero_title', 'Punta Cana espera por você!')) ?>
                </h1>
                <p class="lead text-white-50 mb-4">
                    <?= e(site_config('hero_subtitle', 'Descubra o paraíso caribenho com os melhores pacotes exclusivos para brasileiros. Praias paradisíacas, resorts all-inclusive e uma experiência inesquecível.')) ?>
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="<?= base_url('experiencias') ?>" class="btn btn-primary btn-lg">
                        <i class="bi bi-calendar-check"></i> Agendar Agora
                    </a>
                    <a href="<?= base_url('sobre-nos') ?>" class="btn btn-outline-light btn-lg">
                        Nossa História
                    </a>
                </div>
                <div class="d-flex gap-4 mt-4">
                    <span class="text-white-50 small"><i class="bi bi-geo-alt text-primary"></i> Caribe Dominicano</span>
                    <span class="text-white-50 small"><i class="bi bi-calendar2 text-primary"></i> Pacotes Flexíveis</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Passeios em Destaque -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="text-primary fw-semibold small text-uppercase">Passeios mais realizados</span>
            <h2 class="fw-bold mt-2">Explore os favoritos de Punta Cana</h2>
            <p class="text-muted">Descubra os passeios mais amados por quem já viveu essa experiência paradisíaca.</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($featuredTours)): ?>
                <?php foreach ($featuredTours as $tour): ?>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $tour['sort_order'] * 100 ?>">
                    <div class="card tour-card h-100 border-0 shadow-sm">
                        <div class="position-relative">
                            <img src="<?= e($tour['image_url'] ?: asset('img/tour-placeholder.jpg')) ?>" 
                                 class="card-img-top" alt="<?= e($tour['name']) ?>" style="height:220px;object-fit:cover;">
                            <?php if ($tour['discount_percent'] > 0): ?>
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2"><?= (int)$tour['discount_percent'] ?>% Off</span>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">
                                <a href="<?= base_url('passeio/' . $tour['slug']) ?>" class="text-decoration-none text-dark">
                                    <?= e($tour['name']) ?>
                                </a>
                            </h5>
                            <p class="card-text text-muted small"><?= e(str_limit($tour['description'], 120)) ?></p>
                        </div>
                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                            <div>
                                <?php if ($tour['duration_hours']): ?>
                                <span class="small text-muted"><i class="bi bi-clock"></i> <?= (int)$tour['duration_hours'] ?> Horas</span>
                                <?php endif; ?>
                            </div>
                            <div class="text-end">
                                <?php if ($tour['discount_percent'] > 0): ?>
                                <span class="text-muted text-decoration-line-through small"><?= format_money($tour['price_from']) ?></span>
                                <?php 
                                    $discountedPrice = $tour['price_from'] * (1 - $tour['discount_percent'] / 100);
                                ?>
                                <span class="fw-bold text-primary"><?= format_money($discountedPrice) ?></span>
                                <?php else: ?>
                                <span class="fw-bold text-primary"><?= format_money($tour['price_from']) ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Passeios de exemplo quando o banco estiver vazio -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up">
                    <div class="card tour-card h-100 border-0 shadow-sm">
                        <div class="position-relative">
                            <img src="<?= asset('img/tour-placeholder.jpg') ?>" class="card-img-top" alt="Saona Premium" style="height:220px;object-fit:cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Saona Premium Brasil - Lancha</h5>
                            <p class="card-text text-muted small">Exclusividade da Punta Cana para Brasileiros. Lancha ida e volta...</p>
                        </div>
                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                            <span class="small text-muted"><i class="bi bi-clock"></i> 9 Horas</span>
                            <span class="fw-bold text-primary">$79</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card tour-card h-100 border-0 shadow-sm">
                        <div class="position-relative">
                            <img src="<?= asset('img/tour-placeholder.jpg') ?>" class="card-img-top" alt="Nado com Golfinhos" style="height:220px;object-fit:cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Nado e interação com 1 Golfinho</h5>
                            <p class="card-text text-muted small">Você irá interagir e nadar com 1 golfinho em uma experiência única...</p>
                        </div>
                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                            <span class="small text-muted"><i class="bi bi-clock"></i> 4 Horas</span>
                            <span class="fw-bold text-primary">$155</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card tour-card h-100 border-0 shadow-sm">
                        <div class="position-relative">
                            <img src="<?= asset('img/tour-placeholder.jpg') ?>" class="card-img-top" alt="Santo Domingo" style="height:220px;object-fit:cover;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Santo Domingo</h5>
                            <p class="card-text text-muted small">Explore a alma da primeira cidade do Novo Mundo, onde história se encontra...</p>
                        </div>
                        <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                            <span class="small text-muted"><i class="bi bi-clock"></i> 10 Horas</span>
                            <span class="fw-bold text-primary">$49</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?= base_url('experiencias') ?>" class="btn btn-primary btn-lg">Ver Todos os Passeios</a>
        </div>
    </div>
</section>

<!-- Depoimentos -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="text-primary fw-semibold small text-uppercase">Depoimentos</span>
            <h2 class="fw-bold mt-2">O que nossos viajantes dizem</h2>
            <p class="text-muted">Histórias reais, experiências inesquecíveis e opiniões sinceras.</p>
        </div>

        <div class="swiper testimonials-swiper" data-aos="fade-up">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm p-4 text-center">
                        <div class="mb-3">
                            <div class="text-warning">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                        <p class="text-muted fst-italic">"Segunda vez que viajo com a PuntaCanaBR e mais uma vez superou as expectativas. Recomendo para quem busca tranquilidade e bom preço."</p>
                        <h6 class="fw-bold mb-0">Carlos Eduardo</h6>
                        <small class="text-muted">Rio de Janeiro, RJ</small>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm p-4 text-center">
                        <div class="mb-3">
                            <div class="text-warning">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            </div>
                        </div>
                        <p class="text-muted fst-italic">"Viagem perfeita! Atendimento em português do início ao fim, hotel excelente e passeios bem organizados. Já estou planejando voltar!"</p>
                        <h6 class="fw-bold mb-0">Ana Beatriz</h6>
                        <small class="text-muted">São Paulo, SP</small>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="card border-0 shadow-sm p-4 text-center">
                        <div class="mb-3">
                            <div class="text-warning">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                            </div>
                        </div>
                        <p class="text-muted fst-italic">"Amei a experiência, principalmente os passeios exclusivos. O único ponto a melhorar seria o tempo de transfer do aeroporto ao hotel."</p>
                        <h6 class="fw-bold mb-0">Mariana Silva</h6>
                        <small class="text-muted">Belo Horizonte, MG</small>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!-- Transfer Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="fw-bold">Busque seu Transfer e Reserve Agora!</h2>
            <p class="text-white-50">Reserve seu transfer do aeroporto ou hotel e desfrute de uma viagem pontual, confortável e segura.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="0">
                <div class="card bg-white text-dark h-100 border-0 shadow">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-bus-front fs-1 text-primary mb-3"></i>
                        <h5 class="fw-bold">Transfer em Ônibus Compartilhado</h5>
                        <p class="small text-muted">Viaje com conforto e economia em um ônibus climatizado, com embarques regulares e motoristas experientes.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card bg-white text-dark h-100 border-0 shadow">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-truck fs-1 text-primary mb-3"></i>
                        <h5 class="fw-bold">Transfer Privativo em Van</h5>
                        <p class="small text-muted">Tenha mais conforto e privacidade com nosso transfer exclusivo em van. Perfeito para famílias ou pequenos grupos.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card bg-white text-dark h-100 border-0 shadow">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-universal-access fs-1 text-primary mb-3"></i>
                        <h5 class="fw-bold">Transfer Acessível com Van Adaptada</h5>
                        <p class="small text-muted">Viaje com segurança e acessibilidade em nossa van adaptada com rampa para cadeirantes.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="<?= base_url('transfer') ?>" class="btn btn-light btn-lg">Reserve seu Transfer</a>
        </div>
    </div>
</section>

<!-- Estatísticas -->
<section class="py-5">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-6 col-md-3" data-aos="fade-up">
                <div class="p-3">
                    <h3 class="fw-bold text-primary counter" data-target="98">0</h3>
                    <p class="text-muted small mb-0">% Avaliação de satisfação dos clientes</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="p-3">
                    <h3 class="fw-bold text-primary"><span class="counter" data-target="30">0</span>+</h3>
                    <p class="text-muted small mb-0">Passeios e experiências disponíveis</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="p-3">
                    <h3 class="fw-bold text-primary">+<span class="counter" data-target="2000">0</span></h3>
                    <p class="text-muted small mb-0">Brasileiros atendidos com excelência</p>
                </div>
            </div>
            <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="p-3">
                    <h3 class="fw-bold text-primary">+<span class="counter" data-target="15">0</span></h3>
                    <p class="text-muted small mb-0">Lugares paradisíacos visitados</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="text-primary fw-semibold small text-uppercase">Nosso Blog</span>
            <h2 class="fw-bold mt-2">Blog de Viagem</h2>
            <p class="text-muted">Descubra roteiros imperdíveis, curiosidades locais e dicas práticas para aproveitar Punta Cana.</p>
        </div>

        <div class="row g-4">
            <?php if (!empty($recentPosts)): ?>
                <?php foreach ($recentPosts as $post): ?>
                <div class="col-md-4" data-aos="fade-up">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="<?= e($post['image_url'] ?: asset('img/blog-placeholder.jpg')) ?>" 
                             class="card-img-top" alt="<?= e($post['title']) ?>" style="height:200px;object-fit:cover;">
                        <div class="card-body">
                            <span class="badge bg-primary-subtle text-primary small"><?= e($post['category_name'] ?? 'Geral') ?></span>
                            <h5 class="card-title fw-bold mt-2">
                                <a href="<?= base_url('blog/post/' . $post['slug']) ?>" class="text-decoration-none text-dark">
                                    <?= e($post['title']) ?>
                                </a>
                            </h5>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <small class="text-muted"><?= e($post['author_name'] ?? 'Equipe') ?> • <?= format_date($post['published_at']) ?></small>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-md-4" data-aos="fade-up">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="<?= asset('img/blog-placeholder.jpg') ?>" class="card-img-top" style="height:200px;object-fit:cover;">
                        <div class="card-body">
                            <span class="badge bg-primary-subtle text-primary small">Geral</span>
                            <h5 class="card-title fw-bold mt-2">O que fazer em Punta Cana em 2026</h5>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <small class="text-muted">Equipe • 15/03/2026</small>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="text-center mt-4">
            <a href="<?= base_url('blog') ?>" class="btn btn-outline-primary">Leia nosso Blog</a>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="text-center mb-5" data-aos="fade-up">
                    <h2 class="fw-bold">Perguntas Frequentes</h2>
                    <p class="text-muted">Tire suas principais dúvidas sobre viagens para Punta Cana.</p>
                </div>

                <div class="accordion" id="faqAccordion" data-aos="fade-up">
                    <div class="accordion-item border-0 mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq1">
                                É necessário visto para brasileiros viajarem para Punta Cana?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Não! Brasileiros não precisam de visto para entrar na República Dominicana para estadias de até 30 dias. Basta ter o passaporte válido.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Qual a melhor época para visitar Punta Cana?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Punta Cana pode ser visitada o ano todo! A temporada seca (dezembro a abril) é a mais procurada, mas os meses de maio a novembro oferecem preços mais acessíveis e menos turistas.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Como funciona o transporte do aeroporto para o hotel?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Oferecemos transfer privativo e compartilhado do aeroporto para qualquer hotel na região de Punta Cana. O transfer pode ser reservado diretamente em nosso site.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Vocês oferecem atendimento em português durante toda a viagem?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Sim! Todo o nosso atendimento é 100% em português, desde o planejamento até o suporte durante sua estadia em Punta Cana.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-0 mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq5">
                                O que acontece em caso de cancelamento da viagem?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Consulte nossa <a href="<?= base_url('politicas-de-cancelamento') ?>">Política de Cancelamento</a> para mais detalhes sobre prazos e reembolsos.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted">Não encontrou o que procurava?</p>
                    <a href="<?= base_url('contato') ?>" class="btn btn-outline-primary">Entre em contato conosco</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-5 bg-gradient-primary text-white" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 text-center text-lg-start" data-aos="fade-right">
                <span class="badge bg-warning text-dark mb-2">Última chance para garantir seu verão perfeito</span>
                <h2 class="fw-bold">Pronto para viver essa experiência?</h2>
                <p class="text-white-50">Agende sua viagem agora e garanta os melhores preços e condições exclusivas para brasileiros.</p>
            </div>
            <div class="col-lg-4 text-center text-lg-end" data-aos="fade-left">
                <a href="<?= base_url('experiencias') ?>" class="btn btn-light btn-lg me-2">Pesquisar Passeios</a>
                <a href="<?= base_url('contato') ?>" class="btn btn-outline-light btn-lg mt-2 mt-lg-0">Tire suas dúvidas</a>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>
<?php include VIEWS_PATH . '/layouts/site.php'; ?>
