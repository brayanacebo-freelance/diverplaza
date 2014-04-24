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
        $this->lang->load('stores');
        $this->template
        ->append_js('module::developer.js')
        ->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
        $models = array(
            "store_model",
            "store_category_model",
            "store_image_model",
            "store_intro_model"
            );
        $this->load->model($models);
    }

    // -----------------------------------------------------------------

    public function index() {

        // Paginación de Productos
        $pagination = create_pagination('admin/tiendas/index', $this->store_model->count_all(), 10);

        // Se consultan los storeos
        $stores = $this->store_model
        ->order_by('id', 'DESC')
        ->limit($pagination['limit'], $pagination['offset'])
        ->get_all();

        // Consultamos las categorias
        $categories = $this->store_category_model
        ->order_by('id', 'DESC')
        ->get_all();

        foreach ($categories as $key => $value) {
            $parent = $value->parent;
            if($parent != 0){
                $parent_name = $this->store_category_model->get($parent)->title;
                if($parent_name != "") {
                    $categories[$key]->parent_name = $parent_name;
                }
            } else {
                $categories[$key]->parent_name = "";
            }
        }

        // Intro
        $in = $this->store_intro_model->get_all();
        $intro = array();

        if (count($in) > 0) {
            $intro = $in[0];
        }

        $this->template
        ->set('pagination', $pagination)
        ->set('stores', $stores)
        ->set('categories', $categories)
        ->set('intro', $intro)
        ->build('admin/index');
    }

    /*
     * Categorias
     */

    public function create_category() {
        $categories = $this->store_category_model->order_by('id', 'ASC')->get_all();
        $this->template
        ->set('categories', $categories)
        ->build('admin/create_category');
    }

    // -----------------------------------------------------------------

    public function store_category() {

        $this->form_validation->set_rules('title', 'Titulo', 'required|trim');
        $this->form_validation->set_rules('parent', 'Padre', '');

        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            $data = array(
                'title' => $post->title,
                'slug' => slug($post->title),
                'parent' => $post->parent,
                'created_at' => date('Y-m-d H:i:s')
                );

            if ($this->store_category_model->insert($data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/tiendas#page-categories');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/tiendas/create_category');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/tiendas/create_category');
        }
    }

    // -----------------------------------------------------------------

    public function destroy_category($id = null) {
        $id or redirect('admin/tiendas#page-categories');
        if ($this->store_category_model->delete($id)) {
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/tiendas#page-categories');
    }

    // --------------------------------------------------------------------------------------

    public function edit_category($id = null) {
        $category = $this->store_category_model->get($id);
        $categories = $this->store_category_model->order_by('id', 'ASC')->get_all();
        $this->template
        ->set('categories', $categories)
        ->set('category', $category)
        ->build('admin/edit_category');
    }

    // -----------------------------------------------------------------

    public function update_category() {

        $this->form_validation->set_rules('title', 'Titulo', 'required|trim');
        $this->form_validation->set_rules('parent', 'Padre', '');

        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            $data = array(
                'title' => $post->title,
                'slug' => slug($post->title),
                'parent' => $post->parent
                );

            if ($this->store_category_model->update($post->id,$data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/tiendas#page-categories');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/tiendas/create_category');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/tiendas/create_category');
        }
    }

    /*
     * Productos
     */

    public function create() {
        $categories = $this->store_category_model->order_by('id', 'ASC')->get_all();
        $this->template
        ->set('categories', $categories)
        ->build('admin/create');
    }

    // -----------------------------------------------------------------

    public function store() {

        // Validaciones del Formulario
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('categories', 'Categorias');
        $this->form_validation->set_rules('content', 'Descripción', 'required|trim');
        $this->form_validation->set_rules('introduction', 'Introducción', 'required|trim');
        $this->form_validation->set_rules('price', 'Precio', 'integer');

        // Se ejecuta la validación
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            // Array que se insertara en la base de datos
            $data = array(
                'name' => $post->name,
                'slug' => slug($post->name),
                'description' => html_entity_decode($post->content),
                'introduction' => $post->introduction,
                'price' => ($post->price) ? $post->price : null,
                'created_at' => date('Y-m-d H:i:s')
                );

            // Se carga la imagen
            $config['upload_path'] = './' . UPLOAD_PATH . '/stores';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2050;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            // imagen uno
            $img = $_FILES['image']['name'];

            if (!empty($img)) {
                if ($this->upload->do_upload('image')) {
                    $datos = array('upload_data' => $this->upload->data());
                    $path = UPLOAD_PATH . 'stores/' . $datos['upload_data']['file_name'];
                    $img = array('image' => $path);
                    $data = array_merge($data, $img);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/tiendas/');
                }
            }

            // Se inserta en la base de datos
            if ($this->store_model->insert($data)) {

                $storeId = $this->db->insert_id();
                $categories = $post->categories;

                // Se relacionan las categorias posteriormente a la inserción
                for($i=0; $i < count($categories); $i++){
                    $data = array(
                        'store_id' => $storeId,
                        'category_id' => $categories[$i]
                        );
                    $this->db->insert($this->db->dbprefix.'stores_categories', $data);
                }

                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/tiendas');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/tiendas/create');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/tiendas/create');
        }
    }

    // -----------------------------------------------------------------

    public function destroy($id = null) {
        $id or redirect('admin/tiendas');
        $obj = $this->db->where('id', $id)->get($this->db->dbprefix.'stores')->row();
        if ($this->store_model->delete($id)) {
            @unlink($obj->image); // Eliminamos archivo existente
            $this->db->delete($this->db->dbprefix.'stores_categories', array('store_id' => $id)); // Eliminaos relación pro cat
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/tiendas');
    }

    // --------------------------------------------------------------------------------------

    public function edit($id = null) {
        $id or redirect('admin/tiendas');
        $store = $this->store_model->get($id);
        $categories = $this->store_category_model->order_by('id', 'ASC')->get_all();

        $return = $this->db->where('store_id',$id)->get('stores_categories')->result();
        $selected_category = array();

        foreach ($return as $item) {
            $selected_category[] = $item->category_id;
        }

        $this->template
        ->set('categories', $categories)
        ->set('selected_category', $selected_category)
        ->set('store', $store)
        ->build('admin/edit');
    }

    // -----------------------------------------------------------------

    public function update() {

        // Validaciones del Formulario
        $this->form_validation->set_rules('name', 'Nombre', 'required|trim');
        $this->form_validation->set_rules('categories', 'Categorias');
        $this->form_validation->set_rules('content', 'Descripción', 'required|trim');
        $this->form_validation->set_rules('introduction', 'Introducción', 'required|trim');
        $this->form_validation->set_rules('price', 'Precio', 'integer');

        // Se ejecuta la validación
        if ($this->form_validation->run() === TRUE) {
            $post = (object) $this->input->post();

            // Array que se insertara en la base de datos
            $data = array(
                'name' => $post->name,
                'slug' => slug($post->name),
                'description' => html_entity_decode($post->content),
                'introduction' => $post->introduction,
                'price' => ($post->price) ? $post->price : null
                );

            // Se carga la imagen
            $config['upload_path'] = './' . UPLOAD_PATH . '/stores';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2050;
            $config['encrypt_name'] = true;

            $this->load->library('upload', $config);

            // imagen uno
            $img = $_FILES['image']['name'];

            if (!empty($img)) {
                if ($this->upload->do_upload('image')) {
                    $datos = array('upload_data' => $this->upload->data());
                    $path = UPLOAD_PATH . 'stores/' . $datos['upload_data']['file_name'];
                    $img = array('image' => $path);
                    $data = array_merge($data, $img);
                    $obj = $this->db->where('id', $post->id)->get('stores')->row();
                    @unlink($obj->image);
                } else {
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('admin/tiendas/');
                }
            }

            // Se inserta en la base de datos
            if ($this->store_model->update($post->id,$data)) {

                $this->db->delete($this->db->dbprefix.'stores_categories', array('store_id' => $post->id)); // Eliminaos relación pro cat

                $categories = $post->categories;

                // Se relacionan las categorias posteriormente a la inserción
                for($i=0; $i < count($categories); $i++){
                    $data = array(
                        'store_id' => $post->id,
                        'category_id' => $categories[$i]
                        );
                    $this->db->insert($this->db->dbprefix.'stores_categories', $data);
                }

                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/tiendas');
            } else {
                $this->session->set_flashdata('error', lang('galeria:error_message'));
                redirect('admin/tiendas/create');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/tiendas/create');
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
            if ($this->store_intro_model->update($post->id, $data)) {
                $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
                redirect('admin/tiendas#page-intro');
            } else {
                $this->session->set_flashdata('success', lang('gallery:error_message'));
                redirect('admin/tiendas#page-intro');
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/tiendas#page-intro');
        }
    }

    /*
     * Administración de imagenes
     */

    public function images($id = null) {
        $id or redirect('admin/tiendas');
        // Se consultan las imagenes del store
        $images = $this->store_image_model->get_many_by("store_id",$id);
        $store = $this->store_model->get_many_by("id",$id);
        $store = $store[0];

        $this->template
        ->set('store', $store)
        ->set('images', $images)
        ->build('admin/images');
    }

    // ----------------------------------------------------------------------------------

    public function create_image($id = null) {
        $id or redirect('admin/tiendas');
        $store = $this->store_model->get_many_by("id",$id);
        $store = $store[0];
        $this->template
        ->set('store', $store)
        ->build('admin/create_image');
    }

    // -----------------------------------------------------------------

    public function store_image() {

            // Se carga la imagen
        $config['upload_path'] = './' . UPLOAD_PATH . '/stores';
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
                $path = UPLOAD_PATH . 'stores/' . $datos['upload_data']['file_name'];
                $image = array(
                    'store_id' => $id,
                    'path' => $path
                    );
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('admin/tiendas/images/'.$id);
            }
        }

            // Se inserta en la base de datos
        if ($this->store_image_model->insert($image)) {
            $this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
            redirect('admin/tiendas/images/'.$id);
        } else {
            $this->session->set_flashdata('error', lang('galeria:error_message'));
            redirect('admin/tiendas/create_image/'.$id);
        }
    }

    // -----------------------------------------------------------------

    public function destroy_image($id = null,$store_id = null) {
        $id or redirect('admin/tiendas');
        $store_id or redirect('admin/tiendas');
        $obj = $this->store_image_model->get_many_by('id',$id);
        $obj = $obj[0];
        if ($this->store_image_model->delete($id)) {
            @unlink($obj->path); // Eliminamos archivo existente
            $this->session->set_flashdata('success', 'El registro se elimino con éxito.');
        } else {
            $this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
        }
        redirect('admin/tiendas/images/'.$store_id);
    }

}