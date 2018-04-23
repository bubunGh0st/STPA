<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignUpModel extends CI_Model {

        //To check if session is active in every page
        public function getSites(){
               
                $this->db->select("*");
                $this->db->from("ms_site");
                $query = $this->db->get();
                $result = $query->result();
                        
                return $result;
        }

        public function insertUser($post,$newPassword){
            $this->db->trans_start();

            $this->db->set('Email', $post["Email"]);
            $this->db->set('Password', md5($newPassword));
            $this->db->set('FName', $post["FName"]);
            $this->db->set('LName', $post["LName"]);
            $this->db->set('Title', $post["Title"]);
            $this->db->set('RoleID', "SITE-ADMIN");
            $this->db->set('Status', "ACTIVE-RESET");
            $this->db->insert('ms_user');

            $this->db->set('RefID', $post["Email"]);
            $this->db->set('Action', "RESET PASSWORD");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

}