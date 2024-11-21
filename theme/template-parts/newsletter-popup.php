<aside class="fixed inset-y-0 right-0 flex items-center justify-center bg-pink-50 z-40 rounded-l-[10px]">
    <div class="flex relative">
        <!-- Rotated Button -->
        <div class="w-[41px] h-full relative right-[-0.75rem] z-0 bg-black rounded-l-[5px] pl-[0.375rem] ">
            <button
                class="newsletter-button rotate-180 text-white flex justify-center w-[41px] h-[117px] body-small-light ">
                Naujienlaiškis
            </button>
        </div>


        <!-- Subscription Content -->
        <div class="bg-white flex items-center z-10 max-w-[35.3125rem] text-deep-dark-gray">
            <!-- Image Section -->
            <div class="h-full">
                <img class="object-contain object-center aspect-[213/282] h-full rounded-l-[10px]"
                    src="<?php echo wp_get_attachment_url("410") ?>" alt="Naujienlaiškis" class="h-64 rounded-lg">
            </div>

            <!-- Text Section -->
            <div class="px-9">
                <h2 class="mt-9 heading-sm">Prenumeruokite!</h2>
                <p class="body-small-regular mt-8 block">
                    Prenumeruokite mūsų naujienlaiškį! Ir pirmieji sužinokite visas naujienas bei specialius pasiūlymus.
                </p>

                <form>
                    <div class="mb-4">
                        <label for="email" class="sr-only">El. paštas</label>
                        <input type="email" id="email" name="email" placeholder="El. paštas"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                    </div>

                    <div class="flex items-center mb-4">
                        <input id="privacy" type="checkbox"
                            class="w-4 h-4 text-pink-600 border-gray-300 rounded focus:ring-pink-500">
                        <label for="privacy" class="ml-2 text-gray-700 text-sm">
                            Susipažinau ir sutinku su Privatumo politika bei privatumo politika
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-pink-600 text-white py-2 px-4 rounded-lg shadow-md hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500">
                        Prenumeruoti
                    </button>
                </form>
            </div>
        </div>
    </div>
</aside>