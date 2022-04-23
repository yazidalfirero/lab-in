<style>
	

@media print {
	table.report { page-break-after:auto }
  table.report tr    { page-break-inside:avoid; page-break-after:auto }
  table.report td    { page-break-inside:avoid; page-break-after:auto }
  table.report thead { display:table-header-group }
  table.report tfoot { display:table-footer-group }
  footer {
    position: fixed;
    bottom: 0;
  }
}
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>

<?php
$from = isset($_GET['from']) ? $_GET['from'] : date("Y-m-d",strtotime(date("Y-m-d")." -1 week"));
$to = isset($_GET['to']) ? $_GET['to'] : date("Y-m-d",strtotime(date("Y-m-d")));
function duration($dur = 0){
    if($dur == 0){
        return "00:00";
    }
    $hours = floor($dur / (60 * 60));
    $min = floor($dur / (60)) - ($hours*60);
    $dur = sprintf("%'.02d",$hours).":".sprintf("%'.02d",$min);
    return $dur;
}
?>
<div class="card card-outline card-purple rounded-0 shadow">
	<div class="card-header">
		<h3 class="card-title">Laporan Keuangan Test Laboraturium</h3>
		<div class="card-tools">
		</div>
	</div>
	<div class="card-body">
		<div class="callout border-primary">
			<fieldset>
				<legend>Filter</legend>
					<form action="" id="filter">
						<div class="row align-items-end">
				
							<div class="form-group col-md-3">
								<label for="from" class="control-label">Dari Tanggal</label>
                                <input type="date" name="from" id="from" value="<?= $from ?>" class="form-control form-control-sm rounded-0">
							</div>
							<div class="form-group col-md-3">
								<label for="to" class="control-label">Sampai Tanggal</label>
                                <input type="date" name="to" id="to" value="<?= $to ?>" class="form-control form-control-sm rounded-0">
							</div>
							<div class="form-group col-md-4">
                                <button class="btn btn-primary btn-flat btn-sm"><i class="fa fa-filter"></i> Filter</button>
			                    <button class="btn btn-sm btn-flat btn-success" type="button" id="print"><i class="fa fa-print"></i> Print</button>
							</div>
						</div>
					</form>
			</fieldset>
		</div>
		
			<style>
				#sys_logo{
					object-fit:cover;
					object-position:center center;
					width: 6.5em;
					height: 6.5em;
				}
			</style>
        <div class="container-fluid">
		<div id="outprint" class="printlaporan">
			<div class="row">
				<div class="col-2 d-flex justify-content-center align-items-center">
					<img src="<?= validate_image($_settings->info('logo')) ?>" class="img-circle" id="sys_logo" alt="System Logo">
				</div>
				<div class="col-8">
					<h4 class="text-center"><b><?= $_settings->info('name') ?></b></h4>
					<h3 class="text-center"><b>Laporan Keuangan Cek Laboraturium</b></h3>
					<h5 class="text-center"><b>Rentang Waktu</b></h5>
					<h5 class="text-center"><b><?= date("F d, Y", strtotime($from)). " - ".date("F d, Y", strtotime($to)) ?></b></h5>
				</div>
				<div class="col-2"></div>
			</div>
			<table id="tabelID" class="table table-bordered table-hover table-striped">
				<colgroup>
					<!-- <col width="5%">
					<col width="20%">
					<col width="25%">
					<col width="30%">
					<col width="20%"> -->
				</colgroup>
				<thead>
					<tr class="bg-gradient-purple text-light">
						<th>#</th>
						<th>No. Lab dan Tanggal</th>
						<th>Pasien</th>
						<th>Jenis Kelamin</th>
						<th>Pengirim</th>
						<th>Nama Pengirim</th>
						<th>Pemeriksaan</th>
						<th>Jenis Pemeriksaan</th>
						<th>Hasil</th>
						<th>Nilai Normal</th>
						<th>Satuan</th>
						<th>Harga Pokok</th>
						<th>diskon</th>
						<th>Harga</th>
					</tr>
				</thead>
				<tbody>

					<?php
						$i = 1;
						$diskoun=0;
						$qry = $conn->query("SELECT d.jenis_discount,d.jumlah_discount,p.price,d.title,tl.discount_id,tl.client_gender,p.normalvalue,p.normalvalue_wanita,p.satuan,tl.code,ti.hasil, tl.sender_name,tl.sender,tl.date_created, p.size, tl.client_name, tl.total_amount,ti.paket_price_id,ti.price from `transaction_items` as ti inner join `transaction_list` as tl on ti.transaction_id = tl.id inner join `price_list` as p on ti.price_id = p.id  left join paket pk on pk.price_paket = ti.paket_price_id left join discount d on d.id = tl.discount_id where date(tl.date_created) between '{$from}' and '{$to}' order by unix_timestamp(tl.date_created) desc ");
						$total = 0;
						while($row = $qry->fetch_assoc()):
              if($row['paket_price_id']==null):
				$hasil = $row['price'];
					if($row['jenis_discount']=="persen"):
						$diskoun = $row['price'] * $row['jumlah_discount']/100;
					else:
						$diskoun = $row['jumlah_discount'];
				endif;
				$hasil = $hasil - $diskoun;
				$total += $hasil;
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo $row['code'] ?><br><?php echo date("d-m-Y",strtotime($row['date_created'])) ?></td>
							<td class=""><p class="m-0"><?php echo $row['client_name'] ?></p></td>
							<td class=""><p class="m-0"><?php echo $row['client_gender'] ?></p></td>
							<td class=""><p class="m-0"><?php echo $row['sender'] ?></p></td>
							<td class=""><p class="m-0"><?php echo $row['sender_name'] ?></p></td>
							<td></td>
							<td class=""><p class="m-0"><?php echo $row['size'] ?></p></td>
							<td class=""><p class="m-0"><?php echo $row['hasil'] ?></p></td>
							<td class=""><p class="m-0"><?php echo $row['client_gender'] == "Pria" ? $row['normalvalue'] : $row['normalvalue_wanita'] ?></p></td>
							<td class=""><p class="m-0"><?php echo $row['satuan'] ?></p></td>
							<td class=""><p class="m-0"><?= number_format($row['price'],2) ?></p></td>
							<td class=""><p class="m-0"><?php echo $row['title'] ?></p></td>
							<td class="text-right"><?= number_format($hasil,2) ?></td>
						</tr>
					<?php endif;endwhile; ?>
          <?php 
						$k = 1;
						$qry = $conn->query("SELECT c.name,d.jumlah_discount,p.price,d.title,tl.discount_id,tl.client_gender,p.normalvalue,p.normalvalue_wanita,p.satuan,tl.code,tl.sender_name,tl.sender,tl.date_created, p.size, tl.client_name, tl.total_amount,ti.paket_price_id,(SELECT size from price_list where id = pk.price_id ) as detail,p.price as harga from `transaction_items` as ti inner join `transaction_list` as tl on ti.transaction_id = tl.id inner join `price_list` as p on ti.price_id = p.id  inner join paket pk on pk.price_paket = ti.paket_price_id left join discount d on d.id = tl.discount_id inner join category_list c on p.category_id = c.id where date(tl.date_created) between '{$from}' and '{$to}' group by ti.transaction_id,ti.paket_price_id order by unix_timestamp(tl.date_created) desc");
						while($row = $qry->fetch_assoc()):
              $qry2 = $conn->query("SELECT size as paket , price  from price_list where id = {$row['paket_price_id']}")->fetch_assoc();
              
			  $hasil = $qry2['price'];
			  $diskoun = $qry2['price'] * $row['jumlah_discount']/100;
			  $hasil = $hasil - $diskoun;
			  $total += $hasil;
					?>
						<tr>
							<td class="text-center"><?php echo $k = $i++; ?></td>
							<td class=""><?php echo $row['code'] ?><br><?php echo date("d-m-Y",strtotime($row['date_created'])) ?></td>
							<td class=""><p class="m-0"><?php echo $row['client_name'] ?></p></td>
							<td class=""><p class="m-0"><?php echo $row['client_gender'] ?></p></td>
							<td class=""><p class="m-0"><?php echo $row['sender'] ?></p></td>
							<td class=""><p class="m-0"><?php echo $row['sender_name'] ?></p></td>
							<td><p class="m-0"></p><?php echo $row['name'] ?></td>
							<td class=""><p class="m-0"><?php echo $qry2['paket'] ?></p></td>
							<td class=""><p class="m-0"></p></td>
							<td class=""><p class="m-0"></p></td>
							<td class=""><p class="m-0"></p></td>
							<td class=""><p class="m-0"><?= number_format($qry2['price'],2) ?></p></td>
							<td class=""><p class="m-0"><?php echo $row['title'] ?></p></td>
							<td class="text-right"><?= number_format($hasil,2) ?></td>
						</tr>
					<?php  endwhile; ?>
				</tbody>
				<tfoot>
                    <tr class="bg-gradient-secondary">
                        <th class="py-1 text-center" colspan='12'><b>Total<b></th>
                        <th class="px-2 py-1 text-right total_amount"><?php echo number_format($total) ?></th>
                    </tr>

                </tfoot>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	
	$(document).ready(function(){
		
		$('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
		// 	dom: 'Bfrtip',
        //     buttons: [
        //     'print'
        // ],
            columnDefs: [
                { orderable: false, targets: 4 },
				
            ],
        });
        $('.select2').select2({
            width:'100%'
        })
        $('#filter').submit(function(e){
            e.preventDefault();
            location.href= './?page=reports/date_wise_transaction&'+$(this).serialize();
        })
       $('#print').click(function(){
		   start_loader()
		   var _p = $('#outprint').clone()
		   var _h = $('head').clone()
		   var _el = $('<div>')
		   _h.find("title").text("Laporan Keuangan Laboraturium - Print View")
		   _p.find('tr.text-light').removeClass('text-light bg-gradient-purple bg-lightblue')
		   _el.append(_h)
		   _el.append(_p)
		   var nw = window.open("","_blank","width=1000,height=900,left=300,top=50")
		   	nw.document.write(_el.html())
			nw.document.close()
			setTimeout(() => {
				nw.print()
				setTimeout(() => {
					nw.close()
					end_loader()
				}, 300);
			}, 750);
	   })
	})
</script>