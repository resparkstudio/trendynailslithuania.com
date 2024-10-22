<?php
/*
Template Name: Contacts
*/
get_header();

$soc_media_page_id = 169;

$heading = get_field('heading');
$description = get_field('description');
$phone_number = get_field('phone_number', $soc_media_page_id);
$email = get_field('email', $soc_media_page_id);
$facebook_link = get_field('facebook_link', $soc_media_page_id);
$instagram_link = get_field('instagram_link', $soc_media_page_id);
$mandatory_text = get_field('mandatory_text');
$privacy_text = get_field('privacy_text');

?>
<section id="primary" class="mb-48 mt-5 md:mb-28 md:mt-2.5">
    <main id="main">
        <div id="page-content" class="flex flex-col mx-12 md:mx-4">
            <div id="heading-section" class="w-full mb-16 md:mb-5">
                <?php if ($heading): ?>
                    <h1 class="w-full heading-md text-deep-dark-gray mb-4"><?php echo esc_html($heading); ?></h1>
                <?php endif; ?>

                <?php if ($description): ?>
                    <p class="w-full body-normal-regular text-deep-dark-gray"><?php echo wp_kses_post($description); ?></p>
                <?php endif; ?>
            </div>

            <div id="form-section" class=" grid grid-cols-12 gap-4">
                <div id="contact-details" class="col-span-4 md:col-span-12 md:mb-5">
                    <ul class="mb-7">
                        <?php if ($phone_number): ?>
                            <li class="mb-6 md:mb-4"><a
                                    href="tel:<?php echo esc_attr($phone_number); ?>"><?php echo esc_html($phone_number); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if ($email): ?>
                            <li><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></li>
                        <?php endif; ?>
                    </ul>

                    <div class="flex space-x-5">
                        <?php if ($facebook_link): ?>
                            <a href="<?php echo esc_url($facebook_link); ?>" target="_blank" class="text-white">
                                <svg width="9" height="18" viewBox="0 0 9 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.41091 10.125L8.86909 6.89062H5.95636V4.78125C5.95636 3.86719 6.34909 3.02344 7.65818 3.02344H9V0.246094C9 0.246094 7.78909 0 6.64364 0C4.25455 0 2.68364 1.58203 2.68364 4.39453V6.89062H0V10.125H2.68364V18H5.95636V10.125H8.41091Z"
                                        fill="#201F1F" />
                                </svg>

                            </a>
                        <?php endif; ?>

                        <?php if ($instagram_link): ?>
                            <a href="<?php echo esc_url($instagram_link); ?>" target="_blank" class="text-white">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.02009 4.35938C11.5513 4.35938 13.6406 6.44866 13.6406 8.97991C13.6406 11.5513 11.5513 13.6004 9.02009 13.6004C6.44866 13.6004 4.39955 11.5513 4.39955 8.97991C4.39955 6.44866 6.44866 4.35938 9.02009 4.35938ZM9.02009 11.9933C10.6674 11.9933 11.9933 10.6674 11.9933 8.97991C11.9933 7.33259 10.6674 6.0067 9.02009 6.0067C7.33259 6.0067 6.0067 7.33259 6.0067 8.97991C6.0067 10.6674 7.37277 11.9933 9.02009 11.9933ZM14.8862 4.19866C14.8862 4.80134 14.404 5.28348 13.8013 5.28348C13.1987 5.28348 12.7165 4.80134 12.7165 4.19866C12.7165 3.59598 13.1987 3.11384 13.8013 3.11384C14.404 3.11384 14.8862 3.59598 14.8862 4.19866ZM17.9397 5.28348C18.0201 6.77009 18.0201 11.2299 17.9397 12.7165C17.8594 14.1629 17.5379 15.4085 16.4933 16.4933C15.4487 17.5379 14.1629 17.8594 12.7165 17.9397C11.2299 18.0201 6.77009 18.0201 5.28348 17.9397C3.83705 17.8594 2.59152 17.5379 1.5067 16.4933C0.462054 15.4085 0.140625 14.1629 0.0602679 12.7165C-0.0200893 11.2299 -0.0200893 6.77009 0.0602679 5.28348C0.140625 3.83705 0.462054 2.55134 1.5067 1.5067C2.59152 0.462054 3.83705 0.140625 5.28348 0.0602679C6.77009 -0.0200893 11.2299 -0.0200893 12.7165 0.0602679C14.1629 0.140625 15.4487 0.462054 16.4933 1.5067C17.5379 2.55134 17.8594 3.83705 17.9397 5.28348ZM16.0112 14.2835C16.4933 13.1183 16.3728 10.3058 16.3728 8.97991C16.3728 7.6942 16.4933 4.8817 16.0112 3.67634C15.6897 2.91295 15.0871 2.27009 14.3237 1.98884C13.1183 1.5067 10.3058 1.62723 9.02009 1.62723C7.6942 1.62723 4.8817 1.5067 3.71652 1.98884C2.91295 2.31027 2.31027 2.91295 1.98884 3.67634C1.5067 4.8817 1.62723 7.6942 1.62723 8.97991C1.62723 10.3058 1.5067 13.1183 1.98884 14.2835C2.31027 15.0871 2.91295 15.6897 3.71652 16.0112C4.8817 16.4933 7.6942 16.3728 9.02009 16.3728C10.3058 16.3728 13.1183 16.4933 14.3237 16.0112C15.0871 15.6897 15.7299 15.0871 16.0112 14.2835Z"
                                        fill="#201F1F" />
                                </svg>

                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div id="contact-form" class="col-span-8 md:col-span-12">
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
                                <textarea name="your-message"
                                    class="form-textarea w-full p-4 round-9 border border-mid-gray body-small-light text-deep-dark-gray"
                                    placeholder="Žinutė*" required></textarea>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-5 mt-2.5 md:mt-4">
                            <div
                                class="text-sm text-dark-gray body-extra-small-regular w-full text-end md:text-[0.75rem] md:text-start md:font-light">
                                <?php if ($mandatory_text): ?>
                                    <?php echo esc_html($mandatory_text); ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-span-3 flex w-full items-center md:flex-wrap">
                                <button type="submit" name="cf-submit"
                                    class="btn bg-deep-dark-gray text-white py-4 px-24 round-9 uppercase body-small-medium col-span-3 md:order-2 md:w-full">Siųsti</button>
                                <div class="ml-8 md:order-1 md:ml-0 md:w-full md:mb-4">
                                    <input type="checkbox" name="privacy-policy" required>
                                    <label class="body-small-regular ml-2.5 md:text-[0.75rem]" for="privacy-policy">
                                        <?php esc_html_e('Aš sutinku su', '_tw'); ?>
                                        <a href="<?php echo esc_url(get_permalink(get_page_by_path('privatumo-politika'))); ?>"
                                            target="_blank">
                                            <?php esc_html_e('Privatumo Politika', '_tw'); ?>
                                        </a>
                                        <?php esc_html_e('*', '_tw'); ?>
                                    </label>
                                </div>
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
