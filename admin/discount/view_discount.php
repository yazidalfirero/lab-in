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
			<table class="table table-bordered table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="25%">
					<col width="20%">
                    <col width="20%">
                    <col width="10%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-purple text-light">
						<th>#</th>
						<th>Nama Diskon</th>
						<th>Jenis Diskon</th>
						<th>Jumlah Diskon</th>
						<th>Deskripsi</th>
                        <th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `discount` ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['title'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['jenis_discount'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['jumlah_discount'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['description'] ?></p></td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
                                    <?php if($_settings->userdata('type') == 1): ?>
								  	<a href="./?page=discount/index&id=<?= $row['id'] ?>" class="dropdown-item"><span class="fa fa-edit text-dark"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
									<a href="../classes/Master.php?f=discount_delete&id=<?= $row['id'] ?>" class="dropdown-item delete_data"><span class="fa fa-trash text-danger"></span> Hapus</a>
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
                { orderable: false, targets: 5 }
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