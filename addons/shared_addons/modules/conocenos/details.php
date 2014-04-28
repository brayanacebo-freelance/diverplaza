<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_Conocenos extends Module {

    public $version = '1.0';
    public $imageTable = 'aboutus_images';
    public $mainTable = 'aboutus';

    public function info() {
        return array(
            'name' => array(
                'en' => 'About us',
                'es' => 'Conocenos'
            ),
            'description' => array(
                'en' => 'About us © Brayan Acebo 2014',
                'en' => 'Conocenos © Brayan Acebo 2014',
            ),
            'frontend' => TRUE,
            'backend' => TRUE,
            'menu' => 'content'
        );
    }

    public function install() {

        /* Creación del directorio para carga de imagenes */
        @mkdir($this->upload_path . $this->mainTable, 0777, TRUE);

        // Creando tabla para multiples imagenes
        $this->dbforge->drop_table($this->imageTable);

        $field = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'aboutus_id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'null' => false
            ),
            'path' => array(
                'type' => 'VARCHAR',
                'constraint' => '455',
                'null' => true
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP',
                'constraint' => '',
                'null' => false
            )
        );

        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', true);

        if (!$this->dbforge->create_table($this->imageTable)) {
            return false;
        }

        // Tabla para introducción de la sección

        $this->dbforge->drop_table($this->mainTable);

        $field = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => '11',
                'auto_increment' => true
            ),
            'text' => array(
                'type' => 'TEXT',
                'null' => true
            )
        );

        $this->dbforge->add_field($field);
        $this->dbforge->add_key('id', true);

        if (!$this->dbforge->create_table($this->mainTable)) {
            return false;
        }

        $data = array(
            'text' => ''
        );

        $this->db->insert($this->mainTable, $data);

        // Final
        return true;
    }

    public function uninstall() {
        $this->dbforge->drop_table($this->mainTable);
        $this->dbforge->drop_table($this->imageTable);
        @rmdir($this->upload_path.$this->mainTable);
        return true;
    }

    public function upgrade($old_version) {
        return true;
    }

    public function help() {
        return "Modulo conocenos con texto y multiples imagenes";
    }

}
/* Fin del archivo details.php */