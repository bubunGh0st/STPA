<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SiteModel extends CI_Model {

        //To return all modules
        public function getSites(){
               
            $this->db->select("*");
            $this->db->from("ms_site");
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

        //to return one row all columns from selected ms_module
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
        public function insertSite($post){

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
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }
        //Edit Module
        public function updateSite($post){

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
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }
        
        public function deleteSite($SiteID){

            $this->db->trans_start();

            $this->db->where('SiteID', $SiteID);
            $this->db->delete('ms_site');

            //insert into log_activity
            $this->db->set('RefID', $SiteID);
            $this->db->set('Action', "DELETED SITE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }
        //To check if module is in ms_role_module table
        public function isDeleteSite($SiteID){

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