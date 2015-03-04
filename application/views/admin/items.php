<?php $this->load->view('admin/layout/header'); ?>

<h1> Items</h1>
<p class="text-muted"> Only Admin can Edit/Delete items. Auditors can only make purchase. </p>

<!-- Items panel -->
<div class="panel panel-default">
	
	<!-- Search and filter form -->
	<div class="panel-heading">
		
			<?php echo form_open('admin/items/viewSearch'); ?>
				<div class="form-group">
					<input type="text" class="form-control" name="itemSearch" placeholder="Search products" style="width:25%;display:inline;"/>
					<select name="itemCategory" class="form-control" style="width:25%;display:inline;margin-left:1%">
						<option value=""> -- Choose category --</option>
						<?php foreach ( $categories->result() as $categ ): ?>
							<option value="<?php echo $categ->id; ?>"> <?php echo $categ->name; ?></option>
						<?php endforeach; ?>
					</select>
					<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search </button>
				</div>
			</form>
		
	</div>

	<!-- Items panel -->
	<div class="panel-body">
		<div class="table-responsive">
			
			<!-- Search results info -->
			<p class="bg-info container-fluid " style="border-radius:5px;padding-bottom:4%;">
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
						<th> Id </th>
						<th> Name </th>
						<th> Price </th>
						<th> Quantity </th>
						<th> Category </th>
						<th> Action </th>
					</tr>
				</thead>
				<tbody>
					<?php if ($query !== FALSE): ?>
						<?php foreach ($query->result() as $row): ?>
						<tr>
							<td><?php echo $row->id; ?>    </td>
							<td><?php echo $row->name; ?>  </td>
							<td><?php echo $row->price; ?> </td>
							<td><?php echo $row->quantity; ?></td>
							<td><?php echo $row->category; ?></td>
							<td>
								<button style="display:inline;" class="btn btn-info btn-md"> <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart </button>
								
								<?php if ($this->data['role'] == 'Admin'): ?>
									<button style="display:inline;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#editModal_<?php echo $row->id; ?>"> <span class="glyphicon glyphicon-pencil"></span> Edit </button>
									<button style="display:inline;" class="btn btn-danger btn-md"> <span class="glyphicon glyphicon-trash"></span> Delete </button>
								
									<!-- Edit item modal -->
									<div class="modal fade" id="editModal_<?php echo $row->id; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												
												<div class="modal-header">
													<h2> Edit Item </h2>
												</div>

												<div class="modal-body">
													<?php echo form_open('admin/items/editItem'); ?>

														<div class="form-group"> <!-- item name -->
															<label for="itemName"> Item name: </label>
															<input type="text" class="form-control" name="itemName" placeholder="New name" value="<?php echo $row->name; ?>"/>
														</div>

														<div class="form-group"> <!-- item price -->
															<label for="itemPrice"> Item price: </label>
															<input type="text" class="form-control" name="itemPrice" placeholder="New Price" value="<?php echo (int)$row->price; ?>" />
														</div>

														<div class="form-group"> <!-- item quantity -->
															<label for="itemQuantity"> Item quantity: </label>
															<input type="number" class="form-control" name="itemQuantity" min="0" placeholder="New Quantity" value="<?php echo $row->quantity; ?>"/>
														</div>

														<div class="form-group">
															<label for="itemCategory"> Category: </label>
															<select name="itemCategory" class="form-control">
																<?php foreach ($categories->result() as $categ): ?>
																	<option value="<?php echo $categ->id; ?>"<?php if ($categ->id == $row->category_id){ echo ' selected'; }?>> <?php echo $categ->name; ?> </option>
																<?php endforeach; ?>
															</select>
														</div>
												</div>
												
												<div class="modal-footer">
														<button type="button"  class="btn btn-default" data-dismiss="modal"> Close </button>
														<input type="hidden" name="itemId" value="<?php echo $row->id; ?>" />
														<button type="submit" class="btn btn-primary"> Update </button>
													</form>
												</div>
											</div>
										</div>
									</div>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<?php endif; ?>
			</table>
			
			
		</div>

	</div>
	<div class="panel-footer">
		<!-- Pagination links -->
			<p class="bg-success" style="text-align:center;padding-bottom:4%;border-radius:5px"> <?php echo $this -> pagination -> create_links(); ?> </p>
	</div>
</div>

<?php $this->load->view('admin/layout/footer'); ?>