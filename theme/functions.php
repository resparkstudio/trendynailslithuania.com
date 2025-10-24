<?php

/**
 * _tw functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _tw
 */

if (!defined('_TW_VERSION')) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define('_TW_VERSION', '0.1.0');
}

if (!defined('_TW_TYPOGRAPHY_CLASSES')) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `_tw_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'_TW_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if (!function_exists('_tw_setup')):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _tw_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _tw, use a find and replace
		 * to change '_tw' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('_tw', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');



		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'header-menu' => __('Header Menu'),
				'sidebar-menu' => __('Sidebar Menu'),
				'mobile-sidebar-menu' => __('Mobile Sidebar Menu'),
				'footer-shop-menu' => __('Footer Shop Menu'),
				'footer-info-menu' => __('Footer Info Menu')
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		// Enqueue editor styles.
		add_editor_style('style-editor.css');
		add_editor_style('style-editor-extra.css');

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// Remove support for block templates.
		remove_theme_support('block-templates');
	}
endif;
add_action('after_setup_theme', '_tw_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _tw_widgets_init() {
	register_sidebar(
		array(
			'name' => __('Footer', '_tw'),
			'id' => 'sidebar-1',
			'description' => __('Add widgets here to appear in your footer.', '_tw'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', '_tw_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function _tw_scripts() {
	wp_enqueue_style('_tw-style', get_stylesheet_uri(), array(), _TW_VERSION);

	wp_enqueue_style('swiper-css', get_theme_root_uri() . '/_tw/node_modules/swiper/swiper-bundle.min.css');

	wp_enqueue_script('_tw-script', get_template_directory_uri() . '/js/script.min.js', array('jquery'), _TW_VERSION, true);

	wp_localize_script('wc-checkout', 'wc_checkout_params', array(
		'ajax_url' => WC_AJAX::get_endpoint("%%endpoint%%"),
		'update_order_review_nonce' => wp_create_nonce('update-shipping-method'), // Update the nonce
	));


	wp_localize_script('_tw-script', 'ajax_add_to_cart_params', array(
		'ajax_url' => admin_url('admin-ajax.php')
	));

	wp_localize_script('_tw-script', 'ajax_product_archive_params', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'action' => 'fetch_products'
	));

	wp_localize_script('_tw-script', 'checkoutData', [
		'checkoutUrl' => esc_url(wc_get_checkout_url())
	]);

	wp_localize_script('_tw-script', 'ajax_wishlist_params', array(
		'ajax_url' => admin_url('admin-ajax.php'),
	));
}

add_action('wp_enqueue_scripts', '_tw_scripts');



/**
 * Enqueue the block editor script.
 */
function _tw_enqueue_block_editor_script() {
	if (is_admin()) {
		wp_enqueue_script(
			'_tw-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			_TW_VERSION,
			true
		);
		wp_add_inline_script('_tw-editor', "tailwindTypographyClasses = '" . esc_attr(_TW_TYPOGRAPHY_CLASSES) . "'.split(' ');", 'before');
	}
}
add_action('enqueue_block_assets', '_tw_enqueue_block_editor_script');

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function _tw_tinymce_add_class($settings) {
	$settings['body_class'] = _TW_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter('tiny_mce_before_init', '_tw_tinymce_add_class');


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

function theme_setup() {
	add_theme_support("custom-logo", array());
}
add_action('after_setup_theme', 'theme_setup');

//----------------------------------- ACF

if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' => 'Global nustatymai',
		'menu_title' => 'Global nustatymai',
		'menu_slug' => 'contact-general-settings',
		'capability' => 'edit_posts',
		'redirect' => false,
		'icon_url' => 'dashicons-admin-site'
	));
}

//----------------------------------- WOOCOMMERCE
// add woocommerce theme support
function _tw_add_woocommerce_support() {
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', '_tw_add_woocommerce_support');

// Add popular products checkbox to woo settings
function add_popular_product_checkbox() {
	global $woocommerce, $post;
	echo '<div class="options_group">';

	// Checkbox
	woocommerce_wp_checkbox(
		array(
			'id' => '_populiariausi',
			'label' => __('Populiariausi', 'woocommerce'),
			'description' => __('Pažymėkite šią parinktį, jei produktas turėtų būti rodomas skyriuje "Populiariausi".', 'woocommerce')
		)
	);

	echo '</div>';
}

// remove breadcrumbs
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
// Remove the "On Sale" badge from its default position
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_filter('woocommerce_product_tabs', 'remove_product_tabs', 98);
// Remove product meta (Category, SKU) from single product pages
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

function remove_product_tabs($tabs) {
	unset($tabs['description']);            // Remove the description tab
	unset($tabs['additional_information']); // Remove the additional information tab
	unset($tabs['reviews']);                // Remove the reviews tab
	return $tabs;
}


// Save checkbox
function save_popular_product_checkbox($post_id) {
	$populiariausi = isset($_POST['_populiariausi']) ? 'yes' : 'no';
	update_post_meta($post_id, '_populiariausi', $populiariausi);
}

add_action('woocommerce_process_product_meta', 'save_popular_product_checkbox');
add_action('woocommerce_product_options_general_product_data', 'add_popular_product_checkbox');


// Add "category display in main page" field to product category settings
// Add checkbox to the category edit screen
function add_popular_category_checkbox($term) {
	// Get the current value of the meta field
	$checked = get_term_meta($term->term_id, '_display_in_section', true);
?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="_display_in_section"><?php _e('Rodyti tituliniame puslapyje'); ?></label>
		</th>
		<td>
			<input type="checkbox" name="_display_in_section" id="_display_in_section" value="yes" <?php checked($checked, 'yes'); ?> />
			<p class="description">
				<?php _e('Pažymėkite šią parinktį, jeigu norite, kad ši kategorija būtų rotoma titiliniame puslapyje, kategorijų skiltyje.', 'woocommerce'); ?>
			</p>
		</td>
	</tr>
<?php
}

// Add checkbox to the add new category screen
function add_popular_category_checkbox_new($term) {
?>
	<div class="form-field">
		<label for="_display_in_section"><?php _e('Rodyti tituliniame puslapyje'); ?></label>
		<input type="checkbox" name="_display_in_section" id="_display_in_section" value="yes" />
		<p class="description">
			<?php _e('Pažymėkite šią parinktį, jeigu norite, kad ši kategorija būtų rotoma titiliniame puslapyje, kategorijų skiltyje.', 'woocommerce'); ?>
		</p>
	</div>
	<?php
}

function save_popular_category_checkbox($term_id) {
	$display = isset($_POST['_display_in_section']) ? 'yes' : 'no';
	update_term_meta($term_id, '_display_in_section', $display);
}
add_action('product_cat_edit_form_fields', 'add_popular_category_checkbox', 10, 2);
add_action('product_cat_add_form_fields', 'add_popular_category_checkbox_new', 10, 2);
add_action('edited_product_cat', 'save_popular_category_checkbox', 10, 2);
add_action('create_product_cat', 'save_popular_category_checkbox', 10, 2);

function display_full_product_description() {
	global $post;

	if (!empty($post->post_content)) {
		echo '<div class="woocommerce-product-description mb-10 text-deep-dark-gray w-full">';
		echo apply_filters('the_content', $post->post_content); // Display the full description
		echo '</div>';
	}
}
add_action('woocommerce_single_product_summary', 'display_full_product_description', 25);



// Remove WooCommerce sale flash
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);


function filter_products() {
	$orderby = $_GET['orderby'] ?? 'default'; // Set default as the fallback
	$category = $_GET['category'] ?? ''; // Capture category from AJAX request

	$args = array(
		'post_type' => 'product',
		'posts_per_page' => -1,
	);

	// Apply sorting logic based on orderby
	if ($orderby === 'price-asc') {
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = '_price';
		$args['order'] = 'ASC';
	} elseif ($orderby === 'price-desc') {
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = '_price';
		$args['order'] = 'DESC';
	} elseif ($orderby === 'popularity') {
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = 'total_sales';
		$args['order'] = 'DESC';
	} elseif ($orderby === 'default') {
		$args['orderby'] = array(
			'menu_order' => 'ASC',
			'date' => 'DESC',
		);
	} else {
		$args['orderby'] = $orderby;
		$args['order'] = 'ASC';
	}

	// Apply category filter if provided
	if (!empty($category)) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => $category,
			),
		);
	}

	ob_start();
	$query = new WP_Query($args);
	if ($query->have_posts()) {
		woocommerce_product_loop_start();
		while ($query->have_posts()) {
			$query->the_post();
			wc_get_template_part('content', 'product');
		}
		woocommerce_product_loop_end();
	} else {
		echo '<p>No products found.</p>';
	}

	$product_content = ob_get_clean();
	wp_reset_postdata();

	// Get product count
	ob_start();
	$total = $query->found_posts;
	include locate_template('woocommerce/loop/result-count.php');
	$product_count = ob_get_clean();

	// Return JSON response
	wp_send_json(array(
		'products' => $product_content,
		'product_count' => $product_count,
	));
	wp_die();
}
add_action('wp_ajax_filter_products', 'filter_products');
add_action('wp_ajax_nopriv_filter_products', 'filter_products');



// Remove WooCommerce Notices Wrapper
function remove_woocommerce_notices() {
	remove_action('woocommerce_before_main_content', 'woocommerce_output_all_notices', 10);
}
add_action('wp', 'remove_woocommerce_notices');
add_filter('woocommerce_cart_item_removed_notice_type', '__return_false');



// Remove pagination controls from WooCommerce
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);


function modify_woocommerce_archive_query($query) {
	if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category())) {
		$orderby = $_GET['orderby'] ?? 'default'; // Default sorting if no 'orderby' parameter is provided

		switch ($orderby) {
			case 'price-asc':
				$query->set('orderby', 'meta_value_num');
				$query->set('meta_key', '_price');
				$query->set('order', 'ASC');
				break;
			case 'price-desc':
				$query->set('orderby', 'meta_value_num');
				$query->set('meta_key', '_price');
				$query->set('order', 'DESC');
				break;
			case 'popularity':
				$query->set('orderby', 'meta_value_num');
				$query->set('meta_key', 'total_sales');
				$query->set('order', 'DESC');
				break;
			case 'default': // Default WooCommerce sorting
			default:
				$query->set('orderby', array(
					'menu_order' => 'ASC', // Manual sorting set in the admin
					'title' => 'ASC', // Alphabetical fallback
				));
				break;
		}
	}
}
add_action('pre_get_posts', 'modify_woocommerce_archive_query');

// Limit initial products per page in WooCommerce archives for infinite scroll
function load_initial_products_in_archive($query) {
	if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category() || is_product_tag())) {
		$query->set('posts_per_page', 16);
	}
}
add_action('pre_get_posts', 'load_initial_products_in_archive');


// AJAX handler to load more products on scroll (updated)
function load_more_products_ajax() {
	// Get current AJAX page. (We start counting ajax pages at 2.)
	$ajax_page = isset($_POST['page']) ? intval($_POST['page']) : 2;
	$category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
	$orderby = isset($_POST['orderby']) ? sanitize_text_field($_POST['orderby']) : 'default';

	// Define your counts:
	$initial_posts_count = 16; // Must match the posts_per_page in your initial query
	$ajax_posts_per_page = 8; // Number of products loaded per AJAX request

	// Calculate the offset:
	// For the first AJAX load (ajax_page == 2), offset should be equal to the initial load count.
	$offset = $initial_posts_count + ($ajax_page - 2) * $ajax_posts_per_page;

	$args = [
		'post_type' => 'product',
		'posts_per_page' => $ajax_posts_per_page,
		'offset' => $offset,
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1,
	];

	// Add category filter if specified.
	if (!empty($category)) {
		$args['tax_query'] = [
			[
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => $category,
			],
		];
	}

	// Replicate your ordering logic from modify_woocommerce_archive_query.
	switch ($orderby) {
		case 'price-asc':
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_price';
			$args['order'] = 'ASC';
			break;
		case 'price-desc':
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = '_price';
			$args['order'] = 'DESC';
			break;
		case 'popularity':
			$args['orderby'] = 'meta_value_num';
			$args['meta_key'] = 'total_sales';
			$args['order'] = 'DESC';
			break;
		case 'default':
		default:
			$args['orderby'] = [
				'menu_order' => 'ASC',
				'title' => 'ASC',
			];
			break;
	}

	// Run query
	$query = new WP_Query($args);

	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			wc_get_template_part('content', 'product');
		}
	}

	wp_reset_postdata();
	wp_die();
}
add_action('wp_ajax_load_more_products', 'load_more_products_ajax');
add_action('wp_ajax_nopriv_load_more_products', 'load_more_products_ajax');



// AJAX searchbox funtionality
add_action('wp_ajax_fetch_products', 'fetch_products_callback');
add_action('wp_ajax_nopriv_fetch_products', 'fetch_products_callback');

function fetch_products_callback() {
	if (empty($_GET['query'])) {
		wp_send_json(['html' => '<p class="text-mid-gray pb-4 body-normal-regular">Produktų nerasta</p>', 'has_results' => false]);
		return;
	}

	$query = sanitize_text_field($_GET['query']);
	$product_data = [];
	$product_ids = [];

	// 1. Search by Product Name
	$name_args = [
		'post_type' => 'product',
		'posts_per_page' => 4,
		'post_status' => 'publish',
		's' => $query,
	];

	$name_query = new WP_Query($name_args);
	if ($name_query->have_posts()) {
		while ($name_query->have_posts()) {
			$name_query->the_post();
			$id = get_the_ID();
			if (!in_array($id, $product_ids)) {
				$product_ids[] = $id;
				$product_data[] = [
					'id' => $id,
					'name' => get_the_title(),
					'link' => get_permalink(),
				];
			}
		}
	}
	wp_reset_postdata();

	// 2. Search by Product Category
	$category_terms = get_terms([
		'taxonomy' => 'product_cat',
		'name__like' => $query,
		'fields' => 'ids',
	]);

	if (!is_wp_error($category_terms) && !empty($category_terms)) {
		$category_args = [
			'post_type' => 'product',
			'posts_per_page' => 10,
			'post_status' => 'publish',
			'tax_query' => [
				[
					'taxonomy' => 'product_cat',
					'field' => 'term_id',
					'terms' => $category_terms,
					'operator' => 'IN',
				],
			],
		];

		$category_query = new WP_Query($category_args);
		if ($category_query->have_posts()) {
			while ($category_query->have_posts()) {
				$category_query->the_post();
				$id = get_the_ID();
				if (!in_array($id, $product_ids)) {
					$product_ids[] = $id;
					$product_data[] = [
						'id' => $id,
						'name' => get_the_title(),
						'link' => get_permalink(),
					];
				}
			}
		}
		wp_reset_postdata();
	}

	// 3. Search by Product Attributes
	$attribute_taxonomies = wc_get_attribute_taxonomies();
	foreach ($attribute_taxonomies as $taxonomy) {
		$attribute_name = 'pa_' . $taxonomy->attribute_name;
		$attribute_terms = get_terms([
			'taxonomy' => $attribute_name,
			'name__like' => $query,
			'fields' => 'ids',
		]);

		if (!is_wp_error($attribute_terms) && !empty($attribute_terms)) {
			$attribute_args = [
				'post_type' => 'product',
				'posts_per_page' => 10,
				'post_status' => 'publish',
				'tax_query' => [
					[
						'taxonomy' => $attribute_name,
						'field' => 'term_id',
						'terms' => $attribute_terms,
						'operator' => 'IN',
					],
				],
			];

			$attribute_query = new WP_Query($attribute_args);
			if ($attribute_query->have_posts()) {
				while ($attribute_query->have_posts()) {
					$attribute_query->the_post();
					$id = get_the_ID();
					if (!in_array($id, $product_ids)) {
						$product_ids[] = $id;
						$product_data[] = [
							'id' => $id,
							'name' => get_the_title(),
							'link' => get_permalink(),
						];
					}
				}
			}
			wp_reset_postdata();
		}
	}

	// 4. Return results if any products are found
	if (!empty($product_data)) {
		ob_start();
		$products = $product_data;
		include locate_template('template-parts/search-results.php');
		$html = ob_get_clean();
		wp_send_json(['html' => $html, 'has_results' => true]);
	} else {
		wp_send_json(['html' => '<p class="text-mid-gray pb-4 body-normal-regular">Produktų nerasta</p>', 'has_results' => false]);
	}

	exit;
}

add_action('user_register', 'save_guest_wishlist_on_registration');

function save_guest_wishlist_on_registration($user_id) {
	if (!isset($_SESSION)) {
		session_start();
	}

	// Get guest wishlist from session or cookies
	$guest_wishlist = $_SESSION['guest_wishlist'] ?? [];

	// If using cookies
	if (isset($_COOKIE['guest_wishlist'])) {
		$guest_wishlist = json_decode(stripslashes($_COOKIE['guest_wishlist']), true) ?: [];
	}

	// Ensure the wishlist contains valid product IDs
	$guest_wishlist = array_unique(array_filter($guest_wishlist, 'is_numeric'));

	if (!empty($guest_wishlist)) {
		// Fetch the user's existing wishlist
		$user_wishlist = get_user_meta($user_id, '_custom_user_wishlist', true) ?: [];

		// Merge and save the wishlist
		$merged_wishlist = array_unique(array_merge($user_wishlist, $guest_wishlist));
		update_user_meta($user_id, '_custom_user_wishlist', $merged_wishlist);

		// Clear guest wishlist from session and cookies
		unset($_SESSION['guest_wishlist']);
		setcookie('guest_wishlist', '', time() - 3600, '/'); // Expire the cookie
	}
}

// Custom function to add product to wishlist
function custom_add_to_wishlist() {
	$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

	if ($product_id === 0) {
		wp_send_json_error(['message' => __('Klaida: produktas neegzistuoja', '_tw')]);
		wp_die();
	}

	$product = wc_get_product($product_id);
	$product_name = $product ? $product->get_name() : '';

	if (is_user_logged_in()) {
		$user_id = get_current_user_id();
		$wishlist = get_user_meta($user_id, '_custom_user_wishlist', true) ?: [];

		if (in_array($product_id, $wishlist)) {
			// Remove the product if it's already in the wishlist
			$wishlist = array_diff($wishlist, [$product_id]);
			update_user_meta($user_id, '_custom_user_wishlist', $wishlist);
			wp_send_json_success(['message' => sprintf(__('%s sėkmingai pašalintas iš norų sąrašo.', '_tw'), $product_name)]);
		} else {
			// Add the product if it's not in the wishlist
			$wishlist[] = $product_id;
			update_user_meta($user_id, '_custom_user_wishlist', $wishlist);
			wp_send_json_success(['message' => sprintf(__('%s sėkmingai pridėtas į norų sąrašą.', '_tw'), $product_name)]);
		}
	} else {
		if (!isset($_SESSION)) {
			session_start();
		}

		$wishlist = $_SESSION['guest_wishlist'] ?? [];

		if (in_array($product_id, $wishlist)) {
			// Remove the product if it's already in the wishlist
			$wishlist = array_diff($wishlist, [$product_id]);
			$_SESSION['guest_wishlist'] = $wishlist;
			wp_send_json_success(['message' => sprintf(__('%s sėkmingai pašalintas iš norų sąrašo.', '_tw'), $product_name)]);
		} else {
			// Add the product if it's not in the wishlist
			$wishlist[] = $product_id;
			$_SESSION['guest_wishlist'] = $wishlist;
			wp_send_json_success(['message' => sprintf(__('%s sėkmingai pridėtas į norų sąrašą.', '_tw'), $product_name)]);
		}
	}

	wp_die();
}

add_action('wp_ajax_custom_add_to_wishlist', 'custom_add_to_wishlist');
add_action('wp_ajax_nopriv_custom_add_to_wishlist', 'custom_add_to_wishlist');


function custom_get_wishlist() {
	if (is_user_logged_in()) {
		// Fetch wishlist for logged-in user
		$user_id = get_current_user_id();
		$wishlist = get_user_meta($user_id, '_custom_user_wishlist', true) ?: [];
	} else {
		// Ensure session is started
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
		}

		// Fetch wishlist from session for guest users
		$wishlist = $_SESSION['guest_wishlist'] ?? [];

		// Alternatively, check for a cookie if session is not available
		if (empty($wishlist) && isset($_COOKIE['guest_wishlist'])) {
			$wishlist = json_decode(stripslashes($_COOKIE['guest_wishlist']), true) ?: [];
		}
	}

	// Return only unique and valid product IDs that still exist and are visible
	$valid_wishlist = array_filter(array_unique($wishlist), function ($product_id) {
		$product = wc_get_product($product_id);
		return $product && $product->is_visible();
	});

	return $valid_wishlist;
}


add_action('init', function () {
	if (!isset($_SESSION)) {
		session_start();
	}
}, 1);



function custom_remove_from_wishlist() {
	$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

	if ($product_id === 0) {
		wp_send_json_error(['message' => __('Klaida: produktas neegzistuoja', '_tw')]);
		wp_die();
	}

	if (is_user_logged_in()) {
		$user_id = get_current_user_id();
		$wishlist = get_user_meta($user_id, '_custom_user_wishlist', true) ?: [];

		if (!in_array($product_id, $wishlist)) {
			wp_send_json_error(['message' => __('Produktas nėra norų sąraše', '_tw')]);
			wp_die();
		}

		$wishlist = array_diff($wishlist, [$product_id]);
		update_user_meta($user_id, '_custom_user_wishlist', $wishlist);
	} else {
		if (!isset($_SESSION)) {
			session_start();
		}

		$wishlist = $_SESSION['guest_wishlist'] ?? [];

		if (!in_array($product_id, $wishlist)) {
			wp_send_json_error(['message' => __('Produktas nėra norų sąraše', '_tw')]);
			wp_die();
		}

		$_SESSION['guest_wishlist'] = array_diff($wishlist, [$product_id]);
	}

	wp_send_json_success();
	wp_die();
}

add_action('wp_ajax_custom_remove_from_wishlist', 'custom_remove_from_wishlist');
add_action('wp_ajax_nopriv_custom_remove_from_wishlist', 'custom_remove_from_wishlist');

// Register AJAX actions for logged-in and guest users
add_action('wp_ajax_get_wishlist_count', 'get_wishlist_count');
add_action('wp_ajax_nopriv_get_wishlist_count', 'get_wishlist_count');

// AJAX handler to return wishlist count
function get_wishlist_count() {
	$wishlist = custom_get_wishlist();
	$count = count($wishlist);
	wp_send_json_success(['wishlist_count' => $count]);
}

add_filter('woocommerce_account_menu_items', 'custom_woocommerce_account_menu_items');
function custom_woocommerce_account_menu_items($items) {
	$items = array(
		'dashboard' => 'Pagrindinis',
		'orders' => 'Užsakymai',
		'edit-address' => 'Mano adresai',
		'edit-account' => 'Paskyros nustatymai',
		'customer-logout' => 'Atsijungti',
	);

	return $items;
}

add_filter('body_class', 'add_my_account_body_class');
function add_my_account_body_class($classes) {
	if (is_account_page() && is_user_logged_in()) {
		$classes[] = 'custom-my-account';
	}
	return $classes;
}

// ---------------------------------- Checkout



add_filter('woocommerce_checkout_fields', 'customize_checkout_fields');

function customize_checkout_fields($fields) {
	$fields['billing'] = array(
		'billing_first_name' => array(
			'type' => 'text',
			'required' => true,
			'label' => __('Vardas', 'woocommerce'),
			'class' => array('form-row-first'),
			'priority' => 10, // Adjust order
		),
		'billing_last_name' => array(
			'type' => 'text',
			'required' => true,
			'label' => __('Pavardė', 'woocommerce'),
			'class' => array('form-row-last'),
			'priority' => 20, // Adjust order
		),
		'billing_email' => array(
			'type' => 'email',
			'required' => true,
			'label' => __('El. paštas', 'woocommerce'),
			'class' => array('form-row-wide'),
			'priority' => 30,
		),
		'billing_phone' => array(
			'type' => 'tel',
			'required' => true,
			'label' => __('Telefonas', 'woocommerce'),
			'class' => array('form-row-wide'),
			'priority' => 40,
		),
		'billing_address_1' => array(
			'type' => 'text',
			'required' => true,
			'label' => __('Gatvė, namo numeris', 'woocommerce'),
			'class' => array('form-row-wide'),
			'priority' => 50,
		),
		'billing_city' => array(
			'type' => 'text',
			'required' => true,
			'label' => __('Miestas', 'woocommerce'),
			'class' => array('form-row-wide'),
			'priority' => 60,
		),
		'billing_postcode' => array(
			'type' => 'text',
			'required' => true,
			'label' => __('Pašto kodas', 'woocommerce'),
			'class' => array('form-row-wide'),
			'priority' => 70,
		),
		'billing_country' => array(
			'type' => 'custom', // Custom type to render plain text
			'required' => true,
			'label' => __('Šalis', 'woocommerce'),
			'class' => array('form-row-wide'),
			'priority' => 80,
			'default' => 'LT',
		),

	);

	if (!is_user_logged_in()) {
		$fields['account']['account_password'] = array(
			'type' => 'password',
			'required' => true,
			'label' => __('Slaptažodis', 'woocommerce'),
			'class' => array('form-row-wide'),
			'priority' => 90,
		);
		$fields['account']['account_password_confirm'] = array(
			'type' => 'password',
			'required' => true,
			'label' => __('Patvirtinti slaptažodį', 'woocommerce'),
			'class' => array('form-row-wide'),
			'priority' => 100,
		);
	}

	$fields['shipping'] = array(
		'shipping_country' => array(
			'type' => 'hidden',
			'default' => 'LT', // Default shipping country set to Lithuania
		)
	);

	unset($fields['shipping']['shipping_phone']);

	return $fields;
}

add_filter('woocommerce_form_field_custom', 'render_custom_plain_text_field', 10, 4);

add_filter('woocommerce_form_field_custom', 'render_custom_plain_text_field', 10, 4);

function render_custom_plain_text_field($field, $key, $args, $value) {
	if ($key === 'billing_country') {
		// Ensure a default value is used
		$value = !empty($value) ? $value : 'LT';
		// Get WooCommerce country name
		$countries = WC()->countries->get_countries();
		$country_name = isset($countries[$value]) ? $countries[$value] : __('Lietuva', 'woocommerce'); // Default to Lithuania

		$label = !empty($args['label']) ? $args['label'] : '';
		$field = '<div class="form-row ' . esc_attr(implode(' ', $args['class'])) . '">';
		$field .= '<label>' . esc_html($label) . '</label>';
		$field .= '<span class="px-3">' . esc_html($country_name) . '</span>';
		// Add a hidden input field to actually submit the value
		$field .= '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '"/>';
		$field .= '</div>';
		return $field;
	}
	return $field;
}


// Force shipping country to Lithuania
add_action('woocommerce_checkout_update_order_meta', 'force_shipping_country');

function force_shipping_country($order_id) {
	update_post_meta($order_id, '_shipping_country', 'LT');
}

add_action('woocommerce_checkout_update_order_meta', 'sync_shipping_phone_with_billing');

add_action('woocommerce_checkout_process', 'force_billing_country');

function force_billing_country() {
	if (empty($_POST['billing_country'])) {
		$_POST['billing_country'] = 'LT';
	}
}

function sync_shipping_phone_with_billing($order_id) {
	if (isset($_POST['billing_phone'])) {
		// Get the billing phone from the checkout form
		$billing_phone = sanitize_text_field($_POST['billing_phone']);

		// Update the shipping phone with the billing phone value
		update_post_meta($order_id, '_shipping_phone', $billing_phone);
	}
}

add_filter('woocommerce_default_address_fields', 'customize_default_address_fields');
function customize_default_address_fields($address_fields) {
	// Unset unnecessary fields
	unset($address_fields['address_2']);
	unset($address_fields['state']);
	unset($address_fields['country']);

	return $address_fields;
}

add_filter('woocommerce_billing_fields', 'fix_billing_validation');
function fix_billing_validation($fields) {
	if (isset($fields['billing_address_1'])) {
		$fields['billing_address_1']['required'] = true;
	}
	return $fields;
}


function customize_checkout_account_fields($args, $key, $value) {
	if (in_array($key, ['account_password', 'account_password_confirm'])) {
		if (isset($args['input_class']) && is_array($args['input_class'])) {
			$args['input_class'][] = 'checkout-form-input';
		} else {
			$args['input_class'] = ['checkout-form-input'];
		}

		if (isset($args['label_class']) && is_array($args['label_class'])) {
			$args['label_class'][] = 'checkout-form-label';
		} else {
			$args['label_class'] = ['checkout-form-label'];
		}
	}
	return $args;
}
add_filter('woocommerce_form_field_args', 'customize_checkout_account_fields', 10, 3);



// ajax checkout

function custom_ajax_add_to_cart() {
	$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
	$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

	$added = false;
	if ($product_id > 0) {
		$added = WC()->cart->add_to_cart($product_id, $quantity);
	}

	if ($added) {
		ob_start();
		woocommerce_mini_cart();
		$mini_cart = ob_get_clean();

		wp_send_json_success([
			'cart_count' => WC()->cart->get_cart_contents_count(),
			'mini_cart' => $mini_cart,
			'message' => __('Produktas sėkmingai pridėtas į krepšelį!', 'woocommerce'),
		]);
	} else {
		wp_send_json_error([
			'message' => __('Nepavyko pridėti produkto į krepšelį.', 'woocommerce'),
		]);
	}
	wp_die();
}


function custom_update_mini_cart() {
	ob_start();
	woocommerce_mini_cart();
	$mini_cart = ob_get_clean();

	wp_send_json_success([
		'mini_cart' => $mini_cart,
		'cart_count' => WC()->cart->get_cart_contents_count(),
	]);
}

function custom_ajax_remove_from_cart() {
	$cart_item_key = isset($_POST['cart_item_key']) ? sanitize_text_field($_POST['cart_item_key']) : '';

	if ($cart_item_key && WC()->cart->remove_cart_item($cart_item_key)) {
		WC()->cart->calculate_totals();

		ob_start();
		woocommerce_mini_cart();
		$mini_cart = ob_get_clean();

		wp_send_json_success([
			'mini_cart' => $mini_cart,
			'cart_count' => WC()->cart->get_cart_contents_count(),
		]);
	} else {
		wp_send_json_error(['message' => __('Nepavyko pašaltini iš krepšelio.', 'woocommerce')]);
	}

	wp_die();
}


add_action('wp_ajax_custom_ajax_add_to_cart', 'custom_ajax_add_to_cart');
add_action('wp_ajax_nopriv_custom_ajax_add_to_cart', 'custom_ajax_add_to_cart');
add_action('wp_ajax_custom_update_mini_cart', 'custom_update_mini_cart');
add_action('wp_ajax_nopriv_custom_update_mini_cart', 'custom_update_mini_cart');
add_action('wp_ajax_custom_remove_from_cart', 'custom_ajax_remove_from_cart');
add_action('wp_ajax_nopriv_custom_remove_from_cart', 'custom_ajax_remove_from_cart');

function update_cart_quantity_handler() {
	if (!isset($_POST['cart_item_key'], $_POST['quantity']) || !is_numeric($_POST['quantity'])) {
		wp_send_json_error(['message' => 'Invalid data.']);
	}

	$cart_item_key = sanitize_text_field($_POST['cart_item_key']);
	$quantity = (int) $_POST['quantity'];

	if (WC()->cart->set_quantity($cart_item_key, $quantity, true)) {
		WC()->cart->calculate_totals();

		ob_start();
		woocommerce_mini_cart();
		$mini_cart = ob_get_clean();

		ob_start();
		wc_get_template('checkout/checkout-product-list.php');
		$product_list = ob_get_clean();

		ob_start();
		wc_get_template('checkout/cart-summary-details.php');
		$cart_summary = ob_get_clean();

		wp_send_json_success([
			'subtotal' => WC()->cart->get_cart_subtotal(),
			'shipping_total' => WC()->cart->get_shipping_total(),
			'tax_total' => wc_price(WC()->cart->get_taxes_total()),
			'total' => WC()->cart->get_total(),
			'cart_count' => WC()->cart->get_cart_contents_count(),
			'mini_cart' => $mini_cart,
			'product_list' => $product_list,
			'cart_summary' => $cart_summary,
		]);
	} else {
		wp_send_json_error(['message' => 'Failed to update cart.']);
	}
}
add_action('wp_ajax_update_cart_quantity', 'update_cart_quantity_handler');
add_action('wp_ajax_nopriv_update_cart_quantity', 'update_cart_quantity_handler');

add_action('wp_ajax_get_cart_summary', 'get_cart_summary_handler');
add_action('wp_ajax_nopriv_get_cart_summary', 'get_cart_summary_handler');

function get_cart_summary_handler() {
	if (!function_exists('WC') || WC()->cart === null) {
		wp_send_json_error(['message' => 'Cart not available.']);
	}

	ob_start();

	WC()->cart->calculate_totals();

	wc_get_template('checkout/cart-summary-details.php');

	$html = ob_get_clean();

	if (!empty($html)) {
		wp_send_json_success($html);
	} else {
		wp_send_json_error(['message' => 'Failed to render cart summary.']);
	}
}

add_action('wp_ajax_remove_cart_item', 'remove_cart_item_handler');
add_action('wp_ajax_nopriv_remove_cart_item', 'remove_cart_item_handler');

function remove_cart_item_handler() {
	if (!isset($_POST['cart_item_key'])) {
		wp_send_json_error(['message' => 'Invalid request.']);
	}

	$cart_item_key = sanitize_text_field($_POST['cart_item_key']);

	$removed = WC()->cart->remove_cart_item($cart_item_key);

	if ($removed) {
		WC()->cart->calculate_totals();
		WC()->session->set('cart', WC()->cart->get_cart());


		ob_start();
		woocommerce_mini_cart();
		$mini_cart = ob_get_clean();

		ob_start();
		wc_get_template('checkout/checkout-product-list.php');
		$product_list = ob_get_clean();

		ob_start();
		wc_get_template('checkout/cart-summary-details.php');
		$cart_summary = ob_get_clean();


		wp_send_json_success([
			'cart_count' => WC()->cart->get_cart_contents_count(),
			'mini_cart' => $mini_cart,
			'product_list' => $product_list,
			'cart_summary' => $cart_summary,
		]);
	} else {
		// Debugging: Log if the item could not be removed
		error_log('Failed to remove cart item: ' . $cart_item_key);
		wp_send_json_error(['message' => __('Nepavyko pašalinti prekės iš krepšelio.', 'woocommerce')]);
	}

	wp_die();
}



add_action('template_redirect', 'redirect_empty_cart_checkout');
function redirect_empty_cart_checkout() {
	if (is_checkout() && !is_wc_endpoint_url('order-received') && WC()->cart->is_empty()) {
		wp_safe_redirect(home_url());
		exit;
	}
}


add_action('wp_ajax_apply_discount_code', 'apply_discount_code');
add_action('wp_ajax_nopriv_apply_discount_code', 'apply_discount_code');

function apply_discount_code() {
	if (!isset($_POST['discount_code'])) {
		wp_send_json_error(['message' => 'Nuolaidos kodas nepateiktas']);
	}

	$discount_code = sanitize_text_field($_POST['discount_code']);
	$coupon = new WC_Coupon($discount_code);

	if (!$coupon->get_id()) {
		wp_send_json_error(['message' => 'Toks nuolaidos kodas neegzistuoja.']);
	}

	// Check if coupon is already applied
	$applied_coupons = WC()->cart->get_applied_coupons();
	if (in_array($discount_code, $applied_coupons)) {
		wp_send_json_success(['message' => 'Nuolaidos kodas jau pritaikytas.']);
	}

	// Let WooCommerce validate the coupon
	$valid = $coupon->is_valid();

	if (is_wp_error($valid)) {
		wp_send_json_error(['message' => $valid->get_error_message()]);
	}

	// Remove any previously applied coupons if needed
	$current_applied_code = WC()->session->get('applied_discount_code');
	if (!empty($current_applied_code) && $current_applied_code !== $discount_code) {
		WC()->cart->remove_coupon($current_applied_code);
	}

	// Apply the coupon
	$applied = WC()->cart->apply_coupon($discount_code);

	if ($applied) {
		WC()->session->set('applied_discount_code', $discount_code);
		wp_send_json_success(['message' => 'Nuolaidos kodas pritaikytas sėkmingai!']);
	} else {
		// Get any error messages from WooCommerce
		$notices = wc_get_notices('error');
		$error_message = !empty($notices) ? $notices[0]['notice'] : 'Nepavyko pritaikyti nuolaidos kodo.';
		wc_clear_notices();
		wp_send_json_error(['message' => $error_message]);
	}

	wp_die();
}


add_action('wp_ajax_fetch_cart_summary', 'fetch_cart_summary');
add_action('wp_ajax_nopriv_fetch_cart_summary', 'fetch_cart_summary');

function fetch_cart_summary() {
	ob_start();
	wc_get_template('checkout/cart-summary-details.php');
	$cart_summary = ob_get_clean();

	wp_send_json_success([
		'cart_summary' => $cart_summary,
	]);
}

// Unhook default payment section rendering
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);

// remove woocommerce styles
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

add_filter('gettext', 'gettext_translate_strings', 20, 3);

function gettext_translate_strings($translated_text, $text, $domain) {
	if ($translated_text === 'Prašome pasirinkti atsiėmimo vietą') {
		$translated_text = 'Pasirinkite paštomatą';
	}
	if ($translated_text === 'Search by pickup point name, address...') {
		$translated_text = 'Ieškokite pagal paėmimo vietos pavadinimą, adresą...';
	}


	return $translated_text;
}

add_filter('woocommerce_form_field', 'add_account_form_label_class', 10, 4);

function add_account_form_label_class($field, $key, $args, $value) {
	if (isset($args['label'])) {
		$field = str_replace(
			'<label',
			'<label class="account-form-label"',
			$field
		);
	}
	return $field;
}


function replace_block_formats($init_array) {


	$style_formats = array(
		array(
			'title' => 'heading xl',
			'classes' => 'heading-xl mb-4 inline-block',
			'block' => 'span',
			'wrapper' => true,
		),
		array(
			'title' => 'heading lg',
			'classes' => 'heading-lg mb-3 inline-block',
			'block' => 'span',
			'wrapper' => true,
		),
		array(
			'title' => 'heading md',
			'classes' => 'heading-md mb-3 inline-block',
			'block' => 'span',
			'wrapper' => true,
		),
		array(
			'title' => 'heading sm',
			'classes' => 'heading-sm mb-2 inline-block',
			'block' => 'span',
			'wrapper' => true,
		),
		array(
			'title' => 'body normal regular',
			'classes' => 'body-normal-regular',
			'block' => 'span',
			'wrapper' => true,
		),
		array(
			'title' => 'body normal medium',
			'classes' => 'body-normal-medium',
			'block' => 'span',
			'wrapper' => true,
		),
		array(
			'title' => 'body normal semibold',
			'classes' => 'body-normal-semibold',
			'block' => 'span',
			'wrapper' => true,
		),
		array(
			'title' => 'body small semibold',
			'classes' => 'body-small-semibold',
			'block' => 'span',
			'wrapper' => true,
		),
		array(
			'title' => 'body small medium',
			'classes' => 'body-small-medium',
			'block' => 'span',
			'wrapper' => true,
		),
		array(
			'title' => 'body small regular',
			'classes' => 'body-small-regular',
			'block' => 'span',
			'wrapper' => true,
		),
		array(
			'title' => 'body small light',
			'classes' => 'body-small-light',
			'block' => 'span',
			'wrapper' => true,
		),
		array(
			'title' => 'body extra small regular',
			'classes' => 'body-extra-small-regular',
			'block' => 'span',
			'wrapper' => true,
		),
		array(
			'title' => 'body extra small light',
			'classes' => 'body-extra-small-light',
			'block' => 'span',
			'wrapper' => true,
		),
	);



	$init_array['style_formats'] = wp_json_encode($style_formats);

	$init_array['block_formats'] = 'paragraph=p';
	return $init_array;
}
add_filter('tiny_mce_before_init', 'replace_block_formats');


function enable_custom_styles_in_tinymce($buttons) {
	array_push($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons', 'enable_custom_styles_in_tinymce');


add_action('init', function () {
	if (is_user_logged_in() && isset($_GET['delete_account']) && $_GET['delete_account'] === 'true') {
		$user_id = get_current_user_id();
		$user = get_userdata($user_id);

		if (in_array('administrator', $user->roles)) {
			wp_redirect(add_query_arg('account_error', 'cannot_delete_admin', wc_get_page_permalink('myaccount')));
			exit;
		}

		wp_logout();
		wp_delete_user($user_id);

		wp_redirect(wc_get_page_permalink('myaccount'));
		exit;
	}
});

add_action('woocommerce_account_content', function () {
	if (isset($_GET['account_error']) && $_GET['account_error'] === 'cannot_delete_admin') {
		wc_print_notice(__('Administratoriaus paskyra negali būti ištrinta.', 'woocommerce'), 'error');
	}
});


add_action('wp_ajax_update_shipping_method', 'update_shipping_method_handler');
add_action('wp_ajax_nopriv_update_shipping_method', 'update_shipping_method_handler');

function update_shipping_method_handler() {

	if (!isset($_POST['shipping_method'])) {
		error_log('Missing shipping_method');
		wp_send_json_error(['message' => 'Invalid request.']);
		wp_die();
	}

	$shipping_method = sanitize_text_field($_POST['shipping_method']);

	$chosen_shipping_methods = WC()->session->get('chosen_shipping_methods', []);
	$chosen_shipping_methods[0] = $shipping_method;

	WC()->session->set('chosen_shipping_methods', $chosen_shipping_methods);
	WC()->cart->calculate_totals();

	ob_start();
	wc_get_template('checkout/cart-summary-details.php');
	$cart_summary = ob_get_clean();

	wp_send_json_success([
		'cart_summary' => $cart_summary,
	]);

	wp_die();
}
add_action('woocommerce_checkout_update_order_review', 'update_shipping_method_on_refresh');

function update_shipping_method_on_refresh($posted_data) {
	parse_str($posted_data, $parsed_data);

	if (isset($parsed_data['shipping_method']) && is_array($parsed_data['shipping_method'])) {
		$shipping_method = sanitize_text_field($parsed_data['shipping_method'][0]);
		$chosen_shipping_methods = WC()->session->get('chosen_shipping_methods', []);
		$chosen_shipping_methods[0] = $shipping_method;

		WC()->session->set('chosen_shipping_methods', $chosen_shipping_methods);
		WC()->cart->calculate_totals();
	}
}


// Allow SVG Uploads in WordPress
function allow_svg_upload($mimes) {
	// Add SVG to allowed mime types
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');

// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

	global $wp_version;
	if ($wp_version !== '4.7.1') {
		return $data;
	}

	$filetype = wp_check_filetype($filename, $mimes);

	return [
		'ext' => $filetype['ext'],
		'type' => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
}, 10, 4);

function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg() {
	echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
}
add_action('admin_head', 'fix_svg');


// Redirect to checkout page after login
add_filter('woocommerce_login_redirect', 'redirect_to_checkout_after_login', 10, 2);
function redirect_to_checkout_after_login($redirect, $user) {
	// Check if the user is logging in through WooCommerce login form
	$checkout_url = wc_get_checkout_url();
	return $checkout_url; // Redirect to the checkout page
}

// Redirect to checkout page after registration
add_filter('woocommerce_registration_redirect', 'redirect_to_checkout_after_registration');
function redirect_to_checkout_after_registration($redirect) {
	$checkout_url = wc_get_checkout_url();
	return $checkout_url; // Redirect to the checkout page
}

add_action('woocommerce_checkout_create_order', 'sync_shipping_with_billing_on_order_create', 10, 2);

function sync_shipping_with_billing_on_order_create($order, $data) {
	// Fields to synchronize
	$fields_to_sync = [
		'first_name',
		'last_name',
		'company',
		'address_1',
		'address_2',
		'city',
		'state',
		'postcode',
		'country',
		'phone',
	];

	foreach ($fields_to_sync as $field) {
		// Generate the method names dynamically
		$get_billing_method = "get_billing_$field";
		$set_shipping_method = "set_shipping_$field";

		// Check if the getter method exists
		if (method_exists($order, $get_billing_method) && method_exists($order, $set_shipping_method)) {
			// Copy billing field value to the corresponding shipping field
			$order->{$set_shipping_method}($order->{$get_billing_method}());
		}
	}
}

add_image_size('product-archive-thumbnail', 800, 800, true);



/**
 * Disable payments for all except 1 category and its children
 */

function disable_purchasing_except_category($is_purchasable, $product) {
	$enabled_category = 'greitu-metu-turesime';

	// Get the parent category term
	$parent_term = get_term_by('slug', $enabled_category, 'product_cat');

	if (!$parent_term) {
		return false; // Parent category doesn't exist
	}

	// Get all child categories of the parent
	$child_categories = get_terms(array(
		'taxonomy' => 'product_cat',
		'child_of' => $parent_term->term_id,
		'fields' => 'ids',
		'hide_empty' => false,
	));

	// Add parent category ID to the allowed list
	$allowed_category_ids = array_merge(array($parent_term->term_id), $child_categories);

	// Get product's category IDs
	$product_category_ids = $product->get_category_ids();

	// Check if product has any of the allowed categories
	if (array_intersect($product_category_ids, $allowed_category_ids)) {
		return true; // Allow purchase
	}

	return false; // Disable purchase
}
// add_filter('woocommerce_is_purchasable', 'disable_purchasing_except_category', 10, 2);



/**
 * Show message for non-purchasable products
 */
function show_message_for_disabled_products() {
	global $product;

	$allowed_category = 'allowed-category';

	// Check if product is NOT purchasable and NOT in the allowed category
	if (!$product->is_purchasable() && !has_term($allowed_category, 'product_cat', $product->get_id())) : ?>
		<div class="p-4 bg-rose-500 rounded-md text-white font-semibold">
			<p>Šis produktas laikinai neprieinamas pirkimui.</p>
		</div>
<?php endif;
}

add_action('woocommerce_single_product_summary', 'show_message_for_disabled_products', 31);
