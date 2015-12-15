

<div class="container">
    <h3><?php echo $type; ?> Settings </h3>
    <hr>
   <a href="<?php  echo site_url().$link_add ?>" class="btn btn-lg btn-info">Add new <?php echo $type  ?></a>
    <hr>
    
        <table id="tableData" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <?php echo $table; ?>
            </tbody>
        </table>

   
</div>