<?php $this->load->view('admin/layout/header'); ?>
  
   <h2><?php echo $heading; ?></h2>   
    <h5><?php echo $subheading; ?> </h5>
    <p> <?php echo "Last Login: " . $this->session->userdata('last_login'); ?> </p>
    
    
<?php $this->load->view('admin/layout/footer'); ?>