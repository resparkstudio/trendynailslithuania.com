<?php
$popup_enable = get_field('popup_enable', 'option');
$popup_text   = get_field('popup_text', 'option');
$popup_delay  = get_field('popup_delay', 'option') ?: 3;

if (!$popup_enable || !$popup_text) return;
?>

<div id="acf-popup-overlay" class="fixed inset-0 bg-black/40 backdrop-blur-sm z-[100] hidden items-center justify-center">
    <div class="bg-white rounded-2xl max-w-2xl w-[90%] mx-auto p-14 sm:p-8 relative shadow-2xl">
        <button id="acf-popup-close" class="absolute top-5 right-5 w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 hover:bg-gray-200 transition-colors cursor-pointer" aria-label="Close">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L11 11M11 1L1 11" stroke="#333" stroke-width="1.5" stroke-linecap="round" />
            </svg>
        </button>
        <div class="text-lg sm:text-base mt-2">
            <?php echo wp_kses_post($popup_text); ?>
        </div>
    </div>
</div>

<script>
(function () {
    if (sessionStorage.getItem('acfPopupClosed')) return;

    var delay = <?php echo intval($popup_delay); ?> * 1000;
    var overlay = document.getElementById('acf-popup-overlay');

    setTimeout(function () {
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
    }, delay);

    document.getElementById('acf-popup-close').addEventListener('click', function () {
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
        sessionStorage.setItem('acfPopupClosed', '1');
    });

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) {
            overlay.classList.add('hidden');
            overlay.classList.remove('flex');
            sessionStorage.setItem('acfPopupClosed', '1');
        }
    });
})();
</script>
