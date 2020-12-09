
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(E_ERROR);
class Separation extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model("empdetailsModel");
       $this->load->model("separationModel");
        $this->load->library('session');
        $userdata=$this->session->all_userdata();
        if($userdata["hrms_logged_in"] != TRUE){
        redirect('login/index');
        }
    }

    public function index(){
        $data['emp_data']   = $this->separationModel->agentdata_applied();
        $this->load->view('emp_separation',$data);
    }

    public function separation_ResignUpload(){
        $userdata=$this->session->all_userdata();
        if($userdata['role'] == 'agent'){
            $dataset = array(
                "emp_id" => $_POST['emp_id1'],
                "Resignation_reason" => $_POST['resignation_Reason'],
                "Resignation_date" => date('Y-m-d')
            );
        }
        if($userdata['department'] == 'MANAGEMENT'){
            $date_get= date_create($_POST['lasteworkingdate']);
            $dt_format = date_format($date_get,"Y-m-d");
            if($_POST['managerstatusvalue'] == 'on'){
                $status = 'Accepted';
            }else{ $status = 'Rejected'; }
                $dataset = array(
                    "emp_id" => $_POST['emp_id1'],
                    "Resign_Manager_status" => $status,
                    "Resign_Manager_remark" => $_POST['managerstatustext'],
                    "Resign_Lastworkdate" =>  $dt_format
                );
        }
        if($userdata['department'] == 'HR'){
           
            $dt_format = date_format($date_get,"Y-m-d");
            if($_POST['hrstatusvalue'] == 'on'){
                $status = 'Accepted';
            }else{ $status = 'Rejected'; }
                $dataset = array(
                    "emp_id" => $_POST['emp_id1'],
                    "Resign_HR_status" => $status,
                    "Resign_HR_remark" => $_POST['hrstatustext'],
                );
            }
        $this->separationModel->insertupdatedata('emp_resignation_revoke',$_POST['emp_id1'],$dataset);
        redirect('Separation');
    }
    public function separation_RevokeUpload(){
        $userdata=$this->session->all_userdata();
        if($userdata['role'] == 'agent'){
            $dataset = array(
                "emp_id" => $_POST['emp_id2'],
                "Revoke_reason" => $_POST['revoke_Reason'],
                "Revoke_date" => date('Y-m-d')
            );
        }
        $this->separationModel->insertupdatedata('emp_resignation_revoke',$_POST['emp_id2'],$dataset);
        redirect('Separation');
    }

    public function getuserdata(){
        $this->separationModel->getentireuser('emp_resignation_revoke',$_POST);
    }
  }