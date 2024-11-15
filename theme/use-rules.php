<?php
/*
Template Name: Use Rules
*/
get_header();
?>
<section id="primary" class="mb-36 md:mb-28 mt-5 md:mt-2.5">
    <main id="main" class="max-w-[87.5rem] mx-auto w-full">
        <div id="page-content" class="flex flex-col gap-12 md:gap-10 mx-12 md:mx-4">
            <header id="heading-section" class="w-full">
                <h1 class="w-full heading-md text-deep-dark-gray"><?php echo get_the_title(); ?></h1>
            </header>
            <div class="flex justify-center">
                <div id="privacy-policy-text" class="max-w-2xl text-deep-dark-gray body-normal-regular">
                    <?php
                    the_content();
                    ?>
                </div>
            </div>
        </div><!-- .page-content -->
    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();
