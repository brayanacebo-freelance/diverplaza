<section class="title">
    <h4>Servicios / <?php echo ucfirst($service->name) ?> / Imagenes</h4>
    <a href="<?php echo backend_url('servicios') ?>" >Volver</a>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-services"><span>Imagenes</span></a></li>
            </ul>

            <!-- IMAGENES -->
            <div class="form_inputs" id="page-services">
                <fieldset>

                    <?php echo anchor('admin/servicios/create_image/' . $service->id, '<span>+ Nueva Imagen</span>', 'class="btn blue"'); ?>
                    <br>
                    <br>

                    <?php if (!empty($images)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 70%">Imagen</th>
                                    <th style="width: 30%">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($images as $image): ?>
                                    <tr>
                                        <td><img src="<?php echo val_image($image->path) ?>" alt="imagen" height="100"></td>
                                        <td>
                                            <?php echo anchor('admin/servicios/destroy_image/' . $image->id . '/' . $service->id, lang('global:delete'), array('class' => 'btn red small confirm button')) ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p style="text-align: center">No hay Registros actualmente</p>
                    <?php endif ?>
                </fieldset>
            </div>

        </div>
    </div>
</section>