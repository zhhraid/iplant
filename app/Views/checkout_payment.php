<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Pembayaran - iplant.id</title>
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
                    <a href="/checkout/shipping">Metode Pengiriman</a> &gt; 
                    <span class="active">Metode Pembayaran</span>
                </div>
                
                <?php 
                    $email = $info['email'] ?? '-';
                    $address = ($info['address'] ?? '') . ', ' . ($info['city'] ?? '') . ' ' . ($info['zip'] ?? '');
                    $courier = $shipping['shipping_courier'] ?? 'JNE - REG';
                    $shippingCost = (int) ($shipping['shipping_cost'] ?? 17000);
                    
                    // Calculate weight
                    $totalQty = 0;
                    foreach ($cart as $item) {
                        $totalQty += $item['quantity'];
                    }
                    $totalWeightKg = ($totalQty * 300) / 1000.0;
                ?>
                <form action="/checkout/process" method="POST">
                    <h3 class="checkout-section-title">Metode Pembayaran</h3>
                    
                    <div class="payment-card" style="border: 1px solid #d9d9d9; border-radius: 4px; padding: 25px; background: #fff; margin-bottom: 25px;">
                        <!-- Radio selection -->
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 15px;">
                            <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer" checked style="width: 18px; height: 18px; cursor: pointer;">
                            <label for="bank_transfer" style="font-size: 1.05rem; font-weight: bold; font-style: italic; color: #333; cursor: pointer; display: flex; align-items: center;">Bank Transfer</label>
                        </div>
                        
                        <!-- Info message -->
                        <p style="font-size: 0.9rem; color: #333; margin-bottom: 20px; padding-left: 28px; line-height: 1.4;">Mohon lakukan pembayaran ke salah satu rekening dibawah ini.</p>
                        
                        <!-- Bank Logos using high quality images -->
                        <div class="bank-logos" style="display: flex; gap: 20px; align-items: center; padding-left: 28px;">
                            <img src="/images/payments/bca.png" alt="BCA" style="height: 30px; object-fit: contain;">
                            <img src="/images/payments/bni.png" alt="BNI" style="height: 26px; object-fit: contain;">
                            <img src="/images/payments/mandiri.png" alt="Mandiri" style="height: 26px; object-fit: contain;">
                        </div>
                    </div>
                    
                    <div style="display: flex; justify-content: flex-end; align-items: center; gap: 20px; margin-top: 40px; padding-top: 10px;">
                        <a href="/checkout/shipping" class="back-link-new" style="color: #3498db; text-decoration: none; font-size: 0.95rem;">Kembali</a>
                        <button type="submit" class="btn-primary-new">Selesaikan Order</button>
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
                            <div id="shipping-details-sub" style="font-size: 0.78rem; color: #999; margin-top: 2px;"><?= esc($courier) ?> (<?= number_format($totalWeightKg, 1, '.', ',') ?>kg)</div>
                        </div>
                        <span id="shipping-display">Rp <?= number_format($shippingCost, 0, ',', '.') ?></span>
                    </div>
                    <div class="totals-row-new" id="discount-row" style="<?= $couponDiscount > 0 ? '' : 'display: none;' ?> color: #e74c3c;">
                        <span>Potongan Kupon (<span id="applied-coupon-code"><?= esc($couponCode) ?></span>)</span>
                        <span>-Rp <span id="applied-coupon-discount"><?= number_format($couponDiscount, 0, ',', '.') ?></span></span>
                    </div>
                </div>
                
                <div class="totals-section-new">
                    <div class="totals-row-new total-grand-new" style="border-top: none; margin-top: 0; padding-top: 0;">
                        <span>Total</span>
                        <span id="total-display">Rp <?= number_format($subtotal + $shippingCost - $couponDiscount, 0, ',', '.') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const subtotal = <?= $subtotal ?>;
        const shippingCost = <?= $shippingCost ?>;
        let couponDiscount = <?= $couponDiscount ?>;
        
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
                    
                    // Recalculate total
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
