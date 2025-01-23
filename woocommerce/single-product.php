<?php get_header(); ?>

<?php
function format_single_product($id)
{
    $product = wc_get_product($id);

    return [
        'id' => $id,
        'name' => $product->get_name(),
        'link' => $product->get_permalink(),
        'description' => $product->get_description(),
        'short_description' => $product->get_short_description(),
    ];
}

?>

<main id="single-product">

    <div class="notification">
        <?php wc_print_notices(); ?>
    </div>

    <section class="content-product container">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $produto = format_single_product(get_the_ID());
                ?>
                <div class="product-gallery">
                    <?php echo do_shortcode('[wcgs_gallery_slider]'); ?>
                </div>
                <div class="product-detail">
                    <h1><?= $produto['name']; ?></h1>
                    <p class="short-description"><?= wp_kses_post($produto['short_description']); ?></p>
                    <?php woocommerce_template_single_add_to_cart() ?>
                    <a class="btn-table" href="#tabela-de-codigo-e-tamanhos">TABELA DE CÓDIGO E TAMANHOS</a>
                    <div>
                        <div class="info-store">
                            <div class="icon">
                                <?php include get_stylesheet_directory() . '/img/icons/frete.svg'; ?>
                            </div>
                            <p>Frete grátis em pedidos acima de R$100</p>
                        </div>
                        <div class="info-store">
                            <div class="icon">
                                <?php include get_stylesheet_directory() . '/img/icons/cartao.svg'; ?>
                            </div>
                            <p>Pagamento facilitado</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="product-tabs container" id="tabela-de-codigo-e-tamanhos">
                <ul class="tabs-nav">
                    <?php if (!empty($produto['description'])): ?>
                        <li class="tab-link active" data-tab="description">TABELA DE CÓDIGO E TAMANHOS</li>
                    <?php endif; ?>

                    <?php
                    $tabela_de_medidas = get_field('tabela_de_medidas', $produto['id']);
                    if (!empty($tabela_de_medidas)): ?>
                        <li class="tab-link <?= empty($produto['description']) ? 'active' : ''; ?>" data-tab="tabela-de-medidas">
                            Tabela de medidas</li>
                    <?php endif; ?>
                </ul>

                <div class="tabs-content">
                    <?php if (!empty($produto['description'])): ?>
                        <div id="description" class="tab-content active">
                            <?= wp_kses_post($produto['description']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($tabela_de_medidas)): ?>
                        <div id="tabela-de-medidas" class="tab-content <?= empty($produto['description']) ? 'active' : ''; ?>">
                            <?= wp_kses_post($tabela_de_medidas); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

        <?php }
        } ?>

    <?php
    $related_ids = get_post_meta($produto['id'], '_upsell_ids', true);
    $related_products = [];

    if (!empty($related_ids)) {
        foreach ($related_ids as $product_id) {
            $related_products[] = wc_get_product($product_id);
        }
    }

    if (!empty($related_products)) {
        $related = format_products($related_products);
        ?>

        <section class="related-list">
            <h2 class="title">Produtos relacionados</h2>
            <div class="container">
                <?php supelpack_product_list($related); ?>
            </div>
        </section>

        <?php
    }
    ?>

</main>

<?php get_footer(); ?>