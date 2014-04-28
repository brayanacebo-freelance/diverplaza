<section class="title">
    <h4>Servicios</h4>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-stores"><span>Listado de servicios</span></a></li>
            </ul>

            <!-- TIENDAS -->
            <div class="form_inputs" id="page-stores">
                <fieldset>

                    <?php echo anchor('admin/servicios/create', '<span>+ Nuevo servicio</span>', 'class="btn blue"'); ?>
                    <br>
                    <br>

                    <?php if (!empty($services)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Nombre</th>
                                    <th style="width: 20%">Imagen</th>
                                    <th style="width: 30%">Descripción</th>
                                    <th style="width: 30%">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="inner filtered"><?php $this->load->view('admin/partials/pagination') ?></div>
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($services as $service): ?>
                                    <tr>
                                        <td><?php echo $service->name ?></td>
                                        <td>
                                            <?php if (!empty($service->image)): ?>
                                                <img src="<?php echo site_url($service->image); ?>" style="height: 130px;">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo substr(strip_tags($service->description), 0,100) ?></td>
                                        <td>
                                            <?php echo anchor('admin/servicios/edit/' . $service->id, lang('global:edit'), 'class="btn green small"'); ?>
                                            <?php echo anchor('admin/servicios/images/' . $service->id, "Imagenes", 'class="btn orange small"'); ?>
                                            <?php echo anchor('admin/servicios/destroy/' . $service->id, lang('global:delete'), array('class' => 'btn red small confirm button')) ?>
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