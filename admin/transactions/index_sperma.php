<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="card card-outline card-purple rounded-0 shadow">
	<div class="card-header">
		<h3 class="card-title">Daftar Transaksi Sperma</h3>
		<!-- <div class="card-tools">
			<a href="./?page=transcations/manage_transction" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Add New Transaction</a>
		</div> -->
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-hover table-striped mw-100">
				<colgroup>
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-purple text-light">
						<th>#</th>
						<th>Tanggal Daftar</th>
						<th>Nama Pasien</th>
						<th>Umur</th>
						<th>Alamat Pasien</th>
						<th>Nama Pengirim</th>
						<th>Kontak Pasien</th>
						<th>Alamat Pengirim</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `sperm_transaction` order by `sample_diterima` asc,unix_timestamp(date_created) asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['nama_pasien'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['umur_pasien'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['alamat_pasien'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['nama_pengirim'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['kontak_pasien'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['rujukan_pengirim'] ?></p></td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
								  	<a href="./?page=transactions/manage_sperma&id=<?= $row['id'] ?>" class="dropdown-item"><span class="fa fa-edit text-dark"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
									<a href="./?page=transactions/printout&id=<?= $row['id'] ?>" class="dropdown-item"><span class="fa fa-print text-primary"></span> Cetak</a>
									<?php if($_settings->userdata('type') == 1): ?>
				                    <div class="dropdown-divider"></div>
									<a href="../classes/Master.php?f=transaction_sperm_delete&id=<?= $row['id'] ?>" class="dropdown-item delete_data"><span class="fa fa-trash text-danger"></span> Hapus</a>
									<?php endif; ?>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Price permanently?")
		})
		$('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 4 }
            ],
        });

	})
	function delete_transaction($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_transaction",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>