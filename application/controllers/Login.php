<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Application {     
    public function index(){
    }
    
    public function loginAttempt() {

        if (isset($_POST['username']) && isset($_POST['password'])) {
            if(!$this->setNavBarLogin($_POST['username'],$_POST['password'])) {
                echo '<script>alert("Invalid username and password combination.")</script>';
                redirect('/', 'refresh');
            }
        } else {
            $this->setNavBarLogout();
        }
    }
    

        
    public function setNavBarLogin($username,$password){
        $result = $this->users->queryLogin($username,$password);

        if($result)
        {
            //however we want to set the navbar if they are successful
            $sess_array = array();
            foreach($result as $row)
            {
                $sess_array = array(
                    'username' => $row->username
                );
            }
            $this->session->set_userdata('logged_in', $sess_array);
            redirect('welcome', 'refresh'); //just to test if it works
            return true;
        }else{
            //how ever we want to set the navbar if they type in a wrong password
            //$this->form_validation->set_message('check database', 'invalid password');
            return false;
        }
    }
        
    public function setNavBarLogout(){
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('welcome', 'refresh');
    }
}





