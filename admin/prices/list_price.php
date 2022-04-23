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
<div id="outprint">
            <style>
                #sys_logo{
                    object-fit:cover;
                    object-position:center center;
                    width: 6.5em;
                    height: 6.5em;
                }
            </style>
        <div class="container-fluid">
            <div class="row">
                <div class="col-2"></div>
            </div>
            <table class="table table-bordered table-hover table-striped table-sm">
                <colgroup>
                    <col width="5%">
                    <col width="25%">
                    <col width="20%">
                    <col width="15%">
                    <col width="15%">
                    <col width="20%">
                </colgroup>
                <thead>
                    <tr class="bg-gradient-purple text-light">
                        <th>No.</th>
                        <th>Pemeriksaan</th>
                        <th>Nilai Normal Pria</th>
                        <th>Nilai Normal Wanita</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `price_list` p left join category_list c on p.category_id = c.id order by `category_id` asc, `size` asc ");
						while($row = $qry->fetch_assoc()):
				?>      
                        
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td class=""><?php echo $row['name'] ?> - <?php echo $row['size'] ?></p></td>
                            <td class=""><?php echo $row['normalvalue'] ?></td>
                            <td class=""><?php echo $row['normalvalue_wanita'] ?></td>
                            <td class=""><?php echo $row['satuan'] ?></td>
                            <td class=""><?php echo $row['price'] ?></td>
                        </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
</div> <!-- PENUTUP DIV UNTUK LEMBARAN PRINT-->
        <!-- TOMBOL PRINT -->
        <tr class="bg-gradient-secondary">
            <th><button class="btn btn-flat btn-primary" type="button" id="print"><i class="fa fa-print"></i> Cetak List Pemeriksaan</button></th>
        </tr>

<script>
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
        //    _h.find("title").text("Daily Transaction Report - Print View")
           _p.find('tr.text-light').removeClass('text-light bg-gradient-purple')
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