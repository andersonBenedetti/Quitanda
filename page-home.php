<?php
// Template Name: Home
?>

<?php get_header(); ?>

<?php
$products_new = wc_get_products([
  'limit' => 4,
  'orderby' => 'date',
  'order' => 'DESC',
]);

$data = [];

$data['lancamentos'] = format_products($products_new, 'lancamentos');

$logos = [
  ['img' => 'logo-1.webp', 'description' => 'Logo do cliente 1'],
  ['img' => 'logo-2.webp', 'description' => 'Logo do cliente 2'],
  ['img' => 'logo-3.webp', 'description' => 'Logo do cliente 3'],
  ['img' => 'logo-4.webp', 'description' => 'Logo do cliente 4'],
  ['img' => 'logo-5.webp', 'description' => 'Logo do cliente 5'],
  ['img' => 'logo-6.webp', 'description' => 'Logo do cliente 6'],
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

        <a href="<?php the_field('link_carrossel'); ?>">
          <img class="dkp" src="<?php the_field('imagem_carrossel'); ?>" alt="<?php the_title(); ?>">
          <img class="mbl" src="<?php the_field('imagem_mobile_carrossel'); ?>" alt="<?php the_title(); ?>">
        </a>

      <?php endwhile; ?>
      <?php wp_reset_postdata(); ?>
    <?php else: ?>
      <p><?php _e('Desculpe, nenhum slide encontrado.'); ?></p>
    <?php endif; ?>
  </section>

  <section class="products-home">
    <div class="list-home container">
      <h2 class="title">Produtos em <span class="highlight">destaque</span></h2>
      <?php supelpack_product_list($data['lancamentos']); ?>
      <a href="#" class="btn">
        Ver todos os produtos
        <?php include get_stylesheet_directory() . '/img/icons/arrow-btn.svg'; ?>
      </a>
    </div>
  </section>

  <section class="logos-home container">
    <div class="top">
      <h2 class="title"><span class="highlight">Confiabilidade</span> comprovada por grandes marcas</h2>
      <p>Ao longo dos anos, grandes empresas confiaram em nosso expertise para transformar suas ideias em
        resultados reais, acompanhe algumas delas:</p>
    </div>
    <div class="carousel-logos">
      <?php
      foreach ($logos as $logo): ?>
        <div class="logo">
          <img src="<?php echo get_stylesheet_directory_uri() . "/img/clientes/{$logo['img']}"; ?>"
            alt="<?php echo esc_attr($logo['description']); ?>">
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <?php include(TEMPLATEPATH . '/inc/Feedbacks.php'); ?>

  <section class="cards-home container">
    <div>
      <h2 class="title">Variedade e qualidade para <span class="highlight">padarias, restaurantes, e muito
          mais.</span></h2>
      <div class="cards">
        <a class="card" href="#">
          <p>Para personalizar<span>ver produtos</span></p>
        </a>
        <a class="card" href="#">
          <p>Para o seu delivery<span>ver produtos</span></p>
        </a>
        <a class="card" href="#">
          <p>Para cuidar da higiene<span>ver produtos</span></p>
        </a>
      </div>
    </div>
    <a class="card last" href="#">
      <p>Para padaria & confeitaria<span>ver produtos</span></p>
    </a>
  </section>

  <section class="about-home container">
    <img class="img" src="<?php echo get_stylesheet_directory_uri(); ?>/img/sobre.webp" alt="Sobre a Supelpack">

    <div class="content">
      <h2 class="title">Sobre a <span class="highlight">Supelpack</span></h2>
      <p>
        A Supelpack Embalagens está há mais de 15 anos no mercado, oferecendo as melhores embalagens para você
        que não quer ver seu produto passando despercebido aos olhos do consumidor.
      </p>
      <p>
        A embalagem é uma das grandes ferramentas para o sucesso de um produto, além de ser uma poderosa
        ferramenta de marketing. Quem nunca comprou um produto apenas pela embalagem, não é mesmo?!
      </p>
      <a href="#" class="btn">
        Continue lendo
        <?php include get_stylesheet_directory() . '/img/icons/arrow-btn.svg'; ?>
      </a>
    </div>
  </section>

  <section class="social container">
    <div class="top">
      <div>
        <img class="img" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-social.webp" alt="Logo Supelpack">
        <p>
          <span>SupelPack Embalagens</span>
          Embalagens que reforçam a sua marca. Há +15 anos no mercado.
        </p>
      </div>
      <a href="#" class="btn">
        <?php include get_stylesheet_directory() . '/img/icons/insta-social.svg'; ?>
        Seguir
      </a>
    </div>
  </section>

</main>

<?php get_footer(); ?>