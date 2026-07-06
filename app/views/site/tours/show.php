<?php $t = $tour; ?>

<!-- Banner Image -->
<?php if (!empty($t['image_url'])): ?>
<div style="width:100%; height:400px; background: url('<?= htmlspecialchars($t['image_url']) ?>') center/cover no-repeat; border-radius: 0 0 20px 20px; margin-bottom: 40px;"></div>
<?php endif; ?>

<div style="display:flex; gap:40px; flex-wrap:wrap; max-width:1290px; margin:0 auto; padding:0 20px;">
    <!-- Main Content -->
    <div style="flex:1; min-width:0;">
        <h1 style="font-family:'Poppins',sans-serif; font-size:36px; font-weight:600; color:#1C2011; margin-bottom:20px;"><?= htmlspecialchars($t['name']) ?></h1>
        
        <!-- Meta info -->
        <div style="display:flex; gap:20px; margin-bottom:30px; font-family:'Poppins',sans-serif; font-size:14px; color:#4B5563;">
            <?php if ($t['duration_hours'] > 0): ?>
            <span><span class="wpte-icon-clock"></span> <?= $t['duration_hours'] ?> Horas</span>
            <?php endif; ?>
            <?php if (!empty($t['location'])): ?>
            <span><span class="wpte-icon-map-marker"></span> <?= htmlspecialchars($t['location']) ?></span>
            <?php endif; ?>
            <?php if ($t['max_capacity']): ?>
            <span><span class="wpte-icon-users"></span> Máx. <?= $t['max_capacity'] ?> pessoas</span>
            <?php endif; ?>
        </div>

        <!-- Description -->
        <?php if (!empty($t['description'])): ?>
        <p style="font-family:'Poppins',sans-serif; font-size:16px; line-height:1.8; color:#4B5563; margin-bottom:30px;"><?= nl2br(htmlspecialchars($t['description'])) ?></p>
        <?php endif; ?>

        <?php if (!$t['pregnant_allowed']): ?>
        <p style="font-weight:600; color:#dc2626; margin-bottom:20px;">⚠️ Gestantes não são permitidas.</p>
        <?php endif; ?>

        <!-- Tabs -->
        <div style="border-bottom:2px solid #e5e7eb; margin-bottom:30px;">
            <div style="display:flex; gap:30px;">
                <button onclick="showTab('overview')" class="tab-btn active" style="padding:12px 0; border:none; background:none; font-family:'Poppins',sans-serif; font-size:16px; font-weight:500; cursor:pointer; border-bottom:2px solid #1b6f00; margin-bottom:-2px; color:#1b6f00;">Visão Geral</button>
                <?php if (!empty($packages)): ?>
                <button onclick="showTab('packages')" class="tab-btn" style="padding:12px 0; border:none; background:none; font-family:'Poppins',sans-serif; font-size:16px; font-weight:500; cursor:pointer; color:#4B5563;">Pacotes & Preços</button>
                <?php endif; ?>
                <?php if (!empty($faqs)): ?>
                <button onclick="showTab('faqs')" class="tab-btn" style="padding:12px 0; border:none; background:none; font-family:'Poppins',sans-serif; font-size:16px; font-weight:500; cursor:pointer; color:#4B5563;">FAQs</button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Tab: Overview -->
        <div id="tab-overview" class="tab-content">
            <?php if (!empty($t['overview'])): ?>
            <h2 style="font-family:'Poppins',sans-serif; font-size:24px; font-weight:600; margin-bottom:20px;">Visão Geral</h2>
            <div style="font-family:'Poppins',sans-serif; font-size:16px; line-height:1.8; color:#374151;"><?= nl2br(htmlspecialchars($t['overview'])) ?></div>
            <?php endif; ?>

            <?php if (!empty($t['highlights'])): ?>
            <h3 style="font-family:'Poppins',sans-serif; font-size:20px; font-weight:600; margin:30px 0 15px;">Destaques</h3>
            <ul style="font-family:'Poppins',sans-serif; font-size:15px; line-height:2; color:#374151; padding-left:20px;">
                <?php foreach (explode("\n", $t['highlights']) as $h): if (trim($h)): ?>
                <li><?= htmlspecialchars(trim($h)) ?></li>
                <?php endif; endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if (!empty($t['inclusions'])): ?>
            <h3 style="font-family:'Poppins',sans-serif; font-size:20px; font-weight:600; margin:30px 0 15px; color:#1b6f00;">✓ O que Inclui</h3>
            <ul style="font-family:'Poppins',sans-serif; font-size:15px; line-height:2; color:#374151; padding-left:20px; list-style:none;">
                <?php foreach (explode("\n", $t['inclusions']) as $item): if (trim($item)): ?>
                <li>✅ <?= htmlspecialchars(trim($item)) ?></li>
                <?php endif; endforeach; ?>
            </ul>
            <?php endif; ?>

            <?php if (!empty($t['exclusions'])): ?>
            <h3 style="font-family:'Poppins',sans-serif; font-size:20px; font-weight:600; margin:30px 0 15px; color:#dc2626;">✗ O que Não Inclui</h3>
            <ul style="font-family:'Poppins',sans-serif; font-size:15px; line-height:2; color:#374151; padding-left:20px; list-style:none;">
                <?php foreach (explode("\n", $t['exclusions']) as $item): if (trim($item)): ?>
                <li>❌ <?= htmlspecialchars(trim($item)) ?></li>
                <?php endif; endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>

        <!-- Tab: Packages -->
        <div id="tab-packages" class="tab-content" style="display:none;">
            <?php if (!empty($packages)): foreach ($packages as $pkg): ?>
            <div style="border:1px solid #e5e7eb; border-radius:12px; padding:24px; margin-bottom:20px;">
                <h3 style="font-family:'Poppins',sans-serif; font-size:20px; font-weight:600; margin-bottom:10px;"><?= htmlspecialchars($pkg['name']) ?></h3>
                <?php if (!empty($pkg['description'])): ?>
                <p style="color:#4B5563; margin-bottom:15px;"><?= htmlspecialchars($pkg['description']) ?></p>
                <?php endif; ?>
                <?php if (!empty($pkg['age_groups'])): ?>
                <table style="width:100%; font-family:'Poppins',sans-serif; font-size:14px;">
                    <tr style="background:#f9fafb;"><th style="padding:10px; text-align:left;">Faixa Etária</th><th style="padding:10px;">Idade</th><th style="padding:10px; text-align:right;">Preço</th></tr>
                    <?php foreach ($pkg['age_groups'] as $ag): ?>
                    <tr style="border-bottom:1px solid #f3f4f6;"><td style="padding:10px;"><?= htmlspecialchars($ag['label']) ?></td><td style="padding:10px; text-align:center;"><?= $ag['min_age'] ?>-<?= $ag['max_age'] ?> anos</td><td style="padding:10px; text-align:right; font-weight:600; color:#1b6f00;">$<?= number_format($ag['price'], 2) ?></td></tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>
            </div>
            <?php endforeach; endif; ?>
        </div>

        <!-- Tab: FAQs -->
        <div id="tab-faqs" class="tab-content" style="display:none;">
            <?php if (!empty($faqs)): foreach ($faqs as $faq): ?>
            <details style="border:1px solid #e5e7eb; border-radius:8px; padding:16px; margin-bottom:12px;">
                <summary style="font-family:'Poppins',sans-serif; font-weight:500; cursor:pointer;"><?= htmlspecialchars($faq['question']) ?></summary>
                <p style="margin-top:12px; color:#4B5563; font-size:15px; line-height:1.6;"><?= htmlspecialchars($faq['answer']) ?></p>
            </details>
            <?php endforeach; endif; ?>
        </div>
    </div>

    <!-- Sidebar -->
    <div style="width:350px; flex-shrink:0;">
        <div style="position:sticky; top:20px; background:#fff; border:1px solid #e5e7eb; border-radius:16px; padding:30px; box-shadow:0 4px 20px rgba(0,0,0,0.08);">
            <div style="text-align:center; margin-bottom:20px;">
                <?php if ($t['discount_percent'] > 0): ?>
                <span style="background:#ffd700; color:#1b6f00; padding:4px 12px; border-radius:15px; font-size:12px; font-weight:600;"><?= (int)$t['discount_percent'] ?>% OFF</span>
                <?php endif; ?>
                <div style="margin-top:15px;">
                    <?php if ($t['discount_percent'] > 0): ?>
                    <del style="color:#999; font-size:16px;">$<?= number_format($t['price_from'] / (1 - $t['discount_percent']/100), 0) ?></del>
                    <?php endif; ?>
                    <span style="font-family:'Poppins',sans-serif; font-size:36px; font-weight:700; color:#1b6f00;">$<?= number_format($t['price_from'], 0) ?></span>
                    <span style="font-size:14px; color:#666;"> / pessoa</span>
                </div>
            </div>

            <?php if ($t['duration_hours'] > 0): ?>
            <div style="display:flex; align-items:center; gap:10px; padding:12px 0; border-top:1px solid #f3f4f6;">
                <span class="wpte-icon-clock" style="color:#3772c0;"></span>
                <span style="font-family:'Poppins',sans-serif; font-size:14px;"><?= $t['duration_hours'] ?> Horas</span>
            </div>
            <?php endif; ?>

            <a href="#" onclick="openBookingModal()" style="display:block; width:100%; padding:16px; background:#1b6f00; color:#fff; text-align:center; border-radius:8px; font-family:'Poppins',sans-serif; font-size:16px; font-weight:600; text-decoration:none; margin-top:20px; transition:background 0.3s;" onmouseover="this.style.background='#155d00'" onmouseout="this.style.background='#1b6f00'">Verificar Disponibilidade</a>
            
            <p style="text-align:center; margin-top:15px; font-size:13px; color:#666;">
                Precisa de ajuda? <a href="https://api.whatsapp.com/send?phone=18294582170" style="color:#1b6f00; font-weight:500;">Envie-Nos Uma Mensagem</a>
            </p>
        </div>

        <!-- Related Tours -->
        <?php if (!empty($relatedTours)): ?>
        <div style="margin-top:30px;">
            <h3 style="font-family:'Poppins',sans-serif; font-size:18px; font-weight:600; margin-bottom:15px;">Passeios Relacionados</h3>
            <?php foreach ($relatedTours as $rel): ?>
            <a href="<?= base_url('passeio?slug=' . $rel['slug']) ?>" style="display:flex; gap:12px; padding:12px 0; border-bottom:1px solid #f3f4f6; text-decoration:none; color:inherit;">
                <?php if (!empty($rel['image_url'])): ?>
                <img src="<?= htmlspecialchars($rel['image_url']) ?>" style="width:70px; height:50px; object-fit:cover; border-radius:6px;">
                <?php endif; ?>
                <div>
                    <p style="font-family:'Poppins',sans-serif; font-size:14px; font-weight:500; color:#1C2011; margin:0;"><?= htmlspecialchars($rel['name']) ?></p>
                    <span style="font-size:14px; font-weight:600; color:#1b6f00;">$<?= number_format($rel['price_from'], 0) ?></span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Tab switching script -->
