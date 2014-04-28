
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
<div>
</div>

<h1 class="main_titulos">CONTACTANOS <strong>DIVER</strong></h1>
<div class="div"></div>

<section id="contacto" class="contacto">

    <div class="form">


        <div class="form_container">

            <form name="send" method="post" action="<?php echo site_url('contactenos/send') ?>">
                
                <?php if ($this->session->flashdata('error')): ?>

                <div style="color: red">

                    <?php echo $this->session->flashdata('error') ?>

                </div>

            <?php endif; ?>

            <?php if ($this->session->flashdata('success')): ?>

                <div style="color: green">

                    <?php echo $this->session->flashdata('success') ?>

                </div>

            <?php endif; ?>
                
                <input type="text" name="nombre" id="textfield" class="textfield" value="Nombre" onFocus="javascript:this.value=''">
                <br>
                <input type="text" name="apellidos" id="textfield" class="textfield" value="Apellidos" onFocus="javascript:this.value=''">
                <br>
                <input type="text" name="email" id="textfield" class="textfield" value="eMail" onFocus="javascript:this.value=''">
                <br>
                <input type="text" name="comentarios" id="textfield" class="textfield" value="Comentanos" onFocus="javascript:this.value=''">
                <br>
                <input class="buttons" type="submit" name="button" id="button" value="Submit">
                <input class="buttons" type="reset" name="button2" id="button2" value="Reset">
            </form>

        </div>

        <div class="form_container form_info">

            <h4>Diverplaza Centro Comercial</h4>
            <h4>Transversal 96 #70a-85, Alamos, Bogotá, Colombia</h4>
            <h4>57+1 430 40 73</h4>
            <h4>© 2014 - www.diverplaza.com</h4>
            <br>
            <br>


        </div>

    </div>
</section>
<div id="como_llegar" style="border-top:2px solid #ed9c00 ">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3976.3946746530582!2d-74.11519499999997!3d4.701301999999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9b51a3c64b21%3A0xab2973bb79f953f3!2sDiver+Plaza+Alamos+-+Exito+Alamos!5e0!3m2!1ses-419!2s!4v1398112836531" width="100%" height="450" frameborder="0" style="border:0" scrollwheel="false" ></iframe>
</div>