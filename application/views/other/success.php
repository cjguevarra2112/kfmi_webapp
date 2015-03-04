<?php $this->load->view('admin/layout/header'); ?>

<div class="container-fluid">
    <div class="alert alert-success" role="alert">
        <strong> Well done! </strong>
        You successfully <?php echo $message; ?>
        Click <a href="<?php echo $back; ?>"> here </a> to go back.
    </div>
</div>


<?php $this->load->view('admin/layout/footer'); ?>