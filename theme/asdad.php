<footer id="site-footer" class="bg-black text-white pt-20 pb-4 md:pt-14 md:pb-4 mb:px-4 mt-auto">
    <div
        class="container grid grid-cols-12 gap-4 px-12 lg:px-8 sm:px-4 body-small-regular mb-10 md:grid-cols-1 md:px-4 md:gap-0">
        <!-- 1st Div: Spans columns 1-3 -->
        <div class="col-span-3 md:col-span-1 md:mb-10">
            <div class="site-logo flex flex-none justify-items-center mx-auto pb-5 md:pb-7">
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">
                    <img src="<?php echo esc_url(wp_get_attachment_url(45)); ?>" class="w-[8.625rem] h-[2.625rem]"
                        alt="<?php esc_attr_e('Site Logo', 'your-theme-text-domain'); ?>">
                </a>
            </div>
            <p class="text-sm pb-7">
                <?php esc_html_e('Trendy Nails yra šiuolaikiškas ir inovatyvus Ukrainos manikiūro priemonių prekes ženklas, orientuotas į kokybiškų produktų tiekimą nagų industrijai.', 'your-theme-text-domain'); ?>
            </p>
            <ul class="mt-4 space-y-2.5 mb-7">
                <li><?php echo esc_html('+370 000 00000'); ?></li>
                <li><a href="mailto:info@trendynailsthluania.com"
                        class="underline"><?php echo esc_html('info@trendynailsthluania.com'); ?></a></li>
            </ul>
            <div class="flex space-x-4">
                <!-- Social Links -->
                <a href="<?php echo esc_url('https://facebook.com'); ?>" target="_blank" class="text-white">
                    <!-- Facebook Icon SVG -->
                    <!-- Your SVG goes here, no need for escaping in static SVG -->
                </a>
                <a href="<?php echo esc_url('https://instagram.com'); ?>" target="_blank" class="text-white">
                    <!-- Instagram Icon SVG -->
                </a>
            </div>
        </div>

        <!-- 2nd Div: Spans columns 5-6 -->
        <div class="col-start-5 col-span-2 md:col-span-1 md:mb-4">
            <div class="flex justify-between items-center cursor-pointer md-footer-toggle-menu">
                <h2 class="uppercase body-normal-medium mb-5 md:mb-0 md:font-medium md:normal-case">
                    <?php esc_html_e('Parduotuvė', 'your-theme-text-domain'); ?></h2>
                <svg class="menu-icon-rotate hidden w-3.5 h-3.5 md:inline-block" xmlns="http://www.w3.org/2000/svg"
                    width="13" height="8" viewBox="0 0 13 8" fill="none">
                    <!-- SVG Path -->
                </svg>
            </div>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-shop-menu',
                'container' => false,
                'menu_id' => 'footer-shop-menu',
                'menu_class' => 'space-y-2 md:hidden md:mt-5',
                'fallback_cb' => false,
                'depth' => 1
            ));
            ?>
        </div>

        <!-- 3rd Div: Spans columns 7-8 -->
        <div class="col-start-7 col-span-2 md:col-span-1 md:mb-11">
            <div class="flex justify-between items-center cursor-pointer md-footer-toggle-menu">
                <h2 class="uppercase body-normal-medium mb-5 md:mb-0 md:font-medium md:normal-case">
                    <?php esc_html_e('Info', 'your-theme-text-domain'); ?></h2>
                <svg class="menu-icon-rotate hidden w-3.5 h-3.5 md:inline-block" xmlns="http://www.w3.org/2000/svg"
                    width="13" height="8" viewBox="0 0 13 8" fill="none">
                    <!-- SVG Path -->
                </svg>
            </div>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-info-menu',
                'container' => false,
                'menu_id' => 'footer-info-menu',
                'menu_class' => 'space-y-2.5 md:hidden md:mt-5',
                'fallback_cb' => false,
                'depth' => 1
            ));
            ?>
        </div>

        <!-- 4th Div: Spans columns 10-12 -->
        <div class="col-start-10 col-span-3 pb-10 md:col-span-1 md:pb-0">
            <h2 class="uppercase body-normal-medium mb-6 md:mb-5">
                <?php esc_html_e('Prenumeruokite', 'your-theme-text-domain'); ?></h2>
            <p class="text-sm mb-5 md:mb-8">
                <?php echo wp_kses_post('Užsiregistruokite ir gaukite <b>–15 %</b> nuolaidą pirmajam užsakymui, pirmieji sužinokite apie naujausius produktus!'); ?>
            </p>
            <form action="#" method="POST" class="mt-4 mb-9 md:mb-5 w-full">
                <input type="email" name="email"
                    placeholder="<?php esc_attr_e('El. paštas', 'your-theme-text-domain'); ?>"
                    class="w-full pl-3 py-4 bg-gray-700 text-white rounded-lg">
            </form>
            <!-- Payment icons -->
            <div
                class="grid grid-cols-6 gap-1 mt-4 auto-rows-auto xl:grid-cols-5 lg:grid-cols-4 max-850px:grid-cols-3 max-w-72 md:grid-cols-6">
                <a class="w-full">
                    <!-- Payment Icon SVG -->
                </a>
                <!-- Add other payment icons here -->
            </div>
        </div>
    </div>

    <div class="container block mx-auto text-center md:px-4">
        <p class="text-gray-dark block body-extra-small-light md:text-left">
            &copy; <span id="currentYear"></span>
            <?php esc_html_e('Trendy Nails Lithuania', 'your-theme-text-domain'); ?>
        </p>
    </div>

</footer>