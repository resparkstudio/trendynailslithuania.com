<aside id="newsletter-popup"
    class="fixed inset-y-0 right-[-36rem]  sm:right-[-100vw] flex items-end mb-28 sm:mb-0 justify-center bg-pink-50 z-[21] sm:z-[32] rounded-l-[10px]">
    <div class="inner-aside flex relative">
        <!-- Rotated Button -->
        <a
            class="newsletter-button-outer absolute top-[59px] sm:top-[95px] left-[-30px] -translate-y-1/2 w-[41px] z-10 bg-black rounded-l-[5px] pl-[0.375rem]">
            <div
                class="newsletter-button-inner rotate-180 cursor-pointer text-white flex justify-center w-[41px] h-[117px] body-small-light">
                <?php echo wp_kses_post('Naujienlaiškis'); ?>
            </div>
        </a>

        <!-- Subscription Content -->
        <div
            class="bg-white flex items-center z-20 w-[36rem] sm:w-screen text-deep-dark-gray rounded-l-[10px] sm:rounded-t-[10px] relative sm:flex-wrap">
            <div class="newsletter-close-button cursor-pointer absolute right-4 top-4">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line x1="0.353553" y1="0.755333" x2="13.6612" y2="14.063" stroke="#747474" />
                    <line x1="13.6612" y1="0.353553" x2="0.353554" y2="13.6612" stroke="#747474" />
                </svg>
            </div>
            <!-- Image Section -->
            <div class="h-full rounded-l-[10px] sm:rounded-t-[10px] sm:w-full sm:max-h-[12rem] max-360px:max-h-[10rem]">
                <img class="object-cover object-center aspect-[213/282] h-full rounded-l-[10px] sm:rounded-t-[10px] sm:aspect-[393/192] sm:w-full"
                    src="<?php echo wp_kses_post(wp_get_attachment_url('410')); ?>"
                    alt="<?php echo wp_kses_post('Stacked Trendy Nails bottles with dripping polish'); ?>">
            </div>

            <!-- Text Section -->
            <div class="pl-8 pr-6 sm:px-4">
                <h2 class="mt-9 heading-sm sm:mt-6"><?php echo wp_kses_post('Prenumeruokite!'); ?></h2>
                <p class="body-small-regular mt-8 sm:mt-5 block">
                    <?php echo wp_kses_post('Prenumeruokite mūsų naujienlaiškį! Ir pirmieji sužinokite visas naujienas bei specialius pasiūlymus.'); ?>
                </p>

                <div class="mt-7 sm:mb-6 sm:mt-5">
                    <div class="mb-4">
                        <div id="omnisend-embedded-v2-67431b88dcdc64b34f2f4612"></div>
                    </div>

                    <div class="mb-7 sm:mb-6 flex">
                        <div class="relative">
                            <input id="privacy" type="checkbox"
                                class="relative input-checkbox rounded-[2px] w-3 h-3 mr-2">
                        </div>
                        <label for="privacy" class="block body-extra-small-regular">
                            <?php
                            echo wp_kses_post(
                                'Susipažinau ir sutinku su 
                                        <a class = "link-hover" href="' . esc_url(get_permalink(3)) . '" target="_blank">Privatumo politika</a> 
                                        bei 
                                        <a class = "link-hover" href="' . esc_url(get_permalink(12)) . '" target="_blank">Naudojimo sąlygomis</a>'
                            );
                            ?>
                        </label>


                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>