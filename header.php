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

        <header id="header">
            <p class="text-top">🍎 Frete grátis acima de R$500,00 🍎</p>
            <div class="container">
                <div class="content">
                    <a href="/" class="logo">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-header.webp"
                            alt="Logo Quitanda">
                    </a>
                    <?php echo do_shortcode('[fibosearch]'); ?>
                    <a href="#" class="user">
                        <?php include get_stylesheet_directory() . '/img/icons/user.svg'; ?>
                    </a>
                    <?php echo do_shortcode('[xoo_wsc_cart]'); ?>
                </div>
            </div>
        </header>