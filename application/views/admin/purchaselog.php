<?php $this->load->view('admin/layout/header'); ?>

<h1> Purchase Log </h1>
<p class="text-muted"> See all list of purchases.  </p>



<div>
	<?php echo form_open(base_url('admin/purchaselog/viewSearch')); ?>
		<select name="customerId" class="form-control" id="" style="width:35%;display:inline;">
			<option value=""> - Search By Customer - </option>
			<?php foreach ($customers->result() as $customer): ?>
				<option value="<?php echo $customer->id; ?>"> <?php echo $customer->fname . ' ' . $customer->lname ?></option>
			<?php endforeach; ?>
		</select>
		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search </button>
	</form>
</div>
<br/><br/>

<div class="table-responsive">
	<table class="table table-striped table-bordered table-condensed">
		<thead>
			<tr>
			
				<th> Order Date </th>
				<th> Customer Name </th>
				<th> Cash In </th>
				<th> Cash Change </th>
				<th> Total Amount </th>
			</tr>
		</thead>
		<tbody>


			<?php foreach ($query->result() as $row): ?>

				<?php
					// Getting customer full name
					$customer     = $this -> db -> get_where('customer', array('id' => $row->customer_id ) )->row();
					$customerName = $customer->fname . ' ' . $customer->lname;

				?>
				<tr>
					<td><button class="btn btn-default" data-toggle="modal" data-target="#productsModal_<?php echo $row->id; ?>"> View products </button></td>
				
					<td> <?php echo mdate('%d %F %Y @ %h:%i %a', $row->order_date );  ?>  </td>
					<td><?php echo $customerName;  ?> </td>
					<td><?php echo $row->cash_in; ?></td>
					<td><?php echo $row->cash_change; ?></td>
					<td><?php echo $row->total_amount; ?></td>
					
				</tr>

				<!-- Modal: products list -->
				<div class="modal fade" id="productsModal_<?php echo $row->id; ?>" tabindex="-1" role="dialog" ariaLablledby="productsModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4> Order products </h4>
							</div>
							<div class="modal-body">
								<ul class="list-group">
									<?php foreach ($this->purchaselog_model->getOrderProducts($row->order_key)->result() as $product): ?>
										<li class="list-group-item"> <?php echo $product->name . ' @ ' . $product->price; ?></li>
								    <?php endforeach; ?>
								</ul>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>					
				</div>
				<!-- END Modal -->

			<?php endforeach; ?>
		</tbody>
	</table>

	<p class="bg-info"> <?php echo $this -> pagination -> create_links(); ?> </p>
</div> <!-- END PURCHASE TABLE -->

<?php $this->load->view('admin/layout/footer'); ?>