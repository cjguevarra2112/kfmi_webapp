<?php $this->load->view('admin/layout/header'); ?>

<h1> This is the items page </h1>
<p> Only admin can manage items auditors can only make purchase </p>

<ul>
    <?php foreach ($items->result() as $item): ?>
    <li> <?php echo $item->name . ' ' . $item->price ?> </li>
    <?php endforeach; ?>
</ul>
layout/footer'
<?php $this->load->view('admin/layout/footer'); ?>