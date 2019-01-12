<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>BUKTI PEMBAYARAN</title>
    
    <?php
    echo link_tag('assets/css/pdf.css');
    ?>

</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?php echo base_url(); ?>images/lagirame.png" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                Kode Pembayaran #: <?php echo $order['code']; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Lagirame, Inc.<br>
                                Jl. Nusa Indah Baru II No. 31<br>
                                Karanganyar, Jawa Tengah
                            </td>
                            
                            <td>
                                <?php echo $user['name']; ?><br>
                                <?php echo $user['address']; ?><br>
                                <?php echo $user['email']; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Kode
                </td>
                
                <td>
                    Tanggal Pesan
                </td>

                <td>Tanggal Transfer</td>

                <td>Status</td>
            </tr>
            
            <tr class="details">
                <td>
                    <?php echo $order['code']; ?>
                </td>
                
                <td>
                <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $d = strtotime($order['order_date']);
                          $format = '%d %B %Y';
                          echo strftime($format, $d);?>
                </td>

                <td>
                <?php 
                          setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
                          //$date = date_create($event['start_date']); 
                          $d = strtotime($confirmation['payment_date']);
                          $format = '%d %B %Y';
                          echo strftime($format, $d);?>
                </td>

                <td><?php echo $order['status']; ?></td>

            </tr>

            <tr class="heading">
                <td>
                    Nama
                </td>
                
                <td>
                    Berlaku Untuk
                </td>

                <td>Harga</td>

                <td>Total</td>

            </tr>
            
            <?php   $events=$this->event_model->get_paged_list1()->result();
                $data['events']=$events;
                foreach($events as $event) {
                $result[$event->event_id] = $event->title ;} ?>
        <?php $i = 1; ?>

        <?php foreach ($orderDetails as $orderDetail): ?>
            <tr class="item">
                <td>
                    <?= $orderDetail->event_id=$result[$orderDetail->event_id];?>
                </td>
                
                <td>
                   <?php echo $orderDetail->quantity ?> Orang
                </td>

                <td><?php echo number_format($orderDetail->price,2,',','.'); ?></td>

                <td><?php echo number_format($orderDetail->price * $orderDetail->quantity,2,',','.'); ?></td>
            </tr>
            

             <?php $i++; ?>

        <?php endforeach; ?>

            <tr>
            <td colspan="3" ><h4>TOTAL :</h4></td>
            <td><h4><strong>Rp. <?php echo number_format($order['total'],2,',','.'); ?></strong></h4> </td>               
            </tr> 

        </table>
    </div><br><br>* Keterangan<br>
    - Gunakan invoice ini sebagai bukti pemesanan yang sah pada saat registrasi on-desk di lokasi event.<br>
    - Tiket dapat berlaku sesuai dengan jumlah pemesanan yang dilakukan.<br>
    - Bukti ini hanya berlaku pada saat event berlangsung.

</body>
</html>
