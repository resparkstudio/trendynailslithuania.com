<?php
/*
Template Name: Privacy Policy
*/
get_header();
$heading = get_field('heading');
$policy_text = get_field('policy_text');
?>
<section id="primary" class="mb-36 md:mb-28 mt-5 md:mt-2.5">
    <main id="main">
        <div id="page-content" class="flex flex-col gap-12 md:gap-10 mx-12 md:mx-4">
            <div id="heading-section" class="w-full">
                <?php if ($heading): ?>
                    <h1 class="w-full heading-md text-deep-dark-gray"><?php echo esc_html($heading); ?></h1>
                <?php endif; ?>
            </div>
            <?php if ($policy_text): ?>
                <div class="flex justify-center">
                    <p id="privacy-policy-text" class="max-w-2xl text-deep-dark-gray body-normal-regular">
                        <?php echo wp_kses_post($policy_text); ?>
                    </p>
                </div>
            <?php endif; ?>
        </div><!-- .page-content -->
    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();



