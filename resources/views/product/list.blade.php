

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
                        <a href="{{ url('/product/' . $item->id) }}" class="btn btn-success btn-xs" title="View event"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/product/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit event"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
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


