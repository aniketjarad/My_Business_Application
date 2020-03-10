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
    <h4 class="m-0 text-dark">Projects</h4>
    
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/home/">Home</a></li>
      <li class="breadcrumb-item active">Projects</li>
    </ol>
  </div><!-- /.col -->
  </div><!-- /.row -->
  </div><!-- /.container-fluid -->
    
  </div><!-- /.content-header -->
    <div align="left" style="margin-left:2%;">
      <button type="button" name="add" id="addProjectBtn" class="btn btn-info " style="color: white;" data-toggle="modal" data-target="#addProjectModal">Add Project</button>
      <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importCertiModal">Import</button> -->
    </div>
  <center>
       <div class="table-responsive">       
      <table id="projectTable" class="skill_width table table-bordred display dataTable" style="width:100%">
            <thead style="font-size: 13px;text-align:center;">
                <tr>
                    <th>Project Id</th>
                    <th>Project Name</th>
                    <th>Cost Center</th>                
                    <th>Purchase Order</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size: 11px;text-align:center;">
                <?php 
            $data = $this->getAllProject();
            $count = 1;
            foreach($data as $key => $emp_data)
            {
              $e_code = $emp_data[$count]['project_id'];
            ?>      
          <tr>
            <td><?php echo $emp_data[$count]['project_id']; ?></td>     
             <td><?php echo $emp_data[$count]['project_name']; ?></td>     
            <td><?php echo $emp_data[$count]['cost_center']; ?></td>           
            <td style="word-wrap:break-word;"><?php echo $emp_data[$count]['pos']; ?></td> 
            <td><?php echo $emp_data[$count]['active']; ?></td>            
            <td>
              <input type="button" name="edit" value="Edit" id="<?php echo  $emp_data[$count]['project_id'] ; ?>" class="btn btn-info btn-xs edit_data" data-title="Edit" data-toggle="modal" data-target="#addProjectModal" onclick = "editProject('<?php echo $e_code; ?>');"/>

              

            </td>   

          </tr>
            <?php
            $count ++;
            }
          ?>   
            </tbody>
            <tfoot style="font-size: 13px;text-align:center;">
                <tr>
                    <th>Project Id</th>
                    <th>Project Name</th>
                    <th>Cost Center</th>                
                    <th>Purchase Order</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
            </tfoot>
      </table>
  </div>
</center>

      <!-- Modal -->
 <div class="modal fade" id="addProjectModal" tabindex="-1" role="dialog" aria-labelledby="addCertiModalCenterTitle"   aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addCertiModalLongTitle">Add Project</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="addProjectForm" method="post" action="">        
             
              <div class="form-group" id="projectIdDiv">
                <label for="projectIdFor" id="projectIdLabel">Project Id :</label><span class="required">*</span>
                <input type="text" class="form-control"  name="projectIdName" id="projectId" placeholder="Project Id" required="required">
              </div>
              <div class="form-group" id="projectNameDiv">
                <label for="projectNameFor" id="projectNameLabel">Project Name :</label><span class="required">*</span>
                <input type="text" class="form-control"  name="projectName" id="projectNameId" placeholder="Project Name" required="required">
              </div>
              <div class="form-group" id="projectCostCenterDiv">
                <label for="projectCostCenterFor" id="projectCostCenterLabel">Cost Center :</label><span class="required">*</span>

                <input type="text" class="form-control"  name="projectCostCenter" id="projectCostCenterId" placeholder="Project Cost Center [47200044]" pattern="[0-9]+" required="required" >
              </div>

              <div class="form-group hide-div" id="ActionDiv">
                
                <input type="text" class="form-control"  name="ActionName" id="ActionId" placeholder="Project Cost Center"  >
              </div>
             <div class="form-group hide-div" id="multiSelectPurchaseOrderDiv" >
                <label >Purchase Order :</label>
               <select class="js-example-placeholder-multiple form-control" data-placeholder="Select All The Purchase Orders Applicable" style="width: 100%;" id="multiSelectPurchaseOrderId" name="arrmultiSelectPurchaseOrder[]" multiple="multiple" disabled="disabled">            
               </select>
            </div>
             <div class="rs1-wrap-input1000  " style="padding: 10px;" >
                    
                    <div   class="pull-right hide-div" id="activDiv">
                       <label >Active :</label>
                        <span class="label-input1000" style="padding-left: 20px;">No</span>
                        <div class="switch">
                          <label>
                            <input id="active" name="active" type="checkbox" checked="checked" >
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <span class="label-input1000">Yes</span>
                    </div>
                </div>
            <div class="modal-footer">        
              <div id="hiddenProjectRes" class="col-md-12 hide-div" style="padding-bottom: 45px;">
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


