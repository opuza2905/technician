<?php
include_once '../conf/conn.php';	
 if(isset($_GET['lineSelect']) && !empty($_GET['lineSelect']) && $_GET['lineSelect'] != "Select Line" && isset($_GET['tanggalAwal']) && !empty($_GET['tanggalAwal']) && isset($_GET['tanggalAkhir']) && !empty($_GET['tanggalAkhir'])) {
  //condition if line and daterange prompted
  $lineY = $_GET['lineSelect'];
  $tgl1 = $_GET['tanggalAwal'];
  $tgl2 = $_GET['tanggalAkhir'];
  
  $all = mysqli_query($connection, "select count(*) from tbl_asset where id_line = '$lineY' and tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d')");
  $open = mysqli_query($connection, "select count(*) from tbl_asset where status = 'Open' and id_line = '$lineY' and tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d')");
  $onproc = mysqli_query($connection, "select count(*) from tbl_asset where status = 'On Process' and id_line = '$lineY' and tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d')");
  $finish = mysqli_query($connection, "select count(*) from tbl_asset where status = 'Finished' and id_line = '$lineY' and tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d')");
  $topall = "select tbl_line.line, tbl_kerusakan.nama_kerusakan, count(tbl_asset.serial_number) as entry_count from tbl_line join tbl_asset on tbl_line.id_line=tbl_asset.id_line join tbl_kerusakan on tbl_asset.kode_kerusakan=tbl_kerusakan.kode_kerusakan where tbl_asset.id_line = '$lineY' and tbl_asset.tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d') group by tbl_line.line, tbl_kerusakan.nama_kerusakan order by entry_count desc limit 5";
  $showtable = "select tbl_asset.serial_number, date_format(tbl_asset.tanggal_kerusakan, '%d-%m-%Y %H:%i:%s') as fault_date, date_format(tbl_asset.tanggal_selesai, '%d-%m-%Y %H:%i:%s') as finish_date, tbl_line.line, tbl_asset.type, tbl_kerusakan.nama_kerusakan, tbl_asset.status, tbl_asset.pic_service, tbl_asset.assistent_penerima from tbl_asset inner join tbl_line on tbl_asset.id_line=tbl_line.id_line inner join tbl_kerusakan on tbl_asset.kode_kerusakan=tbl_kerusakan.kode_kerusakan where tbl_asset.id_line = '$lineY' and tbl_asset.tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d') order by tbl_asset.tanggal_kerusakan desc limit 8";
}
elseif(isset($_GET['tanggalAwal']) && !empty($_GET['tanggalAwal']) && isset($_GET['tanggalAkhir']) && !empty($_GET['tanggalAkhir'])){
  //condition if daterange only prompted
  $tgl1 = $_GET['tanggalAwal'];
  $tgl2 = $_GET['tanggalAkhir'];
  
  $all = mysqli_query($connection, "select count(*) from tbl_asset where tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d')");
  $open = mysqli_query($connection, "select count(*) from tbl_asset where status = 'Open' and tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d')");
  $onproc = mysqli_query($connection, "select count(*) from tbl_asset where status = 'On Process' and tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d')");
  $finish = mysqli_query($connection, "select count(*) from tbl_asset where status = 'Finished' and tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d')");
  $topall = "select tbl_line.line, tbl_kerusakan.nama_kerusakan, count(tbl_asset.serial_number) as entry_count from tbl_line join tbl_asset on tbl_line.id_line=tbl_asset.id_line join tbl_kerusakan on tbl_asset.kode_kerusakan=tbl_kerusakan.kode_kerusakan where tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d') group by tbl_line.line, tbl_kerusakan.nama_kerusakan order by entry_count desc limit 5";
  $showtable = "select tbl_asset.serial_number, date_format(tbl_asset.tanggal_kerusakan, '%d-%m-%Y %H:%i:%s') as fault_date, date_format(tbl_asset.tanggal_selesai, '%d-%m-%Y %H:%i:%s') as finish_date, tbl_line.line, tbl_asset.type, tbl_kerusakan.nama_kerusakan, tbl_asset.status, tbl_asset.pic_service, tbl_asset.assistent_penerima from tbl_asset inner join tbl_line on tbl_asset.id_line=tbl_line.id_line inner join tbl_kerusakan on tbl_asset.kode_kerusakan=tbl_kerusakan.kode_kerusakan where tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d') order by tbl_asset.tanggal_kerusakan desc limit 10";
}
elseif(isset($_GET['lineSelect']) && !empty($_GET['lineSelect']) && $_GET['lineSelect'] != "Select Line") {
  //condition if line only selected
  $lineY = $_GET['lineSelect'];

  //$all = mysqli_query($connection, "select count(*) from tbl_asset inner join tbl_line on tbl_asset.id_line=tbl_line.id_line where tbl_line.line='$getLine' and tbl_asset.tanggal_kerusakan between str_to_date('$getTglAwal', '%Y-%m-%d') and str_to_date('$getTglAkhir', '%Y-%m-%d')");
  $all = mysqli_query($connection, "select count(*) from tbl_asset where id_line = '$lineY'");
  $open = mysqli_query($connection, "select count(*) from tbl_asset where status = 'Open' and id_line = '$lineY'");
  $onproc = mysqli_query($connection, "select count(*) from tbl_asset where status = 'On Process' and id_line = '$lineY'");
  $finish = mysqli_query($connection, "select count(*) from tbl_asset where status = 'Finished' and id_line = '$lineY'");
  $topall = "select tbl_line.line, tbl_kerusakan.nama_kerusakan, count(tbl_asset.serial_number) as entry_count from tbl_line join tbl_asset on tbl_line.id_line=tbl_asset.id_line join tbl_kerusakan on tbl_asset.kode_kerusakan=tbl_kerusakan.kode_kerusakan where tbl_asset.id_line = '$lineY' group by tbl_line.line, tbl_kerusakan.nama_kerusakan order by entry_count desc limit 5";
  $showtable = "select tbl_asset.serial_number, date_format(tbl_asset.tanggal_kerusakan, '%d-%m-%Y %H:%i:%s') as fault_date, date_format(tbl_asset.tanggal_selesai, '%d-%m-%Y %H:%i:%s') as finish_date, tbl_line.line, tbl_asset.type, tbl_kerusakan.nama_kerusakan, tbl_asset.status, tbl_asset.pic_service, tbl_asset.assistent_penerima from tbl_asset inner join tbl_line on tbl_asset.id_line=tbl_line.id_line inner join tbl_kerusakan on tbl_asset.kode_kerusakan=tbl_kerusakan.kode_kerusakan where tbl_asset.id_line = '$lineY' order by tbl_asset.tanggal_kerusakan desc limit 10";
}
else{
  //no condition
  $all = mysqli_query($connection, "select count(*) from tbl_asset");
  $open = mysqli_query($connection, "select count(*) from tbl_asset where status = 'Open'");
  $onproc = mysqli_query($connection, "select count(*) from tbl_asset where status = 'On Process'");
  $finish = mysqli_query($connection, "select count(*) from tbl_asset where status = 'Finished'");
  $topall = "select tbl_line.line, tbl_kerusakan.nama_kerusakan, count(tbl_asset.serial_number) as entry_count from tbl_line join tbl_asset on tbl_line.id_line=tbl_asset.id_line join tbl_kerusakan on tbl_asset.kode_kerusakan=tbl_kerusakan.kode_kerusakan group by tbl_line.line, tbl_kerusakan.nama_kerusakan order by entry_count desc limit 5";
  $showtable = "select tbl_asset.serial_number, date_format(tbl_asset.tanggal_kerusakan, '%d-%m-%Y %H:%i:%s') as fault_date, date_format(tbl_asset.tanggal_selesai, '%d-%m-%Y %H:%i:%s') as finish_date, tbl_line.line, tbl_asset.type, tbl_kerusakan.nama_kerusakan, tbl_asset.status, tbl_asset.pic_service, tbl_asset.assistent_penerima from tbl_asset inner join tbl_line on tbl_asset.id_line=tbl_line.id_line inner join tbl_kerusakan on tbl_asset.kode_kerusakan=tbl_kerusakan.kode_kerusakan order by tbl_asset.tanggal_kerusakan desc limit 10";
}
$jumlah = mysqli_num_rows($all);

