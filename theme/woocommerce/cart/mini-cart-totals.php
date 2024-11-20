<?php
defined('ABSPATH') || exit;
?>
<div>
    <div class="flex justify-between mb-4">
        <span><?php echo wp_kses_post("Suma") ?></span>
        <span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
    </div>
    <div class="flex justify-between mb-4">
        <span><?php echo wp_kses_post("Pristatymas") ?></span>
        <span><?php echo wc_price(WC()->cart->get_shipping_total()); ?></span>
    </div>
    <div class="flex justify-between mb-5">
        <span><?php echo wp_kses_post("Iš viso") ?></span>
        <span><?php echo WC()->cart->get_total(); ?></span>
    </div>
    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>"
        class="block black-button text-center uppercase py-3 mb-10 sm:mb-20">
        <?php echo wp_kses_post("Pirkti") ?>
    </a>
</div>