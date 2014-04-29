<section class="title">
    <h4>Tiendas</h4>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-store"><span>Editar Tienda</span></a></li>
            </ul>
            <div class="form_inputs" id="page-store">
                <?php echo form_open_multipart(site_url('admin/tiendas/update'), 'id="form-wysiwyg"'); ?>
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
                                <?php if (!empty($store->image)): ?>
                                    <div>
                                        <img src="<?php echo val_image($store->image) ?>" width="298">
                                    </div>
                                <?php endif; ?>
                                <div class="btn-false">
                                    <?php echo form_upload('image', '', ' id="image"'); ?>
                                </div>
                            </div>
                            <br class="clear">
                        </li>
                        <li>
                            <label for="name">Imagen de fondo
                                <small>
                                    - Imagen Permitidas gif | jpg | png | jpeg<br>
                                    - Tamaño Máximo 2 MB<br>
                                    - Ancho Máximo 252px<br>
                                    - Alto Máximo 170px
                                </small>
                            </label>
                            <div class="input">
                                <?php if (!empty($store->background)): ?>
                                    <div>
                                        <img src="<?php echo val_image($store->background) ?>" width="298">
                                    </div>
                                <?php endif; ?>
                                <div class="btn-false">
                                    <?php echo form_upload('background', '', ' id="image"'); ?>
                                </div>
                            </div>
                            <br class="clear">
                        </li>
                        <li>
                            <label for="title">Nombre <span>*</span></label>
                            <div class="input"><?php echo form_input('name', $store->name, 'class="dev-input-title"'); ?></div>
                        </li>
                        <li>
                            <label for="path">Categorias <span>*</span></label>
                            <select name="categories[]" multiple>
                                <?php foreach ($categories as $item): ?>
                                    <option value="<?php echo $item->id; ?>" <?php echo (in_array($item->id, $selected_category)) ? 'selected' : null ?>>
                                        <?php echo $item->title; ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </li>
                        <li class="even">
                            <label for="name">
                                Descripción
                                <span>*</span>
                                <small>Evite pegar texto directamente desde un sitio web u otro editor de texto, de ser necesario use la herramienta pegar desde.</small>
                            </label>
                            <div class="input">
                                <div class="sroll-table">
                                    <?php echo form_textarea(array('id' => 'text-wysiwyg', 'name' => 'text_wysiwyg', 'value' => $store->description, 'rows' => 30, 'class' => 'wysiwyg-advanced')) ?>
                                    <input type="hidden" name="content" id="text">
                                </div>
                            </div>
                            <br class="clear">
                        </li>
                        <li>
                            <label for="introduction">Introducción
                                <span>*</span>
                                <small class="counter-text"></small>
                            </label>
                            <div class="input"><?php echo form_textarea('introduction', $store->introduction,'class="dev-input-textarea limit-text" length="100"'); ?></div>
                        </li>
                        <li style="display:none">
                            <label for="name">Precio</label>
                            <div class="input">
                                <div class="input"><?php echo form_input('price', $store->price); ?></div>
                            </div>
                        </li>
                    </ul>
                </fieldset>

                <div class="buttons float-right padding-top">
                    <?php echo form_hidden('id',$store->id); ?>
                    <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel'))); ?>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>
</section>