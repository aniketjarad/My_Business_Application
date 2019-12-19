<?php
	$manager = $this->getAllManager();
?>
<div class="container">
			<form id="register-form" class="contact100-form validate-form" method="post" action="">
				<span class="contact100-form-title">
					<h2>Add Employee</h2>
				</span><!-- value="<?php ?>" -->
				<div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate="Name is required">
					<span class="label-input1000">Employee Name</span>
					<input class="input1000" type="text" name="emp_name" placeholder="Enter your name" required>
					<span class="focus-input1000"></span>
				</div>
				<div id="emp_code-div" class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate = " Enter Valid Employee Code">
					<span class="label-input1000">Employee Code</span>
					<input class="input1000" type="text" name="emp_code" placeholder="Enter Employee Code" required>
					<span class="focus-input1000"></span>
				</div>

				<div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate=" Enter Valid WIW ID">
					<span class="label-input1000">WIW ID</span>
					<input class="input1000" type="text" name="wiw_id" placeholder="Enter WIW ID" required>
					<span class="focus-input1000"></span>
				</div>
				<div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate = "Please Enter Valid EMEA ID">
					<span class="label-input1000">EMEA ID</span>
					<input class="input1000" type="text" name="emea_id" placeholder="Enter EMEA ID" required>
					<span class="focus-input1000"></span>
				</div>

				<div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate = "Please Enter Valid Email-ID">
					<span class="label-input1000">Email-ID</span>
					<input class="input1000" type="email" name="email_id" placeholder="Enter Email-ID" required>
					<span class="focus-input1000"></span>
				</div>
				
				<div id="contact-div" class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate = "Please Enter Valid Contact Number">
					<span class="label-input1000">Contact Number</span>
					<input class="input1000" type="text" name="contact_no" placeholder="Enter Contact Number" required>
					<span class="focus-input1000"></span>
				</div>
				<div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate = "Enter Valid Date Of Joining">
					<span class="label-input1000">Date Of Joining</span>
					<input class="input1000 datepicker" type="date" name="doj" placeholder="Enter Date Of Joining" required>
					<span class="focus-input1000"></span>
				</div>

								
				<div id="cc-div" class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate="Enter Valid Cost Center">
					<span class="label-input1000">Cost Center</span>
					<input class="input1000" type="text" name="cost_center" placeholder="Enter Cost Center" required>
					<span class="focus-input1000"></span>
				</div>
				<div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate="Enter Valid Department">
					<span class="label-input1000">Department</span>
					<input class="input1000" type="text" name="department" placeholder="Enter Department" required>
					<span class="focus-input1000"></span>
				</div> 

				
				<div class="wrap-input1000 rs1-wrap-input1000 validate-input" data-validate = "Enter Valid Designation">
					<span class="label-input1000">Designation</span>
					<input class="input1000" type="text" name="designation" placeholder="Enter Designation" required>
					<span class="focus-input1000"></span>
				</div>

				<div class="rs1-wrap-input1000 validate-input" data-validate = "Select Valid Grade">
					<span class="label-input1000">Grade</span>
					<br>
					<!--<input class="input1000" type="text" name="grade" placeholder="Select Grade">-->
					<select id="select" class="js-select2" name="grade" placeholder="Select Grade" required>
						<option value="">Select Grade</option>
						<option value="EXT">External</option>
						<option value="L0">L0</option>
						<option value="L1">L1</option>
						<option value="L2">L2</option>
						<option value="L3">L3</option>
						<option value="L4">L4</option>
						<option value="L5">L5</option>
					</select>
					<span class="label-input1000" style="float:left;margin-left: 20%;"><p>Is a Manager ..?</p></span>
					
					<div  style="margin-left:80%;">
						<!-- Material switch -->
						<div class="">
						    <input name="is_manager" type="checkbox">
						</div>
					</div>
				</div>

				<div class="wrap-input1000 rs1-wrap-input1000 " >
					<span class="label-input1000">Reporting Manager</span>
					<!--<input class="input1000" type="text" name="manager" placeholder="Enter Managers Name" required>-->
					<select class="js-select2 input1000" name="manager" placeholder="Select Grade" required>
					<?php foreach($manager as $value){?>
						<option value="<?php echo $value;?>"><?php echo $value;?></option>
					<?php }?>
					</select>
					<span class="focus-input1000"></span>
				</div>

				<div id="hide" class="wrap-input50">
					
				</div>
				
				<div class="" style="float: right;margin-left: 80%;margin-top: 5%;">
					<button class="login100-form-btn">
						Register
					</button>
				</div>
			</form>
</div>