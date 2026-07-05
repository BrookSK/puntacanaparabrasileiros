<div style="max-width: 450px; margin: 60px auto; padding: 0 20px;">
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="font-family: 'Poppins', sans-serif; font-size: 32px; font-weight: 600; color: #1C2011; margin-bottom: 12px;">Entrar na sua conta</h1>
        <p style="font-family: 'Poppins', sans-serif; color: #4B5563; font-size: 16px;">Acesse sua conta para gerenciar seus passeios e reservas</p>
    </div>

    <?php if (has_flash('error')): ?>
    <div style="background: #fef2f2; color: #991b1b; padding: 14px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; border: 1px solid #fecaca;"><?= flash('error') ?></div>
    <?php endif; ?>
    <?php if (has_flash('success')): ?>
    <div style="background: #f0fdf4; color: #166534; padding: 14px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; border: 1px solid #bbf7d0;"><?= flash('success') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('login/autenticar') ?>" method="POST">
        <?= csrf_field() ?>
        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; color: #1C2011;">Email</label>
            <input type="email" name="email" required autofocus style="width: 100%; padding: 14px 16px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 16px; font-family: 'Poppins', sans-serif; background: #f9fafb; transition: border-color 0.3s;" onfocus="this.style.borderColor='#3772c0'" onblur="this.style.borderColor='#e0e0e0'">
        </div>
        <div style="margin-bottom: 24px;">
            <label style="display: block; margin-bottom: 8px; font-family: 'Poppins', sans-serif; font-weight: 500; font-size: 14px; color: #1C2011;">Senha</label>
            <input type="password" name="password" required style="width: 100%; padding: 14px 16px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 16px; font-family: 'Poppins', sans-serif; background: #f9fafb; transition: border-color 0.3s;" onfocus="this.style.borderColor='#3772c0'" onblur="this.style.borderColor='#e0e0e0'">
        </div>
        <button type="submit" style="width: 100%; padding: 16px; background: #1b6f00; color: #fff; border: none; border-radius: 8px; font-size: 16px; font-family: 'Poppins', sans-serif; font-weight: 500; cursor: pointer; transition: background 0.3s;" onmouseover="this.style.background='#155d00'" onmouseout="this.style.background='#1b6f00'">Entrar</button>
    </form>

    <div style="text-align: center; margin-top: 24px;">
        <p style="font-family: 'Poppins', sans-serif; color: #4B5563; font-size: 14px;">
            Não tem uma conta? <a href="<?= base_url('registro') ?>" style="color: #3772c0; font-weight: 500; text-decoration: none;">Criar conta</a>
        </p>
    </div>
</div>
