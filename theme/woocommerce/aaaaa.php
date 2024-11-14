<form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post">
    <div class="grid grid-cols-2 gap-4 md:gap-2.5">
        <div class="col-span-1 md:col-span-2">
            <input type="text" name="your-name"
                class="form-input w-full p-4 round-9 border border-mid-gray body-small-light text-deep-dark-gray"
                placeholder="Vardas*" required>
        </div>
        <div class="col-span-1 md:col-span-2">
            <input type="text" name="your-last-name"
                class="form-input w-full p-4 round-9 border border-mid-gray body-small-light text-deep-dark-gray"
                placeholder="Pavardė*" required>
        </div>
        <div class="col-span-1 md:col-span-2">
            <input type="email" name="your-email"
                class="form-input w-full p-4 round-9 border border-mid-gray body-small-light text-deep-dark-gray"
                placeholder="El. paštas*" required>
        </div>
        <div class="col-span-1 md:col-span-2">
            <input type="tel" name="your-phone"
                class="form-input w-full p-4 round-9 border border-mid-gray body-small-light text-deep-dark-gray"
                placeholder="Telefonas">
        </div>
        <div class="col-span-2">
            <textarea name="your-message" class="" placeholder="Žinutė*" required></textarea>
        </div>
    </div>
    <div class="flex flex-wrap gap-5 mt-2.5 md:mt-4">
        <div
            class="text-sm text-dark-gray body-extra-small-regular w-full text-end md:text-[0.75rem] md:text-start md:font-light">

            <?php echo wp_kses_post("* Šis laukas yra privalomas."); ?>

        </div>
        <div class="col-span-3 flex w-full items-center md:flex-wrap">
            <button type="submit" name="cf-submit"
                class="black-button py-4 px-24 round-9 body-small-medium col-span-3 md:order-2 md:w-full md:px-0">
                <?php echo wp_kses_post("Siųsti"); ?></button>
            <div class="ml-8 md:order-1 md:ml-0 md:w-full md:mb-4">
                <input type="checkbox" name="privacy-policy" required>
                <label class="body-small-regular ml-2.5 md:text-[0.75rem]" for="privacy-policy">
                    <?php echo wp_kses_post('Aš sutinku su'); ?>
                    <a class="link-hover"
                        href="<?php echo esc_url(get_permalink(get_page_by_path('privatumo-politika'))); ?>">
                        <?php echo wp_kses_post('Privatumo Politika'); ?>
                    </a>
                    <?php echo wp_kses_post('*'); ?>
                </label>
            </div>
        </div>
    </div>
</form>