<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignInModel extends CI_Model {

        public function isSession(){
                $result=false;
                if ($this->session->userdata['email'] == true){
                        $this->db->where("Status","ACTIVE");
                        $this->db->where("Email",$this->session->userdata['email']);
                        $this->db->select("1");
                        $this->db->from("ms_user");
                        $query = $this->db->get();
                        $row = $query->row();
                        if($row!=NULL){
                                $result=true; 
                        }       
                }
                return $result;
        }

}