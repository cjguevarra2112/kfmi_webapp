<?php $this->load->view('admin/layout/header'); ?>
<h1> Category management </h1>


<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline clearfix" >
           <div class="form-group">
               <input type="text" class="form-control" placeholder="Search" />
               <button type="submit" class="btn btn-primary">  Search </button>
           </div>
        </form>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <p class="bg-success" style="text-align:center;"> <?php echo $this->pagination->create_links(); ?> </p>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th> Id </th>
                        <th> Category name </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categs->result() as $row): ?>
                    <tr>
                        <td> <?php echo $row->id; ?> </td>
                        <td> <?php echo $row->name; ?> </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>
<?php $this->load->view('admin/layout/footer'); ?>