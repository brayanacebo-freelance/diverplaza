<section class="title">
    <h4>Conocenos / Imagenes</h4>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-aboutus"><span>Nueva Imagen</span></a></li>
            </ul>
            <div class="form_inputs" id="page-aboutus">
                <?php echo form_open_multipart(site_url('admin/conocenos/aboutus_image')); ?>
                <div class="inline-form">
                    <fieldset>
                        <ul>
                            <li>
                                <label for="name">Imagen
                                    <small>
                                        - Imagen Permitidas gif | jpg | png | jpeg<br>
                                        - Tamaño Máximo 2 MB<br>
                                        - Ancho Máximo 460px<br>
                                        - Alto Máximo 345px
                                    </small>
                                </label>
                                <div class="input">
                                    <div class="btn-false">
                                        <?php echo form_upload('image', '', ' id="image"'); ?>
                                    </div>
                                </div>
                                <br class="clear">
                            </li>
                        </ul>
                    </fieldset>

                    <div class="buttons float-right padding-top">
                        <button type="submit" name="btnAction" value="save" class="btn blue">Guardar</button>
                        <a href="<?php echo backend_url('conocenos') ?>" class="btn red cancel">Cancelar</a>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>

        </div>
    </div>
</section>