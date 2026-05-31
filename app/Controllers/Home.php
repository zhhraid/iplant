<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\OrderTrackingEventModel;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index(): string
    {
        $productModel = new ProductModel();
        // Retrieve products belonging to our 5 active subcategories
        $products = $productModel->whereIn('subcategory', ['Bambu Hoki', 'Anggrek', 'Mawar', 'Mangga', 'Media Tanam'])->findAll();
        return view('home', ['products' => $products]);
    }

    public function login(): string
    {
        return view('login');
    }

    public function register(): string
    {
        return view('register');
    }

    public function forgotPassword(): string
    {
        return view('forgot_password');
    }

    public function category($subcategory = null)
    {
        if (empty($subcategory)) {
            $subcategory = 'bambu-hoki';
        }

        $subNameMap = [
            'bambu-hoki'   => 'Bambu Hoki',
            'anggrek'      => 'Anggrek',
            'mawar'        => 'Mawar',
            'mangga'       => 'Mangga',
            'media-tanam'  => 'Media Tanam'
        ];

        $displayName = $subNameMap[$subcategory] ?? 'Bambu Hoki';
        $activeSlug = isset($subNameMap[$subcategory]) ? $subcategory : 'bambu-hoki';

        $productModel = new ProductModel();
        $products = $productModel->where('subcategory', $displayName)->findAll();

        return view('category', [
            'active_sub'      => $activeSlug,
            'active_sub_name' => $displayName,
            'products'        => $products
        ]);
    }

    public function blog(): string
    {
        $posts = $this->getBlogPosts();
        return view('blog', ['posts' => $posts]);
    }

    public function blogDetail(): string
    {
        $slug = $this->request->getGet('id') ?: 'tanaman-udara-tillandsia';
        $posts = $this->getBlogPosts();
        $activePost = $posts[$slug] ?? $posts['tanaman-udara-tillandsia'];
        
        // Exclude active post for related posts
        $related = array_filter($posts, function($k) use ($slug) {
            return $k !== $slug;
        }, ARRAY_FILTER_USE_KEY);
        
        return view('blog_detail', [
            'post' => $activePost,
            'related' => $related
        ]);
    }

    private function getBlogPosts(): array
    {
        return [
            'tanaman-udara-tillandsia' => [
                'slug' => 'tanaman-udara-tillandsia',
                'title' => 'Tanaman Udara Tillandsia',
                'date' => '10 November 2023 pukul 2:15 pm',
                'image' => '/images/blog/Tanaman Udara Tillandsia.png',
                'content' => '
                    <p>Tillandsia adalah tanaman udara. Berasal dari Meksiko, Amerika Serikat dan Karibia hingga Argentina Tengah. Tanaman ini hanya butuh media udara untuk tumbuh, ia menyerap uap air dan nutrisi dari udara melalui bulu-bulu halus di sekelilingnya.</p>
                    <p>Daun tillandsia berwarna hijau keperakan, bulu-bulu halusnya (trikoma) juga berfungsi sebagai penghambat penguapan air, membuatnya tahan terhadap kekeringan. Tillandsia menyerap karbon dioksida dan menghasilkan oksigen dimalam hari.</p>
                    <p>Dengan sifatnya yang epifit, tillandsia tumbuh menempel pada tanaman lain. Eits, tapi bukan parasit ya, tillandsia tidak merugikan tanaman yang ditumpanginya. Akar pada tanaman ini berfungsi sebagai jangkar.</p>
                    <p>Beberapa tillandsia juga bisa berbunga, lho. Warna daun akan berubah menjadi hijau gelap setelah berbunga dan kembali cerah saat masa berbunga akan datang. Bunga tillandsia ada yang berwarna ungu, pink, dan kuning.</p>
                    <p>Meski tidak butuh media tanam, tillandsia tetap butuh air dan sinar matahari seperti tanaman lainnya ya. Siram tillandsia seminggu sekali dengan cara diguyur merata dengan air dan gantung hingga kembali mengering.</p>
                    <p>Kamu bisa menjadikan tanaman ini sebagai hiasan cantik di dalam rumah. Bisa menanmnya dalam terarium, menempelkan di dinding atau rak. Letakkan di tempat terang yang tidak terpapar sinar matahari langsung ya.</p>
                '
            ],
            'rempah-eropa' => [
                'slug' => 'rempah-eropa',
                'title' => 'Rempah Eropa Yang Bisa Kamu Tanam Di Rumah',
                'date' => '9 November 2023 pukul 10:45 am',
                'image' => '/images/blog/Rempah Eropa Yang Bisa Kamu Tanam Di Rumah.png',
                'content' => '
                    <h4>• Mint</h4>
                    <p>Punya tanaman mint di rumah untuk dijadikan bahan minuman sepertinya enak ya. Mint menyukai tanah yang lembab, tapi juga tetap membutuhkan sinar matahari. Pupuk dengan rutin juga ya, tiap 3 minggu sekali agar tumbuhnya optimal. Kamu bisa memanen daun mint setelah 3-4 bulan.</p>
                    
                    <h4>• Timi/ Thyme</h4>
                    <p>Bau wangi thyme sering dijadikan rempah untuk bahan masakan. Tanaman ini dapat bertahan di tempat kering, dengan tanah ideal yang memiliki drainase baik. Thyme juga dapat dijadikan tanaman hias pot, letakkan dibawah sinar matahari.</p>
                    
                    <h4>• Rosemary</h4>
                    <p>Rempah populer ini sangat menyukai cahaya matahari, paparkan rosemary selama 6-8 jam agar tumbuh dengan subur. Siram ketika tanamannya benar-benar kering. Rosemary tidak dapat tumbuh dengan baik jika akarnya basah.</p>
                    
                    <h4>• Oregano</h4>
                    <p>Siapa uang suka masak menggunakan rempah ini? Kamu bisa menanamnya di rumah dengan perawatan yang mudah. Siram ketika tanahnya sudah kering, paparkan sinar matahari secara penuh. Panen oregano sebelum bunganya tumbuh, ketika tinggi tanaman mencapai 10-13 cm.</p>
                    
                    <h4>• Sage</h4>
                    <p>Selain untuk bahan makanan, sage juga memiliki berbagai manfaat bagi kesehatan, salah satunya menurunkan gula darah dan kolesterol. Perawatan tanaman ini tidak susah kok, sage butuh banyak paparan sinar matahari.</p>
                '
            ],
            'tanaman-hias-keberuntungan' => [
                'slug' => 'tanaman-hias-keberuntungan',
                'title' => 'Tanaman Hias Keberuntungan Zamioculcas',
                'date' => '9 November 2023 pukul 3:30 pm',
                'image' => '/images/blog/Tanaman Hias Keberuntungan Zamioculcas.png',
                'content' => '
                    <p>ZZ Plants (Zamioculcas zamiifolia), nama lainnya adalah Zanzibar Gem, atau disebut juga dengan pohon dolar. Tanaman dari Afrika ini mempunyai kelebihan untuk beradaptasi terhadap temperatur udara, dapat hidup di wilayah tropis hingga sub tropis.</p>
                    <p>Ciri khas dari tanaman ini, daunnya tumbuh sejajar sepanjang batang dan berjarak dari satu daun ke daun lainnya. Zamioulcas menyimpan banyak air di daunnya, memiliki bentuk daun simetris dan batang yang tampak membengkak.</p>
                    <p>Keunikan dari zamioculcas, membuatnya banyak diburu oleh pencinta tanaman hias. Kilap daunnya memukau, dan berwarna hijau tua yang menarik perhatian. Tak heran jika zamio cocok dijadikan hiasan ruangan.</p>
                    <p>Merawat tanaman ini tidak sulit, dapat tahan 2-3 minggu di dalam ruangan. Pastikan media tanam tidak terlalu lembab atau terendam air. Sinar matahati yang dibutuhkan cukup 2-3 jam dipagi hari.</p>
                    <p>Untuk mulai menanam zamio, media tanam yang dibutuhkan adalah cocopeat, kompos, dan arang kasar. Walaupun pertumbuhannya tergolong lambat, zamio sangat tahan terhadap penyakit dan serangga.</p>
                    <p>Kabar yang menbutkan zamioculcas memicu kanker, itu tidak benar ya. Menurut penelitian, dampak paling buruk dari tanaman ini adalah menyebabkan reaksi gatal dan keracunan jika tertelan. Jaukan dari anak maupun hewan peliharaan.</p>
                    <p>Kalau kamu masih ingat drama Korea Start Up, tanaman ini diberikan sebagai hadiah agar penerimanya sukses. Yap! Zamioculcas atau pohon dolar, biasa dijadikan hadiah pindah rumah sebagai simbol keberuntungan.</p>
                    <p>Tanaman ini tidak hanya populer karena daunnya yang mengkilap cantik, tetapi juga menarik untuk dijadikan plant of the day karena perawatannya yang tidak sulit.</p>
                '
            ]
        ];
    }

    public function productDetail($id = 1)
    {
        $productModel = new ProductModel();
        // Fallback to ID 1 if parameter not provided or valid
        $product = $productModel->find($id) ?? $productModel->first();
        
        // Let's pass the other products as 'related'
        $related = $productModel->where('id !=', $product['id'])->findAll(6);
        
        return view('product_detail', ['product' => $product, 'related' => $related]);
    }

    public function addToCart()
    {
        $id = $this->request->getPost('product_id');
        $qty = (int) $this->request->getPost('quantity');
        
        $productModel = new ProductModel();
        $product = $productModel->find($id);
        
        if ($product && $qty > 0) {
            $cart = $this->session->get('cart') ?? [];
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += $qty;
            } else {
                $cart[$id] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'image_url' => $product['image_url'],
                    'quantity' => $qty
                ];
            }
            $this->session->set('cart', $cart);
        }
        
        return $this->response->setJSON(['status' => 'success', 'cart_count' => count($this->session->get('cart') ?? [])]);
    }

    public function buyNow()
    {
        $id = $this->request->getPost('product_id');
        $qty = (int) $this->request->getPost('quantity');

        $productModel = new ProductModel();
        $product = $productModel->find($id);

        if (!$product || $qty <= 0) {
            return $this->response->setJSON(['status' => 'error']);
        }

        $this->session->set('buy_now_cart', [
            $id => [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image_url' => $product['image_url'],
                'quantity' => $qty
            ]
        ]);
        $this->session->set('checkout_mode', 'buy_now');

        return $this->response->setJSON(['status' => 'success']);
    }

    public function updateCart()
    {
        $id = $this->request->getPost('product_id');
        $qty = (int) $this->request->getPost('quantity');
        
        $cart = $this->session->get('cart') ?? [];
        if (isset($cart[$id])) {
            if ($qty <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = $qty;
            }
            $this->session->set('cart', $cart);
        }
        
        return $this->response->setJSON(['status' => 'success']);
    }

    public function removeCart()
    {
        $id = $this->request->getPost('product_id');
        $cart = $this->session->get('cart') ?? [];
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $this->session->set('cart', $cart);
        }
        return $this->response->setJSON(['status' => 'success']);
    }

    public function updateCheckoutItem()
    {
        $id = $this->request->getPost('product_id');
        $qty = (int) $this->request->getPost('quantity');
        $checkoutMode = $this->session->get('checkout_mode') ?? 'cart';
        $sessionKey = $checkoutMode === 'buy_now' ? 'buy_now_cart' : 'cart';
        $cart = $this->session->get($sessionKey) ?? [];

        if (isset($cart[$id]) && $qty >= 1) {
            $cart[$id]['quantity'] = $qty;
            $this->session->set($sessionKey, $cart);

            return $this->response->setJSON(['status' => 'success']);
        }

        return $this->response->setJSON(['status' => 'error']);
    }

    public function cart(): string
    {
        $cart = $this->session->get('cart') ?? [];
        return view('cart', ['cart' => $cart]);
    }

    public function checkoutInfo()
    {
        $this->setCheckoutModeFromRequest();

        $cart = $this->getCheckoutCart();
        if (empty($cart)) return redirect()->to('/cart');
        return view('checkout_info', ['cart' => $cart]);
    }
    
    public function checkoutShipping()
    {
        $cart = $this->getCheckoutCart();
        if (empty($cart)) return redirect()->to('/cart');
        
        // Save previous step data if submitted
        if ($this->request->getMethod() == 'POST') {
            $this->session->set('checkout_info', $this->request->getPost());
            return redirect()->to('/checkout/shipping');
        }
        
        $info = $this->session->get('checkout_info') ?? [];
        $destination = $info['city'] ?? 'DKI Jakarta, Jakarta Pusat, Gambir'; // fallback
        
        // Calculate total weight (300g per item quantity)
        $totalQty = 0;
        foreach ($cart as $item) {
            $totalQty += $item['quantity'];
        }
        $weightGrams = $totalQty * 300;
        $totalWeightKg = $weightGrams / 1000.0;
        
        // Calculate rates
        $rates = $this->calculateRates($destination, $weightGrams);
        
        return view('checkout_shipping', [
            'cart' => $cart,
            'rates' => $rates,
            'totalWeightKg' => $totalWeightKg,
            'destination' => $destination
        ]);
    }

    public function checkoutPayment()
    {
        $cart = $this->getCheckoutCart();
        if (empty($cart)) return redirect()->to('/cart');
        
        // Save previous step data if submitted
        if ($this->request->getMethod() == 'POST') {
            $this->session->set('checkout_shipping', $this->request->getPost());
            return redirect()->to('/checkout/payment');
        }
        
        $info = $this->session->get('checkout_info') ?? [];
        $shipping = $this->session->get('checkout_shipping') ?? [];
        
        return view('checkout_payment', [
            'cart' => $cart,
            'info' => $info,
            'shipping' => $shipping
        ]);
    }

    public function processOrder()
    {
        $cart = $this->getCheckoutCart();
        if (empty($cart)) return redirect()->to('/cart');
        $checkoutMode = $this->session->get('checkout_mode') ?? 'cart';
        
        $info = $this->session->get('checkout_info') ?? [];
        $shipping = $this->session->get('checkout_shipping') ?? [];
        
        $subtotal = 0;
        foreach($cart as $c) {
            $subtotal += $c['price'] * $c['quantity'];
        }
        
        // Parse shipping cost and courier from session
        $shippingCost = isset($shipping['shipping_cost']) ? (int) $shipping['shipping_cost'] : 17000;
        $shippingCourier = $shipping['shipping_courier'] ?? 'JNE - REG';

        $uniqueCode = rand(10, 99); // example
        
        // If there was a discount code applied
        $coupon = $this->session->get('coupon') ?? [];
        $discount = isset($coupon['discount']) ? (int) $coupon['discount'] : 0;
        
        $totalAmount = $subtotal + $shippingCost + $uniqueCode - $discount;

        $orderModel = new OrderModel();
        
        $orderData = [
            'invoice_no' => 'IPLANT' . rand(1000, 9999),
            'customer_email' => $info['email'] ?? '',
            'newsletter' => isset($info['newsletter']) ? 1 : 0,
            'customer_name' => $info['name'] ?? '',
            'customer_city' => $info['city'] ?? '',
            'customer_address' => $info['address'] ?? '',
            'customer_zip' => $info['zip'] ?? '',
            'customer_phone' => $info['phone'] ?? '',
            'is_dropshipper' => isset($info['is_dropshipper']) ? 1 : 0,
            'dropshipper_name' => $info['dropshipper_name'] ?? null,
            'dropshipper_phone' => $info['dropshipper_phone'] ?? null,
            'shipping_courier' => $shippingCourier,
            'shipping_cost' => $shippingCost,
            'subtotal' => $subtotal,
            'unique_code' => $uniqueCode,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'created_at' => Time::now(app_timezone())->toDateTimeString()
        ];
        
        $orderId = $orderModel->insert($orderData);
        
        $orderItemModel = new OrderItemModel();
        foreach($cart as $item) {
            $orderItemModel->insert([
                'order_id' => $orderId,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }
        
        // Clear the checkout source only. Buy Now must not remove the saved cart.
        if ($checkoutMode === 'buy_now') {
            $this->session->remove('buy_now_cart');
            $this->session->remove('checkout_mode');
        } else {
            $this->session->remove('cart');
            $this->session->remove('checkout_mode');
        }
        $this->session->remove('checkout_info');
        $this->session->remove('checkout_shipping');
        $this->session->remove('coupon');
        
        return redirect()->to('/invoice/' . $orderId);
    }
    
    public function invoice($orderId = null)
    {
        if (!$orderId) return redirect()->to('/');
        
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();
        $trackingEventModel = new OrderTrackingEventModel();
        $productModel = new ProductModel();
        
        $order = $orderModel->find($orderId);
        if (!$order) return redirect()->to('/');
        
        $items = $orderItemModel->where('order_id', $orderId)->findAll();
        $productIds = array_column($items, 'product_id');
        $products = empty($productIds) ? [] : $productModel->whereIn('id', $productIds)->findAll();
        $productsById = array_column($products, null, 'id');

        foreach ($items as &$item) {
            $product = $productsById[$item['product_id']] ?? null;
            $item['image_url'] = $product['image_url'] ?? 'https://placehold.co/60x60?text=iplant.id';
        }
        unset($item);

        $trackingEvents = $trackingEventModel
            ->where('order_id', $orderId)
            ->orderBy('sort_order', 'ASC')
            ->orderBy('event_time', 'DESC')
            ->findAll();
        
        return view('invoice', [
            'order' => $order,
            'items' => $items,
            'trackingEvents' => $trackingEvents,
        ]);
    }

    public function cancelOrder($orderId = null)
    {
        if (!$orderId) return redirect()->to('/');

        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);

        if (!$order) return redirect()->to('/');
        if ($this->request->getPost('cancel_confirmation') !== 'yes') {
            return redirect()->to('/invoice/' . $orderId);
        }

        $orderModel->update($orderId, ['status' => 'Dibatalkan']);

        return redirect()->to('/invoice/' . $orderId);
    }

    public function confirmPayment($orderId = null)
    {
        if (!$orderId) return redirect()->to('/');

        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);

        if (!$order) return redirect()->to('/');

        return view('confirm_payment', ['order' => $order]);
    }

    public function submitPaymentConfirmation($orderId = null)
    {
        if (!$orderId) return redirect()->to('/');

        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);

        if (!$order) return redirect()->to('/');

        $paymentAmount = preg_replace('/\D+/', '', (string) $this->request->getPost('amount'));

        $orderModel->update($orderId, [
            'status' => 'Menunggu Konfirmasi',
            'payment_date' => $this->request->getPost('payment_date'),
            'payment_transfer_to' => $this->request->getPost('transfer_to'),
            'payment_source_bank' => $this->request->getPost('source_bank'),
            'payment_account_name' => $this->request->getPost('account_name'),
            'payment_amount' => $paymentAmount !== '' ? (int) $paymentAmount : (int) $order['total_amount'],
            'payment_confirmed_at' => Time::now(app_timezone())->toDateTimeString(),
        ]);

        return redirect()->to('/invoice/' . $orderId);
    }

    public function approvePayment($orderId = null)
    {
        if (!$orderId) return redirect()->to('/');

        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);

        if (!$order) return redirect()->to('/');

        $orderModel->update($orderId, [
            'status' => 'Terbayar',
            'tracking_number' => null,
            'shipping_status' => 'Menunggu Untuk Dikirim',
            'delivered_at' => null,
        ]);
        $this->ensureDefaultTrackingEvents($orderId);

        return redirect()->to('/invoice/' . $orderId);
    }

    public function requestRefund($orderId = null)
    {
        if (!$orderId) return redirect()->to('/');

        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);

        if (!$order) return redirect()->to('/');
        if ($this->request->getPost('refund_confirmation') !== 'yes') {
            return redirect()->to('/invoice/' . $orderId);
        }

        $orderModel->update($orderId, [
            'status' => 'Meminta Refund',
            'refund_reason' => $this->request->getPost('refund_reason'),
            'refund_requested_at' => Time::now(app_timezone())->toDateTimeString(),
        ]);

        return redirect()->to('/invoice/' . $orderId);
    }

    public function approveRefund($orderId = null)
    {
        if (!$orderId) return redirect()->to('/');

        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);

        if (!$order) return redirect()->to('/');

        $orderModel->update($orderId, [
            'status' => 'Refund Disetujui',
            'refund_approved_at' => Time::now(app_timezone())->toDateTimeString(),
        ]);

        return redirect()->to('/invoice/' . $orderId);
    }

    public function applyCoupon()
    {
        $code = strtoupper(trim($this->request->getPost('coupon_code')));
        $coupons = [
            'IPLANTSAVE' => 10000,
            'HIJAU'      => 15000,
            'TANAMAN'    => 20000,
            'DISKON50'   => 50000,
            'HEMAT'      => 25000
        ];

        if (isset($coupons[$code])) {
            $discount = $coupons[$code];
            
            // Check if cart subtotal is smaller than coupon discount
            $cart = $this->getCheckoutCart();
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            if ($subtotal < $discount) {
                // Clear active coupon in session if it was set
                $this->session->remove('coupon');
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Total belanja lebih kecil dari nominal kupon. Kupon tidak dapat digunakan'
                ]);
            }

            $this->session->set('coupon', [
                'code' => $code,
                'discount' => $discount
            ]);
            return $this->response->setJSON([
                'status' => 'success',
                'code' => $code,
                'discount' => $discount
            ]);
        }

        // If not found, clear coupon session
        $this->session->remove('coupon');
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Kode kupon <em>' . esc($code) . '</em> tidak ditemukan'
        ]);
    }

    private function setCheckoutModeFromRequest(): void
    {
        $source = $this->request->getGet('source');

        if ($source === 'cart') {
            $this->session->set('checkout_mode', 'cart');
            $this->session->remove('buy_now_cart');
        } elseif ($source === 'buy_now') {
            $this->session->set('checkout_mode', 'buy_now');
        }
    }

    private function getCheckoutCart(): array
    {
        if (($this->session->get('checkout_mode') ?? 'cart') === 'buy_now') {
            return $this->session->get('buy_now_cart') ?? [];
        }

        return $this->session->get('cart') ?? [];
    }

    private function ensureDefaultTrackingEvents(int $orderId): void
    {
        $trackingEventModel = new OrderTrackingEventModel();

        if ($trackingEventModel->where('order_id', $orderId)->countAllResults() > 0) {
            return;
        }

        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);

        if (!$order) {
            return;
        }

        $baseTime = Time::parse($order['delivered_at'] ?? Time::now(app_timezone())->toDateTimeString(), app_timezone());
        $customerName = $order['customer_name'] ?? 'penerima';
        $events = [
            [0, 'Package has been delivered to ' . $customerName . '.'],
            [103, 'Package will be delivered to your address by Aditya Eiden'],
            [104, 'Shipment process is being delayed for the reason: Reschedule waktu pengiriman'],
            [557, 'Package will be delivered to your address by Aditya Gunawan'],
            [606, 'Package has been arrived at JAKARTA Drop Point.'],
            [611, 'Package will be departed to JAKARTA Drop Point'],
            [629, 'Package has been arrived at JAKARTA Drop Center.'],
            [776, 'Package will be departed to JAKARTA Drop Center'],
            [901, 'Package has been arrived at JAKARTA Transit Center.'],
            [1343, 'Package will be departed to JAKARTA Transit Center'],
            [1350, 'Package has been arrived at MADIUN Transit Center.'],
            [2400, 'Package will be departed to MADIUN Transit Center'],
            [2406, 'Package has been arrived at MALANG Transit Center.'],
            [2435, 'Package has been arrived at MALANG Transit Center.'],
            [2567, 'Package has been processed at BATU Drop Point by Arief Rachman Hakim'],
        ];

        foreach ($events as $index => [$minutesBeforeDelivery, $description]) {
            $eventTime = clone $baseTime;
            $eventTime = $eventTime->subMinutes($minutesBeforeDelivery);

            $trackingEventModel->insert([
                'order_id' => $orderId,
                'event_time' => $eventTime->toDateTimeString(),
                'description' => $description,
                'sort_order' => $index + 1,
                'created_at' => Time::now(app_timezone())->toDateTimeString(),
            ]);
        }
    }

    private function calculateRates(string $destination, int $weightGrams): array
    {
        // 1. Parse province from destination.
        // Destination format: "Province, City, District"
        $parts = explode(',', $destination);
        $province = trim($parts[0]);

        // 2. Base rate per kg depending on province
        $baseRate = 25000; // default
        
        $provinceLower = strtolower($province);
        if (strpos($provinceLower, 'sulawesi selatan') !== false) {
            $baseRate = 10000;
        } elseif (strpos($provinceLower, 'dki jakarta') !== false) {
            $baseRate = 17000;
        } elseif (strpos($provinceLower, 'banten') !== false || strpos($provinceLower, 'jawa barat') !== false) {
            $baseRate = 20000;
        } elseif (strpos($provinceLower, 'jawa tengah') !== false || strpos($provinceLower, 'di yogyakarta') !== false || strpos($provinceLower, 'yogyakarta') !== false || strpos($provinceLower, 'jawa timur') !== false) {
            $baseRate = 22000;
        } elseif (strpos($provinceLower, 'bali') !== false) {
            $baseRate = 25000;
        } elseif (strpos($provinceLower, 'sumatera') !== false || strpos($provinceLower, 'riau') !== false) {
            $baseRate = 30000;
        } elseif (strpos($provinceLower, 'kalimantan timur') !== false || strpos($provinceLower, 'kalimantan') !== false) {
            $baseRate = 28000;
        } elseif (strpos($provinceLower, 'papua') !== false) {
            $baseRate = 45000;
        }

        // 3. Calculate chargeable weight (ceil to nearest kg, minimum 1kg)
        $weightKg = $weightGrams / 1000.0;
        $chargeableWeight = (int) max(1, ceil($weightKg));

        // 4. Calculate prices for each courier and service
        $jne_reg = $baseRate * $chargeableWeight;
        $jne_yes = ($baseRate + 30000) * $chargeableWeight;
        $jne_jtr = 80000; // Flat Rp 80.000

        $jnt_reg = (int) (round(($baseRate * 0.9 * $chargeableWeight) / 1000) * 1000);
        $tiki_reg = (int) (round(($baseRate * 0.95 * $chargeableWeight) / 1000) * 1000);
        $lion_reg = (int) (round(($baseRate * 0.85 * $chargeableWeight) / 1000) * 1000);
        $pos_kilat = (int) (round(($baseRate * 0.8 * $chargeableWeight) / 1000) * 1000);

        return [
            'jne' => [
                'name' => 'JNE',
                'logo' => '/images/expeditions/jne.png',
                'services' => [
                    'REG' => ['name' => 'REG', 'cost' => $jne_reg, 'etd' => '2-3 Hari'],
                    'YES' => ['name' => 'YES', 'cost' => $jne_yes, 'etd' => '1 Hari'],
                    'JTR' => ['name' => 'JTR', 'cost' => $jne_jtr, 'etd' => '5-7 Hari']
                ]
            ],
            'jnt' => [
                'name' => 'J&T Express',
                'logo' => '/images/expeditions/jnt.png',
                'services' => [
                    'Regular' => ['name' => 'Regular', 'cost' => $jnt_reg, 'etd' => '2-3 Hari']
                ]
            ],
            'tiki' => [
                'name' => 'TIKI',
                'logo' => '/images/expeditions/tiki.png',
                'services' => [
                    'Regular' => ['name' => 'Regular', 'cost' => $tiki_reg, 'etd' => '2-3 Hari']
                ]
            ],
            'lion' => [
                'name' => 'Lion Parcel',
                'logo' => '/images/expeditions/lion.png',
                'services' => [
                    'REGPACK' => ['name' => 'REGPACK', 'cost' => $lion_reg, 'etd' => '2-3 Hari']
                ]
            ],
            'pos' => [
                'name' => 'POS Indonesia',
                'logo' => '/images/expeditions/pos.png',
                'services' => [
                    'Kilat' => ['name' => 'Kilat', 'cost' => $pos_kilat, 'etd' => '2-4 Hari']
                ]
            ]
        ];
    }

    public function calculateShippingRates()
    {
        $destination = $this->request->getPost('destination');
        $weightGrams = (int) $this->request->getPost('weight');
        
        if (empty($destination)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Tujuan pengiriman tidak boleh kosong'
            ]);
        }
        
        if ($weightGrams <= 0) {
            $weightGrams = 1000;
        }
        
        $rates = $this->calculateRates($destination, $weightGrams);
        
        return $this->response->setJSON([
            'status' => 'success',
            'destination' => $destination,
            'weight_grams' => $weightGrams,
            'rates' => $rates
        ]);
    }
}
