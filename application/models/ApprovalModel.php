<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApprovalModel extends CI_Model {

        //To return all approval list
        public function getApprovalList(){
               
            $this->db->order_by('a.Status','DESC');
            $this->db->where('a.RoleID', "SITE-ADMIN");
            $this->db->where_in('a.Status', array("WAIT-APPROVAL","REJECTED","ACTIVE-RESET"));
            $this->db->select("a.*");
            $this->db->from("ms_user a");
            $query = $this->db->get();
            //var_dump($this->db->last_query());
            $result = $query->result();
                    
            return $result;
        }

         //get all user sites
        public function getUserSite($Email){
               
            $this->db->select("b.*");
            $this->db->from("ms_user_site a");
            $this->db->join("ms_site b","b.SiteID = a.SiteID");
            $this->db->where('a.Email',$Email);
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

        //User approval
        public function approveUser($post){

            $this->db->trans_start();

            $this->db->set('Status', "ACTIVE-RESET");
            $this->db->set('Password', md5($post['Password']));
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

        //add new site from suggestion
        public function addSite($post){

            $this->db->trans_start();

            $this->db->set('Contact', $post["Contact"]);
            $this->db->set('Address', $post["Address"]);
            $this->db->set('SiteName', $post["SiteName"]);
            $this->db->insert('ms_site'); 

            $this->db->limit(1,0);
            $this->db->order_by("SiteID","DESC");
            $this->db->select("SiteID");
            $this->db->from("ms_site");
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                    $result=$row->SiteID;
            }else{
                    $result=1;
            }

            $this->db->set('Email', $post["Email"]);
            $this->db->set('SiteID', $result);
            $this->db->insert('ms_user_site'); 

            //insert into log_activity
            $this->db->set('RefID', $post["SiteName"]);
            $this->db->set('Action', "INSERTED SITE FOR USER");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }
}