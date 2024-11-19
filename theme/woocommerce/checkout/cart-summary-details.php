<?php
if (!defined('ABSPATH')) {
    exit;
}

$applied_code = WC()->session->get('applied_discount_code');
?>
<div class="cart-summary-details">
    <p><?php echo wp_kses_post(__('Suma:')); ?> <span
            id="ajax-subtotal"><?php echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?></span></p>
    <p><?php echo wp_kses_post(__('Pristatymas:')); ?> <span
            id="ajax-shipping-total"><?php echo wp_kses_post(WC()->cart->get_shipping_total()); ?></span></p>
    <?php if (wc_tax_enabled()): ?>
        <p><?php echo wp_kses_post(__('PVM:')); ?> <span
                id="ajax-tax-total"><?php echo wc_price(WC()->cart->get_taxes_total()); ?></span></p>
    <?php endif; ?>
    <?php if (!empty($applied_code)): ?>
        <p><?php echo wp_kses_post(__('Nuolaidos kodas:')); ?>     <?php echo esc_html($applied_code); ?>
            <span>-<?php echo wc_price((WC()->cart->subtotal * 0.1)); ?></span></p>
    <?php endif; ?>
    <p><?php echo wp_kses_post(__('Iš viso:')); ?> <span
            id="ajax-total"><?php echo wp_kses_post(WC()->cart->get_total()); ?></span></p>
</div>