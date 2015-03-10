<?php $this->load->view('admin/layout/header'); ?>
<h1> Purchase Cart </h1>
<br/>

<?php echo form_open('admin/cart/updateCart'); ?>

<?php
    if (!$this -> cart -> contents() ) {
        echo '<h4 class="text-center text-success bg-success" style="padding-bottom:2%; padding-top:2%; border-radius:7px;"> There are currently no items in the cart </h4>';
    } else {
?>


<div class="table-responsive">
    <table class="table table-hover table-bordered" cellpadding="6" cellspacing="1" style="width:100%" border="0">

    <tr>
        <th> Quantity </th>
        <th>Item Description</th>
        <th style="text-align:right">Item Price</th>
        <th style="text-align:right">Sub-Total</th>
        <th> </th>
    </tr>
    
    <!-- Cart row counter -->
    <?php $i = 1; ?>

    <?php foreach ($this->cart->contents() as $items): ?>

            <?php
                // rowid of each item in cart
                echo form_hidden('rowid_' . (string)$i, $items['rowid']);
                
                // id of each item in cart
                echo form_hidden('id_' . (string)$i, $items['id'] );
            ?>

            <tr>
              <td><?php echo form_input(array('name' => 'qty_'.(string)$i, 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5', 'class' => "form-control")); ?></td>
              <td>
                    <?php echo $items['name']; ?>
              </td>
              <td style="text-align:right">&#8369; <?php echo $this->cart->format_number($items['price']); ?></td>
              <td style="text-align:right">&#8369; <?php echo $this->cart->format_number($items['subtotal']); ?></td>
              <td class="text-center"> <a href="<?php echo base_url('admin/cart/removeFromCart/' . $items['rowid']); ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"> </span> Remove </a></td>
              
            </tr>

    <?php $i++; ?>

    <?php endforeach; ?>
            
    <?php
        // total cart id (number of items in cart)
        echo form_hidden('total', $i);
    ?>

    <tr>
      <td colspan="2"> </td>
      <td class="right"><strong>Total</strong></td>
      <td class="right">&#8369; <?php echo $this->cart->format_number($this->cart->total()); ?></td>
    </tr>

    </table>
</div>

<p class="pull-left">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#clearCartConfirm"> <span class="glyphicon glyphicon-trash"> </span> Clear Cart </button>
</p>
<p class="pull-right">
    
    
    <button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-refresh"></span> Update cart </button> 
    <a href="<?php echo base_url('admin/cart/checkout'); ?>" class="btn btn-success"> <span class="glyphicon glyphicon-log-out"> </span> Proceed to checkout </a> 
</p>
</form>
<?php } ?>

<!-- Modal: confirmation clear cart -->
    <div class="modal fade" id="clearCartConfirm" tabIndex="-1" role="dialog" aria-labelledby="clearCartLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h2> Clear Cart confirm </h2>
                </div>
                <div class="modal-body">
                    <p> Are you sure you want to clear current cart session ? </p>
                </div>
                <div class="modal-footer">
                    <?php echo form_open('admin/cart/clearCart'); ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel </button>
                    <button type="submit" class="btn btn-danger"> Clear current cart session </button>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- END clear cart modal -->

<?php $this->load->view('admin/layout/footer'); ?>