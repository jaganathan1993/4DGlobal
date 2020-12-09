<?php
class separationModel extends CI_Model
{
//   public function getattendanceviewdocu($data){
//     $id = $data['userid'];
//     $emp_doc_set=[];
//     $emp_docum_query=$this->db->query("SELECT * FROM emp_document where emp_id='$id'");
//     $emp_doc_set['emp_doc']= $emp_docum_query->result();

//     $emp_users_query=$this->db->query("SELECT resume,aadhar,pan FROM emp_personal_details where emp_id='$id'");
//     $emp_doc_set['emp_users']= $emp_users_query->result();

//     $emp_promotionwarning_query=$this->db->query("SELECT * FROM promotionwarning_letter where emp_id='$id'");
//     $emp_doc_set['emp_promotionwarning']= $emp_promotionwarning_query->result();

//     echo json_encode($emp_doc_set);
//   }
//get agent list

public function agentdata_applied(){
  if($_SESSION['department'] == 'MANAGEMENT'){
    $query = $this->db->query("SELECT * FROM `emp_separation_managers` RIGHT JOIN emp_resignation_revoke er ON er.emp_id = emp_separation_managers.emp_id WHERE manager_id='".$_SESSION['emp_id']."' ");
    // $query = $this->db->query("select * from emp_separation_managers where manager_id ='".$_SESSION['emp_id']."' in (select * from emp_resignation_revoke) ");
  }else{
    $query = $this->db->query('select * from users where emp_id in (SELECT emp_id from emp_resignation_revoke) order by emp_id');
  }
  return $query->result();
}

  //Insert or update
  public function insertupdatedata($table,$id,$data){
    $check_id = $this->db->query("SELECT * FROM $table where emp_id='$id'");
    if($check_id->row() > 0){
      $updateVal = $this->db->where('emp_id', $id)->update($table,$data);
      if($updateVal){
         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Updated Successfully!..');
      }else{
          $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Updated!..');
      }
    }else{
      $insertVal = $this->db->insert($table,$data);
      if($insertVal){
         $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
      }else{
          $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
      }
    }
  }

  public function getentireuser($table,$data){
    $id=$data['userid'];
    $emp_doc=$this->db->query("SELECT * FROM $table where emp_id='$id'");
    echo json_encode($emp_doc->result());
  }

  //insert only
  public function insertonly($table,$id,$data){
    $insertVal = $this->db->insert($table,$data);
    if($insertVal){
      $this->session->set_flashdata('msg','<p style="color:green;font-size:18px;margin-left:3%;margin-top:3%;">Inserted Successfully!..');
    }else{
        $this->session->set_flashdata('msg','<p style="color:red;font-size:18px;margin-left:3%;margin-top:3%;">Not Inserted!..');
    }
  }
  //GET
  
}
