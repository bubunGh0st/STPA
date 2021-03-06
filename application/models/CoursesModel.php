<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CoursesModel extends CI_Model {

        //To return all courses
        public function getCourses($Email){
               
            $this->db->select("b.*,c.SiteName");
            $this->db->from("ms_user_site a");
            $this->db->join("ms_course b","b.SiteID = a.SiteID");
            $this->db->join("ms_site c","c.SiteID = b.SiteID");
            $this->db->where('a.Email',$Email);
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

         public function getTrimester($CourseID){
               
            $this->db->order_by('StartDate','DESC');
            $this->db->where('CourseID',$CourseID);
            $this->db->select("*");
            $this->db->from("tr_course_trimester");
            $query = $this->db->get();
            $result = $query->result();
                    
            return $result;
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
                    $result="C".sprintf('%07d', ((int)$row->LastNumber+1));
            }else{
                    $result="C0000001";
            } 
            return $result;
        }

        //To insert in course database
        public function insertCourse($post,$Email=""){

            $this->db->trans_start();

            if(empty($Email)){
            $Email= $this->session->userdata['Email'];
            }

            //insert into ms_course
            $this->db->set('CourseID', $post["CourseID"]);
            $this->db->set('CourseCode', $post["CourseCode"]);
            $this->db->set('CourseName', $post["CourseName"]);
            $this->db->set('SiteID', $post["SiteID"]);
            $this->db->set('CourseCredit',$post["CourseCredit"]);
            $this->db->insert('ms_course');

            //insert into log_activity
            $this->db->set('RefID', $post["CourseID"]);
            $this->db->set('Action', "INSERTED COURSE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

        //To insert in trimester database
        public function insertTrimester($post,$Email=""){

            $this->db->trans_start();

            if(empty($Email)){
            $Email=$this->session->userdata['Email'];
            }



            //insert into tr_course_trimester
            $this->db->set('CourseID', $post["CourseID"]);
            $this->db->set('TrimesterName', $post["TrimesterName"]);
            $this->db->set('StartDate', date("Y-m-d",strtotime($_POST["StartDate"])));
            $this->db->set('FinishDate', date("Y-m-d",strtotime($_POST["FinishDate"])));
            $this->db->set('CompletionHours', 0);
            $this->db->set('CompletionWeeks', 0);
            $this->db->set('ReadingHours', 0);
            $this->db->set('RevisionHours', 0);
            $this->db->set('ContactHours', 0);
            $this->db->set('Status', 'INACTIVE');
            $this->db->insert('tr_course_trimester');

            //insert into log_activity
            $this->db->set('RefID', $post["CourseID"]);
            $this->db->set('Action', "INSERTED TRIMESTER");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
            
        }

        //Edit Courses
        public function updateCourse($post,$Email=""){

            $this->db->trans_start();

            if(empty($Email)){
            $Email=$this->session->userdata['Email'];
            }


            $this->db->set('CourseCode', $post["CourseCode"]);
            $this->db->set('CourseName', $post["CourseName"]);
            $this->db->set('SiteID', $post["SiteID"]);
            $this->db->set('CourseCredit',$post["CourseCredit"]);
            $this->db->where('CourseID', $post['CourseID']);
            $this->db->update('ms_course'); 

            //insert into log_activity
            $this->db->set('RefID', $post["CourseID"]);
            $this->db->set('Action', "UPDATED COURSE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

        //To check if course is in tr_course_trimester table
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
        public function deleteCourse($CourseID,$Email=""){

            $this->db->trans_start();
            if(empty($Email)){
            $Email=$this->session->userdata['Email'];
            }


            $this->db->where('CourseID', $CourseID);
            $this->db->delete('ms_course');

            //insert into log_activity
            $this->db->set('RefID', $CourseID);
            $this->db->set('Action', "DELETED COURSE");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

         //To check if trimester is not active
        public function isDeleteTrim($TrimesterID){

            $this->db->select("1");
            $this->db->from("tr_course_trimester");
            $this->db->where('Status', 'INACTIVE');
            $this->db->where('TrimesterID', $TrimesterID);
            $query = $this->db->get();
            $result = $query->row();
            if($result != NULL){
                $result = True;
            }
            else{
                $result = False;
            }        
            return $result;
        }

         //To delete trimester
        public function deleteTrimester($TrimesterID,$Email=""){
            
            $this->db->trans_start();
            if(empty($Email)){
            $Email=$this->session->userdata['Email'];
            }


            $this->db->where('TrimesterID', $TrimesterID);
            $this->db->delete('tr_course_trimester');

            //insert into log_activity
            $this->db->set('RefID', $TrimesterID);
            $this->db->set('Action', "DELETED TRIMESTER");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }


}