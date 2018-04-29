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

        //to return one row all columns from selected tr_course_trimester
         public function getTrimester($TrimesterID){
               
            $this->db->select("a.*, b.CourseName, b.CourseCode");
            $this->db->from("tr_course_trimester a");
            $this->db->join("ms_course b","a.CourseID = b.CourseID");
            $this->db->where('a.TrimesterID',$TrimesterID);
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                return $row;
            }else{
                return NULL;
            }
        }

        //return all staff related to this course trimester
        public function getTrimesterStaff($TrimesterID){
               
            $this->db->select("b.*");
            $this->db->from("tr_course_trimester_staff a");
            $this->db->join("ms_user b","a.StaffEmail = b.Email");
            $this->db->where('a.TrimesterID',$TrimesterID);
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

        //return all Assignment  related to this course trimester
        public function getTrimesterAssignment($TrimesterID){
               
            $this->db->select("a.*");
            $this->db->from("tr_course_trimester_assignment a");
            $this->db->where('a.TrimesterID',$TrimesterID);
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
        }

        //To insert in tr_course_trimester_staff
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

        //to return one row all columns from selected tr_course_trimester
         public function getEditTrimester($TrimesterID){
               
            $this->db->where('TrimesterID',$TrimesterID);
            $this->db->where("(Startdate> '".date("Y-m-d")."')");
            $this->db->select("1");
            $this->db->from("tr_course_trimester");
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                $result = TRUE;
            }else{
                $result = FALSE;
            }

            return $result;
        }

}