<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author 	    Brayan Acebo
 * @package 	PyroCMS
 * @subpackage 	play
 * @category 	Modulos
 */
class Diversion extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $models = array(
            "play_model",
            "play_image_model"
        );
        $this->load->model($models);
    }

// -----------------------------------------------------------------

    public function index($selCategory = null) {

        // Intro
        $in = $this->play_model->get_all();
        $intro = array();
        if (count($in) > 0) {
            $intro = $in[0];
        }

        // Imagenes
        $images = $this->play_image_model
                ->get_all();

        $this->template
                ->set('intro', $intro)
                ->set('images', $images)
                ->build('index');
    }

}