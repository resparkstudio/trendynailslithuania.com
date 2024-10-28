<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package _tw
 */

get_header();
?>

<section id="primary" class="mb-72 mt-56">
	<main id="main">
		<div id="page-content" class="mx-12 md:mx-4 flex justify-center align-center flex-wrap">
			<span
				class="w-full text-center font-not-found-page text-deep-dark-gray"><?php echo esc_html_e('404', '_tw') ?></span>
			<span
				class="w-full text-center text-deep-dark-gray mt-2.5 heading-md md:text-[1.125rem] md:leading-[1.375rem]"><?php echo esc_html_e('Atsiprašome, šis puslapis neegzistuoja', '_tw') ?>
			</span>
			<a href="<?php echo get_permalink(get_page_by_path('titulinis')->ID); ?>"
				class="mt-8 btn text-center bg-deep-dark-gray text-white py-4 px-24 sm:px-0 round-9 uppercase body-small-medium sm:w-full">
				<?php esc_html_e('Grįžti į pagrindinį', "_tw"); ?>
			</a>
		</div>
	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
