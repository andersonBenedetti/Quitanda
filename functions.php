<?php
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

function quitanda_add_woocommerce_support()
{
	add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'quitanda_add_woocommerce_support');

add_theme_support('post-thumbnails');

register_nav_menus([
	'categorias' => 'Categorias'
]);

function quitanda_loop_shop_per_page()
{
	return 12;
}
add_filter('loop_shop_per_page', 'quitanda_loop_shop_per_page');

function format_products($products)
{
	$products_final = [];
	foreach ($products as $product) {
		$products_final[] = [
			'name' => $product->get_name(),
			'img' => wp_get_attachment_image_src($product->get_image_id())[0],
			'link' => $product->get_permalink(),
			'price' => $product->get_price_html(), // Preço formatado pelo WooCommerce
		];
	}
	return $products_final;
}

function quitanda_product_list($products)
{
	echo '<ul class="products-list">';
	foreach ($products as $product) { ?>
		<li class="product-item">
			<a href="<?= esc_url($product['link']); ?>">
				<div class="product-info">
					<img src="<?= esc_url($product['img']); ?>" alt="<?= esc_attr($product['name']); ?>" />
					<h3><?= esc_html($product['name']); ?></h3>
					<p class="product-price"><?= $product['price']; ?></p>
					<span class="btn btn-product">Ver mais detalhes</span>
				</div>
			</a>
		</li>
	<?php }
	echo '</ul>';
}

function custom_post_type($post_type, $singular_name, $plural_name)
{
	$labels = array(
		'name' => $plural_name,
		'singular_name' => $singular_name,
		'menu_name' => $plural_name,
		'add_new' => 'Adicionar Novo',
		'add_new_item' => 'Adicionar Novo',
		'edit' => 'Editar',
		'edit_item' => 'Editar',
		'new_item' => 'Novo',
		'view' => 'Ver',
		'view_item' => 'Ver',
		'search_items' => 'Procurar',
		'not_found' => 'Nenhum slide encontrado',
		'not_found_in_trash' => 'Nenhum slide encontrado no Lixo',
	);

	$args = array(
		'label' => $plural_name,
		'description' => $plural_name,
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'capability_type' => 'post',
		'map_meta_cap' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => $post_type, 'with_front' => true),
		'query_var' => true,
		'supports' => array('title', 'thumbnail'),
		'labels' => $labels,
	);

	register_post_type($post_type, $args);
}

add_action('init', function () {
	custom_post_type('carrossel', 'Carrossel', 'Carrossel');

});

function enqueue_slick_scripts()
{
	wp_enqueue_style('slick-carousel-css', get_template_directory_uri() . '/js/slick-1.8.1/slick/slick.css', array(), '1.8.1');

	wp_enqueue_script('slick-carousel-js', get_template_directory_uri() . '/js/slick-1.8.1/slick/slick.min.js', array('jquery'), '1.8.1', true);
}

add_action('wp_enqueue_scripts', 'enqueue_slick_scripts');

add_action('wp_loaded', function () {
	if (isset($_POST['update_quantity']) && isset($_POST['cart_item_key'])) {
		$cart_item_key = sanitize_text_field($_POST['cart_item_key']);
		$action = sanitize_text_field($_POST['update_quantity']);

		$cart = WC()->cart->get_cart();
		if (isset($cart[$cart_item_key])) {
			$current_quantity = $cart[$cart_item_key]['quantity'];
			if ($action === 'increase') {
				WC()->cart->set_quantity($cart_item_key, $current_quantity + 1);
			} elseif ($action === 'decrease') {
				if ($current_quantity > 1) {
					WC()->cart->set_quantity($cart_item_key, $current_quantity - 1);
				} else {
					WC()->cart->remove_cart_item($cart_item_key);
				}
			}
		}
		wp_safe_redirect(wc_get_cart_url());
		exit;
	}
});