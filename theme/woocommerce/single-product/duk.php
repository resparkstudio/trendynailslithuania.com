<?php
defined('ABSPATH') || exit;

global $product; // Access the current product object

?>
<div class="product-duk p-8 md:p-0 border-light-gray border-[1px] radius-12 md:border-0">
    <h3 class="uppercase md:normal-case heading-sm mb-10 md:mb-8 text-center">
        <?php echo wp_kses_post("Dažniausiai užduodami klausimai"); ?>
    </h3>
    <div class="duk-list ">
        <?php while (have_rows('produkto_duk', $product->get_id())):
            the_row(); ?>
            <div class="duk-item mb-7 md:mb-5">
                <div class="duk-question cursor-pointer body-normal-regular my-5 flex justify-between items-center">
                    <div class="flex items-start gap-x-2">
                        <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="10.5" cy="10.5" r="10.5" fill="#E5D7D1" />
                            <path
                                d="M10.822 6.102C11.4193 6.102 11.9467 6.21867 12.404 6.452C12.8707 6.68533 13.2347 7.01667 13.496 7.446C13.7573 7.866 13.888 8.37 13.888 8.958C13.888 9.64867 13.7387 10.2087 13.44 10.638C13.1413 11.0673 12.7353 11.38 12.222 11.576C11.7087 11.772 11.1207 11.87 10.458 11.87L10.416 13.326H9.464L9.408 11.1H9.772C10.1733 11.1 10.5513 11.0767 10.906 11.03C11.27 10.974 11.5873 10.8713 11.858 10.722C12.138 10.5727 12.3573 10.358 12.516 10.078C12.6747 9.78867 12.754 9.41533 12.754 8.958C12.754 8.566 12.6747 8.23 12.516 7.95C12.3573 7.67 12.1333 7.46 11.844 7.32C11.564 7.17067 11.2233 7.096 10.822 7.096C10.206 7.096 9.72067 7.25 9.366 7.558C9.01133 7.866 8.834 8.30933 8.834 8.888H7.798C7.78867 8.31867 7.91 7.82867 8.162 7.418C8.414 6.998 8.76867 6.676 9.226 6.452C9.68333 6.21867 10.2153 6.102 10.822 6.102ZM9.996 16.07C9.78133 16.07 9.59933 15.9953 9.45 15.846C9.31 15.6967 9.24 15.5147 9.24 15.3C9.24 15.0853 9.31 14.9033 9.45 14.754C9.59933 14.6047 9.78133 14.53 9.996 14.53C10.2107 14.53 10.388 14.6047 10.528 14.754C10.6773 14.9033 10.752 15.0853 10.752 15.3C10.752 15.5147 10.6773 15.6967 10.528 15.846C10.388 15.9953 10.2107 16.07 9.996 16.07Z"
                                fill="#201F1F" />
                        </svg>
                        <h4><?php echo esc_html(get_sub_field('product_duk_question')); ?></h4>
                    </div>
                    <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7 8.4L14 1.04448L13.006 0L10.612 2.5303L7 6.32574L3.388 2.5303L0.994 0.0147108L0 1.05919L7 8.4Z"
                            fill="#201F1F" />
                    </svg>
                </div>
                <div class="duk-answer mx-[1.82rem] hidden opacity-0">
                    <div class="pb-7 md:pb-5">
                        <?php echo wp_kses_post(get_sub_field('product_duk_answer')); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>