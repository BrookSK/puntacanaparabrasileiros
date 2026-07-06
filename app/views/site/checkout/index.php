<div style="max-width: 900px; margin: 40px auto; padding: 0 20px;">
    <h1 style="font-family: 'Poppins', sans-serif; font-size: 32px; font-weight: 600; color: #1C2011; margin-bottom: 30px;">Checkout</h1>

    <?php if (has_flash('error')): ?>
    <div style="background: #fef2f2; color: #991b1b; padding: 14px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; border: 1px solid #fecaca;"><?= flash('error') ?></div>
    <?php endif; ?>

    <div style="display: flex; gap: 40px; flex-wrap: wrap;">
        <!-- Formulário -->
        <div style="flex: 1; min-width: 300px;">
            <form action="<?= base_url('checkout/processar') ?>" method="POST">
                <?= csrf_field() ?>

                <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; margin-bottom: 24px;">
                    <h2 style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 600; margin-bottom: 20px;">Dados do Comprador</h2>
                    
                    <div style="margin-bottom: 16px;">
                        <label style="display: block; margin-bottom: 6px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px;">Nome Completo *</label>
                        <input type="text" name="name" required value="<?= htmlspecialchars($_SESSION['user_name'] ?? '') ?>" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 15px; font-family: 'Poppins', sans-serif; background: #f9fafb;">
                    </div>
                    <div style="display: flex; gap: 12px;">
                        <div style="flex: 1; margin-bottom: 16px;">
                            <label style="display: block; margin-bottom: 6px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px;">Email *</label>
                            <input type="email" name="email" required value="<?= htmlspecialchars($_SESSION['user_email'] ?? '') ?>" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 15px; font-family: 'Poppins', sans-serif; background: #f9fafb;">
                        </div>
                        <div style="flex: 1; margin-bottom: 16px;">
                            <label style="display: block; margin-bottom: 6px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px;">Telefone/WhatsApp</label>
                            <input type="tel" name="phone" style="width: 100%; padding: 12px 16px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 15px; font-family: 'Poppins', sans-serif; background: #f9fafb;">
                        </div>
                    </div>
                </div>

                <button type="submit" style="width: 100%; padding: 18px; background: #1b6f00; color: #fff; border: none; border-radius: 8px; font-size: 18px; font-family: 'Poppins', sans-serif; font-weight: 600; cursor: pointer;" onmouseover="this.style.background='#155d00'" onmouseout="this.style.background='#1b6f00'">Confirmar Compra - $<?= number_format($subtotal, 2) ?></button>
            </form>
        </div>

        <!-- Resumo -->
        <div style="width: 320px; flex-shrink: 0;">
            <div style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; position: sticky; top: 20px;">
                <h3 style="font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 600; margin-bottom: 20px;">Resumo do Pedido</h3>
                
                <?php foreach ($cart as $item): ?>
                <div style="display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #e5e7eb; font-size: 14px;">
                    <span style="font-family: 'Poppins', sans-serif; color: #374151;"><?= htmlspecialchars($item['name']) ?></span>
                    <span style="font-weight: 600;">$<?= number_format($item['total_price'], 2) ?></span>
                </div>
                <?php endforeach; ?>

                <div style="display: flex; justify-content: space-between; padding-top: 16px; margin-top: 8px;">
                    <span style="font-family: 'Poppins', sans-serif; font-size: 16px; font-weight: 600;">Total</span>
                    <span style="font-family: 'Poppins', sans-serif; font-size: 22px; font-weight: 700; color: #1b6f00;">$<?= number_format($subtotal, 2) ?></span>
                </div>

                <div style="margin-top: 16px; padding: 12px; background: #f0fdf4; border-radius: 8px; text-align: center;">
                    <span style="font-size: 13px; color: #166534;">🔒 Pagamento 100% seguro</span>
                </div>
            </div>
        </div>
    </div>
</div>
