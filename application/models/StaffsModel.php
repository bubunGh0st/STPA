<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StaffsModel extends CI_Model {

        //To return all staffs
        public function getStaffs($Email){
               
            $this->db->select("a.*, (Select y.SiteName From ms_user_site x 
                                     Inner Join ms_site y On y.SiteID = x.SiteID Where x.Email=a.Email Limit 0,1) as SiteName");
            $this->db->from("ms_user a");
            $this->db->join("ms_user_site b","b.Email = a.Email");
            $this->db->where("(b.SiteID In (Select z.SiteID From ms_user_site z Where z.Email = '".$Email."' ))");
            $this->db->where('a.RoleID','STAFF');
            $this->db->group_by("a.Email");
            $query = $this->db->get();
           //var_dump($this->db->last_query());
            //die();
            $result = $query->result();
                    
            return $result;
        }

        //to return one row all columns from selected ms_user
        public function getStaff($Email){
               
            $this->db->where('a.RoleID','STAFF');
            $this->db->where('md5(a.Email)',$Email);
            $this->db->select("a.*, (Select y.SiteID From ms_user_site x 
                                     Inner Join ms_site y On y.SiteID = x.SiteID Where x.Email=a.Email Limit 0,1) as SiteID");
            $this->db->from("ms_user a");
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                return $row;
            }else{
                return NULL;
            }
        }

        //insert new Staff
        public function insertStaff($post,$newPassword,$Email=""){
                $this->db->trans_start();
                if(empty($Email)){
                $Email = $this->session->userdata['Email'];
                }

                //insert into ms_user
                $this->db->set('Email', $Email);
                $this->db->set('Password', md5($newPassword));
                $this->db->set('FName', $post["FName"]);
                $this->db->set('LName', $post["LName"]);
                $this->db->set('Title', $post["Title"]);
                $this->db->set('RoleID', "STAFF");
                $this->db->set('Status', "ACTIVE-RESET");
                $this->db->insert('ms_user');

                //insert into ms_user_site
                $this->db->set('Email', $Email);
                $this->db->set('SiteID', $post["SiteID"]);
                $this->db->insert('ms_user_site'); 

                //insert into log_activity
                $this->db->set('RefID', $Email);
                $this->db->set('Action', "INSERTED STAFF");
                $this->db->set('EntryTime', date("Y-m-d H:i:s"));
                $this->db->set('EntryEmail', $Email);
                $this->db->insert('log_activity'); 

                $this->db->trans_complete();
        } 

        //Edit staff
        public function updateStaff($post,$Email=""){

            $this->db->trans_start();
            if(empty($Email)){
                $Email = $this->session->userdata['Email'];
                }

            //update ms_user
                $this->db->Where('Email', $Email);
                $this->db->set('FName', $post["FName"]);
                $this->db->set('LName', $post["LName"]);
                $this->db->set('Title', $post["Title"]);
                $this->db->update('ms_user');

                //update ms_user_site
                $this->db->Where('Email', $Email);
                $this->db->delete('ms_user_site'); 

                $this->db->set('Email', $Email);
                $this->db->set('SiteID', $post["SiteID"]);
                $this->db->insert('ms_user_site'); 

                //insert into log_activity
                $this->db->set('RefID', $Email);
                $this->db->set('Action', "UPDATED STAFF");
                $this->db->set('EntryTime', date("Y-m-d H:i:s"));
                $this->db->set('EntryEmail', $Email);
                $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }


}