<footer id="footer">

</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.tab-link');
        const contents = document.querySelectorAll('.tab-content');
        const button = document.querySelector('.single_add_to_cart_button');

        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                tabs.forEach(t => t.classList.remove('active'));

                contents.forEach(content => content.classList.remove('active'));

                this.classList.add('active');

                const tabId = this.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

        if (button) {
            button.addEventListener('click', function () {
                if (!button.classList.contains('loading')) {
                    button.classList.add('loading');

                    const spinner = document.createElement('div');
                    spinner.classList.add('loading-spinner');

                    button.appendChild(spinner);

                    setTimeout(function () {
                        button.removeChild(spinner);
                        button.classList.remove('loading');
                    }, 3000);
                }
            });
        }

        // Configuração do submenu para dispositivos móveis
        const menuItems = document.querySelectorAll('.menu-item-has-children > a');
        menuItems.forEach(item => {
            item.addEventListener('click', function (event) {
                event.preventDefault();
                const parent = item.parentElement;

                // Fecha outros submenus abertos ao abrir um novo
                menuItems.forEach(i => {
                    const otherParent = i.parentElement;
                    if (otherParent !== parent) {
                        otherParent.classList.remove('open');
                    }
                });

                // Alterna a visibilidade do submenu clicado
                parent.classList.toggle('open');
            });
        });
    });

    const app = new Vue({
        el: '#app',
        data: {
            activeMenu: false,
        },
        created() { },
        methods: {}
    });
</script>

</div>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/slider.js"></script>
<?php wp_footer(); ?>
</body>

</html>