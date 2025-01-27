<?php
// Template Name: Home
?>

<?php get_header(); ?>

<?php
$infos_shop = [
  ['icon' => '🚚', 'title' => 'Entrega para todo Brasil', 'description' => 'Exceto produtos perecíveis'],
  ['icon' => '🛒', 'title' => 'Pedido mínimo R$50', 'description' => 'Pedidos menores, consultar'],
  ['icon' => '🍓', 'title' => 'Linha 100% orgânica', 'description' => 'Em toda categoria Hortifruti'],
  ['icon' => '🚛', 'title' => 'Frete grátis p/ Sul', 'description' => 'em compras acima de R$150'],
  ['icon' => '🍃', 'title' => 'Por um mundo mais sustentável ', 'description' => ''],
];

$products_hortifruti = wc_get_products([
  'limit' => 5,
  'orderby' => 'date',
  'order' => 'DESC',
  'category' => ['hortifruti'],
]);

$data = [];
$data['hortifruti'] = format_products($products_hortifruti, 'hortifruti');
?>

<main id="pg-home">

  <section class="carousel-home">
    <?php
    $args = array(
      'post_type' => 'carrossel',
      'status' => 'publish',
      'posts_per_page' => -1,
      'order' => 'DESC',
    );
    $the_query = new WP_Query($args); ?>

    <?php if ($the_query->have_posts()): ?>
      <?php while ($the_query->have_posts()):
        $the_query->the_post(); ?>

        <a href="<?php the_field('link_da_imagem'); ?>">
          <img class="dkp" src="<?php the_field('imagem_-_desktop'); ?>" alt="<?php the_title(); ?>">
          <img class="mbl" src="<?php the_field('imagem_-_mobile'); ?>" alt="<?php the_title(); ?>">
        </a>

      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php else: ?>
      <p><?php _e('Desculpe, nenhum slide encontrado.'); ?></p>
    <?php endif; ?>
  </section>

  <section class="infos-shop">
    <div class="container">
      <div class="infos-list">
        <?php
        foreach ($infos_shop as $info) {
          echo '<div class="info-item">';
          echo '<span class="icon">' . esc_html($info['icon']) . '</span>';
          echo '<div class="text">';
          echo '<p class="title">' . esc_html($info['title']) . '</p>';
          echo '<p class="description">' . esc_html($info['description']) . '</p>';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
    </div>
  </section>

  <section class="products-shop">
    <div class="container">
      <div class="top">
        <h2>Orgânicos e fresquinhos </h2>
        <a href="#" class="btn">Ver todos os ítens</a>
      </div>

      <?php if (!empty($data['hortifruti'])): ?>
        <?php quitanda_product_list($data['hortifruti']); ?>
      <?php else: ?>
        <p><?php _e('Nenhum produto encontrado na categoria Hortifruti.'); ?></p>
      <?php endif; ?>
    </div>
  </section>

  <section class="banner-shop">
    <?php
    $link_do_banner = get_field('link_do_banner');
    $img_banner = get_field('img_banner');

    if ($link_do_banner && $img_banner): ?>
      <a href="<?= esc_url($link_do_banner); ?>">
        <img src="<?= esc_url($img_banner); ?>" alt="Banner Home">
      </a>
    <?php else: ?>
      <p><?php _e('Nenhum banner configurado.', 'textdomain'); ?></p>
    <?php endif; ?>
  </section>

</main>

<?php get_footer(); ?>