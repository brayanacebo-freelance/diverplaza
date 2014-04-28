<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author 	    Brayan Acebo
 * @package 	PyroCMS
 * @subpackage 	cars
 * @category 	Modulos
 */
class Autos extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $models = array(
            "cars_model",
            "cars_image_model"
        );
        $this->load->model($models);
    }

// -----------------------------------------------------------------

    public function index() {

        // Intro
        $in = $this->cars_model->get_all();
        $intro = array();
        if (count($in) > 0) {
            $intro = $in[0];
        }

        // Imagenes
        $images = $this->cars_image_model
                ->get_all();

        $this->template
                ->set('intro', $intro)
                ->set('images', $images)
                ->build('index');
    }

}