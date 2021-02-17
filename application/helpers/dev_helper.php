<?php
/**
Helper created for easy functions
*/
function start_user_session( $login_data =  array() ){
	if(empty($login_data) || !is_array($login_data)){
		return false;
	}
	$login_array['user_creds'] = $login_data;
    $CI = & get_instance();

    $CI->load->library('session');
	$CI->session->set_userdata($login_array);
}

function is_logged_in(){
	$CI = & get_instance();

    $CI->load->library('session');
    if(!empty($CI->session->userdata['user_creds'])){
		return TRUE;
	}
	return FALSE;
}	

function is_admin(){
	$CI = & get_instance();

    $CI->load->library('session');
    $userdata =$CI->session->userdata['user_creds'];
    if(!empty($userdata)){
    	if($userdata['is_admin'] == IS_ADMIN){
			return TRUE;
    	}
	}
	return FALSE;
}