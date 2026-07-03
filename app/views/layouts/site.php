<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Punta Cana para Brasileiros' ?></title>
    <meta name="description" content="Descubra o paraíso caribenho com os melhores pacotes exclusivos para brasileiros.">
    <link rel="icon" href="/assets/wp/zipwp-image-5876.png" sizes="32x32">
    <link rel="apple-touch-icon" href="/assets/wp/zipwp-image-5876.png">
    <!-- Fonts & Icons via CDN -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        <div class="header-inner">
            <a href="/" class="header-logo">
                <img src="/assets/wp/PUNTA-CANA-1.png" alt="Punta Cana para Brasileiros">
            </a>
            <ul class="header-nav">
                <li><a href="/" class="<?= ($_GET['url'] ?? '') === '' ? 'active' : '' ?>">Home</a></li>
                <li><a href="/experiencias">Passeios</a></li>
                <li><a href="/transfer">Transfer</a></li>
                <li><a href="/blog">Blog</a></li>
                <li><a href="/sobre-nos">Sobre Nós</a></li>
                <li><a href="/contato">Contato</a></li>
            </ul>
            <div class="header-actions">
                <div class="header-flags">
                    <img src="/assets/wp/en-us.svg" alt="EN">
                    <img src="/assets/wp/pt-br.svg" alt="PT" class="active">
                    <img src="/assets/wp/es.svg" alt="ES">
                </div>
                <a href="/busca" class="icon"><i class="fa-solid fa-magnifying-glass"></i></a>
                <a href="https://www.instagram.com/puntacanaparabrasileiros" target="_blank" class="icon"><i class="fa-brands fa-instagram"></i></a>
                <a href="/carrinho" class="icon"><i class="fa-solid fa-cart-shopping"></i></a>
                <a href="https://api.whatsapp.com/send?phone=18294582170" target="_blank" class="icon"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="/minha-conta" class="icon"><i class="fa-solid fa-user"></i></a>
                <a href="/lista-de-desejos" class="icon"><i class="fa-regular fa-heart"></i></a>
                <a href="/experiencias" class="btn-gold">Agendar Agora</a>
            </div>
            <button class="mobile-toggle" onclick="document.querySelector('.header-nav').classList.toggle('show')">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- Content -->
    <main><?= $content ?? '' ?></main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <img src="/assets/wp/PUNTA-CANA-1.png" alt="Logo" style="height:40px;margin-bottom:14px;">
                    <p>A melhor agência especializada em viagens para Punta Cana com atendimento personalizado para brasileiros.</p>
                    <div class="footer-social">
                        <a href="https://www.instagram.com/puntacanaparabrasileiros" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        <a href="https://www.threads.com/@puntacanaparabrasileiros" target="_blank"><i class="fa-brands fa-threads"></i></a>
                        <a href="https://api.whatsapp.com/send?phone=18294582170" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Mapa do Site</h4>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/experiencias">Experiências</a></li>
                        <li><a href="/programa-de-afiliados">Afiliados</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="/sobre-nos">Sobre Nós</a></li>
                        <li><a href="/contato">Contato</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Sobre Punta Cana</h4>
                    <ul>
                        <li><a href="/passeios">Passeios</a></li>
                        <li><a href="/busca">Busca</a></li>
                        <li><a href="/minha-conta">Minha Conta</a></li>
                        <li><a href="/conta-de-afiliado">Conta de Afiliado</a></li>
                        <li><a href="/lista-de-desejos">Lista de Desejos</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Termos & Políticas</h4>
                    <ul>
                        <li><a href="/politicas-de-privacidade">Políticas de Privacidade</a></li>
                        <li><a href="/politicas-de-cancelamento">Políticas de Cancelamento</a></li>
                        <li><a href="/termos-e-condicoes-do-programa-de-afiliados">Políticas de Afiliados</a></li>
                        <li><a href="/termos-e-condicoes">Termos e Condições</a></li>
                        <li><a href="/cancelamentos">Cancelamentos</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© Copyright 2025 | Desenvolvido por LRV Web · Punta Cana para Brasileiros Oliveira & Ramos SRL · RNC: 133287765</p>
                <p>Pagamento seguro <i class="fa-brands fa-paypal"></i> <i class="fa-solid fa-credit-card"></i></p>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Float -->
    <a href="https://api.whatsapp.com/send?phone=18294582170&text=Oi%2C%20tudo%20bem%3F" target="_blank" class="whatsapp-float">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- Cookie Banner -->
    <div class="cookie-banner" id="cookieBanner">
        <div class="container">
            <p>Utilizamos cookies para oferecer uma melhor experiência. <a href="/politicas-de-privacidade">Políticas de Privacidade</a></p>
            <button class="btn-cookie" onclick="localStorage.setItem('cookies_ok','1');document.getElementById('cookieBanner').style.display='none'">Concordo</button>
        </div>
    </div>

    <script>
        if(!localStorage.getItem('cookies_ok')) document.getElementById('cookieBanner').style.display='block';
    </script>
</body>
</html>
