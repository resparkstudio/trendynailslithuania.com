<?php
/**
 * Cart Sidebar Template
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<aside id="cart-sidebar" class="fixed hidden right-0 w-96 h-svh bg-white transform pt-5 z-50">
    <div class="sidebar-wrapper relative h-full">
        <div class="flex justify-between px-5 relative text-deep-dark-gray">

            <h5 class="body-normal-medium flex-none "><?php echo wp_kses_post("Krepšelis") ?></h5>

            <button id="close-sidebar" class="">
                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line x1="0.353553" y1="0.425499" x2="9.70109" y2="9.77304" stroke="black" />
                    <line x1="9.70121" y1="0.353553" x2="0.353671" y2="9.70109" stroke="black" />
                </svg>
            </button>
        </div>

        <div id="mini-cart-contents" class="flex flex-col justify-between h-full">
            <?php woocommerce_mini_cart(); ?>
        </div>

    </div>
</aside>