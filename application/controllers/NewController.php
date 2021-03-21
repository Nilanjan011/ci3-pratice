<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewController extends CI_Controller {

    public $g;
    public function __construct() {
       parent::__construct(); 
  
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('G_model');
        $this->g=new G_model;
        // $this->load->model('ItemCRUDModel');
    }
    public function new($id){
        $ii=['id'=>$id, "n"=>"niochgg"];
        $this->load->view('service',['ii'=>$ii]);
    } 
    public function yy(){
        $this->load->view('service');
    }
    public function postform(){
        $config=[
            'upload_path'=>'./upload/',
            'allowed_types'=>'jpg|jpeg|png|gif'
        ];
        $this->load->library('upload',$config);
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.name]');
            $this->form_validation->set_rules('pass', 'Password', 'required');
            
    
            if ($this->form_validation->run() == FALSE){
                // $this->session->set_flashdata('errors', validation_errors());
                // redirect('y');
                $this->load->view('service');
            }else {
                if($this->upload->do_upload())
                {
                   $data=$this->upload->data();
                   $image_path=('upload/'.$data['raw_name'].$data['file_ext']);
                }else {
                    $upload_error=$this->upload->display_errors();
                    return $this->load->view('service',compact('upload_error'));
                }
                $this->G_model->insert_item($image_path);
                redirect(site_url('d'));
            }
    
        }
    }

    public function display(){
        $data['data'] = $this->G_model->get_data();
        $this->load->view('welcome_message',$data);
    }
    public function delete($id)
    {
        $item = $this->G_model->delete_item($id);

        redirect(site_url('d'));

    }
    public function edit($id)
    {
        $item = $this->g->find_item($id);
        // print_r($item);die();
        $this->load->view('edit',['item'=>$item]);
    
    }
   /**

    * Update Data from this method.

    *

    * @return Response

   */

   public function update($id)
   {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('pass', 'Password', 'required');

        if ($this->form_validation->run() == FALSE){

            $this->load->view('edit',['item'=>$id]);

        }else{ 

          $this->g->update_item($id);

          redirect(site_url('d'));

        }

    }
    public function login_view()
    {
        $csrf = array(
            'name' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('login',['csrf'=> $csrf]);
    }  
    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('pass', 'Password', 'required');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('login');
        }else{
        //    $data=[
        //        'name'=>$this->input->post('email'),      
        //        'pass'=>$this->input->post('pass'),            
        //    ];
        //    $data = $this->security->xss_clean($data);// clean all HTML tag like <script>alert("XSS")</script>
           $user=$this->g->login_check();
            if ($user) {
                $users=$this->input->post('email');
                $this->session->set_userdata("users",$users);
                // var_dump($this->session->has_userdata('users'));
                // echo ($this->session->userdata('users')); // it's print session value 
                // var_dump($this->session->unset_userdata('users')); // it's unset session value
                redirect(site_url('home')); 

            }else {
                $this->session->set_flashdata('errors', "Email or password wrong");
                // $this->load->view('login');
                redirect(site_url('login'));
            }
 
         }
 
    }

    public function logout(){
        $this->session->unset_userdata('users'); // it's unset session value
        $this->session->unset_userdata('errors'); // it's unset session value
        redirect(site_url('login'));
    }

    public function n()
    {
        echo "<h1>It is for button 1 response </h1>";
        // $data = $this->G_model->get_data();
        // echo json_encode($data);
    }

    public function n2()
    {
        echo "<h1>It is for button 222222222222222 response </h1><br>
        <form action='' method='get'>
        <input type='text' placeholder='vhjsdbvdsbf'>
        <input type='submit' value='Submit'>
        </form>";
    }


}

?>