<div class="wrapper style1">
                            </br>

                            <h1>Order Detail</h1>   
    <div class="container" style="text-align: left; margin-top: 20px; max-width: 400px">
        <div class="span12">
    
    <div class="page-header">
        <h3>Rincian Pemesanan</h3>
    </div>
    <table class="table table-bordered table-striped">
        <tr >
            <td >Kode</td><td><?php echo $order['code']; ?></td>
        </tr>
        <tr>
            <td>Tanggal Pesan</td>
            <td>
                <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $d = strtotime($order['order_date']);
                          $format = '%d %B %Y';
                          echo strftime($format, $d);?>
            </td>
        </tr>
        <tr>
            <td>Total</td><td><strong>Rp.&nbsp;<?php echo number_format($order['total'],2,',','.'); ?></strong></td>
        </tr>
        <tr>
            <td>Batas Pembayaran</td><td>
                <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $d = strtotime($order['payment_deadline']);
                          $format = '%d %B %Y';
                          echo strftime($format, $d);?>
            </td>
        </tr>
        <tr>
            <td>Status</td><td><?php echo $order['status']; ?></td>
        </tr>
    </table>
    <h3>Rincian Item</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr style="padding: 10px;">

                <th>Event</th>
                <th>Jumlah Tiket</th>
                <th style="min-width: 100px">Harga</th>
                <th>Total</th>

            </tr>
        </thead>
        <?php 
                                        $events=$this->event_model->get_paged_list1()->result();
                                        $data['events']=$events;
                                        foreach($events as $event) {
                                        $result[$event->event_id] = $event->title ;} ?>
        <?php $i = 1; ?>

        <?php foreach ($orderDetails as $orderDetail): ?>



            <tr>

                <td><?= $orderDetail->event_id=$result[$orderDetail->event_id];?></td>
                <td><?php echo $orderDetail->quantity ?></td>
                <td><?php echo number_format($orderDetail->price,2,',','.'); ?></td>
                <td><?php echo number_format($orderDetail->price * $orderDetail->quantity,2,',','.'); ?></td>

            </tr>

            <?php $i++; ?>

        <?php endforeach; ?>

        <tr>
            <td colspan="3" style="text-align:right"><h4>TOTAL BIAYA : Rp.&nbsp;</h4></td>
            <td style="text-align:right"><h4><strong> <?php echo number_format($order['total'],2,',','.'); ?></strong></h4> </td>               
        </tr>                  

    </table>

</div>	
</div>
</div>
