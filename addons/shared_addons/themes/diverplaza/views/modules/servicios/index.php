
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
                <li><a href="contactenos">Contáctenos</a></li>
            </ul>
        </div><!-- /dl-menuwrapper --><!-- /container -->
    </nav>
</div>
<h1 class="main_titulos">NUESTROS <strong>SERVICIOS</strong></h1>
<section id="servicios" >
    <div class="column2_servicios">

        <?php foreach ($services as $service): ?>
        <article class="servicio">
        <img src="<?php echo $service->image ?>" alt="<?php echo $service->name ?>" class="img_servicio">
            <div class="info_tienda">
                <h3><a href="<?php echo $service->url; ?>"><?php echo $service->name ?></a></h3>
                <p><?php echo $service->introduction ?></p>
            </div>
        </article>
        <?php endforeach; ?>

    </div>
</section>

