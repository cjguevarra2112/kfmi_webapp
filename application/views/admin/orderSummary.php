<?php $this -> load -> view ('admin/layout/header.php'); ?>

	<h2> Purchase Completed! </h2>

		<div class="panel panel-default">
			<div class="panel-heading">
				<h1> Order Summary </h1>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tbody>
							<tr>
								<td>Order date: </td>
								<td><?php echo mdate('%d %F %Y @ %h:%i %a', $orderInfo['order_date']); ?></td>
							</tr>
							<tr>
								<td>Customer name: </td>
								<td><?php echo $orderInfo['customer']->fname. ' ' . $orderInfo['customer']->lname; ?> </td>
							</tr>
							<tr>
								<td>Cash in amount: </td>
								<td><?php echo '&#8369; ' . $this -> cart -> format_number($orderInfo['cash_in']); ?></td>
							</tr>
							<tr>
								<td> Cash change: </td>
								<td> <?php echo '&#8369; ' . $this -> cart -> format_number($orderInfo['cash_change']); ?></td>
							</tr>
							<tr>
								<td>Total amount: </td>
								<td><?php echo '&#8369; ' . $this -> cart -> format_number($orderInfo['total_amount']); ?></td>
							</tr>
							<tr>
								<td>Order Key: </td>
								<td><?php echo $orderInfo['order_key']; ?></td>
							</tr>
							<tr>
								<td colspan="2"> <a href="<?php echo base_url('admin/cart'); ?>" class="btn btn-default"> Click to Finish </a> </td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer">
				
			</div>
		</div>
	</div>
<?php $this -> load -> view ('admin/layout/footer.php'); ?>