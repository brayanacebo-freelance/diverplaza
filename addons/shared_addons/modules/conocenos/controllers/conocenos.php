<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author 	    Brayan Acebo
 * @package 	PyroCMS
 * @subpackage 	aboutus
 * @category 	Modulos
 */
class Conocenos extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $models = array(
            "aboutus_model",
            "aboutus_image_model"
        );
        $this->load->model($models);
    }

// -----------------------------------------------------------------

    public function index($selCategory = null) {

        // Intro
        $in = $this->aboutus_model->get_all();
        $intro = array();
        if (count($in) > 0) {
            $intro = $in[0];
        }

        // Imagenes
        $images = $this->aboutus_image_model
                ->get_all();

        $this->template
                ->set('intro', $intro)
                ->set('images', $images)
                ->build('index');
    }

}