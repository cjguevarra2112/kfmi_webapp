<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo $title;  ?></title>
        
        <!-- BOOTSTRAP STYLES-->
        <link href="<?php echo base_url(); ?>static/css/bootstrap.min.css" rel="stylesheet" />
        
        <!-- FONTAWESOME STYLES-->
        <link href="<?php echo base_url(); ?>static/css/font-awesome.css" rel="stylesheet" />
           
            <!-- CUSTOM STYLES-->
        <link href="<?php echo base_url(); ?>static/css/custom.css" rel="stylesheet" />
         <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>
    <body>
    
        <p> You're logged out, <?php echo $user; ?>. Click <a href="app/"> here </a> to exit. </p>
    
   
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="<?php echo base_url(); ?>static/js/jquery-1.10.2.js"></script>
          <!-- BOOTSTRAP SCRIPTS -->
        <script src="<?php echo base_url(); ?>static/js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="<?php echo base_url(); ?>static/js/jquery.metisMenu.js"></script>
          <!-- CUSTOM SCRIPTS -->
        <script src="<?php echo base_url(); ?>static/js/custom.js"></script>
    </body>
</html>