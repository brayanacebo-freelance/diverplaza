<section class="item">
    <div class="content">
    	<h2>Home / Destacados</h2>
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-destacado"><span><?php echo $titulo; ?></span></a></li>
            </ul>
            <div class="form_inputs" id="page-bibliografia">
                <?php echo form_open_multipart(site_url('admin/home/edit_outstanding/'.$typeItem.'/'.(isset($outstanding) ? $outstanding->id : '')), 'class="crud"'); ?>
                <div class="inline-form">
                <fieldset>
                    <ul>
                        <li>
                            <label for="image">Imagen
                                <small>
                                    - Imagen Permitidas gif | jpg | png | jpeg<br>
                                    - Tamaño Máximo 2 MB<br>
                                    <strong>Noticias</strong><br>
                                    - Ancho Máximo 490px<br>
                                    - Alto Máximo 250px<br>
                                    <strong>Servicios</strong><br>
                                    - Ancho Máximo 253px<br>
                                    - Alto Máximo 170px
                                </small>
                            </label>
                            <div class="input">
                                    <?php if (!empty($outstanding->image)): ?>
                                        <div>
                                            <img src="<?php echo site_url($outstanding->image) ?>" width="298">
                                        </div>
                                    <?php endif; ?>
                                    <div class="btn-false">
                                        <div class="btn">Examinar</div>
                                        <?php echo form_upload('image', '', ' id="image"'); ?>
                                    </div>
                                </div>
                                <br class="clear">
                        </li>
                        <li>
                            <label for="title"><?php echo lang('home:title'); ?> <span>*</span></label>
                            <div class="input"><?php echo form_input('title', (isset($outstanding->title)) ? $outstanding->title : set_value('title'), 'class="dev-input-title"'); ?></div>
                        </li>
                        <li>
                            <label for="text">Texto <span>*</span></label>
                            <div class="input"><?php echo form_textarea('text', (isset($outstanding->text)) ? $outstanding->text : set_value('text'),'class="dev-input-textarea"'); ?></div>
                        </li>
                        <li>
                            <label for="name">Link <span>*</span></label>
                            <div class="input"><?php echo form_input('link', (isset($outstanding->link)) ? $outstanding->link : set_value('link'), 'class="dev-input-url"'); ?></div>
                        </li>
                    </ul>
                </fieldset>

                <div class="buttons">
					<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))); ?>
				</div>
            </div>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</section>