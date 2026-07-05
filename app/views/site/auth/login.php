<div class="text-center mb-4">
    <h3 style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 600;">Entrar na sua conta</h3>
    <p style="color: #666;">Acesse sua conta para gerenciar seus passeios e reservas</p>
</div>

<?php if (has_flash('error')): ?>
<div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 20px;"><?= flash('error') ?></div>
<?php endif; ?>
<?php if (has_flash('success')): ?>
<div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 20px;"><?= flash('success') ?></div>
<?php endif; ?>

<form action="<?= base_url('login/autenticar') ?>" method="POST" style="max-width: 400px; margin: 0 auto;">
    <?= csrf_field() ?>
    <div style="margin-bottom: 16px;">
        <label style="display: block; margin-bottom: 6px; font-weight: 500;">Email</label>
        <input type="email" name="email" required autofocus style="width: 100%; padding: 12px; border: 1px solid #e0e0e0; border-radius: 6px; font-size: 16px;">
    </div>
    <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 6px; font-weight: 500;">Senha</label>
        <input type="password" name="password" required style="width: 100%; padding: 12px; border: 1px solid #e0e0e0; border-radius: 6px; font-size: 16px;">
    </div>
    <button type="submit" style="width: 100%; padding: 14px; background: #1b6f00; color: #fff; border: none; border-radius: 6px; font-size: 16px; font-weight: 500; cursor: pointer;">Entrar</button>
</form>

<div style="text-align: center; margin-top: 20px;">
    <p style="color: #666;">
        Não tem uma conta? <a href="<?= base_url('registro') ?>" style="color: #3772c0;">Criar conta</a>
    </p>
</div>
