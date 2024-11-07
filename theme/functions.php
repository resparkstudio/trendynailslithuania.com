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
	function _tw_setup()
	{
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
function _tw_widgets_init()
{
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
function _tw_scripts()
{

	wp_enqueue_style('_tw-style', get_stylesheet_uri(), array(), _TW_VERSION);
	wp_enqueue_style('swiper-css', get_theme_root_uri() . '/_tw/node_modules/swiper/swiper-bundle.min.css');

	wp_enqueue_script('_tw-script', get_template_directory_uri() . '/js/script.min.js', array(), _TW_VERSION, true);

	wp_localize_script('_tw-script', 'ajax_add_to_cart_params', array(
		'ajax_url' => admin_url('admin-ajax.php')
	));

	wp_localize_script('_tw-script', 'ajax_product_archive_params', array('ajax_url' => admin_url('admin-ajax.php')));

	wp_localize_script('_tw-script', 'checkoutData', [
		'checkoutUrl' => esc_url(wc_get_checkout_url())
	]);

	wp_localize_script('_tw-script', 'ajax_product_archive_params', array(
		'ajax_url' => admin_url('admin-ajax.php'),
		'action' => 'fetch_products'
	));

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', '_tw_scripts');

/**
 * Enqueue the block editor script.
 */
function _tw_enqueue_block_editor_script()
{
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
function _tw_tinymce_add_class($settings)
{
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

function theme_setup()
{
	add_theme_support("custom-logo", array(

	));
}
add_action('after_setup_theme', 'theme_setup');

// Prevent from accesing to certain pages
function redirect_site_settings_page()
{
	if (is_page('footeris') || is_page('socialine-medija')) {
		wp_redirect(get_permalink(get_page_by_path('titulinis')->ID));
		exit;
	}
}
add_action('template_redirect', 'redirect_site_settings_page');


// Make some templates not indexible by the browsers
// TODO if actuallly not appearing in search
function add_noindex_to_specific_templates()
{
	if (is_page_template('soc-media.php') || is_page_template('footer.php')) {
		echo '<meta name="robots" content="noindex, nofollow">';
	}
}

//----------------------------------- ACF

if (function_exists('acf_add_options_page')) {

	acf_add_options_page(array(
		'page_title' => 'Kontaktai',
		'menu_title' => 'Kontaktai',
		'menu_slug' => 'contact-general-settings',
		'capability' => 'edit_posts',
		'redirect' => false,
		'icon_url' => 'dashicons-admin-site'
	));

}

add_action('wp_head', 'add_noindex_to_specific_templates');

//----------------------------------- WOOCOMMERCE
// add woocommerce theme support
function _tw_add_woocommerce_support()
{
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', '_tw_add_woocommerce_support');

// Add popular products checkbox to woo settings
function add_popular_product_checkbox()
{
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

function remove_product_tabs($tabs)
{
	unset($tabs['description']);            // Remove the description tab
	unset($tabs['additional_information']); // Remove the additional information tab
	unset($tabs['reviews']);                // Remove the reviews tab
	return $tabs;
}


// Save checkbox
function save_popular_product_checkbox($post_id)
{
	$populiariausi = isset($_POST['_populiariausi']) ? 'yes' : 'no';
	update_post_meta($post_id, '_populiariausi', $populiariausi);
}

add_action('woocommerce_process_product_meta', 'save_popular_product_checkbox');
add_action('woocommerce_product_options_general_product_data', 'add_popular_product_checkbox');


// Add "category display in main page" field to product category settings
// Add checkbox to the category edit screen
function add_popular_category_checkbox($term)
{
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
function add_popular_category_checkbox_new($term)
{
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

function save_popular_category_checkbox($term_id)
{
	$display = isset($_POST['_display_in_section']) ? 'yes' : 'no';
	update_term_meta($term_id, '_display_in_section', $display);
}
add_action('product_cat_edit_form_fields', 'add_popular_category_checkbox', 10, 2);
add_action('product_cat_add_form_fields', 'add_popular_category_checkbox_new', 10, 2);
add_action('edited_product_cat', 'save_popular_category_checkbox', 10, 2);
add_action('create_product_cat', 'save_popular_category_checkbox', 10, 2);

// display descrption in single product template
function display_full_product_description()
{
	global $post;
	echo '<div class="woocommerce-product-description mb-10 body-small-regular text-deep-dark-gray">';
	echo apply_filters('the_content', $post->post_content); // Display the full description
	echo '</div>';
}
add_action('woocommerce_single_product_summary', 'display_full_product_description', 25);

// AJAX cart logic
function custom_ajax_add_to_cart()
{
	$product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
	$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

	$added = false;
	if ($product_id > 0) {
		$added = WC()->cart->add_to_cart($product_id, $quantity);
	}

	if ($added) {
		wp_send_json_success([
			'cart_count' => WC()->cart->get_cart_contents_count(),
			'message' => __('Product added to cart successfully!', 'woocommerce')
		]);
	} else {
		wp_send_json_error([
			'message' => __('Could not add product to cart.', 'woocommerce')
		]);
	}
	wp_die();
}

function custom_update_mini_cart()
{
	ob_start();
	woocommerce_mini_cart();
	$mini_cart = ob_get_clean();

	wp_send_json_success([
		'mini_cart' => $mini_cart,
		'cart_count' => WC()->cart->get_cart_contents_count(),
	]);
}


function custom_ajax_remove_from_cart()
{
	// Check if cart item key is set
	$cart_item_key = isset($_POST['cart_item_key']) ? sanitize_text_field($_POST['cart_item_key']) : '';

	// Attempt to remove the item from the cart
	if ($cart_item_key && WC()->cart->remove_cart_item($cart_item_key)) {
		// Recalculate totals after item removal
		WC()->cart->calculate_totals();

		// Capture updated mini-cart HTML to send in response
		ob_start();
		woocommerce_mini_cart();
		$mini_cart = ob_get_clean();

		wp_send_json_success([
			'mini_cart' => $mini_cart,
			'cart_count' => WC()->cart->get_cart_contents_count(),
		]);
	} else {
		wp_send_json_error(['message' => __('Failed to remove item from cart.', 'woocommerce')]);
	}

	wp_die();
}


add_action('wp_ajax_custom_ajax_add_to_cart', 'custom_ajax_add_to_cart');
add_action('wp_ajax_nopriv_custom_ajax_add_to_cart', 'custom_ajax_add_to_cart');
add_action('wp_ajax_custom_update_mini_cart', 'custom_update_mini_cart');
add_action('wp_ajax_nopriv_custom_update_mini_cart', 'custom_update_mini_cart');
add_action('wp_ajax_custom_remove_from_cart', 'custom_ajax_remove_from_cart');
add_action('wp_ajax_nopriv_custom_remove_from_cart', 'custom_ajax_remove_from_cart');

// remove woocommerce styles
add_filter('woocommerce_enqueue_styles', '__return_empty_array');


// Remove WooCommerce sale flash
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// Product archive
// Handle sorting via AJAX
function filter_products()
{
	$orderby = $_GET['orderby'] ?? 'popularity';
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

// Function to modify WooCommerce archive query based on URL parameters
function modify_woocommerce_archive_query($query)
{
	if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category())) {
		$orderby = $_GET['orderby'] ?? 'popularity';

		// Apply sorting based on the orderby parameter
		if ($orderby === 'price-asc') {
			$query->set('orderby', 'meta_value_num');
			$query->set('meta_key', '_price');
			$query->set('order', 'ASC');
		} elseif ($orderby === 'price-desc') {
			$query->set('orderby', 'meta_value_num');
			$query->set('meta_key', '_price');
			$query->set('order', 'DESC');
		} else {
			$query->set('orderby', $orderby);
			$query->set('order', 'ASC');
		}
	}
}
add_action('pre_get_posts', 'modify_woocommerce_archive_query');


// Remove WooCommerce Notices Wrapper
function remove_woocommerce_notices()
{
	remove_action('woocommerce_before_main_content', 'woocommerce_output_all_notices', 10);
}
add_action('wp', 'remove_woocommerce_notices');
add_filter('woocommerce_cart_item_removed_notice_type', '__return_false');



// Remove pagination controls from WooCommerce
remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);


// Remove pagination and load all products in WooCommerce archives
function load_all_products_in_archive($query)
{
	if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category() || is_product_tag())) {
		$query->set('posts_per_page', -1);
	}
}
add_action('pre_get_posts', 'load_all_products_in_archive');


// AJAX searchbox funtionality
add_action('wp_ajax_fetch_products', 'fetch_products_callback');
add_action('wp_ajax_nopriv_fetch_products', 'fetch_products_callback');

function fetch_products_callback()
{
	if (empty($_GET['query'])) {
		wp_send_json(['html' => '<p class=" text-mid-gray p-2 body-normal-regular">Produktų nerasta</p>']);
		return;
	}

	$query = sanitize_text_field($_GET['query']);
	$product_data = [];
	$product_ids = [];

	// 1. Search by Product Name
	$name_args = [
		'post_type' => 'product',
		'posts_per_page' => 10,
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
		wp_send_json(['html' => $html]);
	} else {
		wp_send_json(['html' => '<p class=" text-mid-gray p-2 body-normal-regular">Produktų nerasta</p>']);
	}

	exit;
}
