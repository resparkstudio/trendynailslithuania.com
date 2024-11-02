<?php
/**
 * Cart Sidebar Template
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<aside id="cart-sidebar"
    class="fixed right-0 w-96 h-svh bg-white transform translate-x-full transition-transform duration-300 ease-in-out z-50">
    <div class="sidebar-wrapper mx-5 my-7 relative">
        <button id="close-sidebar" class="absolute top-0 right-0 text-gray-600">
            <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <line x1="0.353553" y1="0.425499" x2="9.70109" y2="9.77304" stroke="black" />
                <line x1="9.70121" y1="0.353553" x2="0.353671" y2="9.70109" stroke="black" />
            </svg>
        </button>
        <div class="text-deep-dark-gray">
            <h5 class="body-normal-medium">Krepšelis</h5>
            <?php woocommerce_mini_cart(); ?>
        </div>
    </div>
</aside>