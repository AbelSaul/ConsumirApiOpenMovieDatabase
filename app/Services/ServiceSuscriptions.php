<?php
namespace App\Services;
use DateTime;

   
class ServiceSuscriptions{

        private $email;
        private $system;
        private $user_id;
        private $enddate;

        public function __construct($email,$system){
            $this->email = $email;
            $this->system = $system;
        }

        public function validateUser(){
       
            $url = "http://67.205.138.236:81/6.SuscriptorVersion2.0/suscriptions/src/api_users.php";
            
            $options = array
                (
                    CURLOPT_HEADER => false,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 2,
                    CURLOPT_URL => $url,
                    CURLOPT_CUSTOMREQUEST => "GET",
            );
                
            $handle = curl_init();
            curl_setopt_array($handle, ($options));
            $response = curl_exec($handle);
            $users = json_decode($response,true);


            if (is_array($users) || is_object($users))
            {
                foreach($users as $key => $obj){
                    $email = $obj['email'];
                    if ($email === $this->email) {
                        $this->user_id = $obj['id'];
                        return true;
                    }
                }
            }

            return false;

        }

        public function validateSystem(){
       
            $url = "http://67.205.138.236:81/6.SuscriptorVersion2.0/suscriptions/src/api_suscriptions.php";
            
            $options = array
                (
                    CURLOPT_HEADER => false,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 2,
                    CURLOPT_URL => $url,
                    CURLOPT_CUSTOMREQUEST => "GET",
            );
                
            $handle = curl_init();
            curl_setopt_array($handle, ($options));
            $response = curl_exec($handle);
            $users = json_decode($response,true);


            if (is_array($users) || is_object($users))
            {
                foreach($users as $key => $obj){
                    
                    $user_id = $obj['user_id'];
                    $system = $obj['system'];
                    if ($user_id === $this->user_id && $system === $this->system) {
                        $this->enddate = $obj['enddate'];
                        return true;
                    }
                }
            }

            return false;

        }

        public function validateDateSuscription(){
            $today = $this->today();  
            $enddate = new DateTime($this->enddate);  
            if($today<$enddate){
                return true;
            }
            return false;
        }

        public function today(){
            $today = date('Y-m-j H:i:s'); 
            $date = new DateTime($today);
            return $date;
        }


}

?>