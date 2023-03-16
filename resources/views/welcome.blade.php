@extends('layout.main')
@section('tile')
    Product List
@endsection
@section('content')
    <div class="container-fluid">
      @if(Auth::user())
       <a href="{{ route('add_product') }}" type="button" class="btn btn-sm btn-success text-light mt-3 mb-1" style="margin-left: 90%;" data-toggle="modal" data-target="#add_product">Add New Product</a>
      @endif
      @if ($errors->any())
          <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
         @if ($message = Session::get('success'))
          <div class="alert alert-success alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <p>{{ $message }}</p>
                  </div>
           @endif
        <div class="row mt-5">
            <div class="col-lg-12">
                <table class="table table-striped table-sm border data-table">
                    <thead class="text-light" style="background-color: #8935c9">
                      <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
        
                    </tfoot>
                  </table>        
            </div>
        </div>
    </div>

    {{-- CONFORM MODAL --}}
  <div class="modal fade" id="confirm_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" id="conform_form">
          <p class="text-dark text-bold">Are you sure want to perform this action?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" id="yes_btn">Yes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        </div>
      </form>
      </div>
    </div>
  </div>
   {{-- END OF CONFORM MODAL --}}

    {{-- VIEW PRODUCT MODAL --}}
    <div class="modal fade" id="view_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Product Detais</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-lg-12">
                    <div class="form-group">
                      <label for="image">Image</label>
                      <div class="embed-responsive embed-responsive-16by9 text-center">
                        <iframe class="embed-responsive-item" src="" id="view_image"></iframe>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="view_name" readonly placeholder="Name">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label for="price">Price</label>
                      <input type="text" class="form-control"  id="view_price" readonly placeholder="Price">
                    </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    {{-- END OF VIEW PRODUCT MODAL --}}
        {{-- ADD PRODUCT MODAL --}}
        <div class="modal fade" id="add_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{ route('add_product') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept=".jpg,.png,.jpeg,.jfif" required>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" name="price"  id="price" placeholder="Price" required>
                          </div>
                        </div>
                    </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      {{-- END OF ADD PRODUCT MODAL --}}
       {{-- EDIT PRODUCT MODAL --}}
       <div class="modal fade" id="edit_product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('edit_product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="image">Image</label>
                          <input type="file" name="image" id="edit_image" class="form-control" accept=".jpg,.png,.jpeg,.jfif" required>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group">
                          <label for="image">Stored Image</label>
                          <div class="embed-responsive embed-responsive-16by9 text-center">
                            <iframe class="embed-responsive-item" src="" id="select_image"></iframe>
                          </div>
                        </div>
                      <input type="hidden" name="product_id" id="product_id">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" name="name" id="edit_name" placeholder="Name" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label for="price">Price</label>
                          <input type="text" class="form-control" name="price"  id="edit_price" placeholder="Price" required>
                        </div>
                      </div>
                  </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Update</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    {{-- END OF EDIT PRODUCT MODAL --}}
@endsection
@section('scripts')
<script>
  $(document).ready(function () {
      $('#logout_btn').on('click',function(){
        var url = $(this).data('href');
        $('#conform_form').attr('action',url);
          $('#confirm_modal').modal('show');
      });
      //viw button click
      $('body').on('click', '#view_btn', function() {
            var url = $(this).data('href');
            $.get(url, function(data) {
                  if(data.image == '' || data.image == 'N/A'){
                    $('#view_image').attr('src','images/palceholder.png');
                  }else{
                    $('#view_image').attr('src',data.image);
                  } 
                  $('#view_name').val(data.name);
                  $('#view_price').val(data.price);
                $('#view_product').modal('show');
            })
        });

        //edit button click
      $('body').on('click', '#edit_btn', function() {
            var url = $(this).data('href');
            $('#confirm_modal').modal('show');
        });

        //delete button click
      $('body').on('click', '#delete_btn', function() {
        var url = $(this).data('href');
        $('#conform_form').attr('action',url);
          $('#confirm_modal').modal('show');
            
        });
  });
</script>
<script>
    $(document).ready(function() {

        var table = $('.data-table').DataTable({
            buttons: [{
                text: 'My button',
                action: function(e, dt, button, config) {
                    var info = dt.buttons.exportInfo();
                }
            }],
            processing: true,
            serverSide: true,
            ajax: "{{ route('get_products') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: true,
                    searchable: false, 
                },
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: true,
                    searchable: true,    
                },
                {
                    data: 'price',
                    name: 'price',
                    orderable: true,
                    searchable: true, 
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    print: false,  
                },
            ]
        });

    });//END DOCUMENT READY FUNCTION
</script>
@endsection