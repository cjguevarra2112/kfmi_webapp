<?php $this->load->view('admin/layout/header'); ?>

<h1>Checkout </h1>
<?php echo validation_errors(); ?> 	

<div class="row">
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Payment</h2>	
			</div>

			
			<div class="panel-body">
				<?php echo form_open('admin/cart/finishPayment'); ?>
					<div class="form-group">
						<label for="cashIn">Enter Cash In: </label>
						<input type="text" class="form-control" name="cashIn" required/>
						<p class="help-block"> Need to pay: <strong> <?php echo '&#8369; ' . $total; ?> </strong> </p>
					</div>

					<div class="form-group">
						<label for="customer"> Customer: </label>
						<select name="customer" class="form-control" required>
							<option value=""> - Choose customer - </option>
							<?php foreach ($customers->result() as $customer): ?>
								<option value="<?php echo $customer->id; ?>"> <?php echo $customer->lname . ', ' . $customer->fname . ' - ' . $customer->home_address; ?> </option>
							<?php endforeach; ?> 
 						</select>
 						<p class="help-block"> You can add a customer entry for first time customers in the Customer Panel. </p>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-shopping-cart"></span> Finish Payment</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h2>Cart Summary </h2>
			</div>
			<div class="panel-body table-responsive">
				<table class="table">
					<?php foreach ($cart as $c): ?>
					<tr>
						<td> <strong> <?php echo $c['name'] ?> </strong></td>
						<td> &times; <?php echo $c['qty']?> </td>
						<td> <?php echo '&#8369; ' . $this -> cart -> format_number($c['subtotal']); ?> </td>
					</tr>
					<?php endforeach; ?>
					<tr>
						<td> </td>
						<td> <strong> Total: </strong> </td>
						<td> <?php echo '&#8369; ' . $total; ?> </td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('admin/layout/footer'); ?>