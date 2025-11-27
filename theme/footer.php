<?php
/*
Template Name: Footer
*/


$logo_description = get_field('logo_description', 'option');
$phone_number = get_field('phone_number', 'option');
$email = get_field('email', 'option');
$facebook_link = get_field('facebook_link', 'option');
$instagram_link = get_field('instagram_link', 'option');
$shop_menu_heading = get_field('shop_menu_heading', 'option');
$info_menu_heading = get_field('info_menu_heading', 'option');
$subscribe_heading = get_field('subscribe_heading', 'option');
$subscribe_description = get_field('subscribe_description', 'option');
?>


<footer id="site-footer" class="bg-black text-white pt-20 pb-4 md:pt-14 md:pb-4 mb:px-4 mt-auto">
	<div
		class="max-w-[87.5rem] mx-auto w-full grid grid-cols-12 gap-4 px-12 lg:px-8 sm:px-4 body-small-regular mb-10 md:grid-cols-1 md:px-4 md:gap-0">
		<!-- 1st Div: Spans columns 1-3 -->
		<div class="col-span-3 md:col-span-1 md:mb-10">
			<div class="site-logo flex flex-none justify-items-center mx-auto pb-5 md:pb-7">
				<a href="<?php echo get_permalink(get_page_by_path('titulinis')->ID); ?>">
					<img src="<?php echo esc_url(wp_get_attachment_url(505)); ?>" class="w-[8.625rem] h-[2.625rem]">
				</a>
			</div>
			<?php if ($logo_description): ?>
				<div class="pb-7">
					<?php echo wp_kses_post($logo_description); ?>
				</div>
			<?php endif; ?>
			<ul class="mt-4 space-y-2.5 mb-7 no-list-style">
				<?php if ($phone_number): ?>
					<li>
						<a class="link-hover"
							href="tel:<?php echo esc_attr($phone_number); ?>"><?php echo wp_kses_post($phone_number); ?></a>
					</li>
				<?php endif; ?>

				<?php if ($email): ?>
					<li>
						<a class="link-hover"
							href="mailto:<?php echo esc_attr($email); ?>"><?php echo wp_kses_post($email); ?></a>
					</li>
				<?php endif; ?>
			</ul>
			<div class="flex space-x-4">
				<?php if ($facebook_link): ?>
					<a href="<?php echo esc_url($facebook_link); ?>" target="_blank" class="text-white">
						<svg width="9" height="18" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M8.41091 10.125L8.86909 6.89062H5.95636V4.78125C5.95636 3.86719 6.34909 3.02344 7.65818 3.02344H9V0.246094C9 0.246094 7.78909 0 6.64364 0C4.25455 0 2.68364 1.58203 2.68364 4.39453V6.89062H0V10.125H2.68364V18H5.95636V10.125H8.41091Z"
								fill="white" />
						</svg>
					</a>
				<?php endif; ?>

				<?php if ($instagram_link): ?>
					<a href="<?php echo esc_url($instagram_link); ?>" target="_blank" class="text-white">
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M9.02009 4.35938C11.5513 4.35938 13.6406 6.44866 13.6406 8.97991C13.6406 11.5513 11.5513 13.6004 9.02009 13.6004C6.44866 13.6004 4.39955 11.5513 4.39955 8.97991C4.39955 6.44866 6.44866 4.35938 9.02009 4.35938ZM9.02009 11.9933C10.6674 11.9933 11.9933 10.6674 11.9933 8.97991C11.9933 7.33259 10.6674 6.0067 9.02009 6.0067C7.33259 6.0067 6.0067 7.33259 6.0067 8.97991C6.0067 10.6674 7.37277 11.9933 9.02009 11.9933ZM14.8862 4.19866C14.8862 4.80134 14.404 5.28348 13.8013 5.28348C13.1987 5.28348 12.7165 4.80134 12.7165 4.19866C12.7165 3.59598 13.1987 3.11384 13.8013 3.11384C14.404 3.11384 14.8862 3.59598 14.8862 4.19866ZM17.9397 5.28348C18.0201 6.77009 18.0201 11.2299 17.9397 12.7165C17.8594 14.1629 17.5379 15.4085 16.4933 16.4933C15.4487 17.5379 14.1629 17.8594 12.7165 17.9397C11.2299 18.0201 6.77009 18.0201 5.28348 17.9397C3.83705 17.8594 2.59152 17.5379 1.5067 16.4933C0.462054 15.4085 0.140625 14.1629 0.0602679 12.7165C-0.0200893 11.2299 -0.0200893 6.77009 0.0602679 5.28348C0.140625 3.83705 0.462054 2.55134 1.5067 1.5067C2.59152 0.462054 3.83705 0.140625 5.28348 0.0602679C6.77009 -0.0200893 11.2299 -0.0200893 12.7165 0.0602679C14.1629 0.140625 15.4487 0.462054 16.4933 1.5067C17.5379 2.55134 17.8594 3.83705 17.9397 5.28348ZM16.0112 14.2835C16.4933 13.1183 16.3728 10.3058 16.3728 8.97991C16.3728 7.6942 16.4933 4.8817 16.0112 3.67634C15.6897 2.91295 15.0871 2.27009 14.3237 1.98884C13.1183 1.5067 10.3058 1.62723 9.02009 1.62723C7.6942 1.62723 4.8817 1.5067 3.71652 1.98884C2.91295 2.31027 2.31027 2.91295 1.98884 3.67634C1.5067 4.8817 1.62723 7.6942 1.62723 8.97991C1.62723 10.3058 1.5067 13.1183 1.98884 14.2835C2.31027 15.0871 2.91295 15.6897 3.71652 16.0112C4.8817 16.4933 7.6942 16.3728 9.02009 16.3728C10.3058 16.3728 13.1183 16.4933 14.3237 16.0112C15.0871 15.6897 15.7299 15.0871 16.0112 14.2835Z"
								fill="white" />
						</svg>
					</a>
				<?php endif; ?>
			</div>
		</div>

		<!-- 2nd Div: Spans columns 5-6 -->
		<div class="col-start-5 col-span-2 md:col-span-1 md:mb-4">
			<div class="flex justify-between items-center md:cursor-pointer md-footer-toggle-menu">
				<?php if ($shop_menu_heading): ?>
					<h2 class="uppercase body-normal-medium mb-5 md:mb-0 md:font-medium md:normal-case">
						<?php echo wp_kses_post($shop_menu_heading); ?>
					</h2>
				<?php endif; ?>
				<svg class="menu-icon-rotate hidden w-3.5 h-3.5  md:inline-block" xmlns="http://www.w3.org/2000/svg"
					width="13" height="8" viewBox="0 0 13 8" fill="none">
					<path
						d="M6.5 8L13 0.994744L12.077 -2.11161e-06L9.854 2.40981L6.5 6.02452L3.146 2.40981L0.923 0.0140101L1.66822e-07 1.00876L6.5 8Z"
						fill="white" />
				</svg>
			</div>
			<?php
			wp_nav_menu(array(
				'theme_location' => 'footer-shop-menu',
				'container' => false,
				'menu_id' => 'footer-shop-menu',
				'menu_class' => 'space-y-2 md:hidden md:mt-5 no-list-style',
				'fallback_cb' => false,
				'depth' => 1
			));
			?>
		</div>

		<!-- 3rd Div: Spans columns 7-8 -->
		<div class="col-start-7 col-span-2 md:col-span-1 md:mb-11">
			<div class="flex justify-between items-center md:cursor-pointer md-footer-toggle-menu">
				<?php if ($info_menu_heading): ?>
					<h2 class="uppercase body-normal-medium mb-5 md:mb-0 md:font-medium md:normal-case">
						<?php echo wp_kses_post($info_menu_heading); ?>
					</h2>
				<?php endif; ?>
				<svg class="menu-icon-rotate hidden w-3.5 h-3.5 md:inline-block" xmlns="http://www.w3.org/2000/svg"
					width="13" height="8" viewBox="0 0 13 8" fill="none">
					<path
						d="M6.5 8L13 0.994744L12.077 -2.11161e-06L9.854 2.40981L6.5 6.02452L3.146 2.40981L0.923 0.0140101L1.66822e-07 1.00876L6.5 8Z"
						fill="white" />
				</svg>
			</div>
			<?php
			wp_nav_menu(array(
				'theme_location' => 'footer-info-menu',
				'container' => false,
				'menu_id' => 'footer-info-menu',
				'menu_class' => 'space-y-2.5 md:hidden md:mt-5 no-list-style',
				'fallback_cb' => false,
				'depth' => 1
			));
			?>
		</div>

		<!-- Newsletter col -->
		<div class="col-start-9 col-span-4 md:col-span-1">
			<h2 class="uppercase body-normal-medium mb-5 md:mb-0 md:font-medium md:normal-case">PRENUMERUOKITE</h2>
			<p class="md:mt-2">Užsiregistruokite ir gaukite -10 % nuolaidą kitam užsakymui, pirmieji sužinokite apie naujausius produktus!</p>
			<div class="mt-4" id="omnisend-embedded-v2-67433cccdcdc64b34f2f4633"></div>
		</div>

	</div>

	<div class="container block mx-auto text-center md:px-4">

		<p class="text-dark-gray block body-extra-small-light md:text-left">
			&copy; <span id="currentYear"></span> <?php echo wp_kses_post('Trendy Nails Lithuania'); ?>
		</p>

	</div>

</footer>
</div><!-- #content -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>

</html>