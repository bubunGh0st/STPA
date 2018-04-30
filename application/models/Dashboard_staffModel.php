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

        //to return one row all columns from selected tr_course_trimester by AssignmentID
        public function getTrimesterByAssignment($AssignmentID){
               
            $this->db->select("a.TrimesterID");
            $this->db->from("tr_course_trimester_assignment a");
            $this->db->where('a.AssignmentID',$AssignmentID);
            $this->db->order_by("a.FinishTime","ASC");
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                return $row;
            }else{
                return NULL;
            }
        }

        //to return total assessment hours of Trimester
         public function getTotalAssignmentHours($TrimesterID){
               
            $this->db->select("sum(a.CompletionHours) as AssignmentHours");
            $this->db->from("tr_course_trimester_assignment a");
            $this->db->where('a.TrimesterID',$TrimesterID);
            $this->db->group_by('a.TrimesterID');
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                return $row;
            }else{
                return NULL;
            }
        }


        //to return total weeks of Trimester
         public function getTotalWeeksTrimester($TrimesterID){
               
            $this->db->select("Floor(Datediff(a.FinishDate, a.StartDate)/7) as WeeksTrimester");
            $this->db->from("tr_course_trimester a");
            $this->db->where('a.TrimesterID',$TrimesterID);
            $this->db->group_by('a.TrimesterID');
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

        //to check if trimester can be edited
         public function getEditTrimester($TrimesterID){
               
            $this->db->where('TrimesterID',$TrimesterID);
            $this->db->where('Status','INACTIVE');
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

        //to check if trimester can be activated
         public function getActivateTrimester($TrimesterID){
               
            $this->db->where('TrimesterID',$TrimesterID);
            $this->db->where('CompletionWeeks >',0);
            $this->db->where('CompletionHours >',0);
            $this->db->where('Status','INACTIVE');
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

        //to check if trimester can be deactivated
         public function getDeactivateTrimester($TrimesterID){
               
            $this->db->where('TrimesterID',$TrimesterID);
            $this->db->where('Status','ACTIVE');
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

        //To insert in tr_course_trimester_assignment
        public function insertAssignment($post){

            $this->db->trans_start();

            //insert into tr_course_trimester_assignment
            $this->db->set('TrimesterID', $post["TrimesterID"]);
            $this->db->set('Title', $post["Title"]);
            $this->db->set('Description', $post["Description"]);
            $this->db->set('FinishTime', date("Y-m-d H:i:s",strtotime($post["FinishTime"])));
            $this->db->set('CompletionHours', intval($post["CompletionHours"]));
            $this->db->insert('tr_course_trimester_assignment');

            //insert into log_activity
            $this->db->set('RefID', $post["TrimesterID"][$i]);
            $this->db->set('Action', "INSERTED ASSIGNMENT");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

         //To update hours in tr_course_trimester_assignment
        public function updateTrimesterHours($post){

            $this->db->trans_start();

            //insert into tr_course_trimester_assignment
            $this->db->where('TrimesterID', $post["TrimesterID"]);
            $this->db->set('CompletionHours', intval($post["CompletionHours"]));
            $this->db->set('CompletionWeeks', intval($post["CompletionWeeks"]));
            $this->db->set('ReadingHours', intval($post["ReadingHours"]));
            $this->db->set('ContactHours', intval($post["ContactHours"]));
            $this->db->update('tr_course_trimester');

            //still need an update to distribute to custom table

            //insert into log_activity
            $this->db->set('RefID', $post["TrimesterID"]);
            $this->db->set('Action', "UPDATED TRIMESTER HOURS");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

         //To activate trimester
        public function activateTrimester($TrimesterID){

            $this->db->trans_start();

            //update tr_course_trimester_assignment
            $this->db->where('TrimesterID', $TrimesterID);
            $this->db->set('Status', 'ACTIVE');
            $this->db->update('tr_course_trimester');

            //insert into log_activity
            $this->db->set('RefID', $TrimesterID);
            $this->db->set('Action', "ACTIVATE TRIMESTER");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

         //To deactivate trimester
        public function deactivateTrimester($TrimesterID){

            $this->db->trans_start();

            //insert into tr_course_trimester_assignment
            $this->db->where('TrimesterID', $TrimesterID);
            $this->db->set('Status', 'INACTIVE');
            $this->db->update('tr_course_trimester');

            //insert into log_activity
            $this->db->set('RefID', $TrimesterID);
            $this->db->set('Action', "DEACTIVATE TRIMESTER");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

        //To delete from in tr_course_trimester_assignment
        public function deleteAssignment($AssignmentID){

            $this->db->trans_start();

            //delete from tr_course_trimester_assignment
            $this->db->where('AssignmentID', $AssignmentID);
            $this->db->delete('tr_course_trimester_assignment');

            //insert into log_activity
            $this->db->set('RefID', $AssignmentID);
            $this->db->set('Action', "DELETED ASSIGNMENT");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $this->session->userdata['Email']);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }
}