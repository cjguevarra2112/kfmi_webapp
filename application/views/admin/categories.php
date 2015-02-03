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
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($query->result() as $row): ?>
                    <tr>
                            <td> <?php echo $row->id; ?> </td>
                            <td> <?php echo $row->name; ?> </td>
                            <td>
                                <center>
                                    <button style="display:inline;" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#editModal_<?php echo $row->id; ?>"> <span class="glyphicon glyphicon-pencil"> </span> </button>

                                    <!-- Modal for Edit category -->
                                    <div class="modal fade" id="editModal_<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <!-- Modal HEADER -->
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"> &times; </span>
                                                    </button>
                                                    <h4 class="modal-title" id="editModalLabel"> Edit category </h4>
                                                </div>

                                                <!-- Modal BODY -->
                                                <div class="modal-body">
                                                    <?php echo form_open('admin/categories/editCategory'); ?>
                                                        <div class="form-group">
                                                            <label for="new-category" class="control-label"> New category name: </label>
                                                            <input type="hidden" name="categoryId" value="<?php echo $row->id; ?>" />
                                                            <input type="text" class="form-control" name="newCategoryName" id="new-category" value="<?php echo $row->name; ?>" required/>
                                                        </div>
                                                </div>

                                                <!-- Modal FOOTER -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
                                                    <button type="submit" class="btn btn-primary"> Update </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End update modal -->
                                    <?php
                                        $attr = array('style' => 'display:inline;');
                                        echo form_open('admin/categories/doAction', $attr);
                                    
                                    ?>
                                    <input type="hidden" name="categId" value="<?php echo $row->id; ?>" />
                                    <button type="submit" name="action" class="btn btn-danger btn-lg"> <span class="glyphicon glyphicon-trash"></span></button>
                                    </form>
                                </center>
                            </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
        </div>
    </div>
    
</div>
<?php $this->load->view('admin/layout/footer'); ?>