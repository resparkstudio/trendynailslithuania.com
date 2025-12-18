<?php

/*
Copyright (C) Pimwick, LLC

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if (! $item_data->preview) {
    do_action('woocommerce_email_header', $email_heading, $email);
}

?>

<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Space+Mono:wght@400;700&display=swap');

    .pwgc-email-wrapper {
        font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        color: #1a1a1a;
        max-width: 520px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .pwgc-email-section {
        margin-bottom: 32px;
    }

    /* From & Message Section */
    .pwgc-email-meta {
        background: #fafafa;
        border-left: 3px solid #1a1a1a;
        padding: 20px 24px;
        margin-bottom: 32px;
    }

    .pwgc-email-from-label {
        font-size: 11px;
        font-weight: 500;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #888;
        margin-bottom: 4px;
    }

    .pwgc-email-from-value {
        font-size: 16px;
        font-weight: 500;
        color: #1a1a1a;
    }

    .pwgc-email-message {
        font-size: 15px;
        line-height: 1.7;
        color: #444;
        margin-top: 16px;
        font-style: italic;
    }

    /* Gift Card Container */
    #pwgc-email-gift-card-container {
        background: linear-gradient(145deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
        border-radius: 16px;
        padding: 40px 32px;
        position: relative;
        overflow: hidden;
    }

    /* Subtle pattern overlay */
    #pwgc-email-gift-card-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image:
            radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.03) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.03) 0%, transparent 50%);
        pointer-events: none;
    }

    /* Title */
    #pwgc-email-title {
        font-size: 13px;
        font-weight: 500;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.6);
        text-align: center;
        margin-bottom: 32px;
        position: relative;
    }

    /* Amount Section */
    .pwgc-amount-section {
        text-align: center;
        margin-bottom: 32px;
        position: relative;
    }

    #pwgc-email-amount-label {
        font-size: 10px;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.4);
        margin-bottom: 8px;
    }

    #pwgc-email-amount {
        font-family: 'DM Sans', sans-serif;
        font-size: 48px;
        font-weight: 700;
        color: #ffffff;
        line-height: 1;
        letter-spacing: -1px;
    }

    /* Divider */
    .pwgc-divider {
        width: 60px;
        height: 1px;
        background: rgba(255, 255, 255, 0.15);
        margin: 0 auto 32px;
    }

    /* Card Number Section */
    .pwgc-card-section {
        text-align: center;
        margin-bottom: 32px;
        position: relative;
    }

    #pwgc-email-card-number-label {
        font-size: 10px;
        font-weight: 500;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.4);
        margin-bottom: 12px;
    }

    #pwgc-email-card-number {
        font-family: 'Space Mono', 'Courier New', monospace;
        font-size: 18px;
        font-weight: 700;
        color: #ffffff;
        letter-spacing: 3px;
        background: rgba(255, 255, 255, 0.08);
        padding: 14px 24px;
        border-radius: 8px;
        display: inline-block;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Redeem Button */
    .pwgc-button-section {
        text-align: center;
        position: relative;
    }

    #pwgc-email-redeem-button {
        display: inline-block;
        background: #ffffff;
        padding: 16px 48px;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    #pwgc-email-redeem-button a {
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: white !important;
        text-decoration: none !important;
    }

    /* Footer Note */
    .pwgc-footer-note {
        text-align: center;
        margin-top: 32px;
        font-size: 12px;
        color: #999;
        line-height: 1.6;
    }

    <?php
    foreach ($GLOBALS['pw_gift_cards']->design_colors as $key => $map) {
        $value = '';

        if (isset($item_data->design[$key])) {
            $value = $item_data->design[$key];
        } else if (isset($map[2])) {
            $value = $map[2];
        }

        if (!empty($value)) {
            echo "$map[0] { $map[1]: $value; }\n";
        }
    }
    ?>
</style>

<div class="pwgc-email-wrapper">
    <?php if (!empty($item_data->from) || !empty($item_data->message)) : ?>
        <div class="pwgc-email-meta">
            <?php if (!empty($item_data->from)) : ?>
                <div class="pwgc-email-from-label"><?php _e('From', 'pw-woocommerce-gift-cards'); ?></div>
                <div class="pwgc-email-from-value"><?php echo esc_html($item_data->from); ?></div>
            <?php endif; ?>

            <?php if (!empty($item_data->message)) : ?>
                <div class="pwgc-email-message">"<?php echo nl2br(esc_html($item_data->message)); ?>"</div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div id="pwgc-email-gift-card-container">

        <div id="pwgc-email-title">
            <?php
            // translators: %s is the store name (blog name)
            printf(__('%s Gift Card', 'pw-woocommerce-gift-cards'), esc_html(get_option('blogname')));
            ?>
        </div>

        <div class="pwgc-amount-section">
            <div id="pwgc-email-amount-label"><?php _e('Amount', 'pw-woocommerce-gift-cards'); ?></div>
            <div id="pwgc-email-amount"><?php echo wc_price($item_data->amount, $item_data->wc_price_args); ?></div>
        </div>

        <div class="pwgc-divider"></div>

        <div class="pwgc-card-section">
            <div id="pwgc-email-card-number-label"><?php _e('Gift Card Number', 'pw-woocommerce-gift-cards'); ?></div>
            <div id="pwgc-email-card-number"><?php echo esc_html($item_data->gift_card_number); ?></div>
        </div>

        <div class="pwgc-button-section">
            <div id="pwgc-email-redeem-button">
                <a href="<?php echo esc_url($item_data->redeem_url); ?>"><?php _e('Redeem Now', 'pw-woocommerce-gift-cards'); ?></a>
            </div>
        </div>
    </div>

    <div class="pwgc-footer-note">
        <?php _e('This gift card can be used at checkout.', 'pw-woocommerce-gift-cards'); ?><br>
        <?php _e('No expiration date.', 'pw-woocommerce-gift-cards'); ?>
    </div>
</div>

<?php
if (! $item_data->preview) {
    do_action('woocommerce_email_footer', $email);
}
?>