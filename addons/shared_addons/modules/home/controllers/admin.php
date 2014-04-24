<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * @author 	Luis Fernando Salazar
 * @author 	Brayan Acebo
 * @package 	PyroCMS
 * @subpackage 	Home Module
 * @category 	Modulos
 * @license 	Apache License v2.0
 */
class Admin extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->lang->load('home');
		$this->template->append_metadata($this->load->view('fragments/wysiwyg', null, TRUE));
		$this->load->model(array('home_banner_m', 'home_outstanding_m', 'home_social_networks_m'));
	}

    // -----------------------------------------------------------------

	public function index() {
        // Banner
		$banner = $this->home_banner_m->get_all();
		$num_banner = $this->home_banner_m->count_all();

        // Destacados Noticias
		$outstanding_news = $this->home_outstanding_m->where('type', '1')->get_all();

		// Destacados Servicios
		$outstanding_services = $this->home_outstanding_m->where('type', '2')->get_all();

        // redes sociales
		$social_networks = $this->home_social_networks_m->get_all();

		$this->template
		->set('banner', $banner)
		->set('num_banner', $num_banner)
		->set('outstanding_news', $outstanding_news)
		->set('outstanding_services', $outstanding_services)
		->set('social_networks', $social_networks)
		->build('admin/home_back');
	}

    /*
     * Destacados
     */

	// editamos o creamos una noticia o servicio destacada
    public function edit_outstanding($typeItem = null, $idItem = null)
    {
    	$endurl = ($typeItem == 1) ? "#page-outstanding" : "#page-services";
    	$this->form_validation->set_rules('title', 'Título', 'required|max_length[180]|trim');
    	$this->form_validation->set_rules('text', 'Texto', 'required|max_length[300]|trim');
    	$this->form_validation->set_rules('link', 'Link', 'max_length[420]|valid_url');

		if($this->form_validation->run()!==TRUE)  // abrimos el formulario de edicion
		{
			if(validation_errors() == "")
			{
				$this->session->set_flashdata('error', validation_errors());
			}
			if(!empty($idItem))  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
				$idItem or redirect('admin/home'.$endurl);

				$titulo = ($typeItem == '1' ? 'Editar Noticia' : 'Editar Servicio');
				$outstanding = $this->home_outstanding_m->get($idItem);

				$this->template
				->set('outstanding', $outstanding)
				->set('typeItem', $typeItem)
				->set('titulo', $titulo)
				->build('admin/edit_outstanding_back');
			}
			else
			{
				$titulo = ($typeItem == '1' ? 'Crear Noticia' : 'Crear Servicio');
				$this->template
				->set('typeItem', $typeItem)
				->set('titulo', $titulo)
				->build('admin/edit_outstanding_back');
			}
		}
		else // si el formulario ha sido enviado con éxito se procede
		{
			$_POST['type'] = $typeItem;
			if($idItem != null)  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
				unset($_POST['btnAction']);
				$data = $_POST;

				$config['upload_path'] = './' . UPLOAD_PATH . '/home_outstanding';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 2050;
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);

	            // imagen uno
				$img = $_FILES['image']['name'];

				if (!empty($img)) {
					if ($this->upload->do_upload('image'))
					{
						$datos = array('upload_data' => $this->upload->data());
						$path = UPLOAD_PATH . 'home_outstanding/' . $datos['upload_data']['file_name'];
						$img = array('image' => $path);
						$data = array_merge($data, $img);
						$obj = $this->db->where('id', $idItem)->get('home_outstanding')->row();
						@unlink($obj->image);
					} else {
						$this->session->set_flashdata('error', $this->upload->display_errors());
						return $this->index();
					}
				}

				if ($this->home_outstanding_m->update($idItem, $data)) {
					$this->session->set_flashdata('success', 'Los registros se actualizarón con éxito.');
					redirect('admin/home'.$endurl);
				} else {
					$this->session->set_flashdata('success', lang('home:error_message'));
					return $this->editar_destacado();
				}
			}
			else
			{
				unset($_POST['btnAction']);
				$data = $_POST;

				$config['upload_path'] = './' . UPLOAD_PATH . '/home_outstanding';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 2050;
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);

	            // imagen
				$img = $_FILES['image']['name'];

				if (!empty($img)) {
					if ($this->upload->do_upload('image'))
					{
						$datos = array('upload_data' => $this->upload->data());
						$path = UPLOAD_PATH . 'home_outstanding/' . $datos['upload_data']['file_name'];
						$img = array('image' => $path);
						$data = array_merge($data, $img);
					}
					else
					{
						$this->session->set_flashdata('error', $this->upload->display_errors());
						return $this->index();
					}
				}

				if ($this->home_outstanding_m->insert($data)) {
					$this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
					redirect('admin/home'.$endurl);
				} else {
					$this->session->set_flashdata('success', lang('home:error_message'));
					return $this->nuevo_destacado();
				}
			}
		}
	}

    // -----------------------------------------------------------------

	public function delete_outstanding($idItem = null)
	{
		$idItem or redirect('admin/home#page-outstanding');

		$obj = $this->db->where('id', $idItem)->get($this->db->dbprefix.'home_outstanding')->row();

		if ($this->home_outstanding_m->delete($idItem))
		{
			@unlink($obj->image);
			$this->session->set_flashdata('success', 'El registro se elimino con éxito.');
		}
		else
		{
			$this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
		}
		redirect('admin/home#page-outstanding');
	}

    /*
     * Banner
     */

    public function edit_banner($idItem = null)
    {
    	$this->form_validation->set_rules('title', 'Título', 'required|max_length[180]|trim');
    	$this->form_validation->set_rules('text', 'Texto', 'required|max_length[300]|trim');
    	$this->form_validation->set_rules('link', 'Link', 'max_length[420]|valid_url');

		if($this->form_validation->run()!==TRUE)  // abrimos el formulario de edicion
		{
			if(validation_errors() == "")
			{
				$this->session->set_flashdata('error', validation_errors());
			}
			if(!empty($idItem))  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
				$idItem or redirect('admin/home');

				$titulo = 'Editar Slider';
				$banner = $this->home_banner_m->get($idItem);

				$this->template
				->set('banner', $banner)
				->set('titulo', $titulo)
				->build('admin/edit_banner_back');
			}
			else
			{
				$titulo = 'Crear Slider';
				$this->template
				->set('titulo', $titulo)
				->build('admin/edit_banner_back');
			}
		}
		else // si el formulario ha sido enviado con éxito se procede
		{
			if($idItem != null)  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
				unset($_POST['btnAction']);
				$data = $_POST;

				$config['upload_path'] = './' . UPLOAD_PATH . '/home_banner';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 2050;
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);

	            // imagen uno
				$img = $_FILES['image']['name'];

				if (!empty($img)) {
					if ($this->upload->do_upload('image')) {
						$datos = array('upload_data' => $this->upload->data());
						$path = UPLOAD_PATH . 'home_banner/' . $datos['upload_data']['file_name'];
						$img = array('image' => $path);
						$data = array_merge($data, $img);
						$obj = $this->db->where('id', $idItem)->get('home_banner')->row();
						@unlink($obj->image);
					} else {
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('admin/home/');
					}
				}

				if ($this->home_banner_m->update($idItem, $data)) {
					$this->session->set_flashdata('success', 'Los registros se actualizarón con éxito.');
					redirect('admin/home/');
				} else {
					$this->session->set_flashdata('success', lang('home:error_message'));
					redirect('admin/home/');
				}
			}
			else
			{
				unset($_POST['btnAction']);
				$data = $_POST;

				$config['upload_path'] = './' . UPLOAD_PATH . '/home_banner';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 2050;
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);

	            // imagen uno
				$img = $_FILES['image']['name'];

				if (!empty($img)) {
					if ($this->upload->do_upload('image')) {
						$datos = array('upload_data' => $this->upload->data());
						$path = UPLOAD_PATH . 'home_banner/' . $datos['upload_data']['file_name'];
						$img = array('image' => $path);
						$data = array_merge($data, $img);
					} else {
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('admin/home/');
					}
				}

				if ($this->home_banner_m->insert($data)) {
					$this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
					redirect('admin/home/');
				} else {
					$this->session->set_flashdata('success', lang('home:error_message'));
					return $this->nuevo_destacado();
				}
			}
		}
	}

	public function delete_banner($id = null)
	{
		$id or redirect('admin/home/');

		$obj = $this->db->where('id', $id)->get($this->db->dbprefix.'home_banner')->row();
			if ($this->home_banner_m->delete($id)) {
				@unlink($obj->image);
				$this->session->set_flashdata('success', 'El registro se elimino con éxito.');
			} else {
				$this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
			}

		redirect('admin/home/');

	}

	public function edit_social_network($idItem = null)
	{
		$this->form_validation->set_rules('name', 'Nombre', 'required|max_length[100]|trim');
		$this->form_validation->set_rules('url', 'Dirección Url', 'max_length[420]|valid_url');

		if($this->form_validation->run()!==TRUE)  // abrimos el formulario de edicion
		{
			if(validation_errors() == "")
			{
				$this->session->set_flashdata('error', validation_errors());
			}
			if(!empty($idItem))  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
				$idItem or redirect('admin/home#page-social-network');

				$titulo = 'Editar Redes Sociales';
				$social_network = $this->home_social_networks_m->get($idItem);

				$this->template
				->set('social_network', $social_network)
				->set('titulo', $titulo)
				->build('admin/edit_social_network_back');
			}
			else
			{
				$titulo = 'Crear Slider';
				$this->template
				->set('titulo', $titulo)
				->build('admin/edit_social_network_back');
			}
		}
		else // si el formulario ha sido enviado con éxito se procede
		{
			if($idItem != null)  // si se envia un dato por la URL se hace lo siguiente (Edita)
			{
				unset($_POST['btnAction']);
				$data = $_POST;

				$config['upload_path'] = './' . UPLOAD_PATH . '/home_social_networks';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 2050;
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);

	            // imagen uno
				$img = $_FILES['icon']['name'];

				if (!empty($img)) {
					if ($this->upload->do_upload('icon')) {
						$datos = array('upload_data' => $this->upload->data());
						$path = UPLOAD_PATH . 'home_social_networks/' . $datos['upload_data']['file_name'];
						$img = array('icon' => $path);
						$data = array_merge($data, $img);
						$obj = $this->db->where('id', $idItem)->get('home_social_networks')->row();
						@unlink($obj->icon);
					} else {
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('admin/home#page-social-network');
					}
				}

				if ($this->home_social_networks_m->update($idItem, $data)) {
					$this->session->set_flashdata('success', 'Los registros se actualizarón con éxito.');
					redirect('admin/home#page-social-network');
				} else {
					$this->session->set_flashdata('success', lang('home:error_message'));
					redirect('admin/home#page-social-network');
				}
			}
			else
			{
				unset($_POST['btnAction']);
				$data = $_POST;

				$config['upload_path'] = './' . UPLOAD_PATH . '/home_social_networks';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = 2050;
				$config['encrypt_name'] = true;

				$this->load->library('upload', $config);

	            // imagen uno
				$img = $_FILES['icon']['name'];

				if (!empty($img)) {
					if ($this->upload->do_upload('icon')) {
						$datos = array('upload_data' => $this->upload->data());
						$path = UPLOAD_PATH . 'home_social_networks/' . $datos['upload_data']['file_name'];
						$img = array('icon' => $path);
						$data = array_merge($data, $img);
						$obj = $this->db->where('id', $idItem)->get('home_social_networks')->row();
						@unlink($obj->icon);
					} else {
						$this->session->set_flashdata('error', $this->upload->display_errors());
						redirect('admin/home#page-social-network');
					}
				}

				if ($this->home_social_networks_m->insert($data)) {
					$this->session->set_flashdata('success', 'Los registros se ingresaron con éxito.');
					redirect('admin/home#page-social-network');
				} else {
					$this->session->set_flashdata('success', lang('home:error_message'));
					return $this->nuevo_destacado();
				}
			}
		}
	}

	public function delete_social_network($id = null)
	{
		$id or redirect('admin/home#page-social-network');

		$obj = $this->db->where('id', $id)->get($this->db->dbprefix.'home_social_networks')->row();

		if ($this->home_social_networks_m->delete($id))
		{
			@unlink($obj->icon);
			$this->session->set_flashdata('success', 'El registro se elimino con éxito.');
		}
		else
		{
			$this->session->set_flashdata('error', 'No se logro eliminar el registro, inténtelo nuevamente');
		}
		redirect('admin/home#page-social-network');
	}
}
