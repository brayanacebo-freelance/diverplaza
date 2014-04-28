
<body>
    <div id="main_header">
        <header>
            <figure id="logo">
            <a href="<?php echo site_url('home') ?>"><img src="<?php echo site_url('addons/shared_addons/themes/diverplaza/img/misc/logo.png'); ?>" alt="Logo"></a>
            </figure>
            <nav id="nav_redes">
                <div class="title_nav_redes">
                    Comunidad Virtual Diverplaza:
                </div>
                <ul>
                    <li><a class="face" href="https://www.facebook.com/DiverPlazaCC" target="_blank"></a></li>
                    <li><a class="twit" href="https://twitter.com/DiverPlazaCC" target="_blank"></a></li>
                    <li><a class="fore" href="https://es.foursquare.com/v/diver-plaza/4bec6966c43f2d7fc0d9dbd9" target="_blank"></a></li>
                </ul>
            </nav>
        </header>
        <nav class="nav_general">
            <div id="dl-menu" class="dl-menuwrapper">
                <button class="dl-trigger">Open Menu</button>
                <ul class="dl-menu">
                    <li><a href="home">Inicio</a></li>
                <li><a href="conocenos">Conócenos</a></li>
                <li><a href="tiendas">Tiendas</a></li>
                <li><a href="diversion">Diversión</a></li>
                <li><a href="servicios">Servicios</a></li>
                <li><a href="contacto">Contáctenos</a></li>
</ul>
</div><!-- /dl-menuwrapper --><!-- /container -->
</nav>
</div>

<section id="tiendas_2" >
    <article class="detalle_tiendas">
        <img src="<?php echo $store->image; ?>" alt="" class="detalle_logo">
        <h3 class="detalle_titulo"><?php echo $store->name; ?></h3>
        <p><?php echo $store->description; ?></p>
        <br>
        <a href="#detalle_main"><img src="<?php echo site_url('addons/shared_addons/themes/diverplaza/img/misc/abajo_detalle.png'); ?>" alt=""></a>
        <div id="detalle_main">
            <div class="detalle_img">
                <div class="detalle_img">
                    <div class="swiper-container" style="height: 798px">
                        <div class="swiper-wrapper">
                        <?php foreach ($images as $item): ?>
                            <div class="swiper-slide blue-slide">
                                <img src="<?php echo val_image($item->path); ?>" alt="<?php echo $store->name; ?>">
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <div class="pagination"></div>
                    </div>
                </div>
            </div>
            <div class="detalle_info">
                <h3>Hola</h3>
                <?php echo $store->introduction; ?>
            </div>
            <a href="#main_header" style="position:absolute; bottom:0; right:0;"><img src="<?php echo site_url('addons/shared_addons/themes/diverplaza/img/misc/subir_detalle.png'); ?>" alt=""></a>
        </div>
    </article>

</div>
</section>
</body>
