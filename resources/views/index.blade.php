
@include('header')
   <div class="container">

        <div class="col-md-6 offset-3 mt-5 shadow rounded p-4">
            <h1 class="text-center mb-3">Laravel Ajax Crud</h1>
            <a type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Product
            </a>
            <input type="text" name="search" id="search" class="mb-3 form-control" placeholder="search here.......">
            <div class="table-data">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#sl</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key=> $item)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                                <a class="btn btn-success btn-sm update_product_f"
                                 data-bs-toggle="modal" data-bs-target="#updatemodal"
                                  data-id="{{ $item->id }}"
                                   data-name="{{ $item->name }}"
                                   data-price="{{ $item->price }}"
                                   >edit</a>
                                <a
                                class="btn btn-danger btn-sm delete_product"
                                data-id="{{ $item->id }}"
                                >delete</a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                {!! $products->links() !!}
            </div>
        </div>
   </div>


   <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
   <form action="" method="post" id="addProduct">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="addModalLabel">Add Product</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="errmsg mb-2"></div>
              <div class="form-group mb-2">
                  <label for="name">Name</label>
                  <input type="text" id="name" class="form-control">
              </div>
              <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" id="price" class="form-control">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary add_product">Save Product</button>
          </div>
        </div>
      </div>
   </form>
  </div>

  <!-- update Modal -->
  <div class="modal fade" id="updatemodal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
   <form action="" method="post" id="update_product_f">
    @csrf
    <input type="hidden" id="up_id">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="updateModalLabel">Update Product</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="errmsg mb-2"></div>
              <div class="form-group mb-2">
                  <label for="name">Name</label>
                  <input type="text" id="up_name" class="form-control">
              </div>
              <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" id="up_price" class="form-control">
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary update_product">update Product</button>
          </div>
        </div>
      </div>
   </form>
  </div>

@include('footer')
