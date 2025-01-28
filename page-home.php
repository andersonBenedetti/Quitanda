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

$cat_items = [
    ['icon' => '🍎🥦', 'title' => 'Hortifruti', 'link' => '#'],
    ['icon' => '🫘🧃', 'title' => 'Mercearia', 'link' => '#'],
    ['icon' => '🥪🍪', 'title' => 'Padaria', 'link' => '#'],
    ['icon' => '🧼🛁', 'title' => 'Higiene Pessoal', 'link' => '#'],
    ['icon' => '🧻🧽', 'title' => 'Limpeza', 'link' => '#'],
    ['icon' => '🥛🧀', 'title' => 'Laticínios', 'link' => '#'],
    ['icon' => '🥩🍗', 'title' => 'Açougue', 'link' => '#'],
    ['icon' => '🍷🥤', 'title' => 'Bebidas', 'link' => '#'],
    ['icon' => '💄🧴', 'title' => 'Cosméticos', 'link' => '#'],
    ['icon' => '👃💆🏻‍♀️', 'title' => 'Aromaterapia', 'link' => '#'],
    ['icon' => '🍴✂️', 'title' => 'Bazar', 'link' => '#'],
    ['icon' => '🧸🍼', 'title' => 'Infantil', 'link' => '#'],
];

$products_hortifruti = wc_get_products([
    'limit' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
    'category' => ['hortifruti'],
]);

$products_mercearia = wc_get_products([
    'limit' => 5,
    'orderby' => 'date',
    'order' => 'DESC',
    'category' => ['mercearia'],
]);

$data = [];
$data['hortifruti'] = format_products($products_hortifruti);
$data['mercearia'] = format_products($products_mercearia);
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
                <h2>Orgânicos e fresquinhos</h2>
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

    <section class="products-shop secondary">
        <div class="container">
            <div class="top">
                <h2>Mercearia | Tudo para sua despensa</h2>
                <a href="#" class="btn">Ver todos os ítens</a>
            </div>

            <?php if (!empty($data['mercearia'])): ?>
            <?php quitanda_product_list($data['mercearia']); ?>
            <?php else: ?>
            <p><?php _e('Nenhum produto encontrado na categoria Mercearia.'); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="categories-list">
        <div class="container">
            <h2>Procure por categoria</h2>

            <div class="list">
                <?php foreach ($cat_items as $item): ?>
                <a href="<?= esc_url($item['link']); ?>" class="item">
                    <p class="icon"><?= esc_html($item['icon']); ?></p>
                    <h3 class="title"><?= esc_html($item['title']); ?></h3>
                    <span class="view-all">ver todos</span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="feedback-section">
        <div class="container">
            <h2>Feedback de quem consome e aprova! </h2>

            <?php
            $args = array(
                'post_type' => 'feedbacks',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'order' => 'DESC',
            );

            $the_query = new WP_Query($args); ?>

            <?php if ($the_query->have_posts()): ?>
            <div class="feedback-list carousel-feedback">
                <?php while ($the_query->have_posts()):
                        $the_query->the_post(); ?>
                <div class="feedback-item">
                    <div class="feedback-header">
                        <?php if (has_post_thumbnail()): ?>
                        <img class="feedback-img"
                            src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>"
                            alt="<?php the_title(); ?>">
                        <?php endif; ?>
                        <div class="feedback-info">
                            <h3 class="feedback-title"><?php the_title(); ?></h3>
                            <span class="feedback-stars">
                                <?php
                                        $stars = get_field('quantidade_de_estrelas');

                                        for ($i = 0; $i < $stars; $i++) {
                                            echo '⭐';
                                        }
                                        ?>
                            </span>
                        </div>
                    </div>
                    <p class="feedback-comment"><?php the_field('comentario'); ?></p>
                </div>
                <?php endwhile; ?>
            </div>
            <?php else: ?>
            <p class="no-feedback"><?php _e('Desculpe, nenhum feedback encontrado.', 'textdomain'); ?></p>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>