<script>
function showTab(tab) {
    document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.tab-btn').forEach(el => { el.style.borderBottom = 'none'; el.style.color = '#4B5563'; });
    document.getElementById('tab-' + tab).style.display = 'block';
    event.target.style.borderBottom = '2px solid #1b6f00';
    event.target.style.color = '#1b6f00';
}
</script>

<!-- Booking Modal -->
<div id="bookingModal" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.6); z-index:99999; display:none; align-items:center; justify-content:center;">
    <div style="background:#fff; border-radius:16px; max-width:500px; width:90%; max-height:90vh; overflow-y:auto; padding:32px; position:relative; box-shadow:0 20px 60px rgba(0,0,0,0.3);">
        <button onclick="closeBookingModal()" style="position:absolute; top:16px; right:16px; background:none; border:none; font-size:24px; cursor:pointer; color:#666;">✕</button>
        
        <h2 style="font-family:'Poppins',sans-serif; font-size:22px; font-weight:600; margin-bottom:8px;"><?= htmlspecialchars($t['name']) ?></h2>
        <p style="font-size:14px; color:#6b7280; margin-bottom:24px;">Selecione a data e passageiros</p>

        <!-- Step 1: Date -->
        <div id="step-date">
            <label style="display:block; margin-bottom:8px; font-family:'Poppins',sans-serif; font-weight:500; font-size:14px;">📅 Data do Passeio *</label>
            <input type="date" id="booking-date" min="<?= date('Y-m-d', strtotime('+' . ($t['min_advance_hours'] ?? 24) . ' hours')) ?>" style="width:100%; padding:14px 16px; border:1px solid #e0e0e0; border-radius:8px; font-size:16px; font-family:'Poppins',sans-serif; background:#f9fafb; margin-bottom:20px;">
            
            <label style="display:block; margin-bottom:8px; font-family:'Poppins',sans-serif; font-weight:500; font-size:14px;">🕐 Horário</label>
            <select id="booking-time" style="width:100%; padding:14px 16px; border:1px solid #e0e0e0; border-radius:8px; font-size:16px; font-family:'Poppins',sans-serif; background:#f9fafb; margin-bottom:24px;">
                <option value="">Selecione o horário</option>
                <option value="07:00">07:00</option>
                <option value="08:00">08:00</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
            </select>

            <button onclick="goToStep2()" style="width:100%; padding:14px; background:#3772c0; color:#fff; border:none; border-radius:8px; font-size:16px; font-family:'Poppins',sans-serif; font-weight:500; cursor:pointer;">Continuar →</button>
        </div>

        <!-- Step 2: Passengers -->
        <div id="step-passengers" style="display:none;">
            <div style="margin-bottom:20px;">
                <div style="display:flex; justify-content:space-between; align-items:center; padding:16px 0; border-bottom:1px solid #f3f4f6;">
                    <div>
                        <span style="font-family:'Poppins',sans-serif; font-weight:500;">Adultos</span>
                        <span style="font-size:12px; color:#6b7280; display:block;">18+ anos</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:12px;">
                        <button onclick="changeQty('adults',-1)" style="width:36px; height:36px; border-radius:50%; border:1px solid #e0e0e0; background:#f9fafb; font-size:18px; cursor:pointer;">−</button>
                        <span id="qty-adults" style="font-family:'Poppins',sans-serif; font-weight:600; font-size:18px; min-width:24px; text-align:center;">1</span>
                        <button onclick="changeQty('adults',1)" style="width:36px; height:36px; border-radius:50%; border:1px solid #e0e0e0; background:#f9fafb; font-size:18px; cursor:pointer;">+</button>
                    </div>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; padding:16px 0; border-bottom:1px solid #f3f4f6;">
                    <div>
                        <span style="font-family:'Poppins',sans-serif; font-weight:500;">Crianças</span>
                        <span style="font-size:12px; color:#6b7280; display:block;">2-17 anos</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:12px;">
                        <button onclick="changeQty('children',-1)" style="width:36px; height:36px; border-radius:50%; border:1px solid #e0e0e0; background:#f9fafb; font-size:18px; cursor:pointer;">−</button>
                        <span id="qty-children" style="font-family:'Poppins',sans-serif; font-weight:600; font-size:18px; min-width:24px; text-align:center;">0</span>
                        <button onclick="changeQty('children',1)" style="width:36px; height:36px; border-radius:50%; border:1px solid #e0e0e0; background:#f9fafb; font-size:18px; cursor:pointer;">+</button>
                    </div>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:center; padding:16px 0;">
                    <div>
                        <span style="font-family:'Poppins',sans-serif; font-weight:500;">Bebês</span>
                        <span style="font-size:12px; color:#6b7280; display:block;">0-1 anos (grátis)</span>
                    </div>
                    <div style="display:flex; align-items:center; gap:12px;">
                        <button onclick="changeQty('babies',-1)" style="width:36px; height:36px; border-radius:50%; border:1px solid #e0e0e0; background:#f9fafb; font-size:18px; cursor:pointer;">−</button>
                        <span id="qty-babies" style="font-family:'Poppins',sans-serif; font-weight:600; font-size:18px; min-width:24px; text-align:center;">0</span>
                        <button onclick="changeQty('babies',1)" style="width:36px; height:36px; border-radius:50%; border:1px solid #e0e0e0; background:#f9fafb; font-size:18px; cursor:pointer;">+</button>
                    </div>
                </div>
            </div>

            <!-- Total -->
            <div style="background:#f0fdf4; border-radius:8px; padding:16px; margin-bottom:20px; text-align:center;">
                <span style="font-size:14px; color:#166534;">Total estimado:</span>
                <span id="booking-total" style="font-family:'Poppins',sans-serif; font-size:24px; font-weight:700; color:#1b6f00; margin-left:8px;">$<?= number_format($t['price_from'], 0) ?></span>
            </div>

            <div style="display:flex; gap:12px;">
                <form action="<?= base_url('carrinho/adicionar') ?>" method="POST" style="flex:1;" id="addToCartForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="item_type" value="tour">
                    <input type="hidden" name="item_id" value="<?= $t['id'] ?>">
                    <input type="hidden" name="date" id="form-date">
                    <input type="hidden" name="time_slot" id="form-time">
                    <input type="hidden" name="adults" id="form-adults" value="1">
                    <input type="hidden" name="children" id="form-children" value="0">
                    <input type="hidden" name="babies" id="form-babies" value="0">
                    <button type="submit" style="width:100%; padding:14px; background:#1b6f00; color:#fff; border:none; border-radius:8px; font-size:15px; font-family:'Poppins',sans-serif; font-weight:500; cursor:pointer;">🛒 Adicionar ao Carrinho</button>
                </form>
            </div>
            <button onclick="goToStep1()" style="width:100%; padding:10px; background:none; border:none; color:#3772c0; font-family:'Poppins',sans-serif; font-size:14px; cursor:pointer; margin-top:10px;">← Voltar</button>
        </div>
    </div>
</div>

<script>
var bookingQty = { adults: 1, children: 0, babies: 0 };
var tourPrice = <?= (float)$t['price_from'] ?>;

function openBookingModal() {
    document.getElementById('bookingModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeBookingModal() {
    document.getElementById('bookingModal').style.display = 'none';
    document.body.style.overflow = '';
}
function goToStep2() {
    var date = document.getElementById('booking-date').value;
    if (!date) { alert('Selecione uma data'); return; }
    document.getElementById('step-date').style.display = 'none';
    document.getElementById('step-passengers').style.display = 'block';
    document.getElementById('form-date').value = date;
    document.getElementById('form-time').value = document.getElementById('booking-time').value;
    updateTotal();
}
function goToStep1() {
    document.getElementById('step-date').style.display = 'block';
    document.getElementById('step-passengers').style.display = 'none';
}
function changeQty(type, delta) {
    bookingQty[type] = Math.max(type === 'adults' ? 1 : 0, bookingQty[type] + delta);
    document.getElementById('qty-' + type).textContent = bookingQty[type];
    document.getElementById('form-' + type).value = bookingQty[type];
    updateTotal();
}
function updateTotal() {
    var total = (bookingQty.adults + bookingQty.children) * tourPrice;
    document.getElementById('booking-total').textContent = '$' + total.toFixed(0);
}
// Close on overlay click
document.getElementById('bookingModal').addEventListener('click', function(e) {
    if (e.target === this) closeBookingModal();
});
</script>
