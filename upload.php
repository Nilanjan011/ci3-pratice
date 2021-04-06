<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
       parent::__construct(); 

        $this->load->library('form_validation');

        $this->load->model('user_model');

    }
	public function index()
	{
		$data['data'] = $this->user_model->get_data();
        
		$this->load->view('header',["title"=>"User"]);
		 $this->load->view('user',$data);
		$this->load->view('footer');
	}
	public function add()
	{
		// $this->load->view('welcome_message');
		$this->load->view('header',["title"=>"Add"]);
		$this->load->view('add');
		$this->load->view('footer');
	}
	public function edit($id)
	{
		$item = $this->user_model->find_item($id);
		$this->load->view('header',["title"=>"Edit"]);
		$this->load->view('edit',['item'=>$item]);
		$this->load->view('footer');
	}
	public function insert()
	{

		$config=[
            'upload_path'=>'upload/',
            'allowed_types'=>'jpg|jpeg|png|gif'
        ];
         $new_name = time() . '-' . $_FILES["userFile"]['name'];
         $config['file_name'] = $new_name;
        $this->load->library('upload',$config);
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('phone', 'Phone', 'required');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('address', 'Address', 'required');
            
    
            if ($this->form_validation->run() == FALSE){
                // $this->session->set_flashdata('errors', validation_errors());
                // redirect('y');
                $this->load->view('header',["title"=>"User"]);
                $this->load->view('add');
                $this->load->view('footer');
            }else {
                if($this->upload->do_upload('userFile'))
                {
                   $data=$this->upload->data();
                   $image_path=('upload/'.$data['raw_name'].$data['file_ext']);
                   // $image_path="image";
                }else {
                    $upload_error=$this->upload->display_errors();
                    $this->load->view('add',compact('upload_error'));
                }
                $this->user_model->insert_item($image_path);
                redirect(site_url('/'));
            }
    
        }
	}
	public function delete($id)
    {
        $item = $this->user_model->delete_item($id);

        redirect(site_url('/'));

    }
    public function update($id)
   {
   		// $img=($_FILES["userFile"]["name"]);
   		// echo $img;die();
   		$rand=rand(1,9999999999999);

   		$config=[
            'upload_path'=>'upload/',
            'allowed_types'=>'jpg|jpeg|png|gif'
        ];
         $new_name = time() . '-' . $_FILES["userFile"]['name'];
         $config['file_name'] = $new_name;
        $this->load->library('upload',$config);
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        

        if ($this->form_validation->run() == FALSE){
        	$this->load->view('header',["title"=>"Edit"]);
            $this->load->view('edit',['item'=>$id]);
            $this->load->view("footer");

        }else{ 
        		if($this->upload->do_upload('userFile'))
                {
                   $data=$this->upload->data();
                   $data["raw_name"]=$data["raw_name"];
                   $image_path=('upload/'.$data['raw_name'].$data['file_ext']);
                }else {
                    $upload_error=$this->upload->display_errors();
                    $this->load->view('edit',compact('upload_error'));
                }
        		$this->user_model->update_item($id,$image_path);

          		redirect(site_url('/'));
        }

    }

}
