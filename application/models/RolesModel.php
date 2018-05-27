<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RolesModel extends CI_Model {

        //To return all roles
        public function getRoles(){
               
            $this->db->select("*");
            $this->db->from("ms_role");
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

        //to return one row all columns from selected ms_role
         public function getRole($RoleID){
               
            $this->db->where('RoleID',$RoleID);
            $this->db->select("*");
            $this->db->from("ms_role");
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                return $row;
            }else{
                return NULL;
            }
        }

        //To return all modules belong to role
        public function getRoleModules($RoleID){
               
            $this->db->where('a.RoleID',$RoleID);
            $this->db->select("a.*,b.ModuleName");
            $this->db->from("ms_role_module a");
            $this->db->join('ms_module b', 'a.ModuleID = b.ModuleID');
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

        //To return all modules dont belong to role
        public function getNotRoleModules($RoleID){
               

            $query = $this->db->query("Select a.*
                                       From ms_module a
                                       Where a.ModuleID Not In (Select ModuleID From ms_role_module Where RoleID = '".$RoleID."') ");
            $result = $query->result();
                    
            return $result;
        }

         //To insert into role database.
        public function insertRole($post,$Email=""){

            $this->db->trans_start();
            if(empty($Email)){
                $Email=$this->session->userdata['Email'];
            }

            //insert into ms_module
            $this->db->set('RoleID', $post["RoleID"]);
            $this->db->set('RoleName', $post["RoleName"]);
            $this->db->insert('ms_role');

            //insert into log_activity
            $this->db->set('RefID', $post["RoleID"]);
            $this->db->set('Action', "INSERTED ROLE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

        //Edit Module
        public function updateRole($post,$Email=""){

            $this->db->trans_start();
            
            if(empty($Email)){
                $Email=$this->session->userdata['Email'];
            }

            $this->db->set('RoleName', $post["RoleName"]);
            $this->db->where('RoleID', $post['RoleID']);
            $this->db->update('ms_role'); 

            //insert into log_activity
            $this->db->set('RefID', $post["RoleID"]);
            $this->db->set('Action', "UPDATED ROLE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

        //check if role id already exists
        public function isInsertRole($RoleID){

            $this->db->select("1");
            $this->db->from("ms_role");
            $this->db->where('RoleID', $RoleID);
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

         //grant module to role
        public function grantModule($post,$Email=""){

            $this->db->trans_start();
            if(empty($Email)){
                $Email=$this->session->userdata['Email'];
            }

            //insert into ms_module
            $this->db->set('RoleID', $post["RoleID"]);
            $this->db->set('ModuleID', $post["ModuleID"]);
            $this->db->insert('ms_role_module');

            //insert into log_activity
            $this->db->set('RefID', $post["RoleID"]);
            $this->db->set('Action', "GRANT MODULE ".$post["ModuleID"]);
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

        //revoke module from role
        public function revokeModule($post,$Email=""){

            $this->db->trans_start();
            if(empty($Email)){
                $Email=$this->session->userdata['Email'];
            }


            $this->db->where('RoleID', $post["RoleID"]);
            $this->db->where('ModuleID', $post["ModuleID"]);
            $this->db->delete('ms_role_module');

            //insert into log_activity
            $this->db->set('RefID', $post["RoleID"]);
            $this->db->set('Action', "INVOKE MODULE ".$post["ModuleID"]);
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

         //check if role id used by a user
        public function isDeleteRole($RoleID){

            $this->db->select("1");
            $this->db->from("ms_user");
            $this->db->where('RoleID', $RoleID);
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

         //delete role
        public function deleteRole($RoleID,$Email=""){

            $this->db->trans_start();
            if(empty($Email)){
                $Email=$this->session->userdata['Email'];
            }

            $this->db->where('RoleID', $RoleID);
            $this->db->delete('ms_role_module');
            $this->db->where('RoleID', $RoleID);
            $this->db->delete('ms_role');

            //insert into log_activity
            $this->db->set('RefID', $RoleID);
            $this->db->set('Action', "DELETED ROLE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

}