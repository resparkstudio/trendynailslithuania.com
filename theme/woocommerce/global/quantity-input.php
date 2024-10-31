<?php

defined( 'ABSPATH' ) || exit;

$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'woocommerce' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'woocommerce' );

?>
<div class="flex items-center border-[0.7px] round-9 py-2 border-deep-dark-gray justify-center overflow-hidden grow-0 ">
    <button type="button" class="minus focus:outline-none flex items-center justify-center pl-5 lg:pl-4 text-[1.5rem] text-deep-dark-gray" onclick="this.nextElementSibling.stepDown()">
    <span>
            <?php echo wp_kses_post("-") ?>
    </span>
    </button>
    <input
        type="<?php echo esc_attr( $type ); ?>"
        <?php echo $readonly ? 'readonly="readonly"' : ''; ?>
        id="<?php echo esc_attr( $input_id ); ?>"
        class="quantity-input w-14 lg:w-10 text-center focus:outline-none body-normal-semibold text-[1.5rem] text-deep-dark-gray"
        name="<?php echo esc_attr( $input_name ); ?>"
        value="<?php echo esc_attr( $input_value ); ?>"
        aria-label="<?php esc_attr_e( 'Product quantity', 'woocommerce' ); ?>"
        size="4"
        min="<?php echo esc_attr( $min_value ); ?>"
        max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
        <?php if ( ! $readonly ) : ?>
            step="<?php echo esc_attr( $step ); ?>"
            placeholder="<?php echo esc_attr( $placeholder ); ?>"
            inputmode="<?php echo esc_attr( $inputmode ); ?>"
            autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
        <?php endif; ?>
    />
    <button type="button" class="plus focus:outline-none flex items-center justify-center pr-5 lg:pr-4 text-[1.5rem] text-deep-dark-gray" onclick="this.previousElementSibling.stepUp()">
        <span>
            <?php echo wp_kses_post("+") ?>
    </span>
    </button>
</div>



<?php
