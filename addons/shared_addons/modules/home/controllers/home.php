<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author 	Luis Fernando Salazar Buitrago
 * @author  Brayan Acebo
 * @package 	PyroCMS
 * @subpackage 	Home Module
 * @category 	Modulos
 * @license 	Apache License v2.0
 */

class Home extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $models = array(
            'home_banner_m',
            'home_outstanding_m',
            'home_social_networks_m',
        );
        $this->load->model($models);
    }

    // -----------------------------------------------------------------

    public function index()
    {
    	// Banner
        $banner = $this->home_banner_m->get_all();

        // Destacados Noticias
        $outstanding_news = $this->home_outstanding_m->where('type', '1')->get_all();

		// Destacados Servicios
        $outstanding_services = $this->home_outstanding_m->where('type', '2')->get_all();

        // redes sociales
        $social_networks = $this->home_social_networks_m->get_all();

        $this->template
                ->set('banner', $banner)
                ->set('outstanding_news', $outstanding_news)
                ->set('outstanding_services', $outstanding_services)
                ->set('social_networks', $social_networks)
                ->build('index');
    }

}
