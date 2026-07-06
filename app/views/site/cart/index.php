<div style="max-width: 900px; margin: 40px auto; padding: 0 20px;">
    <h1 style="font-family: 'Poppins', sans-serif; font-size: 32px; font-weight: 600; color: #1C2011; margin-bottom: 30px;">Carrinho</h1>

    <?php if (has_flash('success')): ?>
    <div style="background: #f0fdf4; color: #166534; padding: 14px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; border: 1px solid #bbf7d0;"><?= flash('success') ?></div>
    <?php endif; ?>

    <?php if (empty($cart)): ?>
    <div style="text-align: center; padding: 60px 20px;">
        <h2 style="font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 600; color: #1C2011; margin-bottom: 12px;">Seu carrinho está vazio</h2>
        <p style="font-family: 'Poppins', sans-serif; color: #4B5563; font-size: 16px; margin-bottom: 24px;">Explore nossos passeios e transfers para começar.</p>
        <a href="<?= base_url('experiencias') ?>" style="display: inline-block; padding: 14px 32px; background: #1b6f00; color: #fff; border-radius: 8px; text-decoration: none; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 16px;">Ver Passeios</a>
    </div>
    <?php else: ?>
    <div style="display: flex; flex-direction: column; gap: 16px; margin-bottom: 30px;">
        <?php $total = 0; foreach ($cart as $item): $total += $item['total_price']; ?>
        <div style="display: flex; align-items: center; gap: 16px; padding: 20px; border: 1px solid #e5e7eb; border-radius: 12px; background: #fff;">
            <?php if (!empty($item['image_url'])): ?>
            <img src="<?= htmlspecialchars($item['image_url']) ?>" style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px;">
            <?php else: ?>
            <div style="width: 80px; height: 60px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #9ca3af;">🎫</div>
            <?php endif; ?>
            <div style="flex: 1;">
                <h3 style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 600; color: #1C2011; margin: 0 0 4px;"><?= htmlspecialchars($item['name']) ?></h3>
                <?php if (!empty($item['package_name'])): ?>
                <p style="font-size: 13px; color: #6b7280; margin: 0;"><?= htmlspecialchars($item['package_name']) ?></p>
                <?php endif; ?>
                <?php if (!empty($item['date'])): ?>
                <p style="font-size: 13px; color: #6b7280; margin: 2px 0 0;">📅 <?= $item['date'] ?> <?= $item['time_slot'] ?? '' ?></p>
                <?php endif; ?>
                <p style="font-size: 13px; color: #6b7280; margin: 2px 0 0;">👥 <?= $item['adults'] ?> adulto(s)<?= $item['children'] ? ', ' . $item['children'] . ' criança(s)' : '' ?></p>
            </div>
            <div style="text-align: right;">
                <span style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 600; color: #1b6f00;">$<?= number_format($item['total_price'], 2) ?></span>
                <form action="<?= base_url('carrinho/remover') ?>" method="POST" style="margin-top: 8px;">
                    <?= csrf_field() ?>
                    <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
                    <button type="submit" style="background: none; border: none; color: #dc2626; font-size: 13px; cursor: pointer; text-decoration: underline;">Remover</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Total e Checkout -->
    <div style="border-top: 2px solid #e5e7eb; padding-top: 24px; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <span style="font-family: 'Poppins', sans-serif; font-size: 14px; color: #6b7280;">Total:</span>
            <span style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 700; color: #1b6f00; margin-left: 10px;">$<?= number_format($total, 2) ?></span>
        </div>
        <a href="<?= base_url('checkout') ?>" style="padding: 16px 40px; background: #1b6f00; color: #fff; border-radius: 8px; text-decoration: none; font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 16px;" onmouseover="this.style.background='#155d00'" onmouseout="this.style.background='#1b6f00'">Finalizar Compra →</a>
    </div>
    <?php endif; ?>
</div>
