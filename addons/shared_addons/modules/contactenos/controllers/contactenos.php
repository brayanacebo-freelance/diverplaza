<?php



defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * @author Brayan Acebo

 */

class Contactenos extends Public_Controller {



    public function __construct() {

        parent::__construct();
         
    }



    // -----------------------------------------------------------------



    public function index()

    {



        $this->template
                ->build('index');

    }


    /*
     *Enviar correo
     */

    function send()

    {
        
       $post = (object) $this->input->post(null);
       


        $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('apellidos', 'Apellidos', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('email', 'eMail', 'required|trim|valid_email|max_length[100]');
        $this->form_validation->set_rules('comentarios', 'Comentarios', 'required|trim|max_length[455]');


        if ($this->form_validation->run() === TRUE) {


            $config = array(

                'mailtype' => 'html',

                'wordwrap' => TRUE,

                'protocol' => 'sendmail',

                'charset' => 'utf-8',

                'crlf' => '\r\n',

                'newline' => '\r\n'

            );



            $data['post'] = array(

                'nombre' => $post->nombre,
                'apellidos' => $post->apellidos,
                'email' => $post->email,
                'comentarios' => $post->comentarios

            );


			// mandamos los datos al correo

            $this->email->initialize($config);

            $this->email->from($post->email, 'Formulario de Contacto '.base_url());
            $this->email->to("brayanacebo@gmail.com");

            $this->email->subject('Contacto');

            $msg = $this->load->view('email', $data, true);

            $this->email->message($msg);

            //Validate sendmail
            if( $this->email->send()){
                 $this->session->set_flashdata('success', 'Su mensaje a sido enviado');
                 redirect(base_url('contactenos'));
            }else{
                $this->session->set_flashdata('error', 'Error Mailing, Contact the Webmaster');
                redirect(base_url('contactenos'));
            }
        } else {

            $this->session->set_flashdata('error', validation_errors());
            redirect(base_url('contactenos'));

        }

    }



}