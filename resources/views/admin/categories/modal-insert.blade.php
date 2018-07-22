<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        
        <form id="form" method="POST" action="{{ route('admin.categories.store') }}">
             <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label></div>
                <div class="col-12 col-md-9"><input type="text" required="required" id="text-input" name="name" class="form-control"></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="select" class=" form-control-label">Parent</label></div>
                <div class="col-12 col-md-9">
                  <?php
                  $cates = DB::table('categories')->get();
                  ?>
                  <select name="parent" required="required" id="select" class="form-control">
                    <option value="0">--None--</option>
                   <?php cate_parent($cates); ?>
                  </select>
                </div>
              </div>
              
             <!--  <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Soft</label></div>
                <div class="col-12 col-md-9"><input type="text" id="text-input" onkeypress="return isNumberKey(event)" name="text-input" placeholder="Text" class="form-control"></div>
              </div> -->

              <div class="row form-group">
                <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Description</label></div>
                <div class="col-12 col-md-9"><textarea  name="description" id="editor1" required="required" rows="9" placeholder="Content..." class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group " style="float: right;">
              <button  type="submit" class="btn btn-success btn-sm" name=""><i class="fa fa-dot-circle-o"></i> Insert</button>
              <button type="button" class="btn btn-danger btn-sm" name="reset"><i class="fa fa-ban"></i> Reset</button>
            </div>
             
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
 <script type="text/javascript">
  $('button[name=reset]').on('click',function(){
    $('input[name=name]').val('');
    $('#editor1').val('');

  })
</script>

