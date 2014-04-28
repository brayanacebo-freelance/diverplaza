<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>
    $(function() {
        $.fn.parallax = function(options){
            var $$ = $(this);
            offset = $$.offset();
            var defaults = {
                "start": 0,
                "stop": offset.top + $$.height(),
                "coeff": 0.95
            };
            var opts = $.extend(defaults, options);
            return this.each(function(){
                $(window).bind('scroll', function() {
                    windowTop = $(window).scrollTop();
                    if((windowTop >= opts.start) && (windowTop <= opts.stop)) {
                        newCoord = windowTop * opts.coeff;
                        //console.log($$)

                        $$.css({
                            "background-position": "0 "+ newCoord + "px"
                        });
                    }
                });
            });
        };
        $('#home').parallax({ "coeff":-0.65 });
        $('#home .inner').parallax({ "coeff":1.15 });

    })
</script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        $objWindow = $(window);
        $('div[data-type="background"]').each(function(){
            var $bgObj = $(this);
            $(window).scroll(function() {
                var yPos = -($objWindow.scrollTop() / $bgObj.data('speed'));

                var coords = '100% '+ yPos + 'px';
                // Animate the background
                $bgObj.css({ backgroundPosition: coords });

            });

        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
</script>

<div style="position: absolute; top:20%;">
</div>
<div id="main_header" style="background-color: #f6de3f !important;">
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
            <button class="dl-trigger"></button>
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
<div>
</div>


<h1 class="main_titulos">DIVER <strong>BODEGAS</strong></h1>
<div class="div"></div>
<p style="margin:30px 100px; padding-bottom: 1em; text-align: center;" >
<?php echo $intro->text ?>
</p>

<a href="#bodega" style="position: absolute; width: 50px; left: 47%; right: 47%; margin: 0 auto;"><img src="<?php echo site_url('addons/shared_addons/themes/diverplaza/img/misc/abajo_detalle.png'); ?>" alt="abajo"></a>

<section id="bodega">
<?php foreach ($wineries as $item): ?>
    <article >
        <h2 class="main_titulos"><?php echo $item->name ?></h2>
        <p style="padding-bottom: 3em; text-align: center;" ><?php echo $item->description ?></p>
        <div id="home" class="bg_parralax" data-type="background" data-speed="10">
            <!-- <div class="inner" style="background-position: 0px 293.25px;"></div> -->
            <img src="<?php echo val_image($item->path)?>" alt="<?php echo $item->name ?>">
        </div>
    </article>
<?php endforeach; ?>
</section>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function(){
        $objWindow = $(window);
        $('div[data-type="background"]').each(function(){
            var $bgObj = $(this);
            $(window).scroll(function() {
                var yPos = -($objWindow.scrollTop() / $bgObj.data('speed'));

                var coords = '100% '+ yPos + 'px';
                // Animate the background
                $bgObj.css({ backgroundPosition: coords });

            });

        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
</script>

