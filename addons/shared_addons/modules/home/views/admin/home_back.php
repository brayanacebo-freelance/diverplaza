<section class="title">
    <h4>Home</h4>
</section>
<section class="item">
    <div class="content">
        <div class="tabs">
            <ul class="tab-menu">
                <li><a href="#page-banner"><span>Slider</span></a></li>
                <li><a href="#page-outstanding"><span>Noticias Destacadas</span></a></li>
                <li><a href="#page-services"><span>Servicios Destacadas</span></a></li>
                <li><a href="#page-social-network"><span>Redes Sociales</span></a></li>
            </ul>

            <!-- BANNER -->

            <div class="form_inputs" id="page-banner">
                <fieldset>
                    <?php echo anchor('admin/home/edit_banner/', '<span>+ Crear Slide</span>', 'class="btn blue"'); ?>
                    <br>
                    <br>
                    <?php if (!empty($banner)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Imagen</th>
                                    <th style="width: 20%">Titulo</th>
                                    <th style="width: 20%">Texto</th>
                                    <th style="width: 20%">Link</th>
                                    <th class="width: 20%">Acciones</th>
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
                                <?php foreach ($banner as $slide): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($slide->image)): ?>
                                                <img src="<?php echo site_url($slide->image); ?>" style="width: 139px;">
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $slide->title ?></td>
                                        <td><?php echo $slide->text ?></td>
                                        <td><a href="<?php echo $slide->link ?>"><?php echo $slide->link ?></a></td>
                                        <td>
                                            <?php echo anchor('admin/home/edit_banner/' . $slide->id, lang('global:edit'), 'class="btn green small"'); ?>
                                            <?php echo anchor('admin/home/delete_banner/' . $slide->id, lang('global:delete'), array('class' => 'confirm btn red small')) ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p style="text-align: center">No hay un slide actualmente</p>
                    <?php endif ?>
                </fieldset>
            </div>

            <!-- NOTICIAS -->

            <div class="form_inputs" id="page-outstanding">
                <fieldset>

                    <?php
                    if(count($outstanding_news) < 2)
                    {
                    	echo anchor('admin/home/edit_outstanding/1', '<span>+ Crear Destacado de Noticias</span>', 'class="btn blue"');
                    }
                    ?>
                    <br>
                    <br>

                    <?php if (!empty($outstanding_news)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Imagen</th>
                                    <th style="width: 30%">Titulo</th>
                                    <th style="width: 30%">Link</th>
                                    <th class="width: 20%">Acciones</th>
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
                                <?php foreach ($outstanding_news as $outstanding): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($outstanding->image)): ?>
                                                <div style="height: 80px;width: 170px;overflow: hidden"><img src="<?php echo site_url($outstanding->image); ?>" width="170"></div>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $outstanding->title ?></td>
                                        <td><a href="<?php echo $outstanding->link ?>"><?php echo $outstanding->link ?></a></td>
                                        <td>
                                            <?php echo anchor('admin/home/edit_outstanding/'. $outstanding->type .'/'. $outstanding->id, lang('global:edit'), 'class="btn green small"'); ?>
                                            <?php echo anchor('admin/home/delete_outstanding/' . $outstanding->id.'#page-outstanding', lang('global:delete'), array('class' => 'confirm btn red small')) ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p style="text-align: center">No hay Noticias Destacadas actualmente</p>
                    <?php endif ?>
                </fieldset>
            </div>

			<!-- SERVICIOS -->

			<div class="form_inputs" id="page-services">
                <fieldset>

                    <?php
                    if(count($outstanding_services) < 4)
                    {
                    	echo anchor('admin/home/edit_outstanding/2', '<span>+ Crear Destacado de Servicios</span>', 'class="btn blue"');
                    }?>
                    <br>
                    <br>

                    <?php if (!empty($outstanding_services)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Imagen</th>
                                    <th style="width: 30%">Titulo</th>
                                    <th style="width: 30%">Link</th>
                                    <th class="width: 20%">Acciones</th>
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
                                <?php foreach ($outstanding_services as $outstanding): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($outstanding->image)): ?>
                                                <div style="height: 80px;width: 170px;overflow: hidden"><img src="<?php echo site_url($outstanding->image); ?>" width="170"></div>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $outstanding->title ?></td>
                                        <td><a href="<?php echo $outstanding->link ?>"><?php echo $outstanding->link ?></a></td>
                                        <td>
                                            <?php echo anchor('admin/home/edit_outstanding/'. $outstanding->type .'/'. $outstanding->id, lang('global:edit'), 'class="btn green small"'); ?>
                                            <?php echo anchor('admin/home/delete_outstanding/' . $outstanding->id, lang('global:delete'), array('class' => 'confirm btn red small')) ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p style="text-align: center">No hay Noticias Destacadas actualmente</p>
                    <?php endif ?>
                </fieldset>
            </div>

            <!-- REDES SOCIALES -->

            <div class="form_inputs" id="page-social-network">
                <fieldset>
                    <?php if (count($social_networks) < 4): ?>
                        <?php echo anchor('admin/home/edit_social_network', '<span> + Crear Red Social</span>', 'class="btn blue" titulo="Maximo 4 Registros"'); ?>
                    <?php endif; ?>
                    <br>
                    <br>

                    <?php if (!empty($social_networks)): ?>

                        <table border="0" class="table-list" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 25%">Icono</th>
                                    <th style="width: 25%">Nombre</th>
                                    <th style="width: 30%">Url</th>
                                    <th style="width: 20%">Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                    </td>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($social_networks as $social_network): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($social_network->icon)): ?>
                                                <div style="height: 30px;width: 80px;overflow: hidden"><img src="<?php echo site_url($social_network->icon); ?>" height="30"></div>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo substr($social_network->name, 0, 30) ?></td>
                                        <td><a href="<?php echo $social_network->url ?>"><?php echo $social_network->url ?></a></td>
                                        <td>
                                            <?php echo anchor('admin/home/edit_social_network/' . $social_network->id, lang('global:edit'), 'class="btn green small"'); ?>
                                            <?php echo anchor('admin/home/delete_social_network/' . $social_network->id, lang('global:delete'), array('class' => 'confirm btn red small')) ?>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p style="text-align: center">No hay Redes Sociales actualmente</p>
                    <?php endif ?>
                </fieldset>
            </div>
        </div>
    </div>
</section>