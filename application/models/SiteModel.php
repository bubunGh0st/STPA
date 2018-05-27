<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiteModel extends CI_Model {

        //To return all sites
        public function getSites(){
               
            $this->db->select("*");
            $this->db->from("ms_site");
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

        //to return one row all columns from selected ms_site
         public function getSite($SiteID){
               
            $this->db->where('SiteID',$SiteID);
            $this->db->select("*");
            $this->db->from("ms_site");
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                return $row;
            }else{
                return NULL;
            }
        }

        //To insert into site database.
        public function insertSite($post,$email=""){

            if(empty($email)){
                $email=$this->session->userdata['Email'];
            }

            $this->db->trans_start();

            //insert into ms_module
            
            $this->db->set('SiteName', $post["SiteName"]);
            $this->db->set('Address', $post["Address"]);
            $this->db->set('Contact',$post["Contact"]);
            $this->db->insert('ms_site');

            //insert into log_activity
            $this->db->set('RefID', $post["SiteName"]);
            $this->db->set('Action', "INSERTED SITE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }


        //Edit Site
        public function updateSite($post,$email=""){
            if(empty($email)){
                $email=$this->session->userdata['Email'];
            }

            $this->db->trans_start();

            $this->db->set('SiteName', $post["SiteName"]);
            $this->db->set('Address', $post["Address"]);
            $this->db->set('Contact',$post["Contact"]);
            $this->db->where('SiteID', $post['SiteID']);
            $this->db->update('ms_site'); 

            //insert into log_activity
            $this->db->set('RefID', $post["SiteID"]);
            $this->db->set('Action', "UPDATED SITE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }
        
        //Delete Site
        public function deleteSite($SiteID,$email=""){

             if(empty($email)){
                $email=$this->session->userdata['Email'];
            }

            $this->db->trans_start();

            $this->db->where('SiteID', $SiteID);
            $this->db->delete('ms_site');

            //insert into log_activity
            $this->db->set('RefID', $SiteID);
            $this->db->set('Action', "DELETED SITE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

        //To check if site is in ms_site table
        public function isDeleteSite($SiteID,$email=""){

            if(empty($email)){
                $email=$this->session->userdata['Email'];
            }

            $this->db->select("SiteID");
            $this->db->from("ms_course");
            $this->db->where('SiteID', $SiteID);
            $query = $this->db->get();
            $result = $query->row();

            $this->db->select("SiteID");
            $this->db->from("ms_user_site");
            $this->db->where('SiteID', $SiteID);
            $query2 = $this->db->get();
            $result2 = $query2->row();

            if($result != NULL || $result2 != NULL){
                $result = False;
            }
            else{
                $result = True;
            }        
            return $result;
        }

}