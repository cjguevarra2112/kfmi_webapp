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
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>static/css/style.css" />
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"> KFMI Hardware</a>
                </div>
                 <span class="navbar-text" style="color:#ffffff;"> Logged in as: <?php echo $role ?></span>
      <div style="color: white;
    padding: 15px 50px 5px 50px;
    float: right;
    font-size: 16px;">
           
           <?php echo "Last login: " . $this->session->userdata('last_login'); ?> <a href="<?php echo base_url(); ?>app/logout" class="btn btn-danger square-btn-adjust">Logout</a> </div>
            </nav>   
               <!-- /. NAV TOP  -->
                    <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="<?php echo base_url(); ?>static/img/find_user.png" class="user-image img-responsive"/>
                        </li>


                        <li>
                            <a  href="<?php echo base_url('admin') ?> "> <i class="fa fa-dashboard fa-3x"></i>Dashboard</a>
                        </li>
                          <li>
                            <a  href="<?php echo base_url('admin/items/index'); ?>"> <i class="fa fa-desktop fa-3x"></i> Manage Items </a>
                        </li>
                        <li>
                            <a  href="<?php echo base_url('admin/categories/index'); ?>"><i class="fa fa-qrcode fa-3x"></i> Manage Categories </a>
                        </li>
                               <li  >
                            <a  href="<?php echo base_url('admin/accounts/index'); ?>"><i class="fa fa-bar-chart-o fa-3x"></i> Manage Accounts </a>
                        </li>	
                          <li  >
                        <a  href="<?php echo base_url('admin/logs/index'); ?>"><i class="fa fa-table fa-3x"></i> View Logs </a>
                        </li>
                        <li  >
                            <a  href="<?php echo base_url('admin/cart/index'); ?>"><i class="fa fa-edit fa-3x"></i> Purchase Cart </a>
                        </li>				


                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-3x"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Purchases</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Link</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Link</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Link</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Link</a>
                                        </li>

                                    </ul>

                                </li>
                            </ul>
                          </li>  
                      <li  >
                            <a class="active-menu"  href="blank.html"><i class="fa fa-square-o fa-3x"></i> Blank Page</a>
                        </li>	
                    </ul>

                </div>
            </nav>
            <!-- END NAV TOP -->
            
             <!-- /. NAV SIDE  -->
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
            
