<?php

class G_model extends CI_Model{

    public function __construct() {
        parent::__construct(); 
        $this->load->database();
    }

    public function get_data(){

        $this->load->database();
       
        $query = $this->db->get('user');

        return $query->result();
        
    }

    public function login_check(){
        $email =$this->input->post('email');
        $pass =$this->input->post('pass');
            
        $this->db->where('name', $email);
        $this->db->where('pass', md5($pass));
        $query= $this->db->get("user");

        if ($query->num_rows()==1) {
            return $query->num_rows();
        }
        return false;
    }

    public function insert_item($image_path)
    {    
        $data = array(

            'name' => $this->input->post('email'),
            'pass' => md5($this->input->post('pass')),
            'image'=>$image_path

        );

        return $this->db->insert('user', $data);

    }



    public function update_item($id) 
    {

        $data=array(

            'name' => $this->input->post('email'),

            'pass' => $this->input->post('pass')

        );

        if($id==0){

            return $this->db->insert('user',$data);

        }else{

            $this->db->where('id',$id);

            return $this->db->update('user',$data);

        }        

    }



    public function find_item($id)
    {

        return $this->db->get_where('user', array('id' => $id))->row();

    }



    public function delete_item($id)
    {
        $image=$this->find_item($id);
        unlink($image->image);
        return $this->db->delete('user', array('id' => $id));

    }

}

?>