<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>LAGIRAME - ADMIN</title>

<?php
    echo link_tag('assets/lumino/css/bootstrap.min.css');
    echo link_tag('assets/lumino/css/datepicker3.css');
    echo link_tag('assets/lumino/css/styles.css');
    echo link_tag('assets/datepicker/css/datepicker.css');
    ?>

    <link rel="shortcut icon" href="../images/iconlr.png">
    <link rel="shortcut icon" href="../../images/iconlr.png">
    <link rel="shortcut icon" href="../../../images/iconlr.png">
    <link rel="shortcut icon" href="../../../../images/iconlr.png">
    <script src="<?php echo base_url(); ?>assets/lumino/js/lumino.glyphs.js"></script>
<!--Icons-->

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <?php echo $_header;?>
                
                <ul class="user-menu">
                    <?php echo $_menu;?>  
                </ul> 
            </div>         
        </div><!-- /.container-fluid -->
    </nav>
        
    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar" style="">        
<?php echo $_sidebar;?>
    </div><!--/.sidebar-->
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">  
    <?php echo $_content;?>         
 
    </div>  <!--/.main-->

    
</body>


 <script src="<?php echo base_url(); ?>assets/lumino/js/jquery-1.11.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/lumino/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/lumino/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/eModal.js"></script>
</html>
