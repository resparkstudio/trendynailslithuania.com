<?php
/**
 * Cart Sidebar Template
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<!-- Sidebar for Cart -->
<aside id="cart-sidebar"
    class="fixed top-0 right-0 w-64 h-full bg-white shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50">
    <!-- Close Button -->
    <button id="close-sidebar" class="absolute top-4 right-4 text-gray-600">
        ✖
    </button>
    <div class="p-4">
        <h2 class="text-lg font-semibold">Shopping Cart</h2>
        <?php woocommerce_mini_cart(); ?>
    </div>
</aside>