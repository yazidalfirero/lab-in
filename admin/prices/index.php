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
		<h3 class="card-title">Daftar Pemeriksaan</h3>
		<div class="card-tools">
			<?php if($_settings->userdata('type') == 1): ?>
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Tambah Pemeriksaan Baru</a>
			<?php endif; ?>
			<a href="./?page=prices/list_price" id="" class="btn btn-flat btn-sm btn-secondary"><span class="fas fa-print"></span>  Cetak Pemeriksaan</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="10%">
					<col width="15%">
					<col width="15%">
					<col width="5%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-purple text-light">
						<th>#</th>
						<th>Kategori</th>
						<th>Pemeriksaan</th>
						<th>Harga</th>
						<th>Nilai Normal Pria</th>
						<th>Nilai Normal Wanita</th>
						<th>Satuan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT p.*,c.name as category from `price_list` p inner join category_list c on p.category_id = c.id where p.delete_flag = 0 order by c.`name` asc, p.size asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['category'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['size'] ?></p></td>
							<td class="text-right"><?= number_format($row['price'],2) ?></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['normalvalue'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['normalvalue_wanita'] ?></p></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['satuan'] ?></p></td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
								  	<a class="dropdown-item view_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
									  <?php if($_settings->userdata('type') == 1): ?>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
        $('#create_new').click(function(){
			uni_modal("Tambah Pemeriksaan","prices/manage_price.php")
		})
		$('.view_data').click(function(){
			uni_modal("Price Details","prices/view_price.php?id="+$(this).attr('data-id'))
		})
        $('.edit_data').click(function(){
			uni_modal("Update Price Details","prices/manage_price.php?id="+$(this).attr('data-id'))
		})
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Price permanently?","delete_price",[$(this).attr('data-id')])
		})
		$('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
	})
	function delete_price($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_price",
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