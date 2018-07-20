<div id="edit_size" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
         <div class="error_update_size">
                                       
        </div>
        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.products.update_size') }}">
          <input type="hidden" name="id_pro">
           <div id="add-size">
             

           </div>
           <a href="javascript::void(0)" class="btn btn-secondary" id="add-sub-size"><i class="fa fa-plus"></i> Add sub size</a>
           <div class="modal-footer">
          <input type="button" name="update_size" style="text-align: center;" value="Update" class="btn btn-info">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        </form>

      </div>
        
      </div>

  </div>
</div>
 <script type="text/javascript">
       $('#add-sub-size').on('click',function(){
            var html = '';
            html += ' <div class="row form-group">';
            html += '<div class="col-md-1"><label for="text-input" class=" form-control-label">Size:</label></div>';
            html += ' <div class="col-md-4">';
                html += ' <select name="size[]" class="form-control" id="select">';
                    html += '<option value="XS">XS</option>';
                    html += '<option value="S">S</option>';
                    html += '<option value="M">M</option>';
                    html += '<option value="L">L</option>';
                    html += '<option value="XL">XL</option>';
                    html += '<option value="2XL">2XL</option>';
                    html += '<option value="3XL">3XL</option>';
                html += '</select>';
            html += ' </div>';
            html += '<div><label for="text-input" class=" form-control-label">Quantity:</label></div>';
            html += '<div class="col-md-4"><input type="text" required="required" id="text-input" onkeyup="formatNumBerKeyUp(this)" name="quantity[]" class="form-control"></div>';
            html += ' <button type="button" class="close close-add-size" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
            html += ' </div>';
            $('#add-size').append(html);
        })

        $(document).on('click', '.close-add-size', function () {
            $(this).parent().remove();
        })

        $('input[name=update_size]').click(function(){
          var html = '<ul  id="error" class="alert alert-danger">';
          flag = true;
          var quantity = 0;
            $('input[name="quantity[]"]').each(function(i,n){
                 if($(n).val() == "") {
                    html += '<li>Please fill all quantity</li>';
                     flag = false;
                    return false;

                 }
            })
            var check ;
            var len = $('select[name="size[]"').length;
            $('select[name="size[]"').each(function(i,n){
                $('select[name="size[]"').each(function(j,m){
                    if($(n).val() == $(m).val() && len > 1 && i != j) {
                        html += '<li>Size is unique</li>';
                        flag = false;
                        check = false; 

                    }
                    if(check == false)
                    {
                        return check;
                    }
                });
                if(check == false) {
                    return check;
                }

            }) ;
            html += '</ul>';
            console.log(flag);  
            if(flag) {
                $('input[name="update_size"]').attr("type", "submit");
            } else {
                $('.error_update_size').html(html);
            }
        })
</script>

