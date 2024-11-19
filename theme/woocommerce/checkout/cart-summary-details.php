<?php
if (!defined('ABSPATH')) {
    exit;
}

$applied_code = WC()->session->get('applied_discount_code');
?>
<div class="cart-summary-details">
    <p class="flex justify-between mb-4">
        <span class="body-small-regular">
            <?php echo wp_kses_post(__('Suma:')); ?>
        </span>
        <span class="body-normal-semibold"
            id="ajax-subtotal"><?php echo wp_kses_post(WC()->cart->get_cart_subtotal()); ?>
        </span>
    </p>

    <p class="flex justify-between mb-4">
        <span class="body-small-regular">
            <?php echo wp_kses_post(__('Pristatymas:')); ?>
        </span>
        <span id="ajax-shipping-total" class="body-normal-semibold">
            <?php echo wp_kses_post(WC()->cart->get_shipping_total()); ?>
        </span>
    </p>
    <!-- TO-DO add pvm name whcih is defined in settings. Dont display if no pvm exists -->
    <?php if (wc_tax_enabled()): ?>
        <p class="flex justify-between mb-4">
            <span class="body-small-regular">
                <?php echo wp_kses_post(__('PVM (21%):')); ?>
            </span>
            <span class="body-normal-semibold"
                id="ajax-tax-total"><?php echo wc_price(WC()->cart->get_taxes_total()); ?></span>
        </p>
    <?php endif; ?>

    <?php if (!empty($applied_code)): ?>
        <p class="flex justify-between">
            <span class="body-small-regular">
                <?php echo wp_kses_post(__('Nuolaidos kodas:')); ?>
            </span>
            <?php echo esc_html($applied_code); ?>
            <span
                class="body-normal-semibold"><?php echo wp_kses_post(__('-')); ?><?php echo wc_price((WC()->cart->subtotal * 0.1)); ?></span>
        </p>
    <?php endif; ?>

    <p class="flex justify-between mt-5">
        <span class="body-normal-semibold uppercase">
            <?php echo wp_kses_post(__('Iš viso:')); ?>
        </span>
        <span id="ajax-total" class="body-normal-semibold"><?php echo wp_kses_post(WC()->cart->get_total()); ?>
        </span>
    </p>
</div>