  <?php
if(!isset($_SESSION['emp_code']) || count($_SESSION)== 0){
  //header("Location: /home/login");
  echo "<script>window.location.href='/home/login';</script>";
    exit;
}else{
  //$this->loadModel('EmployeeModel');
  }
  ?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
  <div class="container-fluid">
  <div class="row mb-2">
  <div class="col-sm-6">
    <h4 class="m-0 text-dark">Skill Matrix</h4>
    
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/home/">Home</a></li>
      <li class="breadcrumb-item"><a href="/employee/">Employee</a></li>
      <li class="breadcrumb-item active">Skill</li>
    </ol>
  </div><!-- /.col -->
  </div><!-- /.row -->
  </div><!-- /.container-fluid -->
    
  </div><!-- /.content-header -->
    <div align="left" style="margin-left:2%;">
      <button type="button" name="add" id="addskill_btn" class="btn btn-info " style="color: white;" data-toggle="modal" data-target="#addSkillModal"> Add Skill</button>
      <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importCertiModal">Import</button> -->
    </div>
  <center>
       <div class="table-responsive">       
      <table id="skillmatrix_table" class="skill_width table table-bordred display dataTable" style="width:100%">
            <thead style="font-size: 13px;text-align:center;">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Primary Skill</th>                
                    <th>Secondary Skill</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size: 11px;text-align:center;">
                <?php 
            $data = $this->getAllSkill();
            $count = 1;
            foreach($data as $key => $emp_data)
            {
               $e_code = explode("|",$key)[0];
               $e_name = explode("|",$key)[1];
            ?>      
          <tr>
            <td><?php echo $e_code; ?></td>
            <td><?php echo $e_name; ?></td>
            <td><?php echo $emp_data[$count]['primary_skill']; ?></td>           
            <td style="word-wrap:break-word;"><?php echo $emp_data[$count]['secondary_skill']; ?></td>            
            <td>
              <input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data" data-title="Edit" data-toggle="modal" data-target="#addSkillModal" onclick = "Update_Skill_Element(<?php echo $e_code; ?>);"/>
              <input type="button" name="delete" value="Delete" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data" data-title="Delete"  onclick = "Delete_Skill_Element(<?php echo $e_code; ?>);"/>

            </td>   
          </tr>
            <?php
            $count ++;
            }
          ?>   
            </tbody>
            <tfoot style="font-size: 13px;text-align:center;">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Primary Skill</th>                
                    <th>Secondary Skill</th>
                    <th>Action</th>
                </tr>
            </tfoot>
      </table>
  </div>
</center>

      <!-- Modal -->
 <div class="modal fade" id="addSkillModal" tabindex="-1" role="dialog" aria-labelledby="addCertiModalCenterTitle"   aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addCertiModalLongTitle">Add Employee Skill</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="addskill-form" method="post" action="">        
              <div class="form-group">
                <label for="emp_Name">Employee Name : </label>
                <select class="form-control" id="employee_Name"  name="emp_Name">
                   
                </select>
              </div>
              <div class="form-group"id="mulipleselectdiv_primary" >
                <label >Primay Skills :</label><span class="required">*</span>
               <select class="js-example-placeholder-multiple form-control" data-placeholder="Select All The Skill Sets" style="width: 100%;" id="mulipleselect_primary" name="skill_list_primary[]" multiple="multiple" required="required">            
               </select>
              </div>
              <div class="form-group"id="mulipleselectdiv_secondary" >
                <label >Secondary Skills :</label><span class="required">*</span>
               <select class="js-example-placeholder-multiple form-control" data-placeholder="Select All The Skill Sets" style="width: 100%;" id="mulipleselect_secondary" name="skill_list_secondary[]" multiple="multiple" required="required">            
               </select>
            </div>
            <div class="form-group"id="customskilldiv_secondary" >            
               <button type="button" class="btn fa fa-plus" data-toggle="collapse" data-target="#secskillcolapse"></button> 
               <label >Add New Skills</label>
                <div id="secskillcolapse" class="collapse " style="padding-top: 15px;" >
                  <div style="display: flex;width: 100%;">
                  <input type="text" class="form-control"   name="skillNameCustom" id="IdskillNameCustom" placeholder="Add New Skills Comma Separated" style="width: 95%;">
                   <button type="button" name="addnewskill_btn" id="addnewskill_btn" class="btn btn-info " style="color: white;float: right !important;margin-left: 3%;"><b>+</b></button>
                 </div>
                </div>
            </div>
             
            <div class="modal-footer">        
              <div id="hide_skillres" class="col-md-12 hide-div" style="padding-bottom: 45px;">
                <!-- <span class="label-input50" >'+res.data+'</span> -->
              </div>
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="importCertiModal" tabindex="-1" role="dialog" aria-labelledby="importCertiModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="importCertiModalLongTitle">Import Excel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
</div>
<!--
<div class="modal fade" id="editSkillModal" tabindex="-1" role="dialog" aria-labelledby="importCertiModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="importCertiModalLongTitle">Edit Certificate Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
             <div class="form-group"id="mulipleselectdiv_primary" >
                <label >Primay Skills :</label>
               <select class="js-example-placeholder-multiple form-control" data-placeholder="Select All The Skill Sets" style="width: 100%;" id="upddatePrimarySel" name="update_skill_primary[]" multiple="multiple">            
               </select>
              </div>
              <div class="form-group"id="mulipleselectdiv_secondary" >
                <label >Secondary Skills :</label>
               <select class="js-example-placeholder-multiple form-control" data-placeholder="Select All The Skill Sets" style="width: 100%;" id="updateSecondarySel" name="update_skill_secondary[]" multiple="multiple">            
               </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
  -->


