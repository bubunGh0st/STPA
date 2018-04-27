<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_staffModel extends CI_Model {

        //To return all courses assigned to staff
        public function getStaffCourses($Email){
               
            $this->db->select("c.*,b.TrimesterName,b.TrimesterID");
            $this->db->from("tr_course_trimester_staff a");
            $this->db->join("tr_course_trimester b","b.TrimesterID = a.TrimesterID");
            $this->db->join("ms_course c","c.CourseID = b.CourseID");
            $this->db->where('a.StaffEmail',$Email);
            $this->db->where('b.Status','ACTIVE');
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

         //To return all courses NOT assigned to staff
        public function getStaffNotCourses($Email){
               
            $this->db->select("c.*,b.TrimesterName,b.TrimesterID");
            $this->db->From("tr_course_trimester b");
            $this->db->join("ms_course c","c.CourseID = b.CourseID");
            $this->db->where("(c.SiteID In (Select SiteID From ms_user_site Where Email = '".$Email."'))");
            $this->db->where("(b.TrimesterID Not In (Select TrimesterID From tr_course_trimester_staff Where StaffEmail = '".$Email."'))");
            $this->db->where('b.Status','ACTIVE');
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

        //to return one row all columns from selected ms_course
         public function getCourse($CourseID){
               
            $this->db->where('CourseID',$CourseID);
            $this->db->select("*");
            $this->db->from("ms_course");
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                return $row;
            }else{
                return NULL;
            }
        }

         //To return all sites associate with the site id
        public function getUserSite($Email){
               
            $this->db->select("b.*");
            $this->db->from("ms_user_site a");
            $this->db->join("ms_site b","b.SiteID = a.SiteID");
            $this->db->where('a.Email',$Email);
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

        //Auto generate course id
        public function autogenerateID(){

            $this->db->limit(1,0);
            $this->db->order_by("CourseID","DESC");
            $this->db->select("right(CourseID,7) as LastNumber");
            $this->db->from("ms_course");
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                    $result="M".sprintf('%07d', ((int)$row->LastNumber+1));
            }else{
                    $result="C0000001";
            } 
            return $result;
        }

        //To insert in course database
        public function assignCourse($post){

            $this->db->trans_start();

            if(isset($post["TrimesterID"])){
                for($i=0;$i<=count($post["TrimesterID"])-1;$i++){
                    //insert into tr_course_trimester_staff
                    $this->db->set('TrimesterID', $post["TrimesterID"][$i]);
                    $this->db->set('StaffEmail', $post["Email"]);
                    $this->db->insert('tr_course_trimester_staff');

                    //insert into log_activity
                    $this->db->set('RefID', $post["TrimesterID"][$i]);
                    $this->db->set('Action', "ASSIGN COURSE");
                    $this->db->set('EntryTime', date("Y-m-d H:i:s"));
                    $this->db->set('EntryEmail', $this->session->userdata['Email']);
                    $this->db->insert('log_activity'); 
                }
            }

            $this->db->trans_complete();
        }

        //Edit Courses
        public function updateCourse($post){

            $this->db->trans_start();

            $this->db->set('CourseCode', $post["CourseCode"]);
            $this->db->set('CourseName', $post["CourseName"]);
            $this->db->set('SiteID', $post["SiteID"]);
            $this->db->where('CourseID', $post['CourseID']);
            $this->db->update('ms_course'); 

            //insert into log_activity
            $this->db->set('RefID', $post["CourseID"]);
            $this->db->set('Action', "UPDATED COURSE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

        //To check if module is in ms_role_module table
        public function isDeleteCourse($CourseID){

            $this->db->select("CourseID");
            $this->db->from("tr_course_trimester");
            $this->db->where('CourseID', $CourseID);
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

        //To delete course
        public function deleteCourse($CourseID){

            $this->db->trans_start();

            $this->db->where('CourseID', $CourseID);
            $this->db->delete('ms_course');

            //insert into log_activity
            $this->db->set('RefID', $CourseID);
            $this->db->set('Action', "DELETED COURSE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

}