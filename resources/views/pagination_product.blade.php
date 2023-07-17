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
