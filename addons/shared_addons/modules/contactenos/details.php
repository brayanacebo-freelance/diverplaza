<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Module_Contactenos extends Module {

    public $version = '1.0';

    public function info() {

        return array(
            'name' => array(
                'es' => 'Comtactenos',
                'en' => 'Contactenos'
            ),
            'description' => array(
                'es' => 'Modulo información de contacto © Christian España, Brayan Acebo',
                'en' => 'Manage Info Data © Christian España , Brayan Acebo'
            ),
            'frontend' => true,
            'backend' => true,
            'menu' => 'content',
        );
    }

    public function install() {

        return true;
    }

    public function uninstall() {

        return true;
    }

    public function upgrade($old_version) {

        return true;
    }

    public function help() {

        return "Módulo destinado administrar la información de contacto";
    }

}