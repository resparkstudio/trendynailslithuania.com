<?php


if (!defined('ABSPATH')) {
	exit;
}

get_header('shop'); ?>

<?php

do_action('woocommerce_before_main_content');
?>
<div class="max-w-[87.5rem] mx-auto w-full px-12 md:px-4 mb-40 md:mb-32 mt-5 md:mt-0">
	<?php while (have_posts()): ?>
		<?php the_post(); ?>

		<?php wc_get_template_part('content', 'single-product'); ?>

	<?php endwhile; // end of the loop. ?>

</div>



<?php

do_action('woocommerce_after_main_content');
?>

<?php

do_action('woocommerce_sidebar');
?>

<?php
get_footer();


