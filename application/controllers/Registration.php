<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Registration Controller
 * 
 * @author Md Tuhin Sarker <tuhinsorker92@gmail.com>
 * 
 * @link http://www.tuhin.com
 */


class Registration extends CI_Controller {


    public function __construct() {
        parent::__construct();
    }


    public function index(){
        $data['login_url'] = $this->googleplus->loginURL();
        $this->load->view('index',$data);
    
    }



    #-----------------------
    # pssword genaretor
    #----------------------
    function randstrGen()
    {
        $result = "";
            $chars = "0123456789";
            $charArray = str_split($chars);
            for($i = 0; $i < 5; $i++) {
                    $randItem = array_rand($charArray);
                    $result .="".$charArray[$randItem];
            }
            return $result;
    }



    #------------------------------------
    #   facebook login and registration
    #------------------------------------    
    public function facebook_login()
    {

        $data['user'] = array();

        // Check if user is logged in
        if ($this->facebook->is_authenticated())
        {
            // User logged in, get user details
            $user = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,picture'); 

            if (!isset($user['error']))
            {
                $data['user'] = $user;
            }
        }else{
            redirect('registration/index');    
        }  

        if(empty($user['email'])){

            $this->session->set_flashdata('exception','Email not found');
            redirect('registration/index'); 
        }   

        $check_status = $this->db->select('*')->from('user_info')->where('email',$user['email'])->get()->row();  

        if($check_status){

            $session_data = array(

                'id'        => $check_status->id,
                'name'      => $check_status->name,
                'pen_name'  => $check_status->pen_name,
                'user_type' => $check_status->user_type,
                'email'     => $check_status->email,
                'session_id' => session_id(),
                'logged_in' => TRUE

            );

            $this->session->set_userdata($session_data);
            redirect('registration/dashboard');
            

        } else {

            $password = $this->randstrGen();

            $user_data = array(
                'name'      =>$user['first_name'].' '.$user['last_name'],
                'pen_name'  =>$user['name'],
                'email'     =>$user['email'],
                'password'  =>md5($password),
                'status'    =>1,
                'user_type' =>5
            );
            $this->db->insert('user_info',$user_data);

            #-------------------------------
            #   email send to user email
            #-------------------------------
            $send_data = array(
                'to'       => $user['email'],
                'subject'  => 'Registration',
                'message'  => 'You successfully Registration '.$user['name'].',  Your email is '.$user['email'].' and Password is '.$password,
            );
            
            #----------------------------
            $sdata = $this->db->select('*')->from('user_info')->where('email',$user['email'])->get()->row();  
          
            $session_data = array(
                'id'            => $sdata->id,
                'name'          => $sdata->name,
                'pen_name'      => $sdata->pen_name,
                'user_type'     => $sdata->user_type,
                'email'         => $sdata->email,
                'session_id'    => session_id(),
                'logged_in'     => TRUE
            );

            $this->session->set_userdata($session_data);
            #------------------------------
            $data = array(
                'name' =>  $user['name'],
                'email'=>  $user['email'],
                'password'=>$password
            ); 
                         
        }


        redirect('registration/dashboard');



    }




    #----------------------------------------
    #       google registration and login
    #----------------------------------------    
    public function googl_login(){
     
        // Check if user is logged in
        if ($this->googleplus->getAuthenticate())
        {
            $data = $this->googleplus->getUserInfo();

        }else{
            $this->session->set_flashdata('exception','Email not found');
            redirect('registration/index'); 
        }

        $check_status = $this->db->select('*')->from('user_info')->where('email',$data['email'])->get()->row();  

        if($check_status){

            $session_data = array(
                'id'        => $check_status->id,
                'name'      => $check_status->name,
                'pen_name'  => $check_status->pen_name,
                'user_type' => $check_status->user_type,
                'email'     => $check_status->email,
                'session_id' => session_id(),
                'logged_in' => TRUE
            );

            $this->session->set_userdata($session_data);
            redirect('registration/dashboard');

        }else{

            $password = $this->randstrGen(); 
            $register_data = array(
                'name'          => $data['name'],
                'email'         => $data['email'],
                'pen_name'      => $data['given_name'],
                'user_type'     => 5,
                'status'        =>1,
                'password'      => md5($password)
            );
            
            $this->db->insert('user_info',$register_data);
            #-------------------------------
            #   email send to user email
            #-------------------------------
            $send_data = array(
                 'to'       =>  $data['email'],  
                 'subject'  => 'Registration',
                 'message'  => 'You successfully Registration '.$data['name'].',  Your email is '.$data['email'].' and Password is '.$password,
            );
            #-------------------------------

            @$sdata = $this->db->select('*')->from('user_info')->where('email',$data['email'])->get()->row();
          
            $session_data = array(
                'id'            => $sdata->id,
                'name'          => $sdata->name,
                'pen_name'      => $sdata->pen_name,
                'user_type'     => $sdata->user_type,
                'email'         => $sdata->email,
                'session_id'    => session_id(),
                'logged_in'     => TRUE
            );

            $this->session->set_userdata($session_data);

            $data = array(
                'name'      => $data['name'],
                'email'     => $data['email'],
                'pen_name'  => $data['given_name'],
                'user_type' => 5,
                'status'    => 1,
                'password'  => $password
            );

            $this->session->set_userdata($session_data);
            redirect('registration/dashboard');

       } 
       
    }


    

    public function dashboard($value='')
    {

        $this->load->view('view_profile');
    }

    public function logout($value='')
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('message','Logout successfully');
        redirect('registration/index');
    }



}
