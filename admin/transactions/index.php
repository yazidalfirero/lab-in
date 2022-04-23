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
		<h3 class="card-title">Daftar Transaksi Laboraturium</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="25%">
					<col width="25%">
					<col width="25%">
					<col width="20%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-purple text-light">
						<th>#</th>
						<th>Tanggal Pendaftaran</th>
						<th>Nama Pengirim</th>
						<th>Pasien</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 1;
						$qry = $conn->query("SELECT * from `transaction_list` order by `status` asc,unix_timestamp(date_created) desc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("d-m-Y",strtotime($row['date_created'])) ?></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['sender_name'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['client_name'] ?></p></td>
							<td align="center">
								 <a href="./?page=transactions/view_transaction&id=<?= $row['id'] ?>" class="btn btn-flat btn-default btn-sm border"><i class="fa fa-edit"></i> Input Hasil</a>
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
