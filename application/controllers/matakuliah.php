<?php  
 
    defined('BASEPATH') or exit('No direct script access allowed'); 
    require APPPATH . 'libraries/REST_Controller.php'; 
     
     //ini berfungsi untuk constructor
    class Matakuliah extends REST_Controller { 
  
        function _construct() {
        parent::__construct();
        $this->load->database(); 
        }
    
     
//ini berfungsi untuk melihat data
    function index_get(){ 
        $id = $this->get('kode_mk'); 
        if($id == ''){ 
            $matakuliah = $this->db->get('matakuliah')->result();
        }else{ 
            $this->db->where('kode_mk',$id); 
            $matakuliah = $this->db->get('matakuliah')->result();
        } 
        $this->response($matakuliah, REST_Controller::HTTP_OK);
    } 
     
// ini berfungsi untuk menambahkan data
    function index_post(){ 
        $data = array( 
            'kode_mk' => $this->post('kode_mk'), 
            'nama' => $this->post('nama'),
            'semester' => $this->post('semester'),
            'sks' => $this->post('sks'),
            'sifat' => $this->post('sifat')); 
             
            $insert = $this->db->insert('matakuliah', $data); 
             
            if($insert){ 
                $this->response($data, REST_Controller::HTTP_OK);
            }else{ 
                $this->response(array('status' => 'fail', 502));
            }
    } 
     
//ini berfungsi untuk mengubah atau mengedit data
    function index_put(){ 
         $id = $this->put('kode_mk'); 
         $data = array( 
            'kode_mk' => $this->put('kode_mk'), 
            'nama' => $this->put('nama'),
            'semester' => $this->put('semester'),
            'sks' => $this->put('sks'),
            'sifat' => $this->put('sifat') 
        );  

        $this->db->where('kode_mk', $id); 
        $update = $this->db->update('matakuliah', $data); 
         
        if($update){ 
            $this->response($data, REST_Controller::HTTP_OK); 
        }else{ 
            $this->response(array('status' => 'fail', 502));
        }
         
    } 
 
     
     
 //ini berfungsi untuk menghapus data
    function index_delete(){ 
        $id = $this->delete('kode_mk'); 
        $this->db->where('kode_mk', $id); 
        $delete = $this->db->delete('matakuliah'); 
         
        if($delete){  
            $this->response(array('status'=> 'success', 2011)); 
        }else{ 
            $this->response(array('status' => 'fail', 502));
        }
    }
 
 
}
