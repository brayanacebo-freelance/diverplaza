<div class="container">

    <div class="row alignleft">

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h1 class="t-todos title_seccion">Cont&aacute;ctanos</h1>

            <hr class="hr_title_seccion2">

        </div>

    </div>

    <div class="row mtop10">

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <?php echo form_open(site_url('contact_us/send'), 'class="crud"'); ?>        

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

            <div class="form-group">

                <label class="control-label">Nombre y apellido *</label>

                <input type="text" class="form-control" name="name" value="<?php echo set_value('nombre') ?>">

            </div>

            <div class="form-group">

                <label class="control-label">Correo Electrónico *</label>

                <input type="text" class="form-control" name="email" value="<?php echo set_value('correo') ?>">

            </div>

            <div class="form-group">

                <label class="control-label">Teléfono</label>

                <input type="text" class="form-control" name="phone" value="<?php echo set_value('telefono') ?>">

            </div>

           <div class="form-group">

                <label class="control-label">Celular</label>

                <input type="text" class="form-control" name="cell" value="<?php echo set_value('cell') ?>">

            </div>

            <div class="form-group">

                <label class="control-label">Empresa/Organización</label>

                <input type="text" class="form-control" name="company" value="<?php echo set_value('empresa') ?>">

            </div>

            <!-- <div class="form-group">

                <label class="control-label">Municipio/Departamento</label>

                <input type="text" class="form-control" name="city" value="<?php echo set_value('municipio') ?>">

            </div> -->

            <div class="form-group">

                <label class="control-label">Mensaje *</label>

                <textarea class="form-control" rows="5" name="message"><?php echo set_value('mensaje') ?></textarea>

            </div>

            <div align="right" class="form-group">

                <input type="submit" class="btn btn-primary enviarcontacto" name="btnAction">

            </div>

            <?php echo form_close(); ?>

        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

            <?php if(isset($contact_us->map) && !empty($contact_us->map)): ?>

            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <?php     
                       $map = str_replace("#", "%23", $contact_us->map);
                       echo $map;
                  ?>
               </div>

            </div>

            <?php endif; ?>

            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">

                <div class="cont_datos_contacto">

                    <h3 class="titulo-cor">Datos de Contacto</h3>

                    <hr class="hr_title_seccion2">

                    <ul class="contacto">

                        <li>Dirección: <?php echo (isset($contact_us->adress) ? $contact_us->adress: ''); ?></li>

                        <li>Teléfono: <?php echo (isset($contact_us->phone) ? $contact_us->phone: ''); ?></li>

                        <li>E-mail: <?php echo (isset($contact_us->email) ? $contact_us->email: ''); ?></li>

                    </ul>

                </div>

            </div>

            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">

                <div class="cont_datos_contacto">

                    <h3 class="titulo-cor">Horarios de atenci&oacute;n</h3>

                    <hr class="hr_title_seccion2">

                    <ul class="contacto">
                        <li><?php echo (isset($contact_us->schedule) ? $contact_us->schedule: ''); ?></li>
                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>