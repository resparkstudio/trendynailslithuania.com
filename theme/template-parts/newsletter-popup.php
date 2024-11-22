<aside class="fixed inset-y-0 right-[-36rem] flex items-end mb-28 justify-center bg-pink-50 z-20 rounded-l-[10px]">
    <div class="inner-aside flex relative">
        <!-- Rotated Button -->
        <a
            class="newsletter-button-outer cursor-pointer w-[41px] h-full relative right-[-0.75rem] z-0 bg-black rounded-l-[5px] pl-[0.375rem] ">
            <div
                class="newsletter-button-inner rotate-180 cursor-pointer text-white flex justify-center w-[41px] h-[117px] body-small-light ">
                <?php echo wp_kses_post('Naujienlaiškis'); ?>
            </div>
        </a>

        <!-- Subscription Content -->
        <div class="bg-white flex items-center z-10 max-w-[36rem] text-deep-dark-gray rounded-l-[10px] relative">
            <div class="newsletter-close-button cursor-pointer absolute right-4 top-4">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line x1="0.353553" y1="0.755333" x2="13.6612" y2="14.063" stroke="#747474" />
                    <line x1="13.6612" y1="0.353553" x2="0.353554" y2="13.6612" stroke="#747474" />
                </svg>
            </div>
            <!-- Image Section -->
            <div class="h-full rounded-l-[10px]">
                <img class="object-contain object-center aspect-[213/282] h-full rounded-l-[10px]"
                    src="<?php echo wp_kses_post(wp_get_attachment_url('410')); ?>"
                    alt="<?php echo wp_kses_post('Naujienlaiškis'); ?>" class="h-64 rounded-lg">
            </div>

            <!-- Text Section -->
            <div class="pl-9">
                <h2 class="mt-9 heading-sm"><?php echo wp_kses_post('Prenumeruokite!'); ?></h2>
                <p class="body-small-regular mt-8 block">
                    <?php echo wp_kses_post('Prenumeruokite mūsų naujienlaiškį! Ir pirmieji sužinokite visas naujienas bei specialius pasiūlymus.'); ?>
                </p>

                <form class="mt-7">
                    <div class="mb-4">
                        <label for="email" class="sr-only"><?php echo wp_kses_post('El. paštas'); ?></label>
                        <input type="email" id="email" name="email"
                            placeholder="<?php echo wp_kses_post('El. paštas'); ?>" class="w-full py-2">
                        <button type="submit"></button>
                    </div>

                    <div class="mb-7 flex">
                        <div class="relative">
                            <input id="privacy" type="checkbox"
                                class="relative input-checkbox rounded-[2px] w-3 h-3 mr-2">
                        </div>
                        <label for="privacy" class="block body-extra-small-regular">
                            <?php echo wp_kses_post('Susipažinau ir sutinku su Privatumo politika bei privatumo politika'); ?>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</aside>