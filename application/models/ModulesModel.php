<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModulesModel extends CI_Model {

        //To return all sites
        public function getModules(){
               
            $this->db->select("*");
            $this->db->from("ms_module");
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

        public function autogenerateID(){

            $this->db->limit(1,0);
            $this->db->order_by("ModuleID","DESC");
            $this->db->select("right(ModuleID,4) as LastNumber");
            $this->db->from("ms_module");
            $query = $this->db->get();
            var_dump($this->db->last_query());
            $row = $query->row();
            if($row!=NULL){
                    $result="M".sprintf('%04d', ((int)$row->LastNumber+1));
            }else{
                    $result="M0001";
            } 
            return $result;
        }
        //To insert into module database.
        public function insertModule($post){

            $this->db->trans_start();

            //insert into ms_module
            $this->db->set('ModuleID', $post["ModuleID"]);
            $this->db->set('ModuleName', $post["ModuleName"]);
            $this->db->insert('ms_module');

            //insert into log_activity
            $this->db->set('RefID', $post["ModuleID"]);
            $this->db->set('Action', "INSERTED MODULE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }
        //Edit Module
        public function updateModule($post){

            $this->db->trans_start();

            $this->db->set('ModuleName', $post["ModuleName"]);
            $this->db->where('ModuleID', $post['ModuleID']);
            $this->db->update('ms_module'); 

            //insert into log_activity
            $this->db->set('RefID', $post["ModuleID"]);
            $this->db->set('Action', "UPDATED MODULE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }
        //delete module
        public function deleteModule($post){

            $this->db->trans_start();

            $this->db->where('ModuleID', $post['ModuleID']);
            $this->db->delete('ms_module');


            //insert into log_activity
            $this->db->set('RefID', $post["ModuleID"]);
            $this->db->set('Action', "DLETED MODULE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }
        //To check if module is in ms_role_module table
        public function isDeleteModule($post){

            $this->db->select("ModuleID");
            $this->db->from("ms_role_module");
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

}