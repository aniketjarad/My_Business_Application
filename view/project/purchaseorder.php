<?php
if(!isset($_SESSION['emp_code']) || count($_SESSION)== 0){
//header("Location: /home/login");
echo "<script>window.location.href='/home/login';</script>";
  exit;
}else{
  // $data = $this->getAllProject();
  // print_r($data);
  $dataTable = $this->getAllPurchaseOrderDetails();

  // print_r($data);
  // exit(0);
  //$this->loadModel('EmployeeModel');
}
?>

  <!-- Content Header (Page header) -->
  <div class="content-header">
  <div class="container-fluid">
  <div class="row mb-2">
  <div class="col-sm-6">
    <h4 class="m-0 text-dark">Purchase Order</h4>
    
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/home/">Home</a></li>
      <li class="breadcrumb-item"><a href="/project/">Projects</a></li>
      <li class="breadcrumb-item active">Purchase Order</li>
    </ol>
  </div><!-- /.col -->
  </div><!-- /.row -->
  </div><!-- /.container-fluid -->
    
  </div><!-- /.content-header -->
    <div align="left" style="margin-left:2%;">
      <button type="button" name="add" id="addPOBtn" class="btn btn-info " style="color: white;" data-toggle="modal" data-target="#addPOModal"> Add PO</button>
      <!-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importCertiModal">Import</button> -->
    </div>
  <center>
       <div class="table-responsive">       
      <table id="purchaseOrderTable" class="skill_width table table-bordred display dataTable" style="width:100%">
            <thead style="font-size: 13px;text-align:center;">
                <tr>
                    <th>PO Number</th>
                    <th>Project Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>               
                    <th>Active</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="font-size: 11px;text-align:center;">
               <?php
                $count = 1;
            foreach($dataTable as $key => $emp_data)
            {
              $e_code = $emp_data[$count]['po_number'];
              $deleteCode = $emp_data[$count]['po_number']."|".$emp_data[$count]['project_name'];
              // print_r($emp_data[$count]['po_number']);
            ?>      
          <tr>
            <td><?php echo $emp_data[$count]['po_number']; ?></td>     
            <td><?php echo $emp_data[$count]['project_name']; ?></td>     
            <td><?php echo $emp_data[$count]['start_date']; ?></td>           
            <td><?php echo $emp_data[$count]['end_date']; ?></td> 
            <td><?php echo $emp_data[$count]['active']; ?></td>                
            <td>
              <input type="button" name="edit" value="Edit" id="<?php echo $emp_data[$count]['project_id']; ?>" class="btn btn-info btn-xs edit_data" data-title="Edit" data-toggle="modal" data-target="#addPOModal" onclick = "editPurchaseOrder('<?php echo $e_code; ?>');"/>
              <input type="button" name="delete" value="Delete" id="<?php echo $emp_data[$count]['project_id']; ?>" class="btn btn-info btn-xs edit_data" data-title="Delete"  onclick = "deletePurchaseOrder('<?php echo $deleteCode; ?>');"/>

            </td>   
          </tr>
            <?php
            $count ++;
            }
          ?>   
            </tbody>
            <tfoot style="font-size: 13px;text-align:center;">
                <tr>
                    <th>PO Number</th>
                    <th>Project Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>               
                    <th>Active</th>
                    <th>Action</th>
                </tr>
            </tfoot>
      </table>
  </div>
</center>

      <!-- Modal -->
 <div class="modal fade" id="addPOModal" tabindex="-1" role="dialog" aria-labelledby="addCertiModalCenterTitle"   aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addCertiModalLongTitle">Add Purchase Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="addPOForm" method="post" action="">        
             
             
            <div class="form-group" id="ponumDiv">
                <label for="poNumFor" id="poNumLabel">Purchase Order Number:</label><span class="required">*</span>
                <input type="text" class="form-control"  name="poNumName" id="poNumId" placeholder="Purchase Order Number" required="required">
            </div>
            <div class="form-group">
                <label for="Projectname">Project Name : </label>
                <select class="form-control" id="projectNameId"  name="projectNameName">
                  <!-- <option value="" >----- Select Project -----</option> -->
                   
                </select>
              </div>
            <div class="form-group" id="startDateDiv">
              <label for="projectIdFor" id="startlabel">Start Date :</label><span class="required">*</span>
              <input type="date" class="form-control"  name="startDateName" id="startDateId" required="required">
            </div>
            <div class="form-group" id="endDateDiv">
              <label for="projectIdFor" id="endLabel">End Date :</label><span class="required">*</span>
              <input type="date" class="form-control"  name="endDateName" id="endDateId"  required="required">
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
                <div class="form-group hide-div" id="ActionDiv">
                
                <input type="text" class="form-control"  name="ActionName" id="ActionId" placeholder="Project Cost Center"  >
              </div>
            <div class="modal-footer">        
              <div id="hidPoRes" class="col-md-12 hide-div" style="padding-bottom: 45px;">
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


