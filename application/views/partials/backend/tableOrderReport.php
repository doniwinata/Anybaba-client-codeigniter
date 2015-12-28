

<div class="container">
  <h3>Report Orders </h3>
  <hr>
  <div class="col-xs-6">
    <div class="btn-toolbar">
      <div class="btn-group">
        <a class="btn btn-primary" href="<?php echo site_url().'/orders/reportOrder/ordering' ?>"><span class="fui-time"></span> Pending Order</a>
        <a class="btn btn-success" href="<?php echo site_url().'/orders/reportOrder/paid' ?>"><span class="fui-check"></span> Paid Order</a>
         <a class="btn btn-danger" href="<?php echo site_url().'/orders/reportOrder/finished' ?>"><span class="fui-star"></span> Finished Order</a>
        
      </div>
    </div> <!-- /toolbar -->
  </div>


  <hr>
  <br>
  <?php  if(isset($code)){?>

    <ul class="list-group">
  <li class="list-group-item">Detail Order<h3> <?php echo $code ?> </h3></li>
  <li class="list-group-item"> Total Order <?php echo $total ?> $</li>
  <li class="list-group-item"> Date Order <?php echo $created_at ?></li>
   <li class="list-group-item"> Order of <?php echo $email ?></li>
 
</ul>
  
 
 
  </h3>
  <?php }?> 
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