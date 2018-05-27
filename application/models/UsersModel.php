<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UsersModel extends CI_Model {

        //To return all users
        public function getUsers(){
               
            $this->db->select("*");
            $this->db->from("ms_user");
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

        //to return one row all columns from selected ms_user
         public function getUser($Email){
               
            $this->db->where('Email',$Email);
            $this->db->select("*");
            $this->db->from("ms_user");
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                return $row;
            }else{
                return NULL;
            }
        }

        //get all user sites
        public function getUserSite($Email){
               
            $this->db->select("SiteID");
            $this->db->from("ms_user_site");
            $this->db->where('Email',$Email);
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

         //To insert new user
        public function insertUser($post,$newPassword){
            $this->db->trans_start();


            //insert into ms_user
            $this->db->set('Email', $post["Email"]);
            $this->db->set('Password', md5($newPassword));
            $this->db->set('FName', $post["FName"]);
            $this->db->set('LName', $post["LName"]);
            $this->db->set('Title', $post["Title"]);
            $this->db->set('RoleID', $post["RoleID"]);
            $this->db->set('Status', "ACTIVE-RESET");
            $this->db->insert('ms_user');

            //insert into ms_user_site
            if(isset($post["SiteID"])){
                for($i=0;$i<=count($post["SiteID"])-1;$i++){
                        $this->db->set('Email', $post["Email"]);
                        $this->db->set('SiteID', $post["SiteID"][$i]);
                        $this->db->insert('ms_user_site'); 
                }
            }

            //insert into log_activity
            $this->db->set('RefID', $post["Email"]);
            $this->db->set('Action', "INSERTED USER");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $post["Email"]);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

        //To update new user
        public function updateUser($post,$Email=""){
            if(empty($Email)){
                $Email=$this->session->userdata['Email'];
            }
            $this->db->trans_start();
            
            //update ms_user

            $this->db->Where('Email', $Email);
            $this->db->set('FName', $post["FName"]);
            $this->db->set('LName', $post["LName"]);
            $this->db->set('Title', $post["Title"]);
            $this->db->set('RoleID', $post["RoleID"]);
            $this->db->set('Status', "ACTIVE");
            $this->db->update('ms_user');

            //update ms_user_site
            $this->db->Where('Email', $Email);
            $this->db->delete('ms_user_site');

            if(isset($post["SiteID"])){
                for($i=0;$i<=count($post["SiteID"])-1;$i++){
                    $this->db->set('Email', $Email);
                    $this->db->set('SiteID', $post["SiteID"][$i]);
                    $this->db->insert('ms_user_site'); 
                }
            }

            //update log_activity
            $this->db->set('RefID', $Email);
            $this->db->set('Action', "UPDATED USER");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

        //delete module
        public function deleteUser($Email=""){
            if(empty($Email))
            {
                $Email=$this->session->userdata['Email'];
            }

            $this->db->trans_start();
            $this->db->where('Email', $Email);
            $this->db->delete('ms_user_site');

            $this->db->where('Email', $Email);
            $this->db->delete('ms_user');

            //insert into log_activity
            $this->db->set('RefID', $Email);
            $this->db->set('Action', "DELETED USER");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }
        //To check if module is in ms_role_module table
        public function isDeleteUser($Email){

            $this->db->select("1");
            $this->db->from("log_activity");
            $this->db->where('EntryEmail', $Email);
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
}