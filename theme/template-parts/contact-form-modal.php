<div id="success-modal" class="hidden flex fixed inset-0 items-center justify-center z-[100] bg-black/[0.27]">
    <div
        class="bg-white round-7 max-w-[25.875rem] md:max-w-[20.375rem] w-full h-[9.625rem] md:h-[9.25rem] relative flex flex-col justify-center items-center">
        <div class="w-full">
            <button id="close-modal" class="absolute right-5 top-5">
                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line x1="0.353553" y1="0.42556" x2="9.70109" y2="9.7731" stroke="#747474" />
                    <line x1="9.70121" y1="0.353614" x2="0.353671" y2="9.70115" stroke="#747474" />
                </svg>
            </button>
        </div>

        <h4 class="text-deep-dark-gray heading-sm w-full block px-2 text-center mb-5">
            <?php echo wp_kses_post("Dėkojame, gavome Jūsų laišką!") ?>
        </h4>
        <p class="text-deep-dark-gray body-normal-regular w-full block px-2 text-center">
            <?php echo wp_kses_post("Netrukus su Jumis susisiekime.") ?>
        </p>
    </div>
</div>