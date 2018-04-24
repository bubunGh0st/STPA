<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModulesModel extends CI_Model {

        //To return all sites
        public function getModules(){
               
                $this->db->select("*");
                $this->db->from("ms_module");
                $query = $this->db->get();
                $result = $query->result();
                        
                return $result;
        }

         public function autogenerateID(){

                $this->db->limit(1,0);
                $this->db->order_by("ModuleID","DESC");
                $this->db->select("right(ModuleID,4) as LastNumber");
                $this->db->from("ms_module");
                $query = $this->db->get();
                var_dump($this->db->last_query());
                $row = $query->row();
                if($row!=NULL){
                        $result="M".sprintf('%04d', ((int)$row->LastNumber+1));
                }else{
                        $result="M0001";
                } 
                return $result;
        }

}