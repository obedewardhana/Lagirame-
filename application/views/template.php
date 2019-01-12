<!DOCTYPE HTML>
<!--
    Spatial by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
    <head>
        <title>LAGIRAME</title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
        <?php
            echo link_tag('assets/css/main.css');            
            echo link_tag('assets/datepicker/css/datepicker.css');
            echo link_tag('assets/css/magic-check.css');
            //echo link_tag('assets/css/pikaday.css');
            echo link_tag('assets/css/style.css');
            echo link_tag('assets/css/upload.css');
 
        ?>

 
        <script src="../assets/js/jquery-1.9.1.min.js"></script>        
        <script src="../../assets/js/jquery-1.9.1.min.js"></script>
        <script src="../assets/js/bootstrap-datepicker.js"></script>
        <script src="../../assets/js/bootstrap-datepicker.js"></script>
         
        
        <link rel="shortcut icon" href="images/iconlr.png">
        <link rel="shortcut icon" href="../images/iconlr.png">
        <link rel="shortcut icon" href="../../images/iconlr.png">
        <link rel="shortcut icon" href="../../../images/iconlr.png">

        <!-- Custom CSS -->


    </head>
    <body>

        <!-- Header -->
            <nav id="nav">
                <ul>
                    <?php echo $_header;?>
            </ul>
            </nav>

        <!-- Banner -->
        <div>   
        <?php echo $_content;?>
        </div>
</br>
        <!-- Footer -->
            <footer id="footer">
                    <?php echo $_footer;?>                
            </footer>

    </body>
</html>