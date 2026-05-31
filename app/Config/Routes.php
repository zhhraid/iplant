<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->post('/login', 'Home::processLogin');
$routes->get('/register', 'Home::register');
$routes->post('/register', 'Home::processRegister');
$routes->get('/account', 'Home::account');
$routes->get('/change-password', 'Home::changePassword');
$routes->post('/change-password', 'Home::updatePassword');
$routes->get('/logout', 'Home::logout');
$routes->get('/forgot-password', 'Home::forgotPassword');
$routes->get('/category', 'Home::category');
$routes->get('/category/(:any)', 'Home::category/$1');
$routes->get('/blog', 'Home::blog');
$routes->get('/blog-detail', 'Home::blogDetail');
$routes->get('/product-detail', 'Home::productDetail');
$routes->get('/product-detail/(:num)', 'Home::productDetail/$1');
$routes->get('/cart', 'Home::cart');

// Cart Actions (AJAX)
$routes->post('/cart/add', 'Home::addToCart');
$routes->post('/checkout/buy-now', 'Home::buyNow');
$routes->post('/cart/update', 'Home::updateCart');
$routes->post('/cart/remove', 'Home::removeCart');
$routes->post('/checkout/update-item', 'Home::updateCheckoutItem');

// Checkout Flow
$routes->get('/checkout/info', 'Home::checkoutInfo');
$routes->post('/checkout/shipping', 'Home::checkoutShipping');
$routes->get('/checkout/shipping', 'Home::checkoutShipping'); // Fallback
$routes->post('/checkout/payment', 'Home::checkoutPayment');
$routes->get('/checkout/payment', 'Home::checkoutPayment'); // Fallback
$routes->post('/checkout/apply-coupon', 'Home::applyCoupon');
$routes->post('/checkout/process', 'Home::processOrder');
$routes->post('/shipping/calculate', 'Home::calculateShippingRates');

$routes->get('/invoice/(:num)', 'Home::invoice/$1');
$routes->post('/invoice/(:num)/cancel', 'Home::cancelOrder/$1');
$routes->get('/invoice/(:num)/confirm-payment', 'Home::confirmPayment/$1');
$routes->post('/invoice/(:num)/confirm-payment', 'Home::submitPaymentConfirmation/$1');
$routes->post('/invoice/(:num)/confirm-payment/approve', 'Home::approvePayment/$1');
$routes->post('/invoice/(:num)/refund', 'Home::requestRefund/$1');
$routes->post('/invoice/(:num)/refund/approve', 'Home::approveRefund/$1');
$routes->get('/invoice/(:num)/simulate-ship', 'Home::simulateShip/$1');
$routes->get('/invoice/(:num)/simulate-deliver', 'Home::simulateDeliver/$1');
$routes->get('/invoice/(:num)/review', 'Home::writeReview/$1');
$routes->post('/invoice/(:num)/review/submit', 'Home::submitReview/$1');
$routes->get('/shipping/regions/provinces', 'Home::getProvinces');
$routes->get('/shipping/regions/regencies', 'Home::getRegencies');
$routes->get('/shipping/regions/districts', 'Home::getDistricts');
