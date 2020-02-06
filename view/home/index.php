<?php
//session_start();
if(!isset($_SESSION['emp_code'])){
	header("Location: /home/login");
	exit;
}else{

}

$counts = $this->getAllCount();
?>
<!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Dashboard</h4>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/home/">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
<center>


<div class="row">
   <div class="col-md-3">
      <a href="#" title="Example tile shortcut" class="tile-box tile-box-shortcut btn-success">
         <span class="bs-badge badge-absolute"><?php echo $counts['emp_count']; ?></span>
         <div class="tile-header">Number of Employees</div>
         <div class="tile-content-wrapper"><i class="fa fa-user fafa-icon-css"></i></div>
      </a>
   </div>
   <div class="col-md-3">
      <a href="#" title="Example tile shortcut" class="tile-box tile-box-shortcut btn-warning ">
        <span class="bs-badge badge-absolute"><?php echo $counts['certificate_count']; ?></span>
         <div class="tile-header">Number of Certifications</div>
         <div class="tile-content-wrapper"><i class="fa fa-certificate fafa-icon-css"></i></div>
      </a>
   </div>
   <div class="col-md-3">
      <a href="#" title="Example tile shortcut" class="tile-box tile-box-shortcut btn-primary">
         <span class="bs-badge badge-absolute">2</span>
         <div class="tile-header">##########</div>
         <div class="tile-content-wrapper"><i class="fa fa-address-book fafa-icon-css"></i></div>
      </a>
   </div>
   <div class="col-md-3">
      <a href="#" title="Example tile shortcut" class="tile-box tile-box-shortcut  btn-danger ">
         <div class="tile-header">InActive Users</div>
         <div class="tile-content-wrapper"><i class="fa fa-address-book fafa-icon-css"></i></div>
      </a>
   </div>
</div>


<div class="row" >
 
  <div class="col-md-6" >
     
      <div class="card card-success" style="" id="CertificateChart" >
            <div class="card-header">
              <h3 class="card-title">Servicenow Chart</h3>

              <div class="card-tools">
                <!-- <button type="button" id="saveServicenowChart" class="btn btn-info "> Add Skill</button> -->
              
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fantom fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fantom fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">

              <div class="chart" id="servicenowPieChart">
                <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand">
                  <div class="">
                    
                  </div>
                </div>
                <div class="chartjs-size-monitor-shrink" >
                    <div class=""></div></div></div>
                <canvas id="barChart" width="387" height="287" class="chartjs-render-monitor"></canvas>
              </div>
            </div>
            <!-- /.card-body -->             
        </div>
  </div>
  <div class="col-md-6">
          <div class="card card-success"  id="CertificateChart" >
            <div class="card-header">
              <h3 class="card-title">Servicenow Chart</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fantom fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fantom fa-times"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand">
                  <div class="">
                    
                  </div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                    <div class=""></div></div></div>
                <canvas id="barChart"  width="387" height="287" class="chartjs-render-monitor"></canvas>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
    <!-- /.box-body -->
  </div>
</div>
</center>



 
