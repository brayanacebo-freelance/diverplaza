<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author 	    Brayan Acebo
 * @package 	PyroCMS
 * @subpackage 	Stores
 * @category 	Modulos
 */
class Servicios extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $models = array(
            "service_model",
            "service_image_model"
        );
        $this->load->model($models);
    }

// -----------------------------------------------------------------

    public function index() {

        // Se consultan los serviceos
        $services = $this->service_model
                ->order_by('id', 'DESC')
                ->get_all();

        foreach ($services AS $item) {
            $item->name = substr($item->name, 0, 20);
            $item->image = val_image($item->image);
            $item->introduction = substr($item->introduction, 0, 100);
            $item->url = site_url('servicios/detail/' . $item->slug);
        }

        // Intro
        $in = $this->service_model->get_all();
        $intro = array();
        if (count($in) > 0) {
            $intro = $in[0];
        }
        $this->template
                ->set('services', $services)
                ->set('intro', $intro)
                ->build('index');
    }

// ----------------------------------------------------------------------

    public function detail($slug) {

        $return = $this->service_model->get_many_by('slug', $slug);
        $return = $return[0];

        if (!$return)
            redirect('tiendas');

        // Se convierten algunas variables necesarias para usar como slugs
        $setter = array(
            'image' => val_image($return->image)
        );

        $service = array_merge((array) $return, $setter);

        // imagenes para slider
        $images = $this->service_image_model->get_many_by('service_id', $service['id']);

        $this->template
                ->set('service', (object) $service)
                ->set('images', $images)
                ->build('detail');
    }

}