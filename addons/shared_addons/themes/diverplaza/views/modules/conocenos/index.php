
<div id="main_header" style="background-color: #ed8300 !important;">
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
<div>
</div>

<h1 class="main_titulos">VEN <strong>CONÓCENOS</strong></h1>
<div class="div"></div>
<section id="conocenos">

    <?php echo $intro->text ?>

    <h3 id="device" style="color: #ed9c00; font-size:30px; text-align:center;">
        Galeria
    </h3>
    <a href="#device" style="display: block; text-align:center;"><img src="<?php echo site_url('addons/shared_addons/themes/diverplaza/img/misc/abajo_detalle.png'); ?>" alt=""></a>
</section>

<div class="device">
    <a class="arrow-left" href="#"></a>
    <a class="arrow-right" href="#"></a>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <?php foreach ($images as $image): ?>
                <div class="swiper-slide"> <img src="<?php echo $image->path ?>"> </div>
            <?php endforeach; ?>
        </div>
        <div class="pagination" ></div>
    </div>

</div>

<script>
    var mySwiper = new Swiper('.swiper-container',{
        pagination: '.pagination',
        loop:true,
        grabCursor: true,
        paginationClickable: true
    })
    $('.arrow-left').on('click', function(e){
        e.preventDefault()
        mySwiper.swipePrev()
    })
    $('.arrow-right').on('click', function(e){
        e.preventDefault()
        mySwiper.swipeNext()
    })
</script>
