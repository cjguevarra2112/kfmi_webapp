<?php $this->load->view('admin/layout/header'); ?>
<h1> Customers </h1>
<p class="text-muted"> Register customers for payment </p>
<div class="panel panel-default">
	<div class="panel-heading">
		<?php echo form_open(base_url('admin/customer/viewSearch'), array('class' => 'form-inline clearfix')); ?>
		
			<div class="form-group"> 
				<input type="text" class="form-control" name="customerSearchStr" placeholder="Search customer" style="width:65%;"/>
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search </button>
			</div>
			<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#addCustomerModal"><span class="glyphicon glyphicon-plus"> </span> Add customer </button>
		</form>

		<!-- Modal: Add customer -->
		<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
						<h2>Add Customer </h2>
					</div>
					
					<div class="modal-body">
						<?php echo form_open('admin/customer/addCustomer'); ?>
						<div class="form-group">
							<label for="fname"> First Name: </label>
							<input type="text" class="form-control" name="fname" required/>
						</div>
						<div class="form-group">
							<label for="lname">Last Name: </label>
							<input type="text" class="form-control" name="lname" required/>
						</div>
						<div class="form-group">
							<label for="homeAddress">Home Address: </label>
							<input type="text" class="form-control" name="addr" required/>
						</div>
						<div class="form-group">
							<label for="contact">Contact info: </label>
							<input type="number" class="form-control" min="0" name="contact" required/>
						</div>
					</div>
					<div class="modal-footer">
						
						<button class="btn btn-default" data-dismiss="modal"> Cancel </button>
						<button type="submit" class="btn btn-primary"> Add Customer </button>
						</form>
					</div>
				</div>
			</div>

		</div> <!-- END Modal: Add customer -->

	<div class="panel-body">
		<div class="table-responsive">
			<p class="bg-info container-fluid" style="border-radius:5px; padding-bottom:4%;">
				<?php
					if ($query !== FALSE) {
						if ($query->num_rows() > 1) {
							echo $query->num_rows() . " Results found.";
						} else {
							echo $query->num_rows() . " Result found.";
						}
					} else {
						echo "Sorry, no results found.";
					}
				?>
			</p>

			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Home Address</th>
						<th>Contact</th>
						<th>Date registered</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($query !== FALSE): ?>
						<?php foreach ($query->result() as $row): ?>
							<tr>
								<td><?php echo $row->fname; ?></td>
								<td><?php echo $row->lname; ?></td>
								<td><?php echo $row->home_address; ?></td>
								<td><?php echo $row->contact; ?></td>
								<td><?php echo mdate('%d %F %Y @ %h:%i %a', $row->regdate); ?></td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>

		</div>

	</div>
	<div class="panel-footer">
		<p class="bg-success" style="text-align:center;padding-bottom:4%;border-radius:5px"> <?php echo $this -> pagination -> create_links(); ?> </p>
	</div>
</div>
<?php $this->load->view('admin/layout/footer'); ?>