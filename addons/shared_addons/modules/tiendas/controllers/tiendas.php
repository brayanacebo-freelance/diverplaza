<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
*
* @author 	    Brayan Acebo
* @package 	PyroCMS
* @subpackage 	Stores
* @category 	Modulos
*/

class Tiendas extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $models = array(
            "store_model",
            "store_category_model",
            "store_image_model",
            "store_intro_model"
            );
        $this->load->model($models);
    }

// -----------------------------------------------------------------

    public function index($selCategory = null)
    {
        $category = null;
        if($selCategory){
            $category = $this->store_category_model->get_many_by("slug",$selCategory);
            if (count($category) > 0) {
            $category = $category[0]; // Categoria Seleccionada

            $return = $this->db->where('category_id',$category->id)->get('stores_categories')->result();
            $selected_category = array();
            $stores= array();
            $selected_stores = array();

            foreach ($return as $item) {
                $selected_stores[] = $item->store_id;
            }

            if(count($selected_stores) > 0){
                for ($i=0;$i<count($selected_stores);$i++) {
                // Se consulta storeo a storeo de la categoria
                    $store = $this->store_model->get_many_by("id",$selected_stores[$i]);
                    $store = $store[0];
                // Llenamos el nuevo objeto con todos los storeos
                    $storesObj = new stdClass();
                    $storesObj->id = $store->id;
                    $storesObj->name = substr($store->name, 0, 20);
                    $storesObj->image = val_image($store->image);
                    $storesObj->background = val_image($store->background);
                    $storesObj->introduction = substr($store->introduction, 0, 100);
                    $storesObj->price = ($store->price) ? "Precio: $".number_format($store->price) : null;
                    $storesObj->slug = $store->slug;
                    $storesObj->url = site_url('tiendas/detail/'.$store->slug);
                $stores[] = $storesObj; // Array de objectos
            }

                // Se ordena el Array por id de forma DESC
            // @usort($stores, function($a, $b)
            // {
            //     return strcmp($b->id, $a->id);
            // });
        }

    }else{
                redirect("tiendas"); // si la categoria no existe me redirecciona a todos
            }
        }else{

        // Se consultan los storeos
            $stores = $this->store_model
            ->order_by('id', 'DESC')
            ->get_all();

            foreach($stores AS $item)
            {
                $item->name = substr($item->name, 0, 20);
                $item->image = val_image($item->image);
                $item->introduction = substr($item->introduction, 0, 100);
                $item->price = ($item->price) ? "Precio: $".number_format($item->price) : null;
                $item->url = site_url('tiendas/detail/'.$item->slug);
            }
        }

    // Consultamos las categorias
        $categories = $this->store_category_model
        ->order_by('title', 'ASC')
        ->get_all();

    // Intro
        $in = $this->store_intro_model->get_all();
        $intro = array();
        if (count($in) > 0) {
            $intro = $in[0];
        }

    // Devuelve arbol en HTML, el segundo parametro es el nombre del modulo
        $menu = treemenu($categories,'tiendas');

        $this->template
        ->set('stores', $stores)
        ->set('category', ($category) ? "/ ".$category->title : null)
        ->set('categories', $categories)
        ->set('menu', $menu)
        ->set('intro', $intro)
        ->build('index');
    }


// ----------------------------------------------------------------------

    public function detail($slug)
    {

        $return = $this->store_model->get_many_by('slug', $slug);
        $return = $return[0];

        if(!$return)
            redirect('tiendas');

        // Se convierten algunas variables necesarias para usar como slugs
        $setter = array(
            'image' => val_image($return->image),
            'price' => ($return->price) ? "Precio: $".number_format($return->price) : null
            );

        $store = array_merge((array)$return,$setter);

        $relation = $this->db->where('store_id',$store['id'])->get('stores_categories')->result();
        $categories = array();
        foreach ($relation as $item) {
            $category = $this->store_category_model->get_many_by('id', $item->category_id);
            $category = $category[0];
            $categories[] = array(
                    "title" => $category->title,
                    "slug" => $category->slug
                );
        }

        // imagenes para slider
        $images = $this->store_image_model->get_many_by('store_id',$store['id']);

        $this->template
                ->set('store', (object) $store)
                ->set('categories', $categories)
                ->set('images', $images)
                ->build('detail');

    }
}