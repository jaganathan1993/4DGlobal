<body>
<div class="page-wrapper chiller-theme toggled">
<?php include('header.php');?>
	<main class="page-content">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="col-12 col-md-12 content" style="min-height:780px;">
					<div class="row head-content">
						<div class="col-9 col-md-4 logo"><img src="<?php echo base_url();?>img/logo.jpg"></div>
						<div class="col-3 col-md-8 text-right logout"><a href="<?php echo base_url();?>login/signout">Logout</a></div>
					</div>
					<div class="row activity-row">
						<div class="col-md-12 activity">Add Department</div>
					</div>			
          <?php echo $this->session->flashdata('msg');?>
					<div class="row emp-table">
	          <form action="<?php echo base_url();?>department/add_department" method="post" enctype="multipart/form-data">
              <div class="field_wrapper">
                <div class="row">
                  <div class="col-md-12">                  
                    <p class="">Enter Department Name:</p>
                    <input type="text" name="department[]" placeholder="Enter Department" class="col-md-12 col-xs-12 form-control" required=""/>
                  </div>
                </div>
              </div>
              <br><input type="submit" name="dsubmit" value="submit" class="check-in">
            </form>
              <div class="col-md-3" style="margin-top:4%;">                  
                <a href="javascript:void(0);" title="Add field">
                  <button class="add_button start-break">Add</button>
                </a>
              </div>
                  <div class="col-md-12 table-responsive">
                    <table class="table" id="tabledata">
                      <thead>
                        <tr>
                          <th scope="col">Department</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php if($depart_data!='') { ?>
                        <tr>
                          <?php foreach($depart_data as $department){ ?>
                          <td><?php echo ucfirst($department->department);?></td>
                          <td><span class="emp-break-out"><a href="<?php echo base_url()?>department/del_department/<?php echo $department->id;?>" onClick="return doconfirm();" style="color:red;">Delete</a></span> 
                         </td>
                        </tr>
                      <?php } } ?>
                      </tbody>
                    </table>
                  </div>
				  </div>
			</div>
		</div>
	</div>
</main>
</div>

<script>

$(document).ready(function(){
  var maxField  = 100; 
  var addButton = $('.add_button'); 
  var wrapper   = $('.field_wrapper');
  var fieldHTML = '<br><div class="row"><div class="col-md-12"><input type="text" name="department[]" placeholder="Enter Department" class="col-md-12 col-xs-12 form-control" required=""/><a href="javascript:void(0);" class="remove_button"><button class="check-out" style="">Remove</button></a></div></div>'; 
  var x = 1;
    
  $(addButton).click(function(){
    if(x < maxField){ 
      x++;
      $(wrapper).append(fieldHTML);
    }
  });

  $(wrapper).on('click', '.remove_button', function(e){
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
  });

});

function doconfirm()
{
    let del=confirm("Are you sure to delete permanently?");
    if(del!=true)
    {
        return false;
    }
}
</script>
</body>
</html>