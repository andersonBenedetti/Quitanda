<?php
// Template Name: Home
?>

<?php get_header(); ?>

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

</main>

<?php get_footer(); ?>