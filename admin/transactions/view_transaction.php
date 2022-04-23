<?php
if(isset($_GET['id'])){
    // $qry = $conn->query("SELECT * FROM `transaction_items` where transaction_id = '{$_GET['id']}' ");
    // if($qry->num_rows > 0){
    //     $res = $qry->fetch_assoc();
    //     // print_r($res);
    //     foreach($res as $k => $v){
    //         if(!is_numeric($k))
    //         $$k = $v;
    //     }
    // }
    $qry = $conn->query("SELECT * FROM `transaction_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
    $qry = $conn->query("SELECT * FROM `discount` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }


</style>

<?php
$date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d",strtotime(date("Y-m-d")));
?>

<div class="content py-4">
    <div class="card card-outline card-navy shadow rounded-0">
        <div class="card-header">
            <h5 class="card-title">Detail Transaksi</h5>
            <div class="card-tools">
                <?php if($_settings->userdata('type') == 1): ?>
                <a class="btn btn-sm btn-primary btn-flat" href="./?page=transactions/manage_transaction&id=<?= isset($id) ? $id : '' ?>"><i class="fa fa-edit"></i> Edit</a>
                <button class="btn btn-sm btn-danger btn-flat" id="delete_transaction"><i class="fa fa-trash"></i> Hapus</button>
                <?php endif; ?>
                <a href="./?page=transactions" class="btn btn-default border btn-sm btn-flat"><i class="fa fa-angle-left"></i> Kembali</a>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label text-muted">Kode Transaksi</label>
                            <div class="pl-4"><?= isset($code) ? $code : 'N/A' ?></div>
                        </div>
                    </div>
                </div>

                <fieldset>
                    <legend class="text-muted">Informasi Pasien</legend>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label text-muted">Nama</label>
                                <div class="pl-4"><?= isset($client_name) ? $client_name : 'N/A' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label text-muted">Umur</label>
                                <div class="pl-4"><?= isset($client_age) ? $client_age : 'N/A' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label text-muted">Jenis Kelamin</label>
                                <div class="pl-4"><?= isset($client_gender) ? $client_gender : 'N/A' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label text-muted">No. HP</label>
                                <div class="pl-4"><?= isset($client_contact) ? $client_contact : 'N/A' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label text-muted">Pengirim</label>
                                <div class="pl-4"><?= isset($sender) ? $sender : 'N/A' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label text-muted">Nama Pengirim</label>
                                <div class="pl-4"><?= isset($sender_name) ? $sender_name : 'N/A' ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label text-muted">Alamat</label>
                                <div class="pl-4"><?= isset($client_address) ? $client_address : 'N/A' ?></div>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <div class="clear-fix my-3"></div>
                <fieldset>
                    <div class="row">
                        <div class="col-md-6 mw-100">
                            <legend class="text-muted">Input Pemeriksaan</legend>
                            <table class="table table-bordered table-striped">
                                <colgroup>
                                    <col width="30%">
                                    <col width="20%">
                                    <col width="25%">
                                    <col width="25%">
                                </colgroup>
                                <thead>
                                    <tr class="bg-gradient-purple text-light">
                                        <th class="py-1 text-center">Pemeriksaan</th>
                                        <th class="py-1 text-center">Hasil Nilai</th>
                                        <th class="py-1 text-center">Nilai Rujukan</th>
                                        <th class="py-1 text-center">Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(isset($id)): ?>
                                    <?php
                                    $items = $conn->query("SELECT t.*,tl.client_gender,p.normalvalue_wanita,p.satuan ,p.normalvalue ,p.size, c.name as category FROM `transaction_items` t inner join `price_list` p on t.price_id = p.id inner join category_list c on p.category_id = c.id left join transaction_list tl on tl.id = t.transaction_id where t.transaction_id = '{$_GET['id']}' ");
                                    $i = 1;
                                    while($row = $items->fetch_assoc()):
                                        $qry = $conn->query("SELECT * FROM `transaction_items` where transaction_id = '{$_GET['id']}'");
                                    if($qry->num_rows > 0){
                                        $res = $qry->fetch_array();
                                        foreach($res as $k => $v){
                                            if(!is_numeric($k))
                                            $$k = $v;
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td class=" align-middle px-2 py-1">
                                            <p class="m-0 item_name"><?= $row['size'] ?></p>
                                        </td>
                                        <td class="text-center">
                                            <div class="container-fluid">
                                                <form action="" id="update-hasil">
                                                    <div class="form-group">
                                                        <label hidden for="hasil" class=""></label>
                                                        <input type="text" id="hasil" name="hasil" value="<?php echo $row['hasil'] ?>" class="hasil">
                                                        <input type="text" id="id" name="id" value="<?php echo $row['transaction_id'] ?>" class ="transaction_id" hidden>
                                                        <input type="text" id="price_id" name="price_id" value="<?php echo $row['price_id'] ?>" class="price_id" hidden>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                        <td class=" align-middle px-2 py-1">
                                            <p class="m-0 item_name text-center"><?php echo $row['client_gender'] == "Pria" ? $row['normalvalue'] : $row['normalvalue_wanita'] ?></p>
                                        </td>
                                        <td class=" align-middle px-2 py-1 text-right total"><?php echo $row['satuan'] ?></td>
                                    </tr>

                                     <?php endwhile; ?>
                                     <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gradient-secondary">
                                    <th class="py-1 text-center" colspan='4'><b><b>
                                    <button class="btn btn-flat btn-primary" type="button" id="print"><i class="fa fa-print"></i> Cetak Hasil Lab</button>
                                    <button class="btn btn-flat btn-primary" type="submit" form="update-hasil"><i class="fa fa-save"></i> Simpan</button>
                                    </th>
                                    </tr>
                                    <!-- <tr class="bg-gradient-secondary">
                                        <th class="py-1 text-center" colspan='3'><b>Total<b></th>
                                        <th class="px-2 py-1 text-right total_amount"><?= isset($total_amount) ? number_format($total_amount,2) : 0 ?></th>
                                    </tr> -->
                                </tfoot>
                            </table>

                        </div>
                        <div class="col-md-6 mw-100">
                            <legend class="text-muted">Pembayaran</legend>
                            <table class="table table-stripped table-bordered">
                                <colgroup>
                                    <col width="30%">
                                    <col width="50%">
                                    <col width="20%">
                                </colgroup>
                                <thead>
                                    <tr class="bg-gradient-purple">
                                        <th class="py-1 text-center">Tanggal & Waktu</th>
                                        <th class="py-1 text-center">Nama Pasien</th>
                                        <th class="py-1 text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($id)): ?>
                                    <?php
                                    $history = $conn->query("SELECT * FROM `transaction_list` where id ='{$_GET['id']}' order by unix_timestamp(date_created) asc");
                                    while($row = $history->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td class="px-2 py-1 align-middle"><?= date("d-m-Y h:i A", strtotime($row['date_created'])) ?></td>
                                        <td class="px-2 py-1 align-middle"><?= $row['client_name'] ?></td>
                                        <td class="px-2 py-1 text-right align-middle"><?= number_format($row['total_amount'],2) ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gradient-secondary">
                                        <th class="px-2 py-1 text-center" colspan="3">
                                        <button class="btn btn-flat btn-primary" type="button" id="cetakstruk"><i class="fa fa-print"></i> Cetak Struk Pembayaran</button>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="text-center">

                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <hr>


        <div id="outprint" >
            <style>
                #sys_logo{
                    object-fit:cover;
                    object-position:center center;
                    width: 6.5em;
                    height: 6.5em;
                }
            </style>
        <div class="container-fluid">
            <div class="row row-cols-2">
                <div class="col-md-6">
                <h6 clas="text-left"><div><b>Nama : <?= isset($client_name) ? $client_name : 'N/A' ?><b></div></h6>
                <h6 clas="text-left"><div><b>Umur : <?= isset($client_age) ? $client_age : 'N/A' ?><b></div></h6>
                <h6 clas="text-left"><div><b>Jenis Kelamin : <?= isset($client_gender) ? $client_gender : 'N/A' ?><b></div></h6>
                <h6 clas="text-left"><div><b>Alamat : <?= isset($client_address) ? $client_address : 'N/A' ?><b></div></h6>
                </div>

                <div class="col-md-6">
                <h6 clas="text-left"><div><b>No HP : <?= isset($client_contact) ? $client_contact : 'N/A' ?><b></div></h6>
                <h6 clas="text-left"><div><b>Nama Pengirim : <?= isset($sender_name) ? $sender_name : 'N/A' ?><b></div></h6>
                <h6 clas="text-left"><div><b>No. Lab : <?= isset($code) ? $code : 'N/A' ?><b></div></h6>
                <h6 clas="text-left"><div><b>Tanggal Pemeriksaan : <?= date("d-m-Y",strtotime($date_created)) ?><b></div></h6>
                </div>
            </div>
            <table class="table table-hover table-striped" style="margin-top: 5em;">
                <colgroup>
                <col width="5%">
                    <col width="27%">
                    <col width="23%">
                    <col width="25%">
                    <col width="20%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-purple text-light">

                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($id)): ?>
                    <?php
                        $i = 1;
                        $nomer_pk = 1;
                        $items = $conn->query("SELECT t.*,tr.client_gender,p.satuan,p.normalvalue_wanita ,p.normalvalue ,p.size, tr.date_created ,c.name as category FROM `transaction_items` t inner join `price_list` p on t.price_id = p.id inner join `transaction_list` tr on tr.id = t.transaction_id inner join category_list c on p.category_id = c.id where t.transaction_id = '{$_GET['id']}' group by t.paket_price_id ");
                        foreach ($items as $value): ?>

                        <?php
                          if($value['paket_price_id']!=null): ?>
                          <tr>
                            <td colspan = 5><b><?php echo $nomer_pk = $i++;?>&emsp;<?= $conn->query("SELECT size from price_list where id = {$value['paket_price_id']}")->fetch_assoc()['size'] ?><b></td>
                          </tr>
                          <?php
                            $paket = $conn->query("SELECT t.*,tr.client_gender,p.satuan,p.normalvalue_wanita ,p.normalvalue ,p.size, tr.date_created ,c.name as category FROM `transaction_items` t inner join `price_list` p on t.price_id = p.id left join `paket` pk on pk.price_paket = p.id inner join `transaction_list` tr on tr.id = t.transaction_id inner join `category_list` c on p.category_id = c.id where paket_price_id = {$value['paket_price_id']} and t.transaction_id = '{$_GET['id']}'");
                            foreach ($paket as $item):
                          ?>
                          <tr>
                              
                              <td>  </td>
                              <td class=""><p class="m-0"><b><?php echo $item['size'] ?><b></p></td>
                              <td class=""><p class="m-0"><b><?php echo $item['hasil'] ?><b></p></td>
                              <td class=""><b><?php echo $item['client_gender'] == "Pria" ? $item['normalvalue'] : $item['normalvalue_wanita'] ?><b></td>
                              <td class=""><b><?= $item['satuan'] ?><b></td>
                          </tr>

                      <?php
                    endforeach;
                     else :
                        $nonpaket =  $conn->query("SELECT t.* ,t.total as tt,t.total as tt,tr.client_gender,p.satuan,p.normalvalue_wanita ,p.normalvalue ,p.size, tr.date_created ,c.name as category FROM `transaction_items` t inner join `price_list` p on t.price_id = p.id left join `paket` pk on pk.price_paket = p.id inner join `transaction_list` tr on tr.id = t.transaction_id inner join `category_list` c on p.category_id = c.id where paket_price_id is null and t.transaction_id = '{$_GET['id']}'");
                          foreach ($nonpaket as $item) :
                        ?>
                        <tr>
                            <!-- <td class="text-center"></td> -->
                            <td class="text-left"><b><?php echo $i++; ?><b></td>
                            <td class=""><p class="m-0"><b><?php echo $item['size'] ?><b></p></td>
                            <td class=""><p class="m-0"><b><?php echo $item['hasil'] ?><b></p></td>
                            <td class=""><b><?php echo $item['client_gender'] == "Pria" ? $item['normalvalue'] : $item['normalvalue_wanita'] ?><b></td>
                            <td class=""><b><?= $item['satuan'] ?><b></td>
                        </tr>
                      <?php
                      endforeach;
                    endif;
                    ?>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if($qry->num_rows <= 0): ?>
                        <tr>
                            <th class="py-1 text-center" colspan="6">No Data.</th>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <br><br>
            <h6 style="padding-left: 80%"><p style=""><b>Pemeriksa<b></p></h6>
            <br><br><br>
            <h6 style="padding-left: 76%"><p style=""><b>(............................................)<b></p></h6>
            </div>
        </div>
        <hr>
        <div id="struk">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <h5 class="text-center"><b>NOTA PEMERIKSAAN</b></h5>
                    </div>
                    <div class="col-2"></div>
                </div>
                    <div class="row row-cols-2 px-2">
                        <h6 clas="text-left">Nama : <?= isset($client_name) ? $client_name : 'N/A' ?></h6>
                        <h6 clas="text-left">Alamat : <?= isset($client_address) ? $client_address : 'N/A' ?></h6>
                        <h6 clas="text-right">Tanggal : <?= date("d-m-Y h:i A",strtotime($date_created)) ?></h6>
			<h6 clas="text-right"><div>No. Lab : <?= isset($code) ? $code : 'N/A' ?></div></h6>
                    </div>
                <table class="table table-bordered table-hover table-striped table-sm">
                <colgroup>
                <col width="10%">
                    <col width="30%">
                    <col width="30%">
                    <!-- <col width="30%"> -->
                </colgroup>
                <thead>
                    <tr class="bg-gradient-purple text-light">
                        <th>No.</th>
                        <th>Pemeriksaan</th>
                        <th>Harga</th>
                        <!-- <th>Diskon</th> -->
                    </tr>
                </thead>
                <tbody>
                  <tbody>
                      <?php if(isset($id)): ?>
                      <?php
                          $i = 1;
                          $items = $conn->query("SELECT t.*,t.total as tt,tr.client_gender,p.satuan,p.normalvalue_wanita ,p.normalvalue ,p.size, tr.date_created ,c.name as category FROM `transaction_items` t inner join `price_list` p on t.price_id = p.id inner join `transaction_list` tr on tr.id = t.transaction_id inner join category_list c on p.category_id = c.id where t.transaction_id = '{$_GET['id']}' group by t.paket_price_id ");
                          foreach ($items as $value): ?>

                          <?php
                            if($value['paket_price_id']!=null): $d = $conn->query("SELECT size,price from price_list where id = {$value['paket_price_id']}")->fetch_assoc();?>
                            <tr>
                              <td class="text-center"><?php echo $i++; ?></td>
                              <td><?= $d['size'] ?></td>
                              <td class="text-right"><?=$d['price']?></td>
                            </tr>
                            <?php
                              $paket = $conn->query("SELECT t.* ,t.total as tt,tr.client_gender,p.satuan,p.normalvalue_wanita ,p.normalvalue ,p.size, tr.date_created ,c.name as category FROM `transaction_items` t inner join `price_list` p on t.price_id = p.id left join `paket` pk on pk.price_paket = p.id inner join `transaction_list` tr on tr.id = t.transaction_id inner join `category_list` c on p.category_id = c.id where paket_price_id = {$value['paket_price_id']} and t.transaction_id = '{$_GET['id']}'");
                              foreach ($paket as $item):
                            ?>


                        <?php
                      endforeach;
                       else :
                          $nonpaket =  $conn->query("SELECT t.*,t.total as tt,tr.client_gender,p.satuan,p.normalvalue_wanita ,p.normalvalue ,p.size, tr.date_created ,c.name as category FROM `transaction_items` t inner join `price_list` p on t.price_id = p.id left join `paket` pk on pk.price_paket = p.id inner join `transaction_list` tr on tr.id = t.transaction_id inner join `category_list` c on p.category_id = c.id where paket_price_id is null and t.transaction_id = '{$_GET['id']}'");
                            foreach ($nonpaket as $item) :
                          ?>
                          <tr>
                              <td class="text-center"><?php echo $i++; ?></td>
                              <td class=""><p class="m-0"><?php echo $item['size'] ?></p></td>
                              <td class="text-right"><p class="m-0"><?php echo $item['price'] ?></p></td>

                          </tr>
                        <?php
                        endforeach;
                      endif;
                      ?>
                      <?php endforeach; ?>
                      <?php endif; ?>
                      <?php if($qry->num_rows <= 0): ?>
                          <tr>
                              <th class="py-1 text-center" colspan="6">No Data.</th>
                          </tr>
                      <?php endif; ?>
                  </tbody>
                <tfoot>
                    <?php
                    $dsc = $conn->query("SELECT d.title from transaction_list as t inner join discount as d on t.discount_id = d.id where t.id = {$_GET['id']} ");
                    $dsc = $dsc->fetch_assoc();
                    ?>
                    <tr class="bg-gradient-secondary">
                        <th class="py-1 text-center" colspan='2'><b>Total<b></th>
                          <?php
                          $total = 0;
                          $qry2 = $conn->query("SELECT pl.price as tl , ti.total as ttl FROM `transaction_items` ti left join `price_list` pl on ti.paket_price_id = pl.id where transaction_id = '{$_GET['id']}' ");
                          if($qry2->num_rows > 0)
                          {
                            while ($row = $qry2->fetch_assoc()){
                              if($row['ttl'])
                              {
                                $total += $row['ttl'];
                              }
                            }
                          }
                          $qry2 = $conn->query("SELECT pl.price as tl , ti.total as ttl FROM `transaction_items` ti inner join `price_list` pl on ti.paket_price_id = pl.id where transaction_id = '{$_GET['id']}' group by ti.paket_price_id");
                          if($qry2->num_rows > 0)
                          {
                            while ($row = $qry2->fetch_assoc()){
                              if($row['tl'])
                              {
                                $total += $row['tl'];
                              }
                            }
                          }

                          ?>
                        <th class="px-2 py-1 text-right total_amount"><b><?= number_format($total,2) ?><b></th>
                    </tr>
                    <tr class="bg-gradient-secondary">
                        <th class="py-1 text-center" colspan='2' ><b>Discount<b></th>
                        <th class="px-2 py-1 text-right" id=""><b><?php echo isset($dsc['title']) ? $dsc['title'] : '0' ?><b></th>
                    </tr>
                    <tr class="bg-gradient-secondary">
                        <th class="py-1 text-center" colspan='2'><b>Grand Total<b></th>
                        <th class="px-2 py-1 text-right total_amount"><b><?= isset($total_amount) ? number_format($total_amount,2) : 0 ?><b></th>
                    </tr>
                </tfoot>
            </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#input_hasil').click(function(){
            uni_modal("Input Hasil dari <b><?= isset($code) ? $code : "" ?></b>","transactions/update_status.php?transaction_id=<?= isset($id) ? $id : "" ?>")
        })
        $('#update_status').click(function(){
            uni_modal("Update Status of <b><?= isset($code) ? $code : "" ?></b>","transactions/update_status.php?transaction_id=<?= isset($id) ? $id : "" ?>")
        })
        $('#add_payment').click(function(){
            uni_modal("Add Payment for <b><?= isset($code) ? $code : "" ?></b>","transactions/manage_payment.php?transaction_id=<?= isset($id) ? $id : "" ?>")
        })
        $('.edit_payment').click(function(){
            uni_modal("Edit Payment for <b><?= isset($code) ? $code : "" ?></b>","transactions/manage_payment.php?transaction_id=<?= isset($id) ? $id : "" ?>&id="+$(this).attr('data-id'))
        })
        $('.delete_payment').click(function(){
			_conf("Are you sure to delete this transaction's payment?","delete_payment",[$(this).attr('data-id')])
		})
        $('#delete_transaction').click(function(){
			_conf("Are you sure to delete this transaction?","delete_transaction",['<?= isset($_GET['id']) ? $_GET['id'] : '' ?>'])
		})
        $('.view_data').click(function(){
			uni_modal("Report Details","transactions/view_report.php?id="+$(this).attr('data-id'),"mid-large")
		})
        $('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            dom: 'Bfrtip',
            buttons: [
            'print'
        ],
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
            
        })
    })
    function delete_payment($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_payment",
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
					location.href="./?page=transactions";
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}

    $(document).ready(function(){
        $('#filter').submit(function(e){
            e.preventDefault();
            location.href= './?page=reports/daily_transaction&'+$(this).serialize();
        })
       $('#print').click(function(){
           start_loader()
           var _p = $('#outprint').clone()
           var _h = $('head').clone()
           var _el = $('<div>')
           _h.find("title").text("Daily Transaction Report - Print View")
           _p.find('tr.text-light').removeClass('text-light bg-gradient-purple')
           _el.append(_h)
           _el.append(_p)
           var nw = window.open("","_blank","width=1280,height=900,left=300,top=50")
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
       $('#cetakstruk').click(function(){
           start_loader()
           var _p = $('#struk').clone()
           var _h = $('head').clone()
           var _el = $('<div>')
           _h.find("title").text("Daily Transaction Report - Print View")
           _p.find('tr.text-light').removeClass('text-light bg-gradient-purple')
           _el.append(_h)
           _el.append(_p)
           var nw = window.open("","_blank","width=1000,height=900,left=300,top=300")
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
    $('#update-hasil').submit(function(e){
        e.preventDefault();
        var hasil = $("input:text.hasil").serializeArray()
        var transaction_id = $("input:text.transaction_id").serializeArray()
        var price_id = $("input:text.price_id").serializeArray()
        //var data = hasil.concat(transaction_id).concat(price_id)
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=update_transaction_result",
				data: {
                    hasil : hasil,
                    transaction_id : transaction_id,
                    price_id : price_id
                },
                ContentType: 'application/json',
                method: 'POST',
                type: 'POST',

				error:function(err){
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    console.log(resp)
                    alert_toast("Berhasil mengubah hasil",'success');
                    if(resp.status == 'success'){
                        // location.href="./?page=transactions/view_transaction&id="+resp.tid;
                        window.location.href="./?page=transactions/view_transaction&id="+resp.tid;
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })


</script>
