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
      <button type="button" name="add" class="btn btn-info fa fa-plus" style="color: white;padding: 10px;" data-toggle="modal" data-target="#addCertiModal"> <b>Skill</b></button>
      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#importCertiModal"><b>Import</b></button>
    </div>
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
      $data = $this->getAllSkill();
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
        <td><b>Skill</b></td>
        <td><b>Proficiency</b></td>
        <td><b>Skill Category</b></td>
      </tr> 
      <?php  
      foreach($data[$key] as $keys => $cert_arr)
      {
      ?>          
      <tr>
        <td><?php echo $keys; ?></td>
        <td><?php echo $cert_arr['skill']; ?></td>
        <td><?php echo $cert_arr['proficiency']; ?></td>  
        <td><?php echo $cert_arr['skill_category']; ?></td> 
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
        <h5 class="modal-title" id="addCertiModalLongTitle">Add Employee Skill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form id="addskill-form" method="post" >        
          <div class="form-group">
            <label for="usr">Employee Code :</label>
            <input type="text" class="form-control" id="certEmpCode" placeholder="Enter Employee Code">
          </div>
          <div class="form-group">
            <label for="usr">Skill :</label>
            <input type="text" class="form-control" id="certEmpCode" placeholder="Enter Employee Skill">
          </div>

          <div class="form-group">
            <label for="certCategory">Proficiency : </label>
            <select class="form-control" id="certCategory">
              <option value="Basic">Basic</option>
              <option value="Intermediate">Intermediate</option>
              <option value="Advance">Advance</option>
              <option value="Expert">Expert</option>
            </select>
          </div>
      
      <div class="form-group">
            <label for="certCategory">Skill Category : </label>
            <select class="form-control" id="certCategory">
              <option value="Primary">Primary</option>
              <option value="Secondary">Secondary</option>
             
            </select>
          </div>       
      </div>
      <div class="modal-footer">        
        <button type="submit" class="btn btn-success">Save</button>
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