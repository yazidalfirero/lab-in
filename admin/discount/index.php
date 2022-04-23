<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `discount` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
                $$k = $v;
        }
        
    }
    
       
}
$price_arr = [];
 // $qry = $conn->query("SELECT t.*,p.satuan ,p.normalvalue ,p.size, c.name as category FROM `transaction_items` t inner join `price_list` p on t.price_id = p.id inner join category_list c on p.category_id = c.id where p.category_id = c.id ");
 $harga = $conn->query("SELECT c.id ,c.name, p.price from `price_list` as p inner join `category_list` c on p.category_id = c.id where c.name like '%sperma%' ");
 $harga = $harga->fetch_array();
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

<div class="content py-3">
    <div class="card card-outline card-purple shadow rounded-0 w-50  mx-auto">
        <div class="card-header">
            <h3 class="card-title"><b><?= isset($id) ? "Update Diskon - " : "Tambah Diskon"  ?></b></h3>
        </div>

        <!-- /# column identitas pasien -->
        <div class="card-body">
            <div class="container-fluid">
                <form action="" id="transaction_sperm_form">
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : 'null' ?>">
                    <fieldset class="border-bottom">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="title" class="control-label">Nama Discount</label>
                                <input type="text" name="title" id="title" autofocus value="<?= isset($title) ? $title : "" ?>" class="form-control form-control-sm rounded-0" required>
                                <br>
                                <div class="card">
                                    <div class="card-header">
                                        <label for="jenis_discount" class="control-label">Jenis Discount</label>
                                    </div>
                                    <div class="card-body">
                                        <ul class="nav nav-pills mb-3" id="discount" role="tablist">
                                            <li class="nav-item">
                                                <a href="javascript:;" class="nav-link active" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true" onclick="discount('nominal')">Nominal</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:;" class="nav-link" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="discount('persen')">Persen</a>
                                            </li>
                                        </ul>
                                        <input type="text" name="jenis_discount" id="jenis_discount" value='nominal' hidden>
                                    </div>
                                </div>
                                <label for="jumlah_discount" class="control-label">Jumlah Discount</label>
                                <input type="number" name="jumlah_discount" id="jumlah_discount" autofocus value="<?= isset($jumlah_discount) ? $jumlah_discount : "" ?>" class="form-control form-control-sm rounded-0" required>
                            
                                <label for="description" class="control-label">Description</label>
                                <textarea type="text" name="description" id="description" value="<?= isset($description) ? $description : "" ?>" class="form-control form-control-sm rounded-0" required>  </textarea>
                            </div>
                        </div>
                    </fieldset>
                    </form>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-flat btn-primary btn-sm" type="submit" form="transaction_sperm_form">Simpan</button>
                    <a href="./?page=transactions/index_sperma" class="btn btn-flat btn-default border btn-sm">Batal</a>
                </div>
            </div>
        </div>
        <script>
            $('#motilitasrb_sperm li.selected a').text();
            var price_arr = $.parseJSON('<?= json_encode($price_arr) ?>')
            window.calc_total = function(){
                var total_amount = 0;
                $('#item-list tbody tr').each(function(){
                    var price = $(this).find('input[name="price[]"]').val()
                    var qty = $(this).find('input[name="quantity[]"]').val()
                    qty = qty > 0 ? qty : 0;
                    var total = parseFloat(price) * parseFloat(qty);
                    $(this).find('.total').text(parseFloat(total).toLocaleString('en-US',{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}))
                    $(this).find('input[name="total[]"]').val(total)
                    total_amount += parseFloat(total)
                })
                $('input[name="total_amount"]').val(total_amount)
                $('.total_amount').text(parseFloat(total_amount).toLocaleString('en-US',{style:'decimal',minimumFractionDigits:2,maximumFractionDigits:2}))
            }
            $(function(){
                $('#transaction_sperm_form').submit(function(e){
                    e.preventDefault();
                    var _this = $(this)
                    $('.pop-msg').remove()
                    var el = $('<div>')
                    el.addClass("pop-msg alert")
                    el.hide()
                    start_loader();
                    $.ajax({
                        url:_base_url_+"classes/Master.php?f=discount_add",
                        data: $(this).serializeArray(),
                        ContentType: 'application/json',
                        method: 'POST',
                        type: 'POST',
                        error:err=>{
                            console.log(err)
                            alert_toast("An error occured",'error');
                            end_loader();
                        },
                        success:function(resp){
                            console.log(resp)
                            if(resp.status == 'success'){
                            }else if(!!resp.msg){
                                el.addClass("alert-danger")
                                el.text(resp.msg)
                                _this.prepend(el)
                            }
                            el.show('slow')
                            $('html,body,.modal').animate({scrollTop:0},'fast')
                            end_loader();
                            location.href="./?page=discount/view_discount&id="+resp.tid;
                        }
                    })
                })
            })
            function discount(value)
            {
                $('#jenis_discount').val(value);
            }
        </script>