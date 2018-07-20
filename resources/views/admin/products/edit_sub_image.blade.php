<div id="edit_sub_image" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.update_sub_image') }}">
          <input type="hidden" name="id_pro" value="">
        <div id="old_image"></div>
        
        <div class="clearfix"></div>
        <a href="javascript::void(0)" class="btn btn-secondary" id="add-sub-image"><i class="fa fa-plus"></i> Add sub-image</a>
        <hr>
        <br>
        <div class="sub-image">
                                                    

        </div>
        
        <div class="modal-footer">
          <button type="submit" style="text-align: center;" class="btn btn-info">Update</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
        
      </div>

  </div>
</div>
 <script type="text/javascript">
  $('button[name=reset]').on('click',function(){
    $('input[name=name]').val('');
    $('#editor1').val('');

  })

  $('#add-sub-image').on('click',function(){
            var html = '';
            html += '<div class="row form-group">';
            html += '<div class="col-md-11"><input type="file" id="text-input" name="sub_image[]" class="form-control"></div>';
            html += '<button type="button" class="close close-add-image" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
            html += '</div>';
            $('.sub-image').append(html);
        });

  $(document).on('click', '.del_sub_image', function () {
            $(this).parent().parent().remove();
        })
</script>

