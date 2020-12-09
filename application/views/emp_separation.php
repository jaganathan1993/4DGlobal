<body>
<div class="page-wrapper chiller-theme toggled">
<style>
.colhead{
  font-weight:bold;
  min-width:100px;
}
#positionview{
  position: absolute;
  top: 5px;
  right: 5px;
}
#resignation_Reason,#revoke_Reason{
    font-size:18px;
}

</style>
<?php
 include('header.php');
  $userdata=$this->session->all_userdata();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<main class="page-content">
		<div class="container-fluid p-0">
    <div class="row head-content">
			<div class="col-9 col-md-4 logo"><img src="<?php echo base_url(); ?>img/logo.jpg"></div>
			<div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
		</div>
    <div class="row activity-row">
			<div class="col-md-12 activity">Employee Separation</div>
		</div>
    <?php echo $this->session->flashdata('msg');?>
<div class="row emp-table">
<div class="col-md-12 table-responsive" >
    <div class="row">
    <!-- <form id="attendfilter"> -->
    <div class="col-md-12">
      <table>
      <tr>
      <td>
      <p>Employee</p>
      <select class="form-control useridSeparation" id="useridemp" name="useridemp"  onchange="viewSeparation()">
        <?php if($userdata['role'] != 'agent'){ ?>
        <option style="display: none;" value="" selected>Select Employee ID</option>
          <?php foreach ($emp_data as $emp) { ?>
            <option value="<?php echo $emp->emp_id; ?>" ><?php echo ucfirst($emp->emp_id.'/'.$emp->name); ?></option>
          <?php } ?>
        <?php }else{ ?>
           <option value="<?php echo $userdata['emp_id']; ?>" ><?php echo ucfirst($userdata['emp_id'].'/'.$userdata['name']); ?></option>
        <?php } ?>
      </select>
      </td>
    </tr>
    </table>
    </div>
    <!-- </form> -->
<br><br>
<div class="col-md-12">
  <br>
  <div class="row">
 <div class="col-sm-12" id="emp_Separtation" style="display:none;"><br>
    <div class="card  w-100 shadow-lg bg-white rounded" style="width:50%;color:black "  >
      <div class="card-body">
        
 
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Resignation</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Revoke</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active pl-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"  style="text-decoration:none;">
            <br>
            <form action="<?php echo base_url(); ?>Separation/separation_ResignUpload" method="POST" >
            <input type="hidden" id="emp_id1" name="emp_id1">
            <p>Reason<span  style="padding-left:80%;"><i class="fa fa-calendar"></i> <?php echo "<span id='dtprint_resig'>".date('d-m-Y')."</span>"; ?></span></p>
            <textarea  class="form-control" id="resignation_Reason" rows="3" name="resignation_Reason" required <?php if($userdata['role'] != 'agent'){ echo "readonly"; }?>></textarea>
            <br>
           
            <div id="statusview" >
            
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td >
                            <p>Manager Status</p>
                            <?php if($userdata['department'] == 'MANAGEMENT'){ ?>
                                <input type="checkbox" id="managerstatusvalue" name="managerstatusvalue" checked data-toggle="toggle" data-on="Accepted" data-off="Rejected" data-width="200" > 
                            <?php }else{ ?>
                                <b id="managerstatus">No Status Updated</b>
                            <?php } ?>
                           
                            <br><p><br>Remark</p>
                            <textarea  class="form-control" id="managerstatustext" name="managerstatustext" <?php if($userdata['department'] != 'MANAGEMENT'){ echo "readonly"; }?>></textarea>
                        </td>
                        <td>
                            <p>HR Status</p>
                            <?php if($userdata['department'] == 'HR' && $userdata['role'] != 'agent'){ ?>
                                <input type="checkbox" id="hrstatusvalue" name="hrstatusvalue" checked data-toggle="toggle" data-on="Accepted" data-off="Rejected" data-width="200" > 
                            <?php }else{ ?>
                                <b id="hrstatus">No Status Updated</b>
                            <?php } ?>
                            <br><p><br>Remark</p>
                            <textarea  class="form-control"  id="hrstatustext"  name="hrstatustext" <?php if($userdata['department'] != 'HR'  || $userdata['role'] == 'agent'){ echo "readonly"; }?>></textarea>
                        </td>
                        
                        <td>
                            <p>Last Working Date</p>
                            
                            <input type="date" id="lasteworkingdate" name="lasteworkingdate" <?php if($userdata['department'] != 'MANAGEMENT'){ echo "readonly"; }?> >
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" class="check-in" id="resign_btn" style="margin-left:40%">
            </form>
            </div><br>

            </div>
            <div class="tab-pane fade pl-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"  style="text-decoration:none;">
            <br>
            <form action="<?php echo base_url(); ?>Separation/separation_RevokeUpload" method="POST" >
            <input type="hidden" id="emp_id2" name="emp_id2">
            <p>Reason<span  style="padding-left:80%;"><i class="fa fa-calendar"></i> <?php echo "<span id='dtprint_revoke'>".date('d-m-Y')."</span>"; ?></span></p>
            <textarea  class="form-control" id="revoke_Reason" rows="3" name="revoke_Reason"  <?php if($userdata['role'] != 'agent'){ echo "readonly"; }?>></textarea>
            <input type="submit" id="rework_submit" class="check-in" style="margin-left:40%">
            </form>  
            </div>
        </div>
        <br>         
      </div>
    </div><br>
  </div>
  </div>
