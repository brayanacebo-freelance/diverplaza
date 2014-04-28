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
        $this->lang->load('fundation');
        $this->template
                ->append_js('module::developer.js')
                ->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
        $models = array(
            "fundation_model",
            "fundation_image_model"
        );
        $this->load->model($models);
    }

    // -----------------------------------------------------------------

    public function index() {

        // Paginación de Productos
        $pagination = create_pagination('admin/fundacion/index', $this->fundation_image_model->count_all(), 10);

        // Se consultan los fundationos
        $images = $this->fundation_image_model
                ->order_by('id', 'DESC')
                ->limit($pagination['limit'], $pagination['offset'])
                ->get_all();

        // Intro
        $in = $this->fundation_model->get_all();
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
            if ($this->fundation_model->update($post->id, $data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/fundacion#page-intro');
            } else {
                $this->session->set_flashdata('success', lang('gallery:error_message'));
                redirect('admin/fundacion#page-intro');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/fundacion#page-intro');
        }
    }

    // ----------------------------------------------------------------------------------

    public function create_image() {
        $this->template
                ->build('admin/create_image');
    }

    // -----------------------------------------------------------------

    public function fundation_image() {

        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('description', 'Descripción', 'required|trim');

        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            // Array que se insertara en la base de datos
            $data = array(
                'name' => $post->name,
                'description' => $post->description
            );

            // Se carga la imagen
            $config['upload_path'] = './' . UPLOAD_PATH . '/fundation';
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
                    $path = UPLOAD_PATH . 'fundation/' . $datos['upload_data']['file_name'];
                    $image = array(
                        'path' => $path
                    );
                    $data = array_merge($data, $image);
                } else {
                    $this->session->set_flashdata('error', $this->upload->disfundation_errors());
                    redirect('admin/fundacion/create_image');
                }
            }

            // Se inserta en la base de datos
            if ($this->fundation_image_model->insert($data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/fundacion');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/fundacion/create_image');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/fundacion/create_image');
        }
    }

    // -----------------------------------------------------------------

    public function destroy_image($id = null) {
        $id or redirect('admin/fundacion');
        $obj = $this->fundation_image_model->get_many_by('id', $id);
        $obj = $obj[0];
        if ($this->fundation_image_model->delete($id)) {
            @unlink($obj->path); // Eliminamos archivo existente
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/fundacion');
    }

    // --------------------------------------------------------------------------------------

    public function edit($id = null) {
        $id or redirect('admin/fundacion');
        $fundation = $this->fundation_image_model->get($id);
        $this->template
        ->set('fundation', $fundation)
        ->build('admin/edit');
    }

    // -----------------------------------------------------------------

    public function update() {

        // Validaciones del Formulario
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('description', 'Descripción', 'required|trim');

        // Se ejecuta la validación
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            // Array que se insertara en la base de datos
            $data = array(
                'name' => $post->name,
                'description' => $post->description
                );

            // Se carga la imagen
            $config['upload_path'] = './' . UPLOAD_PATH . '/fundation';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2050;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            // imagen uno
            $img = $_FILES['image']['name'];

            if (!empty($img)) {
                if ($this->upload->do_upload('image')) {
                    $datos = array('upload_data' => $this->upload->data());
                    $path = UPLOAD_PATH . 'fundation/' . $datos['upload_data']['file_name'];
                    $img = array('path' => $path);
                    $data = array_merge($data, $img);
                    $obj = $this->db->where('id', $post->id)->get('fundation')->row();
                    @unlink($obj->image);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/fundacion');
                }
            }

            // Se inserta en la base de datos
            if ($this->fundation_image_model->update($post->id,$data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/fundacion');
            } else {
                $this->session->set_flashdata('error', lang('fundation:error_message'));
                redirect('admin/fundacion/create');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/fundacion/create');
        }
    }

}