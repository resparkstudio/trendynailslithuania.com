<?php
if (!defined('ABSPATH')) {
    exit;
}

// Ensure WooCommerce functions are available
if (!function_exists('WC')) {
    return;
}

?>
<div class="cart-summary-details">
    <p><strong>Suma:</strong> <span id="ajax-subtotal"><?php echo WC()->cart->get_cart_subtotal(); ?></span></p>
    <p><strong>Pristatymas:</strong> <span
            id="ajax-shipping-total"><?php echo WC()->cart->get_shipping_total(); ?></span></p>
    <?php if (wc_tax_enabled()): ?>
        <p><strong>PVM:</strong> <span id="ajax-tax-total"><?php echo wc_price(WC()->cart->get_taxes_total()); ?></span></p>
    <?php endif; ?>
    <p><strong>Iš viso:</strong> <span id="ajax-total"><?php echo WC()->cart->get_total(); ?></span></p>
</div>