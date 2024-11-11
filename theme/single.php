<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _tw
 */

get_header();
?>

<section id="primary" class="max-w-[87.5rem] mx-auto w-full">
	<main id="main" class="mx-12 md:mx-4 mb-36 md:mb-32 mt-5 md:mt-2.5">
		<header id="heading-section mb-4">
			<h1 class="w-full heading-md text-deep-dark-gray mb-4"><?php echo wp_kses_post("Blogas"); ?></h1>
		</header>
		<?php
		while (have_posts()):
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class("w-full"); ?>>
				<!-- Post Title -->
				<header class="">
					<h1 class="text-3xl font-bold text-black"><?php the_title(); ?></h1>
				</header>

				<!-- Post Content -->
				<div class="">
					<?php the_content(); ?>
				</div>

				<footer class="">

				</footer>
			</article>

			<?php
		endwhile;
		?>

	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