if($jumlah == '0'){
  header('Location: ./index.php');
}else{
  $total_all = mysqli_fetch_array($all)[0];
  $total_open = mysqli_fetch_array($open)[0];
  $total_onproc = mysqli_fetch_array($onproc)[0];
  $total_finish = mysqli_fetch_array($finish)[0];
  $query_top = mysqli_query($connection, $topall);
  $query_showtable = mysqli_query($connection, $showtable);
}

//Isi options line
$line = mysqli_query($connection, "select id_line, line from tbl_line order by id_line asc");
?>

<section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total (总)</span>
                <span class="info-box-number">
                  <?= $total_all ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-tag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Open (开)</span>
                <span class="info-box-number">
				<?= $total_open ?>
				</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-sync-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">On Process (进行中)</span>
                <span class="info-box-number">
				<?= $total_onproc ?>
				</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Finish (完成)</span>
                <span class="info-box-number">
				<?= $total_finish ?>
				</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
				 	<!-- <h5 class="card-title">Fault Dashboard</h5> -->
				
				<!-- </div> -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-5 col-12 col-sm-6 col-md-3" style="top: 1vh;">
						<canvas id="myChart" style="min-height: 200px; height: 200px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                  <!-- /.col -->
				  
				  <!-- Top 5 Fault Data here-->
                  <div class="col-md-7 col-12 col-sm-6 col-md-3">
                    <p class="text-center">
                      <strong>Top 5 Fault Entry - 前5故障记录</strong>
                    </p>
					<div class="card-body p-0">
						<div class="table-responsive">
							<table class="table m-0">
								<thead>
									<tr>
										<th>Line</th>
										<th>Kerusakan</th>
										<th>Val</th>
									</tr>
									<?php
									if($query_top->num_rows > 0){
										while($row = $query_top->fetch_assoc()){
											echo "<tr>
													<td>{$row['line']}</td>
													<td>{$row['nama_kerusakan']}</td>
													<td>{$row['entry_count']}</td>
													</tr>";
										}
									}
									?>
								</thead>
							</table>
						</div>
					</div>
                  </div>
                </div>
              </div>
			  <p></p>
			  <p></p>
			  <p></p>
              <!-- data-table -->
              <div class="card-footer">
                <div class="card-body">
					<div class="table-responsive">
						<table id="example2" class="table table-bordered table-hover table-striped">
						  <thead>
						  <tr>
							<th>Serial Number</th>
							<th>Fault Date</th>
							<th>Finish Date</th>
							<th>Line</th>
							<th>Type</th>
							<th>Nama Kerusakan</th>
							<th>Status</th>
							<th>PIC Service</th>
							<th>Assistant</th>
						  </tr>
						  </thead>
						  <tbody>
						  <?php
											if($query_showtable->num_rows > 0){
												while($row = $query_showtable->fetch_assoc()){
													echo "<tr>
															<td>{$row['serial_number']}</td>
															<td>{$row['fault_date']}</td>
															<td>{$row['finish_date']}</td>
															<td>{$row['line']}</td>
															<td>{$row['type']}</td>
															<td>{$row['nama_kerusakan']}</td>
															<td>{$row['status']}</td>
															<td>{$row['pic_service']}</td>
															<td>{$row['assistent_penerima']}</td>
															</tr>";
												}
											}
											?>
						</table>
					</div>
              </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
