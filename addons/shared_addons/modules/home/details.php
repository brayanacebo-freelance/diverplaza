<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_Home extends Module {

    public $version = '1.1';

    public function info() {
        return array(
            'name' => array(
                'es' => 'Home',
                'en' => 'Home',
            ),
            'description' => array(
                'es' => 'Home tipo 1 © Luiz Salazar, Brayan Acebo',
                'en' => 'Home type 1 © Luiz Salazar, Brayan Acebo',
            ),
            'frontend' => true,
            'backend' => true,
            'menu' => 'content',
        );
    }

    public function install() {

        /* Este instalador no sirve nuevamente para el modulo */

        // creamos la base de datos del banner
        $this->dbforge->drop_table('home_banner');

        // creamos un array con los campos de la base de datos
        $banner = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'image' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'text' => array(
                'type' => 'TEXT',
                'constraint' => '0',
                'null' => true
            ),
            'link' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
        );

        // creamos la llave primaria
        $this->dbforge->add_field($banner);
        $this->dbforge->add_key('id', true);

        // creamos la carpeta en la ruta especificada
        $this->dbforge->create_table('home_banner') AND is_dir($this->upload_path . 'home_banner') OR @mkdir($this->upload_path . 'home_banner', 0777, TRUE);

        // creamos la base de datos del banner
        $this->dbforge->drop_table('home_outstanding');

        // creamos un array con los campos de la base de datos
        $home_outstanding = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'image' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'text' => array(
                'type' => 'TEXT',
                'constraint' => '0',
                'null' => true
            ),
            'type' => array(
                'type' => 'INT',
                'constraint' => '1',
                'null' => true
            ),
            'link' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
        );

        // creamos la llave primaria
        $this->dbforge->add_field($home_outstanding);
        $this->dbforge->add_key('id', true);

        // creamos la carpeta en la ruta especificada
        $this->dbforge->create_table('home_outstanding') AND is_dir($this->upload_path . 'home_outstanding') OR @mkdir($this->upload_path . 'home_outstanding', 0777, TRUE);


        $this->dbforge->drop_table('home_social_networks');


        $home_social_networks = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'url' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ),
            'icon' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
        );

        $this->dbforge->add_field($home_social_networks);
        $this->dbforge->add_key('id', true);

        $this->dbforge->create_table('home_social_networks') AND is_dir($this->upload_path . 'home_social_networks') OR @mkdir($this->upload_path . 'home_social_networks', 0777, TRUE);

        return TRUE;
    }

    public function uninstall() {
        $this->dbforge->drop_table('home_banner');
        $this->dbforge->drop_table('home_outstanding');
        $this->dbforge->drop_table('home_social_networks');
        @rmdir(site_url($this->upload_path . 'home_banner'));
        @rmdir(site_url($this->upload_path . 'home_outstanding'));
        @rmdir(site_url($this->upload_path . 'home_social_networks'));
        return true;
    }

    public function upgrade($old_version) {
        return true;
    }

    public function help() {
        return "Pagina inicial del sitio desarrollada a la medida.";
    }

}
