<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Brayan Acebo
 */
// Ajustamos Zona Horaria
date_default_timezone_set("America/Bogota");

class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->lang->load('cars');
        $this->template
                ->append_js('module::developer.js')
                ->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
        $models = array(
            "cars_model",
            "cars_image_model"
        );
        $this->load->model($models);
    }

    // -----------------------------------------------------------------

    public function index() {

        // Paginación de Productos
        $pagination = create_pagination('admin/autos/index', $this->cars_image_model->count_all(), 10);

        // Se consultan los carsos
        $images = $this->cars_image_model
                ->order_by('id', 'DESC')
                ->limit($pagination['limit'], $pagination['offset'])
                ->get_all();

        // Intro
        $in = $this->cars_model->get_all();
        $intro = array();

        if (count($in) > 0) {
            $intro = $in[0];
        }

        $this->template
                ->set('pagination', $pagination)
                ->set('images', $images)
                ->set('intro', $intro)
                ->build('admin/index');
    }

    /*
     * Actualizar Intro
     */

    public function update_intro() {
        $this->form_validation->set_rules('content', 'Texto', 'required');
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();
            $data = array(
                'text' => html_entity_decode($post->content)
            );
            if ($this->cars_model->update($post->id, $data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/autos#page-intro');
            } else {
                $this->session->set_flashdata('success', lang('gallery:error_message'));
                redirect('admin/autos#page-intro');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/autos#page-intro');
        }
    }

    // ----------------------------------------------------------------------------------

    public function create_image() {
        $this->template
                ->build('admin/create_image');
    }

    // -----------------------------------------------------------------

    public function cars_image() {

        // Se carga la imagen
        $config['upload_path'] = './' . UPLOAD_PATH . '/cars';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2050;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        // imagen uno
        $img = $_FILES['image']['name'];
        $image = array();

        if (!empty($img)) {
            if ($this->upload->do_upload('image')) {
                $datos = array('upload_data' => $this->upload->data());
                $path = UPLOAD_PATH . 'cars/' . $datos['upload_data']['file_name'];
                $image = array(
                    'path' => $path
                );
            } else {
                $this->session->set_flashdata('error', $this->upload->discars_errors());
                redirect('admin/autos/create_image');
            }
        }

        // Se inserta en la base de datos
        if ($this->cars_image_model->insert($image)) {
            $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
            redirect('admin/autos');
        } else {
            $this->session->set_flashdata('error', lang('galeria:error_message'));
            redirect('admin/autos/create_image');
        }
    }

    // -----------------------------------------------------------------

    public function destroy_image($id = null) {
        $id or redirect('admin/autos');
        $obj = $this->cars_image_model->get_many_by('id', $id);
        $obj = $obj[0];
        if ($this->cars_image_model->delete($id)) {
            @unlink($obj->path); // Eliminamos archivo existente
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/autos');
    }

}