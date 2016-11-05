@extends('layouts.default')

@section('content')
<div class="container">
    
    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Create New Product</h2>
    

    {!! Form::open(['url' => '/product', 'class' => 'form-horizontal']) !!}

    
    
                <div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
                {!! Form::label('product_name', 'Product Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('product_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('qty') ? 'has-error' : ''}}">
                {!! Form::label('qty', 'Quantity', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('qty', null, ['class' => 'form-control', 'id' => 'us3-address']) !!}
                    {!! $errors->first('qty', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                {!! Form::label('price', 'Price', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('price', null, ['class' => 'form-control', 'id' => 'us3-lat']) !!}
                    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
    

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            <button class="btn btn-success productCreate" type="button">Create Product</button>
        </div>
    </div>
    {!! Form::close() !!}

    

</div>





<input type="hidden" name="_token" value="{{ csrf_token() }}">


<div class="row" id="productList">
    
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Products List </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      
                     
                      
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      This is the Products List so far !
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>S.No</th><th> Product Title </th><th> Quantity </th><th> Price </th>
                    
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            {{-- */$total=0;/* --}}
            @foreach($products as $item)
                {{-- */$x++;/* --}}
                {{-- */$total += $item->qty;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->product_name }}</td><td>{{ $item->qty }}</td><td>{{ $item->price }}</td>
                    <td>
                        
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/product', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Product" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete event',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ));!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                
            @endforeach
            <tr><td></td><td></td><td colspan="3">{{ $total }}</td></tr>
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $products->render() !!} </div>
    </div>
    </div>

</div>
</div>




<script>
$(document).ready(function(){
    $(".productCreate").click(function(){
        var _token = $('input[name="_token"]').val();
        var prod = $("input[name='product_name']").val();
        var qty = $("input[name='qty']").val();
        var price = $("input[name='price']").val();
    $.post("/product/create",{product_name: prod, qty: qty, price: price, _token : _token}, function(data, status){
//        alert("Data: " + data + "\nStatus: " + status);
        $("#productList").html(data);
    });
});
});
</script>
@endsection