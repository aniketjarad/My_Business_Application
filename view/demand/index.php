<?php

if(!isset($_SESSION['emp_code'])){

	header("Location: /home/login");
	exit;
}else{
    $count = $this->getDemandCount();

    // echo "<pre>";
    //print_r($count);
    // echo "</pre>";

}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Demand</h4>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home/">Home</a></li>
          <li class="breadcrumb-item active">Demand</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
  <!-- /.content-header -->
<center>
	<div class="">
        <div align="left" style="margin-left:2%;">
        <button type="button" id="add_btn" name="add" class="btn btn-info fa fa-plus" style="color: white;padding: 10px;" data-toggle="modal" data-target="#addDemandModal"> New Demand</button>
        <div class="col-md-3" style="float: right;">
          <a href="#" title="Example tile shortcut" class="tile-box tile-box-shortcut btn-danger">
             <span class="bs-badge badge-absolute"><?php echo $count['count']; ?></span>
             <div class="tile-header">Available Demand's Now</div>
             <div class="tile-content-wrapper"><i class="fa fa-user fafa-icon-css"></i></div>
          </a>
       </div>
    </div>
    
    	<!--<table id="example" class="table table-bordred display" style="width:100%">
            <thead style="font-size: 13px;text-align:center;">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Wiw Id</th>                
                    <th>Date Of Joining</th>
                    <th>Reporting Manager</th>
                    <th>Cost Center</th>
                    <th>Designation</th>
                    <th>Grade</th>
                    <th>Factory</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size: 11px;text-align:center;">
                <?php 
    				$data = $this->getAll();
    				foreach($data as $key => $emp_data)
    				{
    				?>			
					<tr>
						<td><?php echo $emp_data['emp_code']; ?></td>
						<td><?php echo $emp_data['emp_name']; ?></td>
						<td><?php echo $emp_data['wiw_id']; ?></td>						
						<td><?php echo $emp_data['doj']; ?></td>
						<td><?php echo $emp_data['manager']; ?></td>
						<td><?php echo $emp_data['cost_center']; ?></td>
						<td><?php echo $emp_data['designation']; ?></td>
						<td><?php echo $emp_data['grade']; ?></td>
						<td><?php echo $emp_data['department']; ?></td>
                        <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data" data-title="Edit" data-toggle="modal" data-target="#edit" onclick = "Update_Element(<?php echo $emp_data['emp_code']; ?>);"/></td>   
					</tr>
    				<?php
    				}
    			?>   
            </tbody>
            <tfoot style="font-size: 13px;text-align:center;">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Wiw Id</th>                
                    <th>Date Of Joining</th>
                    <th>Reporting Manager</th>
                    <th>Cost Center</th>
                    <th>Designation</th>
                    <th>Grade</th>
                    <th>Factory</th>
                    <th>Action</th>
                </tr>
            </tfoot>
    	</table> -->
	</div> 
    <!-- Modal Edit-->
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
            <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
        </div>
        <div class="modal-body">
           <form id="update-form" class="contact100-form validate-form" method="post" action="" style="padding-bottom: 0px;">
                <div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate="Name is required"> 
                    <span class="label-input1000">Employee Name</span>
                    <input class="input1000" type="text" name="emp_name" id="emp_name" placeholder="Enter your name" required >
                    <span class="focus-input1000"></span>
                </div>
                <div id="emp_code-div" class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate = " Enter Valid Employee Code">
                    <span class="label-input1000">Employee Code</span>
                    <input class="input1000" type="text" name="emp_code" id="emp_code" placeholder="Enter Employee Code" required readonly >
                    <span class="focus-input1000"></span>
                </div>

                <div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate=" Enter Valid WIW ID">
                    <span class="label-input1000">WIW ID</span>
                    <input class="input1000" type="text" name="wiw_id" id="wiw_id" placeholder="Enter WIW ID" required readonly >
                    <span class="focus-input1000"></span>
                </div>
                <div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate = "Please Enter Valid EMEA ID">
                    <span class="label-input1000">EMEA ID</span>
                    <input class="input1000" type="text" name="emea_id" id="emea_id" placeholder="Enter EMEA ID" required readonly >
                    <span class="focus-input1000"></span>
                </div>

                <div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate = "Please Enter Valid Email-ID">
                    <span class="label-input1000">Email-ID</span>
                    <input class="input1000" type="email" name="email_id" id="email_id"placeholder="Enter Email-ID" required readonly >
                    <span class="focus-input1000"></span>
                </div>
                
                <div id="contact-div"class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate = "Please Enter Valid Contact Number">
                    <span class="label-input1000">Contact Number</span>
                    <input class="input1000" type="text" name="contact_no" id="contact_no" placeholder="Enter Contact Number" required >
                    <span class="focus-input1000"></span>
                </div>
                <div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate = "Enter Valid Date Of Joining">
                    <span class="label-input1000">Date Of Joining</span>
                    <input class="input1000 datepicker" type="date" name="doj" id="doj" placeholder="Enter Date Of Joining" required readonly>
                    <span class="focus-input1000"></span>
                </div>
                                
                <div id="cc-div"class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate="Enter Valid Cost Center">
                    <span class="label-input1000">Cost Center</span>
                    <input class="input1000" type="text" name="cost_center" id="cost_center" placeholder="Enter Cost Center" required >
                    <span class="focus-input1000"></span>
                </div>
                <div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate="Enter Valid Department">
                    <span class="label-input1000">Department</span>
                    <input class="input1000" type="text" name="department" id="department" placeholder="Enter Department" required >
                    <span class="focus-input1000"></span>
                </div> 
                
                <div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate = "Enter Valid Designation">
                    <span class="label-input1000">Designation</span>
                    <input class="input1000" type="text" name="designation" id="designation" placeholder="Enter Designation" required >
                    <span class="focus-input1000"></span>
                </div>

                <div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate = "Select Valid Grade">
                    <span class="label-input1000">Grade</span>
                    
                    <!--<input class="input1000" type="text" name="grade" placeholder="Select Grade">-->
                    <select class="js-select2 input1000" name="grade" id="grade" placeholder="Select Grade" required style="text-align:center;">
                        <option selected disabled hidden>Select Grade</option>
                        <option value="EXT">External</option>
                        <option value="L0">L0</option>
                        <option value="L1">L1</option>
                        <option value="L2">L2</option>
                        <option value="L3">L3</option>
                        <option value="L4">L4</option>
                        <option value="L5">L5</option>
                    </select>
                    <span class="focus-input1000"></span>
                </div>

                <div class="wrap-input1000 rs1-wrap-input1000 " >
                    <span class="label-input1000">Reporting Manager</span>
                    <!--<input class="input1000" type="text" name="manager" placeholder="Enter Managers Name" required>-->
                    <select id="manager" class="js-select2 input1000" name="manager" placeholder="Select Grade" required >
                    <?php  
                    foreach($manager as $value){?>
                        <option value="<?php echo $value;?>"><?php echo $value;?></option>
                    <?php }?>
                    </select>
                    <span class="focus-input1000"></span>
                </div>
                
                <div class=" rs1-wrap-input1000 ">
                    <span class="label-input1000">Is a Manager ..?</span>
                    <br>
                    <div style="text-align: center;">
                        <span class="label-input1000">No</span>
                        
                        <div class="switch">
                          <label>
                            <input id="is_manager" name="is_manager" type="checkbox">
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <span class="label-input1000">Yes</span>
                    </div>
                </div>

                <div class=" rs1-wrap-input1000 " >
                    <span class="label-input1000">Is Active ..?</span>
                    <br>
                    <div style="text-align: center;">
                        <span class="label-input1000">No</span>
                        <div class="switch">
                          <label>
                            <input id="active" name="active" type="checkbox" >
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <span class="label-input1000">Yes</span>
                    </div>
                </div>
                <div id="hide" class="wrap-input50">
                    
                </div>

                <div class="" style="float: right;margin-left: 40%;margin-top: 5%;">
                    <button class="login100-form-btn btn btn-warning">
                        Update
                    </button>
                </div>
                
            </form>
        </div>
        
        <!-- /.modal-content --> 
        </div>
          <!-- /.modal-dialog --> 
    </div>
    </div>
    <!-- End of Modal Edit-->

    <!-- Modal Add new -->
    <div class="modal fade" id="addDemandModal" tabindex="-1" role="dialog" aria-labelledby="addDemandModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-md" role="dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addCertiModalLongTitle">Add New Demand</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="text-align:left;">
            <form method="post" id="add-demand-form" enctype="multipart/form-data">
              <div class="form-group" required>
                <label >Demand Id :</label>
                <input type="text" class="form-control" name="demand_id" id="demand_id_text" placeholder="Enter Demand Id" style="display: none;">
                <select class="form-control" name="demand_id" id="demand_id_select" style="display: none;" >
                </select>
              </div>
              <div class="form-group">
                <label >Candidate Name :</label>
                <input type="text" class="form-control" name="candidate_name" placeholder="Enter Candidate Name">
              </div>
              <div class="form-group">
                <label >Position :</label>
                <input type="text" class="form-control" name="position" placeholder="Enter the Position " required>
              </div>
              <div class="form-group">
                <label >Joining Date :</label>
                <input type="date" class="form-control" name="joining_date" placeholder="Enter Candidate Name">
              </div>
              <div class="form-group">
                <label >Tentative Mapping :</label>
                <input type="text" class="form-control" name="tentative_mapping" placeholder="Enter Tentative Mapping" required>
              </div>

              <div class="form-group">
                <label for="certCategory">Current Status : </label> 
                <select class="form-control" name="status" id="demand_status" required>
                    <option value="On Track">On Track</option>
                    <option value="Dropped">Dropped</option>
                    <option value="Backfill">Backfill</option>
                    <option value="Joined">Joined</option>
                </select>
              </div>
              <div class="form-group" id="backfill_div" style="display: none;">
                <label >Backfill Employee Name :</label>
                <select class="form-control" name="backfill_id" id="backfill_select">
                </select>
              </div>
              <div class="form-group">
                <label >Attach Job Description :</label>
                <input type="file" class="form-control" name="jd_attach" style="align-items: right;" placeholder="Attach Job Description" required>
              </div>
              <div class="form-group">
                <label >Attach CV of Candidate:</label>
                <input type="file" class="form-control" name="cv_attach" style="align-items: right;" placeholder="Attach CV Description">
              </div>
          </div>
            <div id="msg" class="wrap-input50">
            </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Add Demand</button>
          </div>
        </div>
        </form>
      </div>
    </div>
    <!-- End of Modal Add new -->
</center>