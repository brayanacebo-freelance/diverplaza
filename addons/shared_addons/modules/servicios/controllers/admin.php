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
        $this->lang->load('services');
        $this->template
        ->append_js('module::developer.js')
        ->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
        $models = array(
            "service_model",
            "service_image_model"
            );
        $this->load->model($models);
    }

    // -----------------------------------------------------------------

    public function index() {

        // Paginación de Productos
        $pagination = create_pagination('admin/servicios/index', $this->service_model->count_all(), 10);

        // Se consultan los serviceos
        $services = $this->service_model
        ->order_by('id', 'DESC')
        ->limit($pagination['limit'], $pagination['offset'])
        ->get_all();

        $this->template
        ->set('pagination', $pagination)
        ->set('services', $services)
        ->build('admin/index');
    }

    /*
     * Productos
     */

    public function create() {
        $this->template
        ->build('admin/create');
    }

    // -----------------------------------------------------------------

    public function service() {

        // Validaciones del Formulario
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('content', 'Descripción', 'required|trim');
        $this->form_validation->set_rules('introduction', 'Introducción', 'required|trim');

        // Se ejecuta la validación
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            // Array que se insertara en la base de datos
            $data = array(
                'name' => $post->name,
                'slug' => slug($post->name),
                'description' => html_entity_decode($post->content),
                'introduction' => $post->introduction,
                'created_at' => date('Y-m-d H:i:s')
                );

            // Se carga la imagen
            $config['upload_path'] = './' . UPLOAD_PATH . '/services';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2050;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            // imagen uno
            $img = $_FILES['image']['name'];

            if (!empty($img)) {
                if ($this->upload->do_upload('image')) {
                    $datos = array('upload_data' => $this->upload->data());
                    $path = UPLOAD_PATH . 'services/' . $datos['upload_data']['file_name'];
                    $img = array('image' => $path);
                    $data = array_merge($data, $img);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/servicios/');
                }
            }

            // Se inserta en la base de datos
            if ($this->service_model->insert($data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/servicios');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/servicios/create');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/servicios/create');
        }
    }

    // -----------------------------------------------------------------

    public function destroy($id = null) {
        $id or redirect('admin/servicios');
        $obj = $this->db->where('id', $id)->get($this->db->dbprefix.'services')->row();
        if ($this->service_model->delete($id)) {
            @unlink($obj->image); // Eliminamos archivo existente
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/servicios');
    }

    // --------------------------------------------------------------------------------------

    public function edit($id = null) {
        $id or redirect('admin/servicios');
        $service = $this->service_model->get($id);

        $this->template
        ->set('service', $service)
        ->build('admin/edit');
    }

    // -----------------------------------------------------------------

    public function update() {

        // Validaciones del Formulario
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('content', 'Descripción', 'required|trim');
        $this->form_validation->set_rules('introduction', 'Introducción', 'required|trim');

        // Se ejecuta la validación
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            // Array que se insertara en la base de datos
            $data = array(
                'name' => $post->name,
                'slug' => slug($post->name),
                'description' => html_entity_decode($post->content),
                'introduction' => $post->introduction
                );

            // Se carga la imagen
            $config['upload_path'] = './' . UPLOAD_PATH . '/services';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2050;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            // imagen uno
            $img = $_FILES['image']['name'];

            if (!empty($img)) {
                if ($this->upload->do_upload('image')) {
                    $datos = array('upload_data' => $this->upload->data());
                    $path = UPLOAD_PATH . 'services/' . $datos['upload_data']['file_name'];
                    $img = array('image' => $path);
                    $data = array_merge($data, $img);
                    $obj = $this->db->where('id', $post->id)->get('services')->row();
                    @unlink($obj->image);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/servicios/');
                }
            }

            // Se inserta en la base de datos
            if ($this->service_model->update($post->id,$data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/servicios');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/servicios/create');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/servicios/create');
        }
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
            if ($this->service_intro_model->update($post->id, $data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/servicios#page-intro');
            } else {
                $this->session->set_flashdata('success', lang('gallery:error_message'));
                redirect('admin/servicios#page-intro');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/servicios#page-intro');
        }
    }

    /*
     * Administración de imagenes
     */

    public function images($id = null) {
        $id or redirect('admin/servicios');
        // Se consultan las imagenes del service
        $images = $this->service_image_model->get_many_by("service_id",$id);
        $service = $this->service_model->get_many_by("id",$id);
        $service = $service[0];

        $this->template
        ->set('service', $service)
        ->set('images', $images)
        ->build('admin/images');
    }

    // ----------------------------------------------------------------------------------

    public function create_image($id = null) {
        $id or redirect('admin/servicios');
        $service = $this->service_model->get_many_by("id",$id);
        $service = $service[0];
        $this->template
        ->set('service', $service)
        ->build('admin/create_image');
    }

    // -----------------------------------------------------------------

    public function service_image() {

            // Se carga la imagen
        $config['upload_path'] = './' . UPLOAD_PATH . '/services';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2050;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

            // imagen uno
        $img = $_FILES['image']['name'];
        $image = array();
        $id = $this->input->post('id');

        if (!empty($img)) {
            if ($this->upload->do_upload('image')) {
                $datos = array('upload_data' => $this->upload->data());
                $path = UPLOAD_PATH . 'services/' . $datos['upload_data']['file_name'];
                $image = array(
                    'service_id' => $id,
                    'path' => $path
                    );
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/servicios/images/'.$id);
            }
        }

            // Se inserta en la base de datos
        if ($this->service_image_model->insert($image)) {
            $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
            redirect('admin/servicios/images/'.$id);
        } else {
            $this->session->set_flashdata('error', lang('galeria:error_message'));
            redirect('admin/servicios/create_image/'.$id);
        }
    }

    // -----------------------------------------------------------------

    public function destroy_image($id = null,$service_id = null) {
        $id or redirect('admin/servicios');
        $service_id or redirect('admin/servicios');
        $obj = $this->service_image_model->get_many_by('id',$id);
        $obj = $obj[0];
        if ($this->service_image_model->delete($id)) {
            @unlink($obj->path); // Eliminamos archivo existente
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/servicios/images/'.$service_id);
    }

}