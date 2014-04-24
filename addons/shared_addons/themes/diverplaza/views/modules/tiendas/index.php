
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
                        <li><a href="index.html">Inicio</a></li>
                        <li><a href="conocenos.html">Conocenos</a></li>
                        <li><a href="tiendas.html">Tiendas</a></li>
                        <li><a href="zonaD.html">Diversion</a></li>
                        <!-- 					<li><a href="#">Eventos</a></li>
                                                                <li><a href="#">Divercliente</a></li> -->
                        <li><a href="servicios.html">Servicios</a></li>
                        <li><a href="contacto.html">Contáctenos</a></li>
                    </ul>
                </div><!-- /dl-menuwrapper --><!-- /container -->
            </nav>
        </div>
        <h1 class="main_titulos">NUESTRAS <strong>TIENDAS</strong></h1>
        <section id="tiendas" >
            <div class="column1_tiendas">
                <!-- <input name="textarea" type="text" id="textarea" value="" size="24"> -->
                <h2 class="categorias_titulo">CATEGORÍAS</h2>
                <ul>
                    <li><a href="tiendas">Todos</a></li>
                <?php foreach ($categories as $item): ?>
                    <li><a href="<?php echo site_url('tiendas/index/'.$item->slug) ?>"><?php echo ucfirst($item->title) ?></a></li>
                <?php endforeach; ?>
                </ul>
            </div>
            <div class="column2_tiendas">
            <?php foreach ($stores as $item): ?>
                <article class="tienda">
                    <img src="<?php echo $item->image ?>" alt="Logo" class="logo">
                    <img src="<?php echo site_url('addons/shared_addons/themes/diverplaza/img/store/tienda_1.jpg'); ?>" alt="" class="img_tienda">

                    <div class="info_tienda">
                        <h3><a href="<?php echo $item->url; ?>"><?php echo $item->name ?></a></h3>
                        <p><?php echo ucfirst($item->introduction) ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
            </div>
            <!-- <div class="paginador">
                <ul>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                </ul>
            </div> -->
        </section>




