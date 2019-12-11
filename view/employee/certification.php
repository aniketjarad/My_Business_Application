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
    <div>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCertiModal">Add</button>
      
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#importCertiModal">Import Excel</button>
    </div>
  </div><!-- /.content-header -->
    
  <center>
       


  <table id="certiTable" class="table table-bordred display dataTable" >
    <thead style="font-size: 13px;text-align: center;">
      <tr>
        <th style="width: 20px;"> # </th>
        <th></th>
        <th>Emp Code</th>
        <th>Emp Name</th>
      </tr>
    </thead>
    <tbody style="font-size: 13px;text-align: center;">
    <?php 
      $i = 0 ;
      $data = $this->getAllCertification();
      foreach($data as $key => $emp_data)
      {
        $e_code = explode("|",$key)[0];
        $e_name = explode("|",$key)[1];
      ?>      
      <tr class="clickable" data-toggle="collapse" data-target="#group-of-rows-<?php echo $i; ?>" aria-expanded="false" aria-controls="group-of-rows-<?php echo $i; ?>" style="font-size: 13px;text-align: center;">
        <td style="width: 20px;">
        <i class="fa fa-plus" ></i>
        <i class="fa fa-minus"></i></td>
        <td></td>
        <td><?php echo $e_code; ?></td>
        <td><?php echo $e_name; ?></td>  
      </tr>
    </tbody>
    <tbody id="group-of-rows-<?php echo $i; ?>" class="collapse" style="font-size: 13px;text-align: center;">
      <tr>
        <td></td>
        <td><b>Name</b></td>
        <td><b>Expiry</b></td>
        <td><b>Category</b></td>
      </tr> 
      <?php  
      foreach($data[$key] as $keys => $cert_arr)
      {
      ?>          
      <tr>
        <td><?php echo $keys; ?></td>
        <td><?php echo $cert_arr['cert_name']; ?></td>
        <td><?php echo $cert_arr['cert_expiry']; ?></td>  
        <td><?php echo $cert_arr['category']; ?></td> 
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

        <form>        
          <div class="form-group">
            <label for="usr">Employee Code :</label>
            <input type="text" class="form-control" id="certEmpCode" placeholder="Enter Employee Code">
          </div>
          <div class="form-group">
            <label for="usr">Certificate Name :</label>
            <input type="text" class="form-control" id="certEmpCode" placeholder="Enter Employee Code">
          </div>

          <div class="form-group">
            <label for="certCategory">Certificate Category : </label>
            <select class="form-control" id="certCategory">
              <option value="None">NONE</option>
              <option value="Servicenow">Servicenow</option>
              <option value="ITIL">ITIL</option>
              <option value="Other">Other</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-success">Save</button>
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