</div>
</div>
</div>
</body>

<script>
$('.useridSeparation').select2();

viewSeparation();
function viewSeparation(){
  
  $('#emp_Separtation').hide();
  
  var emp_id = $("#useridemp").children("option:selected").val();

  if(emp_id != ''){
    $('#emp_id1').val(emp_id);
    $('#emp_id2').val(emp_id);
    $('#emp_Separtation').show();
    $.ajax({
      url : "<?php echo base_url(); ?>Separation/getuserdata",
      method : "POST",
      data : {"userid":emp_id},
      success : function(datares){
        var data = JSON.parse(datares);
        console.log(data);
        if(data.length > 0){
          $('#resignation_Reason').val(data[0].Resignation_reason);
          $('#revoke_Reason').val(data[0].Revoke_reason);
          var user_role = "<?php echo $userdata['role']; ?>";
          if(user_role != 'agent'){
            if(data[0].Resignation_reason != ''){
              $('#resignation_Reason').prop('readonly',true);
              $('#resign_btn').prop('disabled', false);  
            }
            if(data[0].Revoke_reason != ''){
              $('#revoke_Reason').prop('readonly',true);
              $('#rework_submit').prop('disabled', false); 
            }
          }else{
            if(data[0].Resignation_reason != ''){
              $('#resignation_Reason').prop('readonly',true);
              $('#resign_btn').prop('disabled', true);  
            }else{
              $('#resignation_Reason').prop('readonly',false);
              $('#resign_btn').prop('disabled', false);
            }
          }
          
          if(data[0].Resign_Manager_status !=''){
            $('#managerstatus').html('<h4>'+data[0].Resign_Manager_status+'</h4>');
          }else{
            $('#managerstatus').html('<b>No Status Updated</b>');
          }

          if(data[0].Resign_HR_status !=''){
            $('#hrstatus').html('<h4>'+data[0].Resign_HR_status+'</h4>');
          }else{
            $('#hrstatus').html('<b>No Status Updated</b>');
          }

          $('#dtprint_resig').html(data[0].Resignation_date);
          $('#dtprint_revoke').html(data[0].Revoke_date);
          $('#managerstatustext').val(data[0].Resign_Manager_remark);

          var manager_accepReject = data[0].Resign_Manager_status;
          if(manager_accepReject == 'Accepted'){
            $('#managerstatusvalue').bootstrapToggle('on');
          }else{
            $('#managerstatusvalue').bootstrapToggle('off');
          }

          $('#hrstatustext').val(data[0].Resign_HR_remark);
          var hrstatusvalue = data[0].Resign_HR_status;

          if(hrstatusvalue == 'Accepted' || hrstatusvalue == ''){
            $('#hrstatusvalue').bootstrapToggle('on');
          }else{
            $('#hrstatusvalue').bootstrapToggle('off');
          }

          if(data[0].Resign_Lastworkdate != '0000-00-00'){
            var dt=data[0].Resign_Lastworkdate.split("-");
            //var dtview = dt[0]+'/'+dt[1] + '/' + dt[2];
            var day = ("0" + dt[2]).slice(-2);
            var month = ("0" + (dt[1] + 1)).slice(-2);
            var today = dt[0]+"-"+(month)+"-"+(day) ;
            $("#lasteworkingdate").val(today);
          }

          //Revoke Details          

        }else{
          $('#revoke_Reason').val('');
          $('#lasteworkingdate').val('');
          // $('#dtprint_resig').html('');
          $('#hrstatustext').val('');
          $('#managerstatustext').val('');
          $('#hrstatusvalue').bootstrapToggle('on');
          $('#managerstatusvalue').bootstrapToggle('on');
          $('#resignation_Reason').val('');
        }
      }
    }); 
  }
}
</script>
