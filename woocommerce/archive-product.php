<?php get_header(); ?>

<main id="archive-product">

  <section class="intro">
    <div class="img">
      <?php
      $queried_object = get_queried_object();
      if ($queried_object && isset($queried_object->term_id)) {
        $image = get_field('imagem_categoria', 'product_cat_' . $queried_object->term_id);

        if ($image) {
          echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($queried_object->name) . '">';
        }
      }
      ?>
    </div>
    <div class="content">
      <h1>
        <?php
        if (is_shop()) {
          echo 'Loja';
        } else {
          single_cat_title();
        }
        ?>
      </h1>
      <a href="#" class="btn secondary">
        Ver todos os produtos
        <?php include get_stylesheet_directory() . '/img/icons/arrow-btn.svg'; ?>
      </a>
    </div>
  </section>

  <section class="intro-store container">
    <p>Para o seu delivery</p>
    <?php echo do_shortcode('[fibosearch]'); ?>
  </section>

  <?php
  $products = [];
  if (have_posts()) {
    while (have_posts()) {
      the_post();
      $products[] = wc_get_product(get_the_ID());
    }
  }

  $data = [];
  $data['products'] = format_products($products);
  ?>

  <section class="store-top container">
    <p class="products-count">
      <?php
      echo "<span>" . count($products) . "</span>" . " produtos ";
      ?>
    </p>
    <?php woocommerce_catalog_ordering(); ?>
  </section>

  <section class="products-store container">
    <div class="first-column">
      <div class="filter-list">
        <?php
        $product_categories = get_categories(
          array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
          )
        );

        if (!empty($product_categories)) {
          echo '<ul class="category-list desktop-view">';
          echo '<li>Categorias</li>';

          $current_category = get_queried_object();

          foreach ($product_categories as $category) {
            $class = '';
            if ($current_category && $current_category->term_id === $category->term_id) {
              $class = ' class="current-category"';
            }
            echo '<li' . $class . '><a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a></li>';
          }

          echo '</ul>';


          echo '<select class="mobile-view" onchange="location = this.value;">';
          echo '<option value="">Selecione uma categoria</option>';
          foreach ($product_categories as $category) {
            echo '<option value="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</option>';
          }
          echo '</select>';
        } else {
          echo '<p>Não foram encontradas categorias de produtos.</p>';
        }
        ?>
      </div>
      <div class="query-content">
        <h2>Em dúvida do que orçar? </h2>
        <p>Entre em contato e solicite seu orçamento personalizado com a nossa equipe!</p>
        <a href="#" class="btn secondary">
          Fale conosco
          <?php include get_stylesheet_directory() . '/img/icons/whats-btn.svg'; ?>
        </a>
      </div>
    </div>

    <?php if (!empty($data['products'][0])) { ?>
      <div class="last-column">
        <?php supelpack_product_list($data['products']); ?>
        <?= get_the_posts_pagination(); ?>
      </div>
    </section>
  <?php } else { ?>
    <section class="no-results">
      <div class="container">
        <p>Nenhum resultado para a sua busca.</p>
        <p>Confira outras categorias ou redefina os filtros para encontrar o produto ideal.</p>
      </div>
    </section>
  <?php } ?>

</main>

<?php get_footer(); ?>