<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgetPasswordModel extends CI_Model {
	
        //To check if the email is valid
        public function checkEmail($post){
            $result=false;

            $this->db->where_in('Status', array('ACTIVE','ACTIVE-RESET'));
            $this->db->where("Email",$post['Email']);
            $this->db->select("1");
            $this->db->from("ms_user");
            $query = $this->db->get();
            $row = $query->row();
            if($row!=NULL){
                    $result=true; 
            }       
            return $result;
        }

      	public function generateRandomString($length = 8) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}

        //To reset the password
        public function updatePassword($Email,$newPassword,$status='ACTIVE-RESET'){
            $this->db->trans_start();

            $this->db->set('Password', md5($newPassword));
            $this->db->set('Status', $status);
            $this->db->where('Email', $Email);
            $this->db->update('ms_user'); 

            $this->db->set('RefID', $Email);
            $this->db->set('Action', "RESET PASSWORD");
            $this->db->set('EntryTime', date("Y-m-d H:i:s"));
            $this->db->set('EntryEmail', $Email);
            $this->db->insert('log_activity'); 

            $this->db->trans_complete();
        }

         //To send password to email
        public function sendEmail($Email,$messagex,$subject){
            require_once 'vendor/autoload.php';
            // Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465,'ssl'))
              ->setUsername('stp.weltec@gmail.com')
              ->setPassword('weltec_123')
            ;
            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);
            // Create a message
            $message = (new Swift_Message($subject))
              ->setFrom(['stp.weltec@noreply.com' => 'STPA'])
              ->setTo([$Email])
              ->setBody($messagex);
            // Send the message
            $result = $mailer->send($message);
        }

}