<?php

if(!isset($_SESSION['emp_code'])){
	header("Location: /home/login");
	exit;
}else{
    $all = $this->getAllArchieve();
    $data = $all['data'];
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Demand Archieve</h4>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home/">Home</a></li>
          <li class="breadcrumb-item"><a href="/home/demand/">Demand</a></li>
          <li class="breadcrumb-item active">Archieve</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
  <!-- /.content-header -->
<center>
  <div>
	<table id="demand_archieve_table" class="table table-bordred display" style="width:100%;margin-top:15px;">
        <thead style="font-size: 13px;text-align:center;">
            <tr>
                <th>Demand Id</th>
                <th>BOS Id</th>
                <th>Candidate Name</th>
                <th>Position</th>                
                <th>Date Of Joining</th>
                <th>Status</th>
                <th>Tentative Mapping</th>
                <th>BackFill Employee ID</th>
                <th>JD</th>
                <th>CV</th>
                <!-- <th>Action</th> -->
            </tr>
        </thead>
        <tbody style="font-size: 11px;text-align:center;">
            <?php 
				
                
				foreach($data as $key => $emp_data)
				{
				?>			
				<tr>
					<td><?php if(!empty($emp_data['demand_id'])) echo $emp_data['demand_id']; else echo "---";?></td>
                    <td><?php if(!empty($emp_data['bos_id'])) echo $emp_data['bos_id']; else echo "---";?></td>
					<td><?php if(!empty($emp_data['candidate_name'])) echo $emp_data['candidate_name']; else echo "---"; ?></td>
					<td><?php if(!empty($emp_data['position'])) echo $emp_data['position']; else echo "---"; ?></td>
					<td><?php if(!empty($emp_data['joining_date'])) echo $emp_data['joining_date']; else echo "---"; ?></td>
					<td><?php if(!empty($emp_data['status'])) echo $emp_data['status']; else echo "---"; ?></td>
					<td><?php if(!empty($emp_data['tentative_mapping'])) echo $emp_data['tentative_mapping']; else echo "---"; ?></td>
					<td><?php if(!empty($emp_data['backfill_emp_id'])) echo $emp_data['backfill_emp_id']; else echo "---"; ?></td>
					<td><?php if(!empty($emp_data['jd'])) { echo "<a download=".end(explode("/",$emp_data['jd']))." href=".$emp_data['jd']." class='fa fa-file-alt' style='color: #E20074;'></a>";} else echo "---";?> 
                    </td>
					<td><?php if(!empty($emp_data['cv'])) {echo "<a download=".end(explode("/",$emp_data['cv']))." href=".$emp_data['cv']." class='fa fa-file-alt' style='color: #E20074;'></a>";} else echo "---";?>                  
                    </td>
                    <!--<td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data" data-title="Edit" data-toggle="modal" data-target="#addDemandModal" onclick = "Update_Demand(<?php echo $emp_data['demand_id']; ?>);"/></td> -->
				</tr>
				<?php
				}
			?>   
        </tbody>
        <tfoot style="font-size: 13px;text-align:center;">
            <tr>
                <th>Demand Id</th>
                <th>BOS Id</th>
                <th>Candidate Name</th>
                <th>Position</th>                
                <th>Date Of Joining</th>
                <th>Status</th>
                <th>Tentative Mapping</th>
                <th>BackFill Employee ID</th>
                <th>JD</th>
                <th>CV</th>
            </tr>
        </tfoot>
	</table>
</div>
    <!-- Modal Add new -->
    <!--<div class="modal fade" id="addDemandModal" tabindex="-1" role="dialog" aria-labelledby="addDemandModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-md" role="dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="DemandTitle">Add New Demand</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" style="text-align:left;">
            <form method="post" id="add-demand-form" enctype="multipart/form-data">
              <div class="form-group" required>
                <label >Demand Id :</label>
                <input type="text" class="form-control" name="demand_id" id="demand_id_text" placeholder="Enter Demand Id" readonly>
              </div>
               <div class="form-group">
                <label >BOS Id :</label>
                <input type="text" class="form-control" name="bos_id" id="bos_id" placeholder="Enter BOS ID" >
              </div>
              <div class="form-group">
                <label >Candidate Name :</label>
                <input type="text" class="form-control" name="candidate_name" id="candidate_name"placeholder="Enter Candidate Name">
              </div>
              <div class="form-group">
                <label >Position :</label>
                <input type="text" class="form-control" name="position" id="position" placeholder="Enter the Position " required>
              </div>
              <div class="form-group">
                <label >Expected Joining Date :</label>
                <input type="date" class="form-control" name="joining_date" id="joining_date" placeholder="Enter Candidate Name" required>
              </div>
              <div class="form-group">
                <label >Tentative Mapping :</label>
                <input type="text" class="form-control" name="tentative_mapping" id="tentative_mapping" placeholder="Enter Tentative Mapping" >
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
                <select class="form-control" name="backfill_emp_id" id="backfill_select">
                </select>
              </div>
              <div id="jd_div" class="form-group">
                <label >Attach Job Description :</label>
                <input type="file" class="form-control" name="jd_attach" id="jd_attach"style="align-items: right;" placeholder="Attach Job Description" required>
                <a id="jd" name="jd"></a>
              </div>
              <div id="cv_div" class="form-group">
                <label >Attach CV of Candidate:</label>
                <input type="file" class="form-control" name="cv_attach" id="cv_attach" style="align-items: right;" placeholder="Attach CV Description">
                <a id="cv" name="cv"></a>
              </div>
              </div>
                <input type="text" class="form-control" id="action" name="action" style="display: none;" value="add"/>
                <div id="msg" class="wrap-input50">
                </div>
              <div class="modal-footer">
                <button type="submit" id="btn_demand" class="btn btn-success">Add Demand</button>
              </div>
            </div>
        </form>
      </div>
    </div> -->
    <!-- End of Modal Add new -->
</center>