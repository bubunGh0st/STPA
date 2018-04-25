<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApprovalModel extends CI_Model {

        //To return all users
        public function getUser(){
               
            $this->db->select("*");
            $this->db->from("ms_user");
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

        //User approval
        public function approveUser($post){

            $this->db->trans_start();

            $this->db->set('Status', "ACTIVE-RESET");
            $this->db->where('Email', $post['Email']);
            $this->db->update('ms_user'); 

            //insert into log_activity
            $this->db->set('RefID', $post["Email"]);
            $this->db->set('Action', "USER APPROVED");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

        //User Rejection
        public function rejectUser($post){

            $this->db->trans_start();

            $this->db->set('Status', "REJECTED");
            $this->db->where('Email', $post['Email']);
            $this->db->update('ms_user'); 

            //insert into log_activity
            $this->db->set('RefID', $post["Email"]);
            $this->db->set('Action', "USER REJECTED");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

}