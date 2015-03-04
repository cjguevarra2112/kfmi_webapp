<?php $this->load->view('admin/layout/header'); ?>

<h1> Items</h1>
<div class="panel panel-default">
	<div class="panel-heading">
		Sarch form here
	</div>
	<div class="panel-body">
		<div class="table-responsive">

			<!-- Pagination links -->
			<p class="bg-success" style="text-align:center;"> <?php echo $this -> pagination -> create_links(); ?> </p>
			
			<!-- Search results info -->
			<p class="bg-info container-fluid">
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
							<td><?php echo $row->id; ?> </td>
							<td><?php echo $row->name; ?> </td>
							<td><?php echo $row->price; ?></td>
							<td><?php echo $row->quantity; ?></td>
							<td><?php echo $row->category; ?> </td>
							<td>
								<button style="display:inline;" class="btn btn-info btn-md"> <span class="glyphicon glyphicon-shopping-cart"></span> Add to Cart </button>
								
								<?php if ($this->data['role'] == 'Admin'): ?>
									<button style="display:inline;" class="btn btn-danger btn-md"> <span class="glyphicon glyphicon-trash"></span> Delete </button>
									<button style="display:inline;" class="btn btn-primary btn-md"> <span class="glyphicon glyphicon-pencil"></span> Edit </button>
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
		
	</div>
</div>

<?php $this->load->view('admin/layout/footer'); ?>