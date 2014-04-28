<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author 	    Brayan Acebo
 * @package 	PyroCMS
 * @subpackage 	fundation
 * @category 	Modulos
 */
class Fundacion extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $models = array(
            "fundation_model",
            "fundation_image_model"
        );
        $this->load->model($models);
    }

// -----------------------------------------------------------------

    public function index() {

        // Intro
        $in = $this->fundation_model->get_all();
        $intro = array();
        if (count($in) > 0) {
            $intro = $in[0];
        }

        // Imagenes
        $fundation = $this->fundation_image_model
                ->get_all();

        $this->template
                ->set('intro', $intro)
                ->set('fundation', $fundation)
                ->build('index');
    }

}