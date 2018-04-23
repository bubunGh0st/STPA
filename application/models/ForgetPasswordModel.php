<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgetPasswordModel extends CI_Model {

        //To check if session is active in every page
        public function checkEmail($post){
                $result=false;

                $this->db->where("Status","ACTIVE");
                $this->db->where("Email",$post['Email']);
                $this->db->select("1");
                $this->db->from("ms_user");
                $query = $this->db->get();
                $row = $query->row();
                if($row!=NULL){
                        $result=true; 
                }       
                return $result;
        }

}