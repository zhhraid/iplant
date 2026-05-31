<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Pengiriman - iplant.id</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="checkout-page-container">
        <!-- Left Side: Form Content -->
        <div class="checkout-left-side">
            <div class="checkout-left-content">
                <div class="checkout-logo-new">
                    <a href="/">iPlant</a>
                </div>
                
                <div class="checkout-breadcrumb-new">
                    <a href="/checkout/info">Informasi Pembeli</a> &gt; 
                    <span class="active">Metode Pengiriman</span> &gt; 
                    <span>Metode Pembayaran</span>
                </div>
                
                
                
                
                <form action="/checkout/payment" method="POST" id="checkoutShippingForm">
                    <h3 class="checkout-section-title">Metode Pengiriman</h3>
                    
                    <div class="courier-selector-container">
                        <?php foreach ($rates as $key => $courier): ?>
                            <div class="courier-card <?= $key === 'jne' ? 'selected' : '' ?>" id="card-<?= $key ?>">
                                <div class="courier-header" onclick="selectCourier('<?= $key ?>')">
                                    <div style="display:flex; align-items:center; gap:12px;">
                                        <input type="radio" name="selected_courier" id="courier_<?= $key ?>" value="<?= $key ?>" <?= $key === 'jne' ? 'checked' : '' ?>>
                                        <label for="courier_<?= $key ?>" style="cursor: pointer; display: flex; align-items: center;">
                                            <img src="<?= esc($courier['logo']) ?>" alt="<?= esc($courier['name']) ?>" class="courier-logo-img">
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="courier-services-panel" id="panel-<?= $key ?>" style="<?= $key === 'jne' ? '' : 'display:none;' ?>">
                                    <?php foreach ($courier['services'] as $srvKey => $service): ?>
                                        <label class="service-option-row">
                                            <input type="radio" name="shipping_service_radio" value="<?= esc($courier['name']) ?> - <?= esc($service['name']) ?>" data-cost="<?= $service['cost'] ?>" <?= ($key === 'jne' && $srvKey === 'REG') ? 'checked' : '' ?> onclick="event.stopPropagation(); updateService('<?= esc($courier['name']) ?> - <?= esc($service['name']) ?>', <?= $service['cost'] ?>)">
                                            <span><strong style="font-style: italic; font-weight: 700;"><?= esc($service['name']) ?></strong> - Rp <?= number_format($service['cost'], 0, ',', '.') ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <input type="hidden" name="shipping_courier" id="shipping_courier_input" value="JNE - REG">
                    <input type="hidden" name="shipping_cost" id="shipping_cost_input" value="<?= $rates['jne']['services']['REG']['cost'] ?>">
                    
                    <div style="display: flex; justify-content: flex-end; align-items: center; gap: 20px; margin-top: 40px; padding-top: 10px;">
                        <a href="/checkout/info" class="back-link-new" style="color: #3498db; text-decoration: none; font-size: 0.95rem;">Kembali</a>
                        <button type="submit" class="btn-primary-new">Lanjutkan</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Right Side: Order Summary -->
        <div class="checkout-right-side">
            <div class="checkout-right-content">
                <div class="summary-items-new">
                    <?php 
                        $coupon = session()->get('coupon') ?? [];
                        $couponCode = $coupon['code'] ?? '';
                        $couponDiscount = (int) ($coupon['discount'] ?? 0);
                        $subtotal = 0;
                        foreach($cart as $item): 
                            $subtotal += $item['price'] * $item['quantity'];
                    ?>
                    <div class="summary-item-new" id="item-<?= $item['id'] ?>">
                        <div class="summary-item-left">
                            <img src="<?= esc($item['image_url']) ?>" alt="<?= esc($item['name']) ?>" onerror="this.src='https://placehold.co/50x50?text=iplant.id'">
                            <div class="summary-item-details">
                                <div class="summary-item-name-new"><?= esc($item['name']) ?></div>
                                <div class="summary-item-price-new"><?= number_format($item['price'], 0, ',', '.') ?></div>
                            </div>
                        </div>
                        <div class="qty-selector-new">
                            <button type="button" onclick="changeQty(<?= $item['id'] ?>, -1)" <?= $item['quantity'] <= 1 ? 'disabled' : '' ?>>-</button>
                            <input type="text" id="qty-<?= $item['id'] ?>" value="<?= $item['quantity'] ?>" readonly>
                            <button type="button" onclick="changeQty(<?= $item['id'] ?>, 1)">+</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <div class="coupon-section-new">
                    <label class="coupon-label-new">Kode Kupon</label>
                    <div class="coupon-input-group-new">
                        <input type="text" id="coupon_code" name="coupon_code" placeholder="Kode" value="<?= esc($couponCode) ?>">
                        <button type="button" onclick="applyCoupon()">Cari</button>
                    </div>
                    <!-- Coupon Error Message -->
                    <div id="coupon-error" style="display: none; color: #333; font-size: 0.88rem; margin-top: 10px; text-align: left;">
                        <span id="coupon-error-msg"></span>
                    </div>
                </div>
                
                <div class="totals-section-new" style="border-bottom: 1px solid #e1e1e1; padding-bottom: 15px;">
                    <div class="totals-row-new">
                        <span>Subtotal</span>
                        <span>Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                    </div>
                    <div class="totals-row-new" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px;">
                        <div>
                            <div style="font-weight: 500; color: #666;">Tarif Pengiriman</div>
                            <div id="shipping-details-sub" style="font-size: 0.78rem; color: #999; margin-top: 2px;">JNE - REG (<?= number_format($totalWeightKg, 1, '.', ',') ?>kg)</div>
                        </div>
                        <span id="shipping-display">Rp <?= number_format($rates['jne']['services']['REG']['cost'], 0, ',', '.') ?></span>
                    </div>
                    <div class="totals-row-new" id="discount-row" style="<?= $couponDiscount > 0 ? '' : 'display: none;' ?> color: #e74c3c;">
                        <span>Potongan Kupon (<span id="applied-coupon-code"><?= esc($couponCode) ?></span>)</span>
                        <span>-Rp <span id="applied-coupon-discount"><?= number_format($couponDiscount, 0, ',', '.') ?></span></span>
                    </div>
                </div>
                
                <div class="totals-section-new">
                    <div class="totals-row-new total-grand-new" style="border-top: none; margin-top: 0; padding-top: 0;">
                        <span>Total</span>
                        <span id="total-display">Rp <?= number_format($subtotal + $rates['jne']['services']['REG']['cost'] - $couponDiscount, 0, ',', '.') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const subtotal = <?= $subtotal ?>;
        let couponDiscount = <?= $couponDiscount ?>;
        
        function updateService(courierService, cost) {
            document.getElementById('shipping_courier_input').value = courierService;
            document.getElementById('shipping_cost_input').value = cost;
            
            // Format to Rupiah
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });
            
            const formattedCost = formatter.format(cost).replace('Rp', 'Rp ');
            document.getElementById('shipping-display').innerText = formattedCost;
            
            // Update subtext
            const weightStr = "<?= number_format($totalWeightKg, 1, '.', ',') ?>kg";
            document.getElementById('shipping-details-sub').innerText = courierService + " (" + weightStr + ")";
            
            // Update grand total
            const grandTotal = subtotal + cost - couponDiscount;
            document.getElementById('total-display').innerText = formatter.format(grandTotal).replace('Rp', 'Rp ');
        }

        function selectCourier(courierKey) {
            // Remove 'selected' class from all cards
            document.querySelectorAll('.courier-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add 'selected' class to active card
            document.getElementById('card-' + courierKey).classList.add('selected');
            
            // Hide all panels
            document.querySelectorAll('.courier-services-panel').forEach(panel => {
                panel.style.display = 'none';
            });
            
            // Uncheck other courier radio buttons
            document.getElementById('courier_' + courierKey).checked = true;
            
            // Show selected panel
            const selectedPanel = document.getElementById('panel-' + courierKey);
            selectedPanel.style.display = 'block';
            
            // Select first service in this panel
            const firstRadio = selectedPanel.querySelector('input[type="radio"]');
            if (firstRadio) {
                firstRadio.checked = true;
                // Read value and cost
                const srvName = firstRadio.value;
                const cost = parseInt(firstRadio.getAttribute('data-cost'));
                updateService(srvName, cost);
            }
        }
        
        function changeQty(productId, delta) {
            const input = document.getElementById('qty-' + productId);
            let qty = parseInt(input.value) + delta;
            if (qty < 1) {
                return;
            }

            updateCartItem(productId, qty);
        }
        
        function updateCartItem(productId, qty) {
            // Show loading state
            document.querySelector('.checkout-right-content').style.opacity = '0.5';
            
            fetch('/checkout/update-item', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'product_id=' + productId + '&quantity=' + qty
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    location.reload();
                } else {
                    document.querySelector('.checkout-right-content').style.opacity = '1';
                }
            })
            .catch(err => {
                console.error(err);
                document.querySelector('.checkout-right-content').style.opacity = '1';
            });
        }
        
        function applyCoupon() {
            const input = document.getElementById('coupon_code');
            const code = input.value.trim();
            const errorDiv = document.getElementById('coupon-error');
            const invalidCodeSpan = document.getElementById('invalid-coupon-code');
            const discountRow = document.getElementById('discount-row');
            const appliedCodeSpan = document.getElementById('applied-coupon-code');
            const appliedDiscountSpan = document.getElementById('applied-coupon-discount');
            const grandTotalSpan = document.getElementById('total-display');
            
            if (code === '') {
                errorDiv.style.display = 'none';
                return;
            }
            
            // Show loading state
            document.querySelector('.checkout-right-content').style.opacity = '0.5';
            
            fetch('/checkout/apply-coupon', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: 'coupon_code=' + encodeURIComponent(code)
            })
            .then(res => res.json())
            .then(data => {
                document.querySelector('.checkout-right-content').style.opacity = '1';
                if (data.status === 'success') {
                    // Hide error
                    errorDiv.style.display = 'none';
                    // Show discount row
                    discountRow.style.display = 'flex';
                    appliedCodeSpan.innerText = data.code;
                    
                    const formatter = new Intl.NumberFormat('id-ID');
                    appliedDiscountSpan.innerText = formatter.format(data.discount);
                    
                    // Update global coupon discount
                    couponDiscount = data.discount;
                    
                    // Recalculate total with current shipping cost
                    const shippingCost = parseInt(document.getElementById('shipping_cost_input').value);
                    const grandTotal = subtotal + shippingCost - couponDiscount;
                    grandTotalSpan.innerText = 'Rp ' + formatter.format(grandTotal);
                } else {
                    // Show error from backend
                    errorDiv.style.display = 'block';
                    document.getElementById('coupon-error-msg').innerHTML = data.message;
                    
                    // Hide discount row
                    discountRow.style.display = 'none';
                    
                    // Reset global coupon discount
                    couponDiscount = 0;
                    
                    const formatter = new Intl.NumberFormat('id-ID');
                    const shippingCost = parseInt(document.getElementById('shipping_cost_input').value);
                    const grandTotal = subtotal + shippingCost;
                    grandTotalSpan.innerText = 'Rp ' + formatter.format(grandTotal);
                }
            })
            .catch(err => {
                console.error(err);
                document.querySelector('.checkout-right-content').style.opacity = '1';
            });
        }
    </script>
</body>
</html>
