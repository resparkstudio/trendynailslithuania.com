<?php
/**
 * Lost password confirmation text.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/lost-password-confirmation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.9.0
 */

defined('ABSPATH') || exit;

wc_print_notice(esc_html__('Slaptažodžio atstatymo el. laiškas buvo išsiųstas.', 'woocommerce'));
?>

<?php do_action('woocommerce_before_lost_password_confirmation_message'); ?>

<p><?php echo esc_html(apply_filters('woocommerce_lost_password_confirmation_message', esc_html__('Slaptažodžio atstatymo el. laiškas buvo išsiųstas į jūsų paskyros el. pašto adresą, tačiau gali užtrukti kelias minutes, kol jis pasieks jūsų pašto dėžutę. Prašome palaukti bent 10 minučių prieš bandydami dar kartą.', 'woocommerce'))); ?>
</p>

<?php do_action('woocommerce_after_lost_password_confirmation_message'); ?>