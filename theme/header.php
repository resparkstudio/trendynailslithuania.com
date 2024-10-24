<?php
/*
Template Name: Header
*/

$soc_media_page_id = 169;
$facebook_link = get_field('facebook_link', $soc_media_page_id);
$instagram_link = get_field('instagram_link', $soc_media_page_id);
?>


<li?php /** * The header for our theme * * This is the template that displays the `head` element and everything up *
	until the `#content` element. * * @link
	https://developer.wordpress.org/themes/basics/template-files/#template-partials * * @package _tw */ ?>
	<!doctype html>
	<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@400;500;600;700&display=swap"
			rel="stylesheet">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<?php wp_body_open(); ?>

		<div id="page" class="relative">
			<a href="#content" class="sr-only"><?php esc_html('Skip to content'); ?></a>

			<header
				class="fixed w-full site-header flex justify-between items-center h-20 md:h-[3.75rem] px-12 md:px-4 z-40 bg-white md:z-30">
				<nav id="site-navigation"
					class="main-navigation body-small-regular text-black flex-1 flex justify-start pr-4 md:hidden">

					<?php
					$locations = get_nav_menu_locations();

					if (isset($locations['header-menu'])) {
						$menu_id = $locations['header-menu'];
						$menu_items = wp_get_nav_menu_items($menu_id);

						echo '<ul id="primary-menu" class="flex main-menu-fluid-spacing whitespace-nowrap relative gap-11">';

						foreach ($menu_items as $index => &$item) {
							$classes = 'flex items-center gap-1 cursor-pointer';
							$item_title = $item->title;

							if ($index === 0) {
								$item->title = '<p class = "link-hover">' . $item_title . '</p>' . '
								<div class="flex items-center">
									<svg class="h-full inline-block" width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M4.5 5L9 0.621716L8.361 0L6.822 1.50613L4.5 3.76532L2.178 1.50613L0.639 0.00875643L0 0.630473L4.5 5Z" fill="black"/>
									</svg>
								</div>';
							}

							echo '<li class="' . esc_attr(implode(' ', $item->classes)) . '">';
							echo '<a href="' . esc_url($item->url) . '" class="' . esc_attr($classes) . '">';
							echo $item->title;
							echo '</a>';
							echo '</li>';
						}

						echo '</ul>';
					}
					?>
				</nav>

				<div class="mobile-shop-link hidden md:block md:mr-9 cursor-pointer">
					<svg width="18" height="8" viewBox="0 0 18 8" fill="none" xmlns="http://www.w3.org/2000/svg">
						<line y1="1.4" x2="17.5" y2="1.4" stroke="black" stroke-width="1.2" />
						<line y1="7.4" x2="17.5" y2="7.4" stroke="black" stroke-width="1.2" />
					</svg>
				</div>

				<!-- Site Logo -->
				<div class="site-logo flex flex-none justify-items-center mx-auto">
					<a href="<?php echo get_permalink(get_page_by_path('titulinis')->ID); ?>">
						<img src="<?php echo esc_url(wp_get_attachment_image_url(get_theme_mod('custom_logo'), 'full')); ?>"
							class="w-[8.625rem] h-[2.625rem] md:w-[6.25rem] md:h-[1.875rem]">
					</a>
				</div>

				<!-- Header Icons -->
				<div class="header-icons flex-1 flex justify-end space-x-6 pl-4">
					<!-- Search Icon -->
					<a href="#" id="search-icon">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<mask id="path-1-inside-1_192_1896" fill="white">
								<path
									d="M16 15.1804L12.2137 11.3999C13.368 10.0356 13.9503 8.27796 13.8389 6.49436C13.7275 4.71076 12.9309 3.03925 11.6158 1.82923C10.3007 0.619213 8.56884 -0.0356608 6.78215 0.00149919C4.99546 0.0386592 3.29228 0.764977 2.02863 2.02863C0.764977 3.29228 0.0386592 4.99546 0.00149919 6.78215C-0.0356608 8.56884 0.619213 10.3007 1.82923 11.6158C3.03925 12.9309 4.71076 13.7275 6.49436 13.8389C8.27796 13.9503 10.0356 13.368 11.3999 12.2137L15.1804 16L16 15.1804ZM6.93249 12.7043C5.79093 12.7043 4.67501 12.3658 3.72584 11.7316C2.77667 11.0974 2.03689 10.1959 1.60003 9.14126C1.16318 8.0866 1.04888 6.92609 1.27158 5.80647C1.49429 4.68684 2.044 3.65841 2.8512 2.8512C3.65841 2.044 4.68684 1.49429 5.80647 1.27158C6.92609 1.04888 8.0866 1.16318 9.14126 1.60003C10.1959 2.03689 11.0974 2.77667 11.7316 3.72584C12.3658 4.67501 12.7043 5.79093 12.7043 6.93249C12.7043 7.69045 12.555 8.441 12.2649 9.14126C11.9749 9.84153 11.5497 10.4778 11.0138 11.0138C10.4778 11.5497 9.84153 11.9749 9.14126 12.2649C8.441 12.555 7.69045 12.7043 6.93249 12.7043Z" />
							</mask>
							<path
								d="M16 15.1804L12.2137 11.3999C13.368 10.0356 13.9503 8.27796 13.8389 6.49436C13.7275 4.71076 12.9309 3.03925 11.6158 1.82923C10.3007 0.619213 8.56884 -0.0356608 6.78215 0.00149919C4.99546 0.0386592 3.29228 0.764977 2.02863 2.02863C0.764977 3.29228 0.0386592 4.99546 0.00149919 6.78215C-0.0356608 8.56884 0.619213 10.3007 1.82923 11.6158C3.03925 12.9309 4.71076 13.7275 6.49436 13.8389C8.27796 13.9503 10.0356 13.368 11.3999 12.2137L15.1804 16L16 15.1804ZM6.93249 12.7043C5.79093 12.7043 4.67501 12.3658 3.72584 11.7316C2.77667 11.0974 2.03689 10.1959 1.60003 9.14126C1.16318 8.0866 1.04888 6.92609 1.27158 5.80647C1.49429 4.68684 2.044 3.65841 2.8512 2.8512C3.65841 2.044 4.68684 1.49429 5.80647 1.27158C6.92609 1.04888 8.0866 1.16318 9.14126 1.60003C10.1959 2.03689 11.0974 2.77667 11.7316 3.72584C12.3658 4.67501 12.7043 5.79093 12.7043 6.93249C12.7043 7.69045 12.555 8.441 12.2649 9.14126C11.9749 9.84153 11.5497 10.4778 11.0138 11.0138C10.4778 11.5497 9.84153 11.9749 9.14126 12.2649C8.441 12.555 7.69045 12.7043 6.93249 12.7043Z"
								fill="#201F1F" />
							<path
								d="M16 15.1804L27.3137 26.4941L38.6361 15.1718L27.3051 3.85807L16 15.1804ZM12.2137 11.3999L-0.000896891 1.06528L-9.51699 12.3125L0.908617 22.7222L12.2137 11.3999ZM11.3999 12.2137L22.7222 0.908617L12.3125 -9.51699L1.06528 -0.000896891L11.3999 12.2137ZM15.1804 16L3.85807 27.3051L15.1718 38.6361L26.4941 27.3137L15.1804 16ZM12.7043 6.93249H28.7043H12.7043ZM27.3051 3.85807L23.5188 0.0775357L0.908617 22.7222L4.69492 26.5027L27.3051 3.85807ZM24.4283 21.7345C28.2491 17.2186 30.1765 11.4007 29.8077 5.49684L-2.13 7.49188C-2.27597 5.15523 -1.51311 2.85259 -0.000896891 1.06528L24.4283 21.7345ZM29.8077 5.49684C29.4389 -0.407016 26.8025 -5.93984 22.4494 -9.9451L0.78233 13.6036C-0.940559 12.0183 -1.98404 9.82854 -2.13 7.49188L29.8077 5.49684ZM22.4494 -9.9451C18.0963 -13.9504 12.3635 -16.118 6.44945 -15.995L7.11485 15.998C4.77415 16.0467 2.50521 15.1888 0.78233 13.6036L22.4494 -9.9451ZM6.44945 -15.995C0.53537 -15.872 -5.10229 -13.4679 -9.28508 -9.28508L13.3423 13.3423C11.6869 14.9978 9.45555 15.9494 7.11485 15.998L6.44945 -15.995ZM-9.28508 -9.28508C-13.4679 -5.10229 -15.872 0.53537 -15.995 6.44945L15.998 7.11485C15.9494 9.45555 14.9978 11.6869 13.3423 13.3423L-9.28508 -9.28508ZM-15.995 6.44945C-16.118 12.3635 -13.9504 18.0963 -9.9451 22.4494L13.6036 0.78233C15.1888 2.50521 16.0467 4.77415 15.998 7.11485L-15.995 6.44945ZM-9.9451 22.4494C-5.93984 26.8025 -0.407016 29.4389 5.49684 29.8077L7.49188 -2.13C9.82854 -1.98404 12.0183 -0.940559 13.6036 0.78233L-9.9451 22.4494ZM5.49684 29.8077C11.4007 30.1765 17.2186 28.2491 21.7345 24.4283L1.06528 -0.000896891C2.85259 -1.51311 5.15523 -2.27597 7.49188 -2.13L5.49684 29.8077ZM0.0775357 23.5188L3.85807 27.3051L26.5027 4.69492L22.7222 0.908617L0.0775357 23.5188ZM26.4941 27.3137L27.3137 26.4941L4.68629 3.8667L3.8667 4.68629L26.4941 27.3137ZM6.93249 -3.2957C8.95544 -3.2957 10.933 -2.69583 12.615 -1.57194L-5.16328 25.0351C-1.58293 27.4274 2.62643 28.7043 6.93249 28.7043V-3.2957ZM12.615 -1.57194C14.297 -0.448053 15.608 1.14937 16.3821 3.01833L-13.182 15.2642C-11.5342 19.2425 -8.74364 22.6428 -5.16328 25.0351L12.615 -1.57194ZM16.3821 3.01833C17.1563 4.88729 17.3588 6.94384 16.9641 8.92791L-14.421 2.68502C-15.2611 6.90834 -14.8299 11.2859 -13.182 15.2642L16.3821 3.01833ZM16.9641 8.92791C16.5695 10.912 15.5954 12.7345 14.1649 14.1649L-8.46251 -8.46251C-11.5073 -5.41766 -13.5809 -1.53829 -14.421 2.68502L16.9641 8.92791ZM14.1649 14.1649C12.7345 15.5954 10.912 16.5695 8.92791 16.9641L2.68502 -14.421C-1.53829 -13.5809 -5.41766 -11.5073 -8.46251 -8.46251L14.1649 14.1649ZM8.92791 16.9641C6.94384 17.3588 4.88729 17.1563 3.01833 16.3821L15.2642 -13.182C11.2859 -14.8299 6.90834 -15.2611 2.68502 -14.421L8.92791 16.9641ZM3.01833 16.3821C1.14937 15.608 -0.448053 14.297 -1.57194 12.615L25.0351 -5.16328C22.6428 -8.74364 19.2425 -11.5342 15.2642 -13.182L3.01833 16.3821ZM-1.57194 12.615C-2.69583 10.933 -3.2957 8.95544 -3.2957 6.93249H28.7043C28.7043 2.62643 27.4274 -1.58293 25.0351 -5.16328L-1.57194 12.615ZM-3.2957 6.93249C-3.2957 5.58931 -3.03114 4.25928 -2.51713 3.01833L27.047 15.2642C28.1412 12.6227 28.7043 9.7916 28.7043 6.93249H-3.2957ZM-2.51713 3.01833C-2.00311 1.77738 -1.24971 0.649839 -0.299934 -0.299934L22.3275 22.3275C24.3492 20.3058 25.9529 17.9057 27.047 15.2642L-2.51713 3.01833ZM-0.299934 -0.299934C0.649839 -1.24971 1.77738 -2.00311 3.01833 -2.51713L15.2642 27.047C17.9057 25.9529 20.3058 24.3492 22.3275 22.3275L-0.299934 -0.299934ZM3.01833 -2.51713C4.25928 -3.03114 5.58931 -3.2957 6.93249 -3.2957V28.7043C9.7916 28.7043 12.6227 28.1412 15.2642 27.047L3.01833 -2.51713Z"
								fill="#201F1F" mask="url(#path-1-inside-1_192_1896)" />
						</svg>
					</a>

					<!-- <a href="#" class="search-icon">
					<?php get_product_search_form(); ?>
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<mask id="path-1-inside-1_192_1896" fill="white">
							<path
								d="M16 15.1804L12.2137 11.3999C13.368 10.0356 13.9503 8.27796 13.8389 6.49436C13.7275 4.71076 12.9309 3.03925 11.6158 1.82923C10.3007 0.619213 8.56884 -0.0356608 6.78215 0.00149919C4.99546 0.0386592 3.29228 0.764977 2.02863 2.02863C0.764977 3.29228 0.0386592 4.99546 0.00149919 6.78215C-0.0356608 8.56884 0.619213 10.3007 1.82923 11.6158C3.03925 12.9309 4.71076 13.7275 6.49436 13.8389C8.27796 13.9503 10.0356 13.368 11.3999 12.2137L15.1804 16L16 15.1804ZM6.93249 12.7043C5.79093 12.7043 4.67501 12.3658 3.72584 11.7316C2.77667 11.0974 2.03689 10.1959 1.60003 9.14126C1.16318 8.0866 1.04888 6.92609 1.27158 5.80647C1.49429 4.68684 2.044 3.65841 2.8512 2.8512C3.65841 2.044 4.68684 1.49429 5.80647 1.27158C6.92609 1.04888 8.0866 1.16318 9.14126 1.60003C10.1959 2.03689 11.0974 2.77667 11.7316 3.72584C12.3658 4.67501 12.7043 5.79093 12.7043 6.93249C12.7043 7.69045 12.555 8.441 12.2649 9.14126C11.9749 9.84153 11.5497 10.4778 11.0138 11.0138C10.4778 11.5497 9.84153 11.9749 9.14126 12.2649C8.441 12.555 7.69045 12.7043 6.93249 12.7043Z" />
						</mask>
						<path d="..." fill="#201F1F" />
					</svg>
				</a> -->

					<!-- Favorites (Heart) Icon -->
					<a href="<?php echo esc_url(home_url('/favorites')); ?>" id="favorites-icon">
						<svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M15.7663 2.2377C15.3753 1.84531 14.9111 1.53404 14.4002 1.32168C13.8893 1.10931 13.3417 1 12.7887 1C12.2357 1 11.6881 1.10931 11.1772 1.32168C10.6663 1.53404 10.2021 1.84531 9.81116 2.2377L8.9998 3.05166L8.18843 2.2377C7.39874 1.44548 6.32768 1.00041 5.21089 1.00041C4.09409 1.00041 3.02303 1.44548 2.23334 2.2377C1.44365 3.02993 1 4.10441 1 5.22479C1 6.34516 1.44365 7.41965 2.23334 8.21187L3.0447 9.02583L8.9998 15L14.9549 9.02583L15.7663 8.21187C16.1574 7.81967 16.4677 7.354 16.6794 6.84146C16.891 6.32893 17 5.77958 17 5.22479C17 4.67 16.891 4.12064 16.6794 3.60811C16.4677 3.09558 16.1574 2.6299 15.7663 2.2377V2.2377Z"
								stroke="#201F1F" stroke-width="1.1" stroke-linecap="round" />
						</svg>
					</a>

					<!-- My Account (User) Icon -->
					<a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"
						id="account-icon">
						<svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M3.44922 4.16345C3.44922 2.14386 5.09308 0.5 7.11267 0.5C9.13226 0.5 10.7761 2.14384 10.7761 4.16341C10.7761 6.183 9.13225 7.82686 7.11267 7.82686C5.09308 7.82686 3.44922 6.18303 3.44922 4.16345ZM3.49008 4.16345C3.49008 6.16138 5.11474 7.78603 7.11267 7.78603C9.1106 7.78603 10.7353 6.16138 10.7353 4.16345C10.7353 2.16552 9.1106 0.540862 7.11267 0.540862C5.11474 0.540862 3.49008 2.16552 3.49008 4.16345Z"
								fill="#201F1F" stroke="#201F1F" />
							<path
								d="M0.564753 15.9166L0.518478 16.4591H1.06294H13.1621H13.7066L13.6603 15.9166C13.3736 12.5551 10.5473 9.9078 7.11254 9.9078C3.67782 9.9078 0.851488 12.5551 0.564753 15.9166ZM0.5 16.4795C0.5 12.8338 3.46683 9.86694 7.11254 9.86694C10.7583 9.86694 13.7251 12.8338 13.7251 16.4795V16.4999H0.5V16.4795Z"
								fill="#201F1F" stroke="#201F1F" />
						</svg>
					</a>

					<!-- Shopping Bag Icon -->
					<a href="<?php echo wc_get_cart_url(); ?>" id="cart-icon">
						<svg width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
							<mask id="path-1-inside-1_192_1899" fill="white">
								<path
									d="M6.7251 0C4.79515 0 3.2251 1.56392 3.2251 3.48633V3.98438H0.225098V17H13.2251V3.98438H10.2251V3.48633C10.2251 1.56392 8.65505 0 6.7251 0ZM4.2251 3.48633C4.2251 2.1132 5.34658 0.996094 6.7251 0.996094C8.10361 0.996094 9.2251 2.1132 9.2251 3.48633V3.98438H4.2251V3.48633ZM12.2251 4.98047V16.0039H1.2251V4.98047H3.2251V6.97266H4.2251V4.98047H9.2251V6.97266H10.2251V4.98047H12.2251Z" />
							</mask>
							<path
								d="M6.7251 0C4.79515 0 3.2251 1.56392 3.2251 3.48633V3.98438H0.225098V17H13.2251V3.98438H10.2251V3.48633C10.2251 1.56392 8.65505 0 6.7251 0ZM4.2251 3.48633C4.2251 2.1132 5.34658 0.996094 6.7251 0.996094C8.10361 0.996094 9.2251 2.1132 9.2251 3.48633V3.98438H4.2251V3.48633ZM12.2251 4.98047V16.0039H1.2251V4.98047H3.2251V6.97266H4.2251V4.98047H9.2251V6.97266H10.2251V4.98047H12.2251Z"
								fill="#201F1F" />
							<path
								d="M3.2251 3.98438V4.98438H4.2251V3.98438H3.2251ZM0.225098 3.98438V2.98438H-0.774902V3.98438H0.225098ZM0.225098 17H-0.774902V18H0.225098V17ZM13.2251 17V18H14.2251V17H13.2251ZM13.2251 3.98438H14.2251V2.98438H13.2251V3.98438ZM10.2251 3.98438H9.2251V4.98438H10.2251V3.98438ZM9.2251 3.98438V4.98438H10.2251V3.98438H9.2251ZM4.2251 3.98438H3.2251V4.98438H4.2251V3.98438ZM12.2251 4.98047H13.2251V3.98047H12.2251V4.98047ZM12.2251 16.0039V17.0039H13.2251V16.0039H12.2251ZM1.2251 16.0039H0.225098V17.0039H1.2251V16.0039ZM1.2251 4.98047V3.98047H0.225098V4.98047H1.2251ZM3.2251 4.98047H4.2251V3.98047H3.2251V4.98047ZM3.2251 6.97266H2.2251V7.97266H3.2251V6.97266ZM4.2251 6.97266V7.97266H5.2251V6.97266H4.2251ZM4.2251 4.98047V3.98047H3.2251V4.98047H4.2251ZM9.2251 4.98047H10.2251V3.98047H9.2251V4.98047ZM9.2251 6.97266H8.2251V7.97266H9.2251V6.97266ZM10.2251 6.97266V7.97266H11.2251V6.97266H10.2251ZM10.2251 4.98047V3.98047H9.2251V4.98047H10.2251ZM6.7251 -1C4.24656 -1 2.2251 1.00795 2.2251 3.48633H4.2251C4.2251 2.11989 5.34374 1 6.7251 1V-1ZM2.2251 3.48633V3.98438H4.2251V3.48633H2.2251ZM3.2251 2.98438H0.225098V4.98438H3.2251V2.98438ZM-0.774902 3.98438V17H1.2251V3.98438H-0.774902ZM0.225098 18H13.2251V16H0.225098V18ZM14.2251 17V3.98438H12.2251V17H14.2251ZM13.2251 2.98438H10.2251V4.98438H13.2251V2.98438ZM11.2251 3.98438V3.48633H9.2251V3.98438H11.2251ZM11.2251 3.48633C11.2251 1.00795 9.20364 -1 6.7251 -1V1C8.10645 1 9.2251 2.11989 9.2251 3.48633H11.2251ZM5.2251 3.48633C5.2251 2.66917 5.89517 1.99609 6.7251 1.99609V-0.00390625C4.79799 -0.00390625 3.2251 1.55723 3.2251 3.48633H5.2251ZM6.7251 1.99609C7.55502 1.99609 8.2251 2.66917 8.2251 3.48633H10.2251C10.2251 1.55723 8.6522 -0.00390625 6.7251 -0.00390625V1.99609ZM8.2251 3.48633V3.98438H10.2251V3.48633H8.2251ZM9.2251 2.98438H4.2251V4.98438H9.2251V2.98438ZM5.2251 3.98438V3.48633H3.2251V3.98438H5.2251ZM11.2251 4.98047V16.0039H13.2251V4.98047H11.2251ZM12.2251 15.0039H1.2251V17.0039H12.2251V15.0039ZM2.2251 16.0039V4.98047H0.225098V16.0039H2.2251ZM1.2251 5.98047H3.2251V3.98047H1.2251V5.98047ZM2.2251 4.98047V6.97266H4.2251V4.98047H2.2251ZM3.2251 7.97266H4.2251V5.97266H3.2251V7.97266ZM5.2251 6.97266V4.98047H3.2251V6.97266H5.2251ZM4.2251 5.98047H9.2251V3.98047H4.2251V5.98047ZM8.2251 4.98047V6.97266H10.2251V4.98047H8.2251ZM9.2251 7.97266H10.2251V5.97266H9.2251V7.97266ZM11.2251 6.97266V4.98047H9.2251V6.97266H11.2251ZM10.2251 5.98047H12.2251V3.98047H10.2251V5.98047Z"
								fill="#201F1F" mask="url(#path-1-inside-1_192_1899)" />
						</svg>
						<!-- TO-DO cart count -->
						<!-- <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span> -->
					</a>
				</div>




			</header>
			<div class="fixed left-0 z-50 body-small-regular h-[5rem] text-black flex items-center pl-12 md:hidden">
				<a href="#" id="sidebar-close-link" class="invisible gap-1">
					<span class="inline-block">
						Parduotuvė
					</span>
					<div class="flex items-center">
						<svg class="h-full inline-block" width="9" height="5" viewBox="0 0 9 5" fill="none"
							xmlns="http://www.w3.org/2000/svg">
							<path
								d="M4.5 5L9 0.621716L8.361 0L6.822 1.50613L4.5 3.76532L2.178 1.50613L0.639 0.00875643L0 0.630473L4.5 5Z"
								fill="black" />
						</svg>
					</div>
				</a>
			</div>

			<!-- Sidebar -->
			<aside id="shop-sidebar"
				class="shop-sidebar flex-col fixed left-0 w-[16.5rem] md:w-[14.25rem] h-svh bg-black text-white body-small-regular hidden z-40 pt-20 md:pt-[3.75rem] grid-rows-12">
				<nav id="desktop-sidebar-navigation"
					class="main-navigation body-small-regular text-white flex flex-col md:hidden row-span-9 pl-12 pr-4 py-9">
					<?php
					$locations = get_nav_menu_locations();

					if (isset($locations['sidebar-menu'])) {
						$menu_id = $locations['sidebar-menu'];
						$menu_items = wp_get_nav_menu_items($menu_id);
						$menu_items_by_parent = [];

						// Organize menu items by parent ID
						foreach ($menu_items as $item) {
							$menu_items_by_parent[$item->menu_item_parent][] = $item;
						}

						echo '<ul id="primary-sidebar-menu" class="flex flex-col main-menu-fluid-spacing gap-5 overflow-auto pr-4">';

						function display_menu_items($parent_id, $menu_items_by_parent, $is_submenu = false)
						{
							if (!isset($menu_items_by_parent[$parent_id])) {
								return;
							}

							foreach ($menu_items_by_parent[$parent_id] as $item) {
								$classes = 'flex items-center justify-between cursor-pointer sidebar-toggle-menu';
								$has_children = isset($menu_items_by_parent[$item->ID]);

								echo '<li>';
								echo '<a href="' . esc_url($item->url) . '" class="' . esc_attr($classes) . '" data-has-children="' . ($has_children ? 'true' : 'false') . '">';
								echo '<div class="flex-grow">' . '<span class="link-hover">' . $item->title . '</span>' . '</div>';

								if ($has_children) {
									echo '<div class="icon flex items-center justify-end">
                            <svg class="sidebar-more-icon menu-icon-rotate" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 4.5L0.621716 0L0 0.639L1.50613 2.178L3.76532 4.5L1.50613 6.822L0.00875641 8.361L0.630473 9L5 4.5Z" fill="white"/>
                            </svg>
                        </div>';
								}

								echo '</a>';

								if ($has_children) {
									echo '<ul class="pt-5 gap-5 flex-col submenu hidden">'; // Apply submenu and hidden classes here
									display_menu_items($item->ID, $menu_items_by_parent, true);
									echo '</ul>';
								}

								echo '</li>';
							}
						}

						display_menu_items(0, $menu_items_by_parent);
						echo '</ul>';
					}
					?>
				</nav>


				<nav id="mobile-sidebar-navigation"
					class="main-navigation body-small-regular text-white flex-col hidden md:flex row-span-10 pt-6 pl-8 pr-10">
					<?php
					if (isset($locations['mobile-sidebar-menu'])) {
						$menu_id = $locations['mobile-sidebar-menu'];
						$menu_items = wp_get_nav_menu_items($menu_id);
						$menu_items_by_parent = [];

						// Organize menu items by parent ID
						foreach ($menu_items as $item) {
							$menu_items_by_parent[$item->menu_item_parent][] = $item;
						}

						echo '<ul id="mobile-primary-menu" class="flex flex-col overflow-y-auto overflow-x-hidden main-menu-fluid-spacing gap-5 pr-10">';

						function display_mobile_menu_items($parent_id, $menu_items_by_parent, $is_submenu = false)
						{
							if (!isset($menu_items_by_parent[$parent_id])) {
								return;
							}

							foreach ($menu_items_by_parent[$parent_id] as $item) {
								$classes = 'flex items-center justify-between cursor-pointer sidebar-toggle-menu';
								$has_children = isset($menu_items_by_parent[$item->ID]);

								echo '<li>';
								echo '<a href="' . esc_url($item->url) . '" class="' . esc_attr($classes) . '" data-has-children="' . ($has_children ? 'true' : 'false') . '">';
								echo '<div class="flex-grow">' . '<span class="link-hover">' . $item->title . '</span>' . '</div>';

								if ($has_children) {
									echo '<div class="icon flex items-center justify-end">
                        <svg class="sidebar-more-icon menu-icon-rotate" width="5" height="9" viewBox="0 0 5 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 4.5L0.621716 0L0 0.639L1.50613 2.178L3.76532 4.5L1.50613 6.822L0.00875641 8.361L0.630473 9L5 4.5Z" fill="white"/>
                        </svg>
                    </div>';
								}

								echo '</a>';

								if ($has_children) {
									echo '<ul class="pt-5 gap-5 flex-col submenu hidden">'; // Similar classes for the submenu
									display_mobile_menu_items($item->ID, $menu_items_by_parent, true);
									echo '</ul>';
								}

								echo '</li>';
							}
						}

						display_mobile_menu_items(0, $menu_items_by_parent);
						echo '</ul>';
					}
					?>
				</nav>




				<div
					class="sidebar-footer px-12 pb-11 md:px-8 md:pb-6 flex flex-col justify-end row-span-3 md:row-span-2 gap-5">
					<p class="w-full md:font-normal md:text-[0.75rem] body-small-light">
						<?php esc_html('Sekite mūsų naujienas!'); ?>
					</p>
					<div class="flex gap-4 w-full">
						<?php if ($facebook_link): ?>
							<a href="<?php echo esc_url($facebook_link); ?>" target="_blank" class="text-white">
								<svg width="8" height="16" viewBox="0 0 8 16" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path
										d="M7.47636 9L7.88364 6.125H5.29455V4.25C5.29455 3.4375 5.64364 2.6875 6.80727 2.6875H8V0.21875C8 0.21875 6.92364 0 5.90545 0C3.78182 0 2.38545 1.40625 2.38545 3.90625V6.125H0V9H2.38545V16H5.29455V9H7.47636Z"
										fill="white" />
								</svg>
							</a>
						<?php endif; ?>

						<?php if ($instagram_link): ?>
							<a href="<?php echo esc_url($instagram_link); ?>" target="_blank" class="text-white">
								<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path
										d="M8.01786 3.875C10.2679 3.875 12.125 5.73214 12.125 7.98214C12.125 10.2679 10.2679 12.0893 8.01786 12.0893C5.73214 12.0893 3.91071 10.2679 3.91071 7.98214C3.91071 5.73214 5.73214 3.875 8.01786 3.875ZM8.01786 10.6607C9.48214 10.6607 10.6607 9.48214 10.6607 7.98214C10.6607 6.51786 9.48214 5.33929 8.01786 5.33929C6.51786 5.33929 5.33929 6.51786 5.33929 7.98214C5.33929 9.48214 6.55357 10.6607 8.01786 10.6607ZM13.2321 3.73214C13.2321 4.26786 12.8036 4.69643 12.2679 4.69643C11.7321 4.69643 11.3036 4.26786 11.3036 3.73214C11.3036 3.19643 11.7321 2.76786 12.2679 2.76786C12.8036 2.76786 13.2321 3.19643 13.2321 3.73214ZM15.9464 4.69643C16.0179 6.01786 16.0179 9.98214 15.9464 11.3036C15.875 12.5893 15.5893 13.6964 14.6607 14.6607C13.7321 15.5893 12.5893 15.875 11.3036 15.9464C9.98214 16.0179 6.01786 16.0179 4.69643 15.9464C3.41071 15.875 2.30357 15.5893 1.33929 14.6607C0.410714 13.6964 0.125 12.5893 0.0535714 11.3036C-0.0178571 9.98214 -0.0178571 6.01786 0.0535714 4.69643C0.125 3.41071 0.410714 2.26786 1.33929 1.33929C2.30357 0.410714 3.41071 0.125 4.69643 0.0535714C6.01786 -0.0178571 9.98214 -0.0178571 11.3036 0.0535714C12.5893 0.125 13.7321 0.410714 14.6607 1.33929C15.5893 2.26786 15.875 3.41071 15.9464 4.69643ZM14.2321 12.6964C14.6607 11.6607 14.5536 9.16071 14.5536 7.98214C14.5536 6.83929 14.6607 4.33929 14.2321 3.26786C13.9464 2.58929 13.4107 2.01786 12.7321 1.76786C11.6607 1.33929 9.16071 1.44643 8.01786 1.44643C6.83929 1.44643 4.33929 1.33929 3.30357 1.76786C2.58929 2.05357 2.05357 2.58929 1.76786 3.26786C1.33929 4.33929 1.44643 6.83929 1.44643 7.98214C1.44643 9.16071 1.33929 11.6607 1.76786 12.6964C2.05357 13.4107 2.58929 13.9464 3.30357 14.2321C4.33929 14.6607 6.83929 14.5536 8.01786 14.5536C9.16071 14.5536 11.6607 14.6607 12.7321 14.2321C13.4107 13.9464 13.9821 13.4107 14.2321 12.6964Z"
										fill="white" />
								</svg>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</aside>
			<div id="content" class="pt-20 md:pt-[3.75rem]">