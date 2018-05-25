<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileModel extends CI_Model {

        //To update profile
        public function updateProfile($post,$Email=""){
                $this->db->trans_start();

                if(empty($Email)){
                $Email = $this->session->userdata['Email'];
                }

                $this->db->set('FName', $post['FName']);
                $this->db->set('LName', $post['LName']);
                $this->db->set('Title', $post['Title']);
                $this->db->where('Email', $Email);
                $this->db->update('ms_user'); 

                $this->db->set('RefID', $Email);
                $this->db->set('Action', "UPDATED PROFILE");
                $this->db->set('EntryTime', date("Y-m-d H:i:s"));
                $this->db->set('EntryEmail', $Email);
                $this->db->insert('log_activity'); 

                $this->db->trans_complete();
        }


}