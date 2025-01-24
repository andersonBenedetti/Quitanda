<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
    <title>
        <?php if (is_front_page() || is_home()) {
            echo get_bloginfo('name');
        } else {
            echo wp_title('');
        } ?>
    </title>
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <script src="<?php echo get_template_directory_uri(); ?>/js/vue.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fustat:wght@200..800&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>

<body>
    <div id="app">

        <?php
        $menu_items = [
            ['label' => 'Todos os produtos', 'url' => '/loja'],
            ['label' => 'Mercearia', 'url' => '/categoria-produto/mercearia'],
            ['label' => 'Hortifruti', 'url' => '/categoria-produto/hortifruti'],
            ['label' => 'Padaria', 'url' => '/categoria-produto/padaria'],
            ['label' => 'Higiene pessoal', 'url' => '/categoria-produto/higiene-pessoal'],
            ['label' => 'Limpeza', 'url' => '/categoria-produto/limpeza'],
            ['label' => 'Laticínios', 'url' => '/categoria-produto/laticinios'],
            ['label' => 'Açougue', 'url' => '/categoria-produto/acougue'],
            ['label' => 'Bebidas', 'url' => '/categoria-produto/bebidas'],
            ['label' => 'Cosméticos', 'url' => '/categoria-produto/cosmeticos'],
            ['label' => 'Aromaterapia', 'url' => '/categoria-produto/aromaterapia'],
            ['label' => 'Bazar', 'url' => '/categoria-produto/bazar'],
            ['label' => 'Infantil', 'url' => '/categoria-produto/infantil']
        ];
        ?>

        <header id="header">
            <p class="text-top">🍎 Frete grátis acima de R$500,00 🍎</p>
            <div class="container">
                <div class="content">
                    <a href="/" class="logo">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-header.webp"
                            alt="Quitanda - Voltar para página inicial" loading="lazy">
                    </a>
                    <div class="search-desk">
                        <?php echo do_shortcode('[fibosearch]'); ?>
                    </div>
                    <div class="links">
                        <a href="#" class="user" aria-label="Área do Usuário">
                            <?php include get_stylesheet_directory() . '/img/icons/user.svg'; ?>
                        </a>
                        <?php echo do_shortcode('[xoo_wsc_cart]'); ?>
                        <div class="menu-header" :class="{ active: activeMenu }">
                            <button class="btn-menu" @click="activeMenu = !activeMenu" aria-label="Abrir menu"
                                aria-expanded="false">
                                <span></span>
                            </button>
                            <ul class="menu-list" id="menu">
                                <?php
                                foreach ($menu_items as $item) {
                                    echo '<li><a href="' . esc_url($item['url']) . '" aria-label="' . esc_html($item['label']) . '">' . esc_html($item['label']) . '</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="search-mobile">
                    <?php echo do_shortcode('[fibosearch]'); ?>
                </div>

                <ul class="menu-desk">
                    <?php
                    foreach ($menu_items as $item) {
                        echo '<li><a href="' . esc_url($item['url']) . '" aria-label="' . esc_html($item['label']) . '">' . esc_html($item['label']) . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </header>