
<div class="container">


  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title"><?php echo $title ?></h3>
    </div>
    <div class="panel-body">
      <?php if(validation_errors()){ ?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo validation_errors(); ?>
      </div>
      <?php } ?>
      <?php echo isset($data) ? form_open('products/edit/'.$data['id'],array('class' => 'form-horizontal', 'id' => 'myform')) :  form_open('products/add',array('class' => 'form-horizontal', 'id' => 'myform')); ?>

      <?php echo  isset($data) ? ' <input name="item[id]" type="hidden" class="form-control input-sm" value="'.$data['id'].'" placeholder="Product" id="item_name" >' :''  ?>
      <div class="form-group">
       <label for="inputPassword3" class="col-sm-2 control-label">Name</label>
       <div class="col-sm-5">
        <input name="item[name]" type="text" class="form-control input-sm" value="<?php   echo isset($data) ?  $data['name'] : set_value('item[name]'); ?>" placeholder="Product" id="item_name" required>
      </div>    
    </div>    

    <div class="form-group">
     <label for="inputPassword3" class="col-sm-2 control-label">Price</label>
     <div class="col-sm-3">
      <input name="item[price]" type="number" class="form-control" value="<?php echo isset($data) ?  $data['price'] : set_value('item[price]'); ?>" placeholder="Price" id="item_price" required>
    </div> 
  </div>
  <div class="form-group">
   <label for="inputPassword3" class="col-sm-2 control-label">Picture URI</label>
   <div class="col-sm-5">
    <input name="item[picture_name]" type="text" class="form-control" value="<?php echo isset($data) ?  $data['picture_name'] : set_value('item[picture_name]'); ?>" placeholder="Picture Link" id="item_picture_name" required >
  </div> 
</div>
<div class="form-group">
  <label for="inputPassword3" class="col-sm-2 control-label">Description</label>
  <div class="col-sm-6">
    <textarea name="item[description]" type="text" class="form-control"  placeholder="description" id="item_description" > <?php echo isset($data) ?  $data['description'] : set_value('item[description]'); ?></textarea>
  </div>
</div> 
<div class="form-group">
  <div class="form-group">
   <label for="inputPassword3" class="col-sm-2 control-label">Status</label>
   <div class="col-sm-4">
    <select  name="item[status]" class="form-control" id="select_status">
      <option value='available'>Available</option>
      <option value='empty' >Empty</option>
    </select>
  </div>
</div> 
</div>

<div class="form-group">
  <div class="form-group">
   <label for="inputPassword3" class="col-sm-2 control-label">Product Type</label>
   <div class="col-sm-5">
    <select   name="item[type]"  class="form-control" id="select_type">
      <option value='clothes'>Clothes</option>
      <option value='watches'>Watches</option>
      <option value='bags'>Bags</option>
      <option value='accessories' >Accessories</option>
    </select>
  </div>
</div> 
</div>
<div class="form-group">
 <div class="pull-left col-lg-offset-3">
  <button type="submit" value="submit" class="btn btn-danger">Cancel</button>
  <button type="submit" value="submit" class="btn btn-primary">Save changes</button>
</div>
 </div>
</php  echo form_close(); ?>
</div>
</div>

</div>






