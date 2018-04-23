<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SignInModel extends CI_Model {

        //To check if session is active in every page
        public function isSession(){
                $result=false;
                if ($this->session->userdata['Email'] == true){
                        $this->db->where_in('Status', array('ACTIVE','ACTIVE-RESET'));
                        $this->db->where("Email",$this->session->userdata['Email']);
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

        //to check if the sign in is valid
        //1 - successfull, 2 - invalid email, 3 - invalid password
        public function isSignIn($post){
                $result=1;
                
                $this->db->where_in('Status', array('ACTIVE','ACTIVE-RESET'));
                $this->db->where("Email",$post['Email']);
                $this->db->select("1");
                $this->db->from("ms_user");
                $queryEmail = $this->db->get();
                $rowEmail = $queryEmail->row();

                if($rowEmail!=NULL){
                        $this->db->where_in('Status', array('ACTIVE','ACTIVE-RESET'));
                        $this->db->where("Email",$post['Email']);
                        $this->db->where("Password",md5($post['Password']));
                        $this->db->select("1");
                        $this->db->from("ms_user");
                        $queryPassword = $this->db->get();
                        $rowPassword = $queryPassword->row();
                        if($rowPassword==NULL){
                                $result=3;
                        }
                }else{
                        $result=2;
                }
                
                return $result;
        }

}