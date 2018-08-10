 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $("#btnPrint").live("click", function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>Reçu payament depuis PayPal</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
</head>
<body>

    <form id="form1">
    <div id="dvContainer">
        <img src="  https://logos-download.com/wp-content/uploads/2016/03/PayPal_logo_small.png" style="float: left; width: 200px; height:200px;" >
       <br><br><br><br>
       <div class="row-fluid">
<div class="span12 statbox white" style="height: 550px;" >
<div class="span4">
	

<img src="<?= base_url()?>technipack_pictures/technipacklogo.png" style="float: left; width: 200px; height:200px;" >



</div>

<div class="span8" style="float: right;">
<h2>Facture de paiement</h2>
<p>
	
Date De Transmission: <?= $date_created ?></p>
<b>Statut De Payement:</b> <?=$payment_status ?><br>


<b>ID De Transaction:</b><?=$txn_id?><br>
<b>Paiement Brut:</b><?= $mc_gross?><br>
<b>ID de l'acheteur</b><?= $payer_id ?><br>
<b>E-mail de l'acheteur</b> <?=$payer_email?><br>
<b>Statut de l'acheteur: </b><?= $payer_status?><br>
<b>Date de Paiement</b><?= $payment_date ?><br>
<b>Nom de l'acheteur</b><?= $first_name.' '.$last_name ?><br>
<b>Adresse 1 </b> <?= $address_name ?></br>
<b>Adresse 1 </b> <?= $address_street ?></br>
<b>Ville </b> <?= $address_state ?></br>
<b>Pays </b> <?= $address_country ?></br>
<img src="<?= base_url();?>mojs/cachet.jpg" style="width: 250px;">
</p>

</div>


</div>
</div>
    </div>
    <div class="attachments">
                            <ul>
                                <li>
                                    <span class="label label-important">pdf</span> <b>Reçu.pdf</b> <i>(2,5MB)</i>
                                    <span class="quickMenu">
                                        
                                        <a href="#" class="glyphicons cloud-download" id="btnPrint"><i></i></a>
                                    </span>
                                </li>
</ul>
</div>



    </form>