</section>


<script>
	<?php
		if(isset($_GET['lineSelect']) && !empty($_GET['lineSelect']) && $_GET['lineSelect'] != "Select Line" && isset($_GET['tanggalAwal']) && !empty($_GET['tanggalAwal']) && isset($_GET['tanggalAkhir']) && !empty($_GET['tanggalAkhir'])) {
		//condition if line and daterange prompted
		$lineY = $_GET['lineSelect'];
		$tgl1 = $_GET['tanggalAwal'];
		$tgl2 = $_GET['tanggalAkhir'];
		
		$status = mysqli_query($connection,"select * from tbl_status");
		while($dr = mysqli_fetch_array($status)){
			$id_status[] = $dr['id'];
			$nama_status = $dr['status_name'];
			$nama[] = $dr['status_name'];
 
			$asset = mysqli_query($connection,"select * from tbl_asset where status='$nama_status' and id_line = '$lineY' and tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d')");
				$count_data[] = mysqli_num_rows($asset);
			}
		}elseif(isset($_GET['tanggalAwal']) && !empty($_GET['tanggalAwal']) && isset($_GET['tanggalAkhir']) && !empty($_GET['tanggalAkhir'])){
		//condition if daterange only prompted
		$tgl1 = $_GET['tanggalAwal'];
		$tgl2 = $_GET['tanggalAkhir'];
		
		$status = mysqli_query($connection,"select * from tbl_status");
		while($dr = mysqli_fetch_array($status)){
			$id_status[] = $dr['id'];
			$nama_status = $dr['status_name'];
			$nama[] = $dr['status_name'];
 
			$asset = mysqli_query($connection,"select * from tbl_asset where status='$nama_status' and tanggal_kerusakan between str_to_date('$tgl1', '%Y-%m-%d') and str_to_date('$tgl2', '%Y-%m-%d')");
				$count_data[] = mysqli_num_rows($asset);
			}
		}elseif(isset($_GET['lineSelect']) && !empty($_GET['lineSelect']) && $_GET['lineSelect'] != "Select Line") {
		//condition if line only selected
		$lineY = $_GET['lineSelect'];
		
		$status = mysqli_query($connection,"select * from tbl_status");
		while($dr = mysqli_fetch_array($status)){
			$id_status[] = $dr['id'];
			$nama_status = $dr['status_name'];
			$nama[] = $dr['status_name'];
 
			$asset = mysqli_query($connection,"select * from tbl_asset where status='$nama_status' and id_line = '$lineY'");
				$count_data[] = mysqli_num_rows($asset);
			}
		}else{
		//no condition
		$status = mysqli_query($connection,"select * from tbl_status");
		while($dr = mysqli_fetch_array($status)){
			$id_status[] = $dr['id'];
			$nama_status = $dr['status_name'];
			$nama[] = $dr['status_name'];
 
			$asset = mysqli_query($connection,"select * from tbl_asset where status='$nama_status'");
				$count_data[] = mysqli_num_rows($asset);
			}
		}
	 ?>
	 
	var ctx = document.getElementById('myChart');
	new Chart(ctx, {
		type: 'pie',
		data: {
			datasets: [{
				label: 'Status',
				data: <?php echo json_encode($count_data); ?>,
				backgroundColor: [
					'rgba(255, 0, 0, 1)',
					'rgba(255, 193, 7, 1)',
					'rgba(76, 175, 80, 1)'
					],
				borderColor: [
					'rgba(255, 0, 0, 1)',
					'rgba(255, 193, 7, 1)',
					'rgba(76, 175, 80, 1)'
					],
				borderWidth: 1
			}]
		},
		options: {
			responsive: true,
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	});
</script>