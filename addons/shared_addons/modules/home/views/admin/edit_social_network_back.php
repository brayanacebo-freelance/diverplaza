<section class="item">
    <div class="content">
    	<h2>Home / Redes Sociales</h2>
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-aliado"><span><?php echo $titulo; ?></span></a></li>
            </ul>

            <div class="form_inputs" id="page-bibliografia">
                <?php echo form_open_multipart(site_url('admin/home/edit_social_network/'.(isset($social_network) ? $social_network->id : '')), 'class="crud"'); ?>
                <div class="inline-form">
                    <fieldset>
                        <ul>
                            <li>
                                <label for="icon">Icono
                                    <small>
                                        - Icono Permitidas gif | jpg | png | jpeg<br>
                                        - Tamaño Máximo 2 MB<br>
                                        - Ancho Máximo 25px<br>
                                        - Alto Máximo 25px
                                    </small>
                                </label>
                                <div class="input">
                                    <?php if (!empty($social_network->icon)): ?>
                                        <div>
                                        <img src="<?php echo site_url($social_network->icon) ?>" width="25">
                                        </div>
                                    <?php endif; ?>
                                    <div class="btn-false">
                                        <div class="btn">Examinar</div>
                                        <?php echo form_upload('icon', '', ' id="image"'); ?>
                                    </div>
                                </div>
                                <br class="clear">
                            </li>
                            <li>
                                <label for="name">Nombre <span>*</span></label>
                                <div class="input"><?php echo form_input('name', (isset($social_network->name)) ? $social_network->name : set_value('name'), 'style="width: 350px;"'); ?></div>
                            </li>
                            <li>
                                <label for="url">Dirección Url <span>*</span></label>
                                <div class="input"><?php echo form_input('url', (isset($social_network->url)) ? $social_network->url : set_value('url'), 'style="width: 450px;"'); ?></div>
                            </li>
                        </ul>
                        <?php
                        $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel')));
                        ?>
                    </fieldset>
                </div>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</section>