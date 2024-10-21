<?php
/*
Template Name: Contacts
*/
get_header();


?>
<section id="primary" class="mb-36 md:mb-28 mt-5">
    <main id="main">
        <div id="page-content" class="flex flex-col mx-12">
            <div id="heading-section" class="w-full mb-16">
                <h1 class="w-full heading-md text-deep-dark-gray mb-4">Kontaktai</h1>
                <p class="w-full body-normal-regular text-deep-dark-gray">Turite klausimų? Susisiekite su mumis.
                    Užpildykite formą ir mes kuo greičiau Jums atsakysime.</p>
            </div>
            <div id="form-section grid grid-cols-12 gap-4">
                <div id="contact-details" class="col-span-4"></div>
                <div id="contact-form" class="col-span-8">
                    <form action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post"
                        class="grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <input type="text" name="your-name"
                                class="form-input w-full p-2 rounded border body-small-light text-deep-dark-gray"
                                placeholder="Vardas*" required>
                        </div>
                        <div class="col-span-1">
                            <input type="text" name="your-last-name"
                                class="form-input w-full p-2 rounded border body-small-light text-deep-dark-gray"
                                placeholder="Pavardė*" required>
                        </div>
                        <div class="col-span-1">
                            <input type="email" name="your-email"
                                class="form-input w-full p-2 rounded border body-small-light text-deep-dark-gray"
                                placeholder="El. paštas*" required>
                        </div>
                        <div class="col-span-1">
                            <input type="tel" name="your-phone"
                                class="form-input w-full p-2 rounded border body-small-light text-deep-dark-gray"
                                placeholder="Telefonas">
                        </div>
                        <div class="col-span-2">
                            <textarea name="your-message"
                                class="form-textarea w-full p-2 rounded border body-small-light text-deep-dark-gray"
                                placeholder="Žinutė*" required></textarea>
                        </div>
                        <div class="flex items-center col-span-2 mt-4">
                            <input type="checkbox" name="privacy-policy" required class="mr-2">
                            <label class="body-small-regular" for="privacy-policy">Aš sutinku su Privatumo
                                Politika*</label>
                        </div>
                        <div class="flex justify-between items-center col-span-2 mt-4">
                            <button type="submit" name="cf-submit"
                                class="btn bg-deep-dark-gray text-white py-2 px-6 rounded uppercase body-small-medium">Siųsti</button>
                            <div class="text-sm text-dark-gray body-extra-small-regular">* Šis laukas yra privalomas.
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- .page-content -->
    </main><!-- #main -->
</section><!-- #primary -->

<?php
get_footer();



