<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 * @author 	    Brayan Acebo
 * @package 	PyroCMS
 * @subpackage 	wineries
 * @category 	Modulos
 */
class Bodegas extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $models = array(
            "wineries_model",
            "wineries_image_model"
        );
        $this->load->model($models);
    }

// -----------------------------------------------------------------

    public function index() {

        // Intro
        $in = $this->wineries_model->get_all();
        $intro = array();
        if (count($in) > 0) {
            $intro = $in[0];
        }

        // Imagenes
        $wineries = $this->wineries_image_model
                ->get_all();

        $this->template
                ->set('intro', $intro)
                ->set('wineries', $wineries)
                ->build('index');
    }

}