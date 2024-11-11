<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _tw
 */

get_header();
?>

<section id="primary" class="max-w-[87.5rem] mx-auto w-full">
    <main id="main" class="mx-12 md:mx-4 mb-36 md:mb-32 mt-5 md:mt-2.5">

        <!-- Blog Title and Category Navigation -->
        <header id="heading-section mb-4">
            <h1 class="w-full heading-md text-deep-dark-gray mb-4"><?php echo wp_kses_post("Blogas"); ?></h1>
        </header>

        <div
            class="flex gap-8 md:gap-6 overflow-x-auto body-small-regular text-dark-gray md:text-[0.75rem] md:leading-[1rem] pb-5 border-b-[0.5px] border-dark-gray mb-12 md:mb-6">
            <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>"
                class="filter-button link-active link-hover whitespace-nowrap"><?php echo wp_kses_post("Rodyti viską") ?></a>
            <?php
            $blog_categories = get_categories(array('hide_empty' => true));
            foreach ($blog_categories as $category) {
                $category_url = esc_url(get_category_link($category->term_id));
                $category_active = (is_category($category->term_id)) ? 'link-active' : '';

                echo '<a href="' . $category_url . '" class="filter-button link-hover whitespace-nowrap ' . $category_active . '">' . esc_html($category->name) . '</a>';
            }
            ?>
        </div>

        <?php if (have_posts()): ?>
            <div id="blog-posts" class="grid grid-cols-12 gap-4">

                <?php $post_count = 0; ?>

                <?php while (have_posts()):
                    the_post();
                    $post_count++;

                    $col_span_class = ($post_count <= 3 || $post_count > 5) ? 'col-span-4' : 'col-span-6';
                    $aspect_ratio_class = ($post_count <= 3 || $post_count > 5) ? 'aspect-square' : 'aspect-[664/434]';
                    ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class("$col_span_class lg:col-span-6 md:col-span-12 blog-post mb-10"); ?>>

                        <!-- Post Thumbnail with Conditional Aspect Ratio -->
                        <?php if (has_post_thumbnail()): ?>
                            <div class="post-thumbnail mb-5 lg:aspect-[664/434] <?php echo $aspect_ratio_class; ?>">
                                <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover')); ?>
                            </div>
                        <?php else: ?>
                            <div class="post-thumbnail mb-5 lg:aspect-[664/434] <?php echo $aspect_ratio_class; ?>">
                                <?php echo wp_get_attachment_image(7, 'large', false, array('class' => 'w-full h-full object-cover')); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Post Title -->
                        <div class="mb-4 heading-sm">
                            <h4 class="text-deep-dark-gray"><?php the_title(); ?></h4>
                        </div>

                        <!-- "Daugiau" Button -->
                        <div class="text-deep-dark-gray">
                            <a class="flex gap-3" href="<?php the_permalink(); ?>">
                                <span><?php echo wp_kses_post("Daugiau"); ?></span>
                                <div class="flex items-center">
                                    <svg width="6" height="10" viewBox="0 0 6 10" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z"
                                            fill="#201F1F" />
                                    </svg>
                                </div>
                            </a>
                        </div>

                    </article>

                <?php endwhile; ?>

            </div>

            <!-- Pagination -->
            <div class="pagination mt-8 flex justify-center items-center space-x-4 text-gray-700 font-semibold">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('<span class="flex items-center"> &laquo; Previous</span>', '_tw'),
                    'next_text' => __('<span class="flex items-center">Next &raquo; <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 5L0.746059 -3.26113e-08L-4.06079e-07 0.71L1.80736 2.42L4.51839 5L1.80736 7.58L0.0105077 9.29L0.756567 10L6 5Z" fill="#201F1F"/></svg></span>', '_tw'),
                ));
                ?>
            </div>

        <?php else: ?>
            <p><?php echo wp_kses_post("Įrašų nerasta"); ?></p>
        <?php endif; ?>

    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
