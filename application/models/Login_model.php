<?php defined('BASEPATH') OR exit('No direct script access allowed');

class login_model extends CI_Model
{
     function __construct()
     {
          // Call the Model constructor
          parent::__construct();
          $this->load->database();
          $this ->load->library('encryption');
          $key  =  $this->encryption->create_key( 16 );
     }

     //get the username & password 
      function get_pass($usr, $pwd)
     {
          $sql = "select password from sistemas_users where username = '" . $usr . "' and password = '" . $pwd . "'";
          $query = $this->db->query($sql);
          if($query->num_rows() > 0){
               return $query->row_array();
          }else{
               return false;
          } 
     }

     function get_user($usr, $pwd)
     {
          
         /* $pass  =  $this->encryption->encrypt($pwd);
          $plain_text  =  $pass."Puntosdeinteres" ; 
          $clavef  =  $this->encryption->encrypt($plain_text);*/
          $sql = "select * from sistemas_users where username = '" . $usr . "' and password = '" . $pwd . "'";
          $query = $this->db->query($sql);
          if($query->num_rows() > 0){
               return $query->result();
          }else{
               return false;
          }
          
     }
     function get_di($usr, $pwd)
     {
          $sql = "select id from sistemas_users where username = '" . $usr . "' and password = '" . $pwd . "'";
          $query = $this->db->query($sql);
          if($query->num_rows() > 0){
               return $query->row_array();
          }else{
               return false;
          } 
     }


     function get_nivel($usr, $idS){
          $sql = "select nivel_acceso from sistemas_sistemasxusuario where id_sistema = '" . $idS . "'and id_usuario= '" . $usr . "'";
          $query = $this->db->query($sql);
          if($query->num_rows() > 0){
               return $query->row_array();
          }else{
               return false;
          }

     }

     function form_insert($data){
     // Inserting in Table(students) of Database(college)
     $this->db->insert('sistemas_users', $data);
     }

}