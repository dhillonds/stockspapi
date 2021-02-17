<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* 
* User Model is designed to deal with data of admin and front end user
* Author: Damanjeet Singh Dhillon
* Created at: JUNE 5, 2019 @ 1:59am
*/
class Users extends CI_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('user_model');
        //$this->load->model('files_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if(!empty(is_logged_in())){
            header("Location: ".base_url()."users/dashboard");
        }else{
            header("Location: ".base_url()."users/login");
        }
    }

    public function login(){
        if(!empty(is_logged_in())){
            header("Location: ".base_url()."users/dashboard");
        }
        $data = array(
                        'status' => FALSE, 
                        'message' => "Something went wrong. Try again later"
                    );
        if(!empty($_POST)){
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[40]');
            if($this->form_validation->run() == TRUE){
                $login_data = array(
                                    'username'  => $this->input->post('username'), 
                                    'password'  => $this->input->post('password')
                                );
                if($return_data = $this->user_model->get_single_user($login_data)){
                    start_user_session($return_data);
                    if($this->session->userdata['user_creds']){
                        header("Location: ".base_url()."users/dashboard");
                        $data = array(
                                        'status' => TRUE, 
                                        'message' => "User logged in successfully", 
                                    );
                    }
                }else{
                    $data['message'] = "Username or Password is wrong";
                }
            }
        }
        $this->load->view('include/header');
        $this->load->view('login');
        $this->load->view('include/footer');
    }

    public function dashboard(){
        if(empty(is_logged_in())){
            header("Location: ".base_url());
        }
        $this->load->view('include/header');
        $this->load->view('dashboard');
        $this->load->view('include/footer');
    }

    public function logout(){
        session_destroy();
        header("Location: ".base_url());
    }

    public function employees(){
        if(empty(is_logged_in())){
            header("Location: ".base_url());
        }
        if(!is_admin()){
            header("Location: ".base_url());
        }
        $data = array(
                        'status' => FALSE, 
                        'message' => "No users found"
                    );
        $users_data = $this->user_model->get_multiple_users(TRUE);
        if(!empty($users_data)){
            $data['status'] = TRUE;
            $data['message'] = "Users found";
            $data['data'] = $users_data;
        }
        $this->load->view('include/header');
        $this->load->view('employees',$data);
        $this->load->view('include/footer');
    }

    public function add(){
        if(empty(is_logged_in())){
            header("Location: ".base_url());
        }
        if(!is_admin()){
            header("Location: ".base_url());
        }
        $data = array(
                        'status' => FALSE, 
                        'message' => "Something went wrong, User was not created", 
                        'data' =>  array(), 
                    );
        if(!empty($_POST)){
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('ausername', 'Username', 'trim|required|callback_is_unique');
            $this->form_validation->set_rules('apassword', 'Password', 'trim|required|min_length[6]|max_length[50]');
            $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required|min_length[2]|max_length[255]');

                if ($this->form_validation->run() == TRUE)
                {
                    $user_data = array(
                                        'username' => trim($this->input->post('ausername')), 
                                        'password' => trim($this->input->post('apassword')), 
                                        'full_name' => trim($this->input->post('full_name')), 
                                        'is_admin' => NOT_ADMIN, 
                                    );
                    $return_data = $this->user_model->create_user($user_data);
                    if(!empty($return_data)){
                        $data = array(
                                        'status' => TRUE, 
                                        'message' => "User was created successfully", 
                                        'data' =>  $return_data, 
                                    );
                        header("Location:".base_url('users/employees'));
                    }
                }
                $data['message'] = validation_errors();
        }
        $this->load->view('include/header');
        $this->load->view('add_user',$data);
        $this->load->view('include/footer');
    }

    public function edit($user_id = NULL){
        if(empty(is_logged_in())){
            header("Location: ".base_url());
        }
        if(!is_admin()){
            header("Location: ".base_url());
        }
        if(empty($user_id)){
            header("Location: ".base_url());
        }
        $data = array(
                        'status' => FALSE, 
                        'message' => "Something went wrong, User was not created", 
                        'data' =>  array(), 
                    );
        if($return_data = $this->user_model->get_user_data($user_id)){
            $data['user_data'] = $return_data;
        }else{
            header("Location:".base_url('users/employees'));
        }
        if(!empty($_POST)){
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('apassword', 'Password', 'trim|required|min_length[6]|max_length[50]');
            
                if ($this->form_validation->run() == TRUE)
                {
                    $user_data = array(
                                        'password' => trim($this->input->post('apassword')), 
                                        'is_admin' => NOT_ADMIN, 
                                        'salt' => $return_data['salt'], 
                                    );
                    $return_data = $this->user_model->update_user($user_data, $user_id);
                    if(!empty($return_data)){
                        $data = array(
                                        'status' => TRUE, 
                                        'message' => "User was updated successfully", 
                                        'data' =>  $return_data, 
                                    );
                        header("Location:".base_url('users/employees'));
                    }
                }
                $data['message'] = validation_errors();
        }
        $this->load->view('include/header');
        $this->load->view('edit_user',$data);
        $this->load->view('include/footer');
    }

    public function reset_password(){
        if(empty(is_logged_in())){
            header("Location: ".base_url());
        }
        if(!is_admin()){
            header("Location: ".base_url());
        }
        $data = array(
                        'status' => FALSE, 
                        'message' => "Something went wrong, User was not created", 
                        'data' =>  array(), 
                    );
        // if($return_data = $this->user_model->get_user_data($user_id)){
        //     $data['user_data'] = $return_data;
        // }else{
        //     header("Location:".base_url('users/employees'));
        // }
        if(!empty($_POST)){
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('cpassword', 'Current Password', 'trim|required|min_length[6]|max_length[50]');
            $this->form_validation->set_rules('apassword', 'New Password', 'trim|required|min_length[6]|max_length[50]');
            $this->form_validation->set_rules('repassword', 'Confirm New Password', 'trim|required|matches[apassword]');
            
                if ($this->form_validation->run() == TRUE)
                {
                    $check_login = array('username' => $this->session->userdata['user_creds']['username'], 'password' => trim($this->input->post('cpassword')));
                        
                    if($found_user = $this->user_model->get_single_user($check_login)){
                        $user_data = array(
                                            'password' => trim($this->input->post('apassword')), 
                                            'salt' => $found_user['salt'], 
                                        );
                        $cur_uid = $found_user['user_id'];
                        $return_data = $this->user_model->update_user($user_data, $cur_uid);
                        if(!empty($return_data)){
                            $data = array(
                                            'status' => TRUE, 
                                            'message' => "User was updated successfully", 
                                            'data' =>  $return_data, 
                                        );
                            header("Location:".base_url('users/employees'));
                        }

                    }
                }
                $data['message'] = validation_errors();
        }
        $this->load->view('include/header');
        $this->load->view('reset_password',$data);
        $this->load->view('include/footer');
    }

    public function change_status(){
        $response = array(
                        'status' => FALSE, 
                        'message' => 'Haan aagya andar par hoeya ni kussh', 
                        'data' => 'khaali'
                    );   
        // if(empty(is_logged_in())){
  //           echo json_encode($response);
  //           exit;
  //       }
        $user_id = $this->input->post('user_id');
        if(!empty($user_id)){
            $return_data = $this->user_model->get_user_state($user_id);
            if(!empty($return_data) && is_array($return_data)){
                if($return_data['is_active'] != DELETED){
                    if($return_data['is_active'] == ACTIVE){
                        $new_status = array('is_active' => INACTIVE);
                    }else if($return_data['is_active'] == INACTIVE){
                        $new_status = array('is_active' => ACTIVE);
                    }
                    if(!empty($new_status)){
                        $this->user_model->update_user_status($new_status, $user_id);
                        $response['status'] = TRUE;
                        $response['message'] = 'Le nwin aagi';                    
                    }
                }
            }
        }
        
        echo json_encode($response);
    }

    // public function superuser(){
    //     $user_data = array(
    //                                     'username' => 'jamalhifm', 
    //                                     'password' => 'qwerty123', 
    //                                     'full_name' => 'Jamal', 
    //                                     'is_admin' => 1, 
    //                                 );
    //     $return_data = $this->user_model->create_user($user_data);
    //     print_r($return_data);
    // }

    public function is_unique($username = NULL){
        return TRUE;
        // $this->form_validation->set_message('is_unique', 'Email already registered.');
        // if(!empty($username)){
        //     if($this->user_model->is_unique_email($username)){
        //         return TRUE;
        //     }else{
        //         return FALSE;
        //     }
        // }
        // return FALSE;
    }

}
