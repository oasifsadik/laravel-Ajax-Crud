<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
        $(document).ready(function(){
            $(document).on('click','.add_product' , function(e){
                e.preventDefault();

                let name = $('#name').val();
                let price = $('#price').val();
                $.ajax({
                    url: "{{ url('add-product') }}",
                    method : "POST",
                    data: {
                        name:name,
                        price:price,
                    },
                    success: function (response) {
                        if(response.status =='success')
                        {
                            $('#exampleModal').modal('hide');
                            $('#addProduct')[0].reset();
                            $('.table').load(location.href+' .table');
                        }
                    },
                    error:function(err){
                        let error = err.responseJSON;
                        $.each(error.errors, function (indexInArray, valueOfElement) {
                            $('.errmsg').append('<span class="text-danger">'+valueOfElement+'</span>'+'<br>');
                        });
                    }
                });
            });
            //
            $(document).on('click','.update_product_f',function(){
                let id = $(this).data('id');
                let name = $(this).data('name');
                let price = $(this).data('price');

                $('#up_id').val(id);
                $('#up_name').val(name);
                $('#up_price').val(price);

            });
            //update
            $(document).on('click','.update_product' , function(e){
                e.preventDefault();

                let up_id = $('#up_id').val();
                let up_name = $('#up_name').val();
                let up_price = $('#up_price').val();
                $.ajax({
                    url: "{{ url('update-product') }}",
                    method : "POST",
                    data: {
                        up_id:up_id,
                        up_name:up_name,
                        up_price:up_price,
                    },
                    success: function (response) {
                        if(response.status =='success')
                        {
                            $('#updatemodal').modal('hide');
                            $('#update_product_f')[0].reset();
                            $('.table').load(location.href+' .table');
                        }
                    },
                    error:function(err){
                        let error = err.responseJSON;
                        $.each(error.errors, function (indexInArray, valueOfElement) {
                            $('.errmsg').append('<span class="text-danger">'+valueOfElement+'</span>'+'<br>');
                        });
                    }
                });
            });
            //delete
            $(document).on('click','.delete_product' , function(e){
                e.preventDefault();

                let product_id = $(this).data('id');
                if(confirm('Are You Sure')){

                    $.ajax({
                        url: "{{ url('delete-product') }}",
                        method : "get",
                        data: {
                            product_id:product_id,
                        },
                        success: function (response) {
                            if(response.status =='success')
                            {
                                $('.table').load(location.href+' .table');
                            }
                        },
                    });
                }
            });
            //pagination
            $(document).on('click','.pagination a', function (e) {
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1]
                product(page)
            });
            function product(page){
                $.ajax({
                    url: "/pagination/paginate-data?page="+page,
                    success: function (response) {
                        $('.table-data').html(response);
                    }
                });
            }
            //search
            $(document).on('keyup',function (e) {
                e.preventDefault();
                let search_string = $('#search').val();
                $.ajax({
                    method: "GET",
                    url: "{{ url('search-product') }}",
                    data: {
                        search_string:search_string,
                    },
                    success: function (response) {
                        $('.table-data').html(response);
                        if(response.status == 'product not found')
                        {
                            $('.table-data').html('<span class="text-danger">'+'product not found'+'</span>')
                        }
                    }
                });
             })
        });
</script>
</body>
</html>
