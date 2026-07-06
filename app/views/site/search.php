<div style="max-width: 900px; margin: 60px auto; padding: 0 20px;">
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="font-family: 'Poppins', sans-serif; font-size: 32px; font-weight: 600; color: #1C2011; margin-bottom: 12px;">Busca</h1>
        <p style="font-family: 'Poppins', sans-serif; color: #4B5563; font-size: 16px;">Encontre passeios, transfers e experiências em Punta Cana</p>
    </div>

    <form action="<?= base_url('busca') ?>" method="GET" style="margin-bottom: 40px;">
        <div style="display: flex; gap: 12px;">
            <input type="text" name="q" value="<?= htmlspecialchars($query ?? '') ?>" placeholder="Digite o que procura..." style="flex: 1; padding: 14px 16px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 16px; font-family: 'Poppins', sans-serif; background: #f9fafb;" onfocus="this.style.borderColor='#3772c0'" onblur="this.style.borderColor='#e0e0e0'">
            <button type="submit" style="padding: 14px 28px; background: #1b6f00; color: #fff; border: none; border-radius: 8px; font-size: 16px; font-family: 'Poppins', sans-serif; font-weight: 500; cursor: pointer;" onmouseover="this.style.background='#155d00'" onmouseout="this.style.background='#1b6f00'">Buscar</button>
        </div>
    </form>

    <?php if (!empty($query)): ?>
        <?php if (!empty($results)): ?>
        <p style="font-family: 'Poppins', sans-serif; color: #4B5563; margin-bottom: 24px;"><?= count($results) ?> resultado(s) para "<strong><?= htmlspecialchars($query) ?></strong>"</p>
        
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <?php foreach ($results as $item): ?>
            <div style="display: flex; gap: 20px; padding: 20px; border: 1px solid #e8e9e7; border-radius: 12px; transition: box-shadow 0.3s;">
                <?php if (!empty($item['image_url'])): ?>
                <img src="<?= $item['image_url'] ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 120px; height: 90px; object-fit: cover; border-radius: 8px;">
                <?php endif; ?>
                <div style="flex: 1;">
                    <h3 style="font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 600; color: #1C2011; margin: 0 0 8px;">
                        <?php if ($item['type'] === 'tour'): ?>
                            <a href="<?= base_url('passeio?slug=' . $item['slug']) ?>" style="color: #1C2011; text-decoration: none;"><?= htmlspecialchars($item['name']) ?></a>
                        <?php else: ?>
                            <a href="<?= base_url('blog/post?slug=' . $item['slug']) ?>" style="color: #1C2011; text-decoration: none;"><?= htmlspecialchars($item['name']) ?></a>
                        <?php endif; ?>
                    </h3>
                    <p style="font-family: 'Poppins', sans-serif; color: #4B5563; font-size: 14px; margin: 0 0 8px; line-height: 1.5;"><?= htmlspecialchars(substr($item['description'] ?? '', 0, 150)) ?>...</p>
                    <?php if ($item['price_from'] > 0): ?>
                    <span style="font-family: 'Poppins', sans-serif; font-weight: 600; color: #1b6f00; font-size: 18px;">$<?= number_format($item['price_from'], 0) ?></span>
                    <?php endif; ?>
                    <span style="font-family: 'Poppins', sans-serif; font-size: 12px; padding: 4px 10px; background: <?= $item['type'] === 'tour' ? '#e8f5e9' : '#e3f2fd' ?>; color: <?= $item['type'] === 'tour' ? '#1b6f00' : '#3772c0' ?>; border-radius: 12px; margin-left: 10px;"><?= $item['type'] === 'tour' ? 'Passeio' : 'Blog' ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div style="text-align: center; padding: 60px 20px;">
            <p style="font-family: 'Poppins', sans-serif; font-size: 18px; color: #4B5563; margin-bottom: 12px;">Nenhum resultado encontrado para "<strong><?= htmlspecialchars($query) ?></strong>"</p>
            <p style="font-family: 'Poppins', sans-serif; font-size: 14px; color: #9ca3af;">Tente buscar com outras palavras ou explore nossos passeios.</p>
            <a href="<?= base_url('experiencias') ?>" style="display: inline-block; margin-top: 20px; padding: 12px 24px; background: #3772c0; color: #fff; border-radius: 8px; text-decoration: none; font-family: 'Poppins', sans-serif; font-weight: 500;">Ver Todos os Passeios</a>
        </div>
        <?php endif; ?>
    <?php else: ?>
    <div style="text-align: center; padding: 60px 20px;">
        <p style="font-family: 'Poppins', sans-serif; font-size: 16px; color: #9ca3af;">Digite algo no campo acima para buscar.</p>
    </div>
    <?php endif; ?>
</div>
