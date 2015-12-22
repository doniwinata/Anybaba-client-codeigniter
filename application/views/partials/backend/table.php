

<div class="container">
    <h3><?php echo $type; ?> Settings </h3>
    <hr>
    <a type="button" href="<?php echo $addLink ?>" class="btn btn-primary btn-lg addNew"  >Add new <?php echo $type  ?></a>
   
    <hr>
    
        <table id="tableData" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <?php echo $table; ?>
            </tbody>
        </table>

   
</div>


<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="delete_confirm"></h4>
      </div>
      <div class="modal-body" >
        Are you sure to delete this <?php echo $type ?> ? 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a id="delete_submit" id-item="" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>