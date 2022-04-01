<div>
    <style>
        nav svg{
            height:20px;
        }
        nav .hidden{
            display:block !important;
        }
    </style>
    <div class="container" style="padding: 30px 0">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-4">
                               Orders history
                            </div>
                            <div class="col-md-4">
                               <a href="{{ route('admin.orders') }}" class="btn btn-primary full-right">Tous les ordres</a>
                            </div>
                            <div class="col-md-4">
                                <input placeholder="search..." style="width: 300px" type="text" wire:model="search_history" class="form-control full-right">
                            </div>
                        </div>
                        
                    </div>
                    <div class="panel-body">
                      
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Subtotal</th>
                                    <th>Discount</th>
                                    <th>Tax</th>
                                    <th>Total</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Zipcode</th>
                                    <th>Status</th>
                                    <th>Order date</th>
                                    <th>Orders</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderss as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>${{ $order->subtotal }}</td>
                                    <td>${{ $order->discount }}</td>
                                    <td>${{ $order->tax }}</td>
                                    <td>${{ $order->total }}</td>
                                    <td>{{ $order->firstname }}</td>
                                    <td>{{ $order->lastname }}</td>
                                    <td>{{ $order->mobile }}</td>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->zipcode }}</td>
                                    <td>{{ $order->status }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    {{-- <td><a href="{{ route('admin.orderdetailss',['order_id'=>$order->id]) }}" class="btn btn-info btn-sm">Details</td> --}}
                                   
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $orderss->links() }}
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
