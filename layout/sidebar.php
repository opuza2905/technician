<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/logo.png" alt="logo" height="250" width="250">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links --> <!-- Add condition over here -->
    <ul class="navbar-nav">
		<li class="nav-item">
		  <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
		</li>
    </ul>
	
	<form method="GET">
		<li class="nav-item d-none d-sm-inline-block">
			<?php
				include_once 'conf/conn.php';	
				echo "<select class='custom-select form-control-border border-width-2' name='lineSelect' id='lineSelect'>";
				echo "<option>Select Line</option>";
				$line = mysqli_query($connection, "select id_line, line from tbl_line order by id_line asc");	
				while ($row_line = $line->fetch_assoc()) {
					$select = '';
					if($row_line["id_line"] == @$_GET['lineSelect']){
						$select = 'selected';
					}
					echo "<option value='" . $row_line["id_line"] . "' $select>" . $row_line["line"]. "</option>";
				}
				echo "</select>";
			?>
		</li>
		
		&nbsp;&nbsp;&nbsp;
		<li class="nav-item d-none d-sm-inline-block">
			<div class="input-group date" id="reservationdate" data-target-input="nearest">
				<input type="text" name="tanggalAwal" class="form-control datetimepicker-input" data-target="#reservationdate" value="<?php echo @$_GET['tanggalAwal'];?>"/>
				<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
					<div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
			</div>
		</li>
					&nbsp;-&nbsp;
		<li class="nav-item d-none d-sm-inline-block">
			<div class="input-group date" id="reservationdate1" data-target-input="nearest">
				<input type="text" name="tanggalAkhir" class="form-control datetimepicker-input" data-target="#reservationdate1" value="<?php echo @$_GET['tanggalAkhir'];?>"/>
				<div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
					<div class="input-group-text"><i class="fa fa-calendar"></i></div>
				</div>
			</div>
		</li>
		&nbsp;&nbsp;
		<li class="nav-item d-none d-sm-inline-block">
			<td>
				<button type="submit" class="btn btn-block btn-primary">Show - 展示</button>
			</td>
		</li>
	</form>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->

      <!-- Full screen -->
	  <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/logo.png" alt="YCME" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><strong>Dashboard</strong></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/logo.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block" target="_blank">YIFANG CME</a>
        </div>
      </div> -->
   
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
		<li class="nav-header">MENU</li>
          <li class="nav-item menu-close">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda (主页)
                <i class="right fas fa-angle-left"></i>
              </p>
			</a>
			<ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far nav-icon fas fa-list"></i>
                  <p>Fault Entry</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far nav-icon fas fa-sync-alt"></i>
                  <p>Item Repairing</p>
                </a>
              </li>
            </ul>
          </li>
		  <!-- Add clock -->
		 <li>
			<?php
				date_default_timezone_set("Asia/jakarta");
			?>
			<br></br>
			<center><span id="time" style="font-size:24"></span>
			
			<script type="text/javascript">
				window.onload = function() { time(); }
			   
				function time() {
					var e = document.getElementById('time'),
					d = new Date(), h, m, s;
					h = d.getHours();
					m = set(d.getMinutes());
					s = set(d.getSeconds());
			   
					e.innerHTML = h +':'+ m +':'+ s;
			   
					setTimeout('time()', 1000);
				}
			   
				function set(e) {
					e = e < 10 ? '0'+ e : e;
					return e;
				}
			</script>
		 </li>
		 <!-- <link rel="stylesheet" href="../css/loader.css"> -->
		 
		</ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>