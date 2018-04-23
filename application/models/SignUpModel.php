<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignUpModel extends CI_Model {

        //To return all sites
        public function getSites(){
               
                $this->db->select("*");
                $this->db->from("ms_site");
                $query = $this->db->get();
                $result = $query->result();
                        
                return $result;
        }

        //To check if the email is valid and at least 1 site is checked
        public function isSignUp($post){
                $result=true;
                if (!empty($post["Email"])){
                        $this->db->where("Email",$post["Email"]);
                        $this->db->select("1");
                        $this->db->from("ms_user");
                        $query = $this->db->get();
                        $row = $query->row();
                        if($row!=NULL){
                                $result=false; 
                        }     
                }else{
                        $result=false;
                }
                if(!isset($post["SiteID"])){
                        $result=false;    
                }
                return $result;
        }

        //To sign up new user
        public function insertUser($post,$newPassword){
                $this->db->trans_start();

                //insert into ms_user
                $this->db->set('Email', $post["Email"]);
                $this->db->set('Password', md5($newPassword));
                $this->db->set('FName', $post["FName"]);
                $this->db->set('LName', $post["LName"]);
                $this->db->set('Title', $post["Title"]);
                $this->db->set('RoleID', "SITE-ADMIN");
                $this->db->set('Status', "WAIT-APPROVAL");
                $this->db->insert('ms_user');

                //insert into ms_user_site
                for($i=0;$i<=count($post["SiteID"])-1;$i++){
                        $this->db->set('Email', $post["Email"]);
                        $this->db->set('SiteID', $post["SiteID"][$i]);
                        $this->db->insert('ms_user_site'); 
                }

                //insert into log_activity
                $this->db->set('RefID', $post["Email"]);
                $this->db->set('Action', "SIGN UP");
                $this->db->set('EntryTime', date("Y-m-d H:i:s"));
                $this->db->set('EntryEmail', $post["Email"]);
                $this->db->insert('log_activity'); 

                $this->db->trans_complete();
        }

}