<?php

class ItemCRUDModel extends CI_Model{

    public function get_itemCRUD(){

        // if(!empty($this->input->get("search"))){

        //   $this->db->like('title', $this->input->get("search"));

        //   $this->db->or_like('description', $this->input->get("search")); 

        // }$query=$db->table('user')->get();

        $query = $this->db->get("user");

        return 'njfsjkngnkjls';
        // return $query->result();
        
    }



    public function insert_item()

    {    

        $data = array(

            'name' => $this->input->post('name'),

            'pass' => $this->input->post('pass')

        );

        return $this->db->insert('user', $data);

    }



    public function update_item($id) 
    {

        $data=array(

            'name' => $this->input->post('name'),

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

        return $this->db->delete('user', array('id' => $id));

    }

}

?>