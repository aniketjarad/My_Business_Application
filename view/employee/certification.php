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
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newCertiModal">New Category</button>
  </div>
<center>
  <table id="certiTable" class="table table-bordred display dataTable" style="margin-top: 25px;" >
    <thead style="font-size: 13px;text-align: center; ">
      <tr>
        <th style="width: 20px;"> # </th>
        <th></th>
        <th>Emp Code</th>
        <th>Emp Name</th>
        <th></th>
        <th>Emp Action</th>
      </tr>
    </thead>
    <tbody style="font-size: 13px;text-align: center;" class="table-bordred">
    <?php 
      $i = 0 ;
      $data = $this->getAllCertification();
      foreach($data as $key => $emp_data)
      {
        $cert_count = 1;
        $e_code = explode("|",$key)[0];
        $e_name = explode("|",$key)[1];
        $e_code_btn = "buttonId".$e_code;
      ?>      
      <tr class="clickable" data-toggle="collapse" class="table-bordred"data-target="#group-of-rows-<?php echo $i; ?>" aria-expanded="false" aria-controls="group-of-rows-<?php echo $i; ?>" style="font-size: 13px;text-align: center; ">
        <td style="width: 20px;">
        <i class="fa fa-plus" ></i>
        <i class="fa fa-minus"></i></td>
        <td></td>
        <td><?php echo $e_code; ?></td>
        <td><?php echo $e_name; ?></td>  
        <td></td>
        <td>
           <input type="button" name="delete" value="Delete" id="<?php echo $e_code_btn; ?>" class="btn btn-info btn-xs edit_data" data-title="Delete"  onclick = "deleteCompEmp(<?php echo $e_code; ?>);"/>
        </td>

      </tr>
    </tbody>
    <tbody id="group-of-rows-<?php echo $i; ?>" class="table-bordred collapse" style="font-size: 13px;text-align: center;">
      <tr style="background-color:  #f7d38f;">
        <td></td>
        <td><b>Category</b></td>
        <td><b>Name</b></td>
        <td><b>Module</b></td>        
        <td><b>Expiry</b></td>
        <td><b>Action</b></td>
      </tr> 
      <?php  
      foreach($data[$key] as $keys => $cert_arr)
      {
        $cert_name= strval($e_code)."|".$cert_arr['cert_name']; 
        // echo $cert_name;
      ?>          
      <tr style="background-color:  #faf1d9;">
        <td><?php echo $cert_count; ?></td>
        <td><?php echo $cert_arr['category']; ?></td> 
        <td><?php echo $cert_arr['cert_name']; ?></td>
        <td><?php echo $cert_arr['module']; ?></td>           
        <td><?php echo $cert_arr['cert_expiry']; ?></td> 
        <td>        
          <input type="button" name="delete" value="X" id="<?php echo $cert_name; ?>" class="btn btn-info btn-xs edit_data" data-title="Delete"  onclick = "deleteCertiElement(id);"/>
        </td>
      </tr>                
      <?php
      $cert_count++;
      }
      ?>
    </tbody>
    <?php $i= $i + 1 ;
    }
    ?>   
    <!-- </tbody> -->
    <tfoot style="font-size: 13px;text-align: center;">
        <tr>
          <th style="width: 20px;">#</th>
          <th></th>
          <th>Emp Code</th>
          <th>Emp Name</th>
          <th></th>
          <th>Emp Action</th>
         </tr>
    </tfoot>
  </table>
  
  <!-- Modal -->
  <div class="modal fade" id="addCertiModal" tabindex="-1" role="dialog" aria-labelledby="addCertiModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
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
                    //print_r($emp_data);
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
                <label for="certCategory">Certificate Category : </label><span class="required">*</span>
                <select class="form-control" id="certificateCategory"  name="certCategory" required="required">
                </select>
              </div>

              <div class="form-group " id="certificateModulediv" >
                <label for="certModule" >Certificate Module : </label><span class="required">*</span>
                <select class="form-control" id="certificateModule"  name="certModule" required="required">
                </select>
              </div>

              <div class="form-group" id="certificatediv" >
                <label for="certName" >Certificate Name : </label><span class="required">*</span>
                <select class="form-control" id="certificateName"  name="certName" required="required">
                </select>
              </div>
                   

              <div class="form-group" id="certificateExpDateDiv">
                <label for="certNameCustom" id="certificateExpDat" >Expiry Date :</label><span class="required">*</span>
                <input type="date" class="form-control"  name="certExpDatename" id="certificateExpDateId" placeholder="Expiry Date" required="required">
              </div>
            
              <div class="modal-footer">        
                <div id="hide_result" class="col-md-12 hide-div" style="padding-bottom: 45px;"></div>
                <button  type="submit" class="btn btn-success">Save</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="newCertiModal" tabindex="-1" role="dialog" aria-labelledby="addCertiModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addCertiModalLongTitle">Add New Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="newCertificate-form" method="post" action="">  
            <div class="form-group" id="divNewCertCategory">
              <label for="certNameCustom" id="lebelNewCertCategory">Certificate Category :</label><span class="required">*</span>
              <input type="text" class="form-control"  name="nameNewCertCategory" id="idNewCertCategory" placeholder="Enter Certificate Category" required="required">
            </div>
            
            <div class="form-group" id="divNewCertModule">
              <label for="certNameCustom" id="labelNewCertModule">Certificate Module :</label><span class="required">*</span>
              <input type="text" class="form-control"  name="nameNewCertModule" id="idNewCertModule" placeholder="Enter Certificate Module" required="required">
            </div>

             <div class="form-group" id="divNewCertName">      
              <label for="certNameCustom" id="labelNewCertName" >Certificate Name :</label><span class="required">*</span>
              <input type="text" class="form-control"  name="nameNewCertName" id="idNewCertName" placeholder="Enter Certificate Name" required="required">
            </div>
            <div class="form-group" id="divNewCertType" >
              <label for="certName" >Certificate type : </label>
              <select class="form-control" id="idNewCertType"  name="nameselNewCertType">
                <option name="Main Line">Main Line</option>
                <option name="Micro">Micro</option>
              </select>
            </div>      
        </div>      
        <div class="modal-footer">        
          <div id="hide_result_new" class="col-md-12 hide-div" style="padding-bottom: 45px;">
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
</center>