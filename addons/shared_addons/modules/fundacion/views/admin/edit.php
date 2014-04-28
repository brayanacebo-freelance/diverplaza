<section class="title">
    <h4>Fundación</h4>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-store"><span>Editar fundación</span></a></li>
            </ul>
            <div class="form_inputs" id="page-store">
                <?php echo form_open_multipart(site_url('admin/fundacion/update'), 'id="form-wysiwyg"'); ?>
                <div class="inline-form">
                    <fieldset>
                        <ul>
                           <li>
                            <label for="name">Imagen
                                <small>
                                    - Imagen Permitidas gif | jpg | png | jpeg<br>
                                    - Tamaño Máximo 2 MB<br>
                                    - Ancho Máximo 252px<br>
                                    - Alto Máximo 170px
                                </small>
                            </label>
                            <div class="input">
                                <?php if (!empty($fundation->image)): ?>
                                    <div>
                                        <img src="<?php echo val_image($fundation->image) ?>" width="298">
                                    </div>
                                <?php endif; ?>
                                <div class="btn-false">
                                    <?php echo form_upload('image', '', ' id="image"'); ?>
                                </div>
                            </div>
                            <br class="clear">
                        </li>
                        <li>
                            <label for="title">Nombre <span>*</span></label>
                            <div class="input"><?php echo form_input('name', $fundation->name, 'class="dev-input-title"'); ?></div>
                        </li>


                        <li>
                            <label for="introduction">Descripción
                                <span>*</span>
                                <small class="counter-text"></small>
                            </label>
                            <div class="input"><?php echo form_textarea('description', $fundation->description,'class="dev-input-textarea limit-text" length="500"'); ?></div>
                        </li>

                    </ul>
                </fieldset>

                <div class="buttons float-right padding-top">
                    <?php echo form_hidden('id',$fundation->id); ?>
                    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))); ?>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>
</section>