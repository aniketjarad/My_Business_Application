  <?php

  if(!isset($_SESSION['emp_code'])){
  header("Location: /home/login");
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
    <h4 class="m-0 text-dark">Certification</h4>
    
  </div><!-- /.col -->
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="/home/">Home</a></li>
      <li class="breadcrumb-item"><a href="/employee/">Employee</a></li>
      <li class="breadcrumb-item active">Certification</li>
    </ol>
  </div><!-- /.col -->
  </div><!-- /.row -->
  </div><!-- /.container-fluid -->
    
  </div><!-- /.content-header -->
    <div align="left" style="margin-left:2%;">
      <button type="button" name="add" class="btn btn-info " data-toggle="modal" data-target="#addCertiModal">Add Certification</button>
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importCertiModal">Import</button>
    </div>
  <center>
       


  <table id="certiTable" class="table table-bordred display dataTable" >
    <thead style="font-size: 13px;text-align: center; ">
      <tr>
        <th style="width: 20px;"> # </th>
        <th></th>
        <th>Emp Code</th>
        <th>Emp Name</th>
        <th></th>
      </tr>
    </thead>
    <tbody style="font-size: 13px;text-align: center;" class="table-bordred">
    <?php 
      $i = 0 ;
      $data = $this->getAllCertification();
      foreach($data as $key => $emp_data)
      {
        $e_code = explode("|",$key)[0];
        $e_name = explode("|",$key)[1];
      ?>      
      <tr class="clickable" data-toggle="collapse" class="table-bordred"data-target="#group-of-rows-<?php echo $i; ?>" aria-expanded="false" aria-controls="group-of-rows-<?php echo $i; ?>" style="font-size: 13px;text-align: center; ">
        <td style="width: 20px;">
        <i class="fa fa-plus" ></i>
        <i class="fa fa-minus"></i></td>
        <td></td>
        <td><?php echo $e_code; ?></td>
        <td><?php echo $e_name; ?></td>  
        <td></td>
      </tr>
    </tbody>
    <tbody id="group-of-rows-<?php echo $i; ?>" class="table-bordred collapse" style="font-size: 13px;text-align: center;">
      <tr style="background-color:  #f7d38f;">
        <td></td>
        <td><b>Category</b></td>
        <td><b>Name</b></td>
        <td><b>Module</b></td>        
        <td><b>Expiry</b></td>
      </tr> 
      <?php  
      foreach($data[$key] as $keys => $cert_arr)
      {
      ?>          
      <tr style="background-color:  #faf1d9;">
        <td><?php echo $keys; ?></td>
        <td><?php echo $cert_arr['category']; ?></td> 
        <td><?php echo $cert_arr['cert_name']; ?></td>
        <td><?php echo $cert_arr['module']; ?></td>           
        <td><?php echo $cert_arr['cert_expiry']; ?></td> 
      </tr>                
      <?php
      }
      ?>
    </tbody>
    <?php $i= $i + 1 ;
    }
  ?>   

  </tbody>
  <tfoot style="font-size: 13px;text-align: center;">
      <tr>
        <th style="width: 20px;">#</th>
        <th></th>
        <th>Emp Code</th>
        <th>Emp Name</th>
        <th></th>
       </tr>
  </tfoot>
  </table>

</center>

  <!-- Modal -->
<div class="modal fade" id="addCertiModal" tabindex="-1" role="dialog" aria-labelledby="addCertiModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCertiModalLongTitle">Add Employee Certificate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="addCertificate-form" method="post" action="">  

          <div class="form-group">
            <label for="emp_Name">Employee Name : </label>
            <select class="form-control" id="employee_Name"  name="emp_Name">
               <?php 
                  $i = 0 ;
                  $data = $this->getAll();
                  

                  foreach($data as $key => $emp_data)
                  {
                    print_r($emp_data);
                    $e_code = $emp_data['emp_code'];
                    $e_name = $emp_data['emp_name'];
                  ?>     
                   <option value=<?php echo $e_code; ?>  ><?php echo $e_name; ?></option>
                     <?php 
                   }
                   ?>
            </select>
          </div>
         

          <div class="form-group">
            <label for="certCategory">Certificate Category : </label>
            <select class="form-control" id="certificateCategory"  name="certCategory">
              <option value="None" >---Select Category---</option>
              <option value="Servicenow">Servicenow</option>
              <option value="ITIL">ITIL</option>
              <option value="Other">Other</option>
            </select>
          </div>

           <div class="form-group hide-div" id="certificateModulediv" >
            <label for="certModule" >Certificate Module : </label>
            <select class="form-control" id="certificateModule"  name="certModule">
            
            </select>
          </div>

           <div class="form-group hide-div" id="certificatediv" >
            <label for="certName" >Certificate Name : </label>
            <select class="form-control" id="certificateName"  name="certName">
              <option value="null" >---Select Certificate---</option>
            </select>
          </div>
          <div class="form-group hide-div" id="certificatedivCustomModule">
            <label for="certNameCustom" id="certificateCustomMOD"  >Certificate Module :</label>
            <input type="text" class="form-control"  name="certModuleCustom" id="IdcertModuleCustom" placeholder="Enter Certificate Name">
          </div>

           <div class="form-group hide-div" id="certificatedivCustomName">      
            <label for="certNameCustom" id="certificateNameCustom" >Certificate Name :</label>
            <input type="text" class="form-control"  name="certNameCustom" id="certificatedivCustomNameId" placeholder="Enter Certificate Name">
          </div>

           <div class="form-group" id="certificateExpDateDiv">
            <label for="certNameCustom" id="certificateExpDat" >Expiry Date :</label>
            <input type="date" class="form-control"  name="certExpDatename" id="certificateExpDateId" placeholder="Expiry Date">
          </div>

       
      </div>
      
      <div class="modal-footer">
        
        <div id="hide_result" class="col-md-12 hide-div" style="padding-bottom: 45px;">
          <!-- <span class="label-input50" >'+res.data+'</span> -->
        </div>
        <button  type="submit" class="btn btn-success">Save</button>

      </div>
         </form>
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