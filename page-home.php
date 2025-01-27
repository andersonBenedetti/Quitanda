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

</main>

<?php get_footer(); ?>