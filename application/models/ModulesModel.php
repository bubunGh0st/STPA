<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModulesModel extends CI_Model {

        //To return all modules
        public function getModules(){
               
            $this->db->select("*");
            $this->db->from("ms_module");
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

        //to return one row all columns from selected ms_module
         public function getModule($ModuleID){
               
            $this->db->where('ModuleID',$ModuleID);
            $this->db->select("*");
            $this->db->from("ms_module");
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                return $row;
            }else{
                return NULL;
            }
        }

        public function autogenerateID(){

            $this->db->limit(1,0);
            $this->db->order_by("ModuleID","DESC");
            $this->db->select("right(ModuleID,4) as LastNumber");
            $this->db->from("ms_module");
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                    $result="M".sprintf('%04d', ((int)$row->LastNumber+1));
            }else{
                    $result="M0001";
            } 
            return $result;
        }
        //To insert into module database.
        public function insertModule($post,$Email=""){

            $this->db->trans_start();

            if(empty($Email)){
            $Email=$this->session->userdata['Email'];
            }

            //insert into ms_module
            $this->db->set('ModuleID', $post["ModuleID"]);
            $this->db->set('ModuleName', $post["ModuleName"]);
            $this->db->insert('ms_module');

            //insert into log_activity
            $this->db->set('RefID', $post["ModuleID"]);
            $this->db->set('Action', "INSERTED MODULE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

        //Edit Module
        public function updateModule($post,$Email=""){

            $this->db->trans_start();

            if(empty($Email)){
            $Email=$this->session->userdata['Email'];
            }

            $this->db->set('ModuleName', $post["ModuleName"]);
            $this->db->where('ModuleID', $post['ModuleID']);
            $this->db->update('ms_module'); 

            //insert into log_activity
            $this->db->set('RefID', $post["ModuleID"]);
            $this->db->set('Action', "UPDATED MODULE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

        //delete module
        public function deleteModule($ModuleID,$Email=""){

            $this->db->trans_start();

            if(empty($Email)){
            $Email=$this->session->userdata['Email'];
            }

            $this->db->where('ModuleID', $ModuleID);
            $this->db->delete('ms_module');

            //insert into log_activity
            $this->db->set('RefID', $ModuleID);
            $this->db->set('Action', "DELETED MODULE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }
        
        //To check if module is in ms_role_module table
        public function isDeleteModule($ModuleID){

            $this->db->select("ModuleID");
            $this->db->from("ms_role_module");
            $this->db->where('ModuleID', $ModuleID);
            $query = $this->db->get();
            $result = $query->row();
            if($result != NULL){
                $result = False;
            }
            else{
                $result = True;
            }        
            return $result;
        }

        public function isGranted($ModuleID=array(),$Email=""){
            if(empty($Email)){
                $Email=$this->session->userdata['Email'];
            }
            $this->db->select("1");
            $this->db->from("ms_role_module a");
            $this->db->join("ms_user b","b.RoleID = a.RoleID");
            $this->db->where_in('a.ModuleID', $ModuleID);
            $this->db->where('b.Email', $Email);
            $query = $this->db->get();
           // var_dump($this->db->last_query());

            $result = $query->row();
            if($result != NULL){
                $result = True;
            }
            else{
                $result = False;
            }        
            return $result;
        }

}