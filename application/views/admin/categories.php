<?php $this->load->view('admin/layout/header'); ?>
<h1> Category management </h1>


<div class="panel panel-default">
    <div class="panel-heading">
        <!-- <form class="form-inline clearfix" > -->
          <?php echo form_open('admin/categories/viewSearch', array('class' => 'form-inline clearfix')); ?>
           <div class="form-group">
               <input type="text" name="categorySearch" class="form-control" placeholder="Search" />
               <button type="submit" class="btn btn-primary">  Search </button>
           </div>
        <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#addCategory"> Create new category </button>
        </form>
        
        <!-- Modal for add category -->
        <div class="modal fade" id="addCategory" tab-index="-1" role="dialog" aria-labelledby="#addCategoryLabel">
            <div class="modal-dialog">
                <div class="modal-content"> 
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title"> Create New Category </h4>
                    </div>
                    
                    <div class="modal-body">
                        <div class="form-group">
                            <?php echo form_open('admin/categories/addCategory'); ?>
                            <label for="categoryName" class="control-label"> Category name: </label>
                            <input type="text" class="form-control" name="categoryName" required/>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"> Add </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Close </button>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- END add category modal -->
        
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <p class="bg-success" style="text-align:center;"> <?php echo $this->pagination->create_links(); ?> </p>
            <p class="bg-info container-fluid">
                <?php
                    if ($query !== FALSE) {
                        if ($query->num_rows() > 1) {
                            echo $query->num_rows() . " Results found";
                        } else {
                            echo $query->num_rows() . " Result found";
                        }
                    } else {
                        echo "Sorry no results found.";
                    }
                ?>
            </p>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th> Id </th>
                        <th> Category name </th>
                        <th> Action </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($query !== FALSE): ?>
                        <?php foreach ($query->result() as $row): ?>
                        <tr>
                                <td class="categ"> <?php echo $row->id; ?> </td>
                                <td class="categ"> <?php echo $row->name; ?> </td>
                                <td>
                                    <center>
                                        <button style="display:inline;" class="btn btn-primary btn-md" data-toggle="modal" data-target="#editModal_<?php echo $row->id; ?>"> <span class="glyphicon glyphicon-pencil"></span> Edit </button>

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
                                            echo form_open('admin/categories/deleteCategory', $attr);

                                        ?>
                                        <input type="hidden" name="categId" value="<?php echo $row->id; ?>" />
                                        <button type="submit" class="btn btn-danger btn-md"> <span class="glyphicon glyphicon-trash"></span> Delete </button>
                                        </form>
                                    </center>
                                </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            
        </div>
    </div>
    
</div>
<?php $this->load->view('admin/layout/footer'); ?>