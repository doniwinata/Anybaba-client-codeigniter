
<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titleUpdate">Update Member </h4>
    </div>
    <div class="modal-body">
        <?php echo form_open('auth/signupMember'); ?>
        <div class="login-form">

            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                 <h4 class="modal-title" id="form_name">-</h4>
            </div>    
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <h4 class="modal-title" id="form_email">=</h4>
            </div> 
            <div class="form-group">
                <div class="form-group">
                    <label for="sel1">Status</label>
                    <select class="form-control" id="form_status">
                        <option value='active'>Active</option>
                        <option value='inactive' >Inactive</option>
                    </select>
                </div>
            </div> 
              
        </div>
    </php  echo form_close(); ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
</div>
</div>
</div>
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
        Are you sure to delete this member ? 
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="delete_submit" type="button" id-member="www" class="btn btn-danger">Delete</button>
    </div>
</div>
</div>
</div>