@extends("layouts.main")

@section("content")

    <div class="d-flex flex-column-fluid" id="dev-format">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Ventas: 
                            {{ App\Payment::with("productPurchases", "user", "guestUser", "productPurchases.productFormatSize", "productPurchases.productFormatSize.product", "productPurchases.productFormatSize.format", "productPurchases.productFormatSize.size")->has("productPurchases")
                ->has("productPurchases.productFormatSize")->has( "productPurchases.productFormatSize.product")->has( "productPurchases.productFormatSize.format")->has( "productPurchases.productFormatSize.size")->count() }}
                            </h3>
                            
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Clientes Registrados: {{ App\User::where("role_id", 2)->count() }} </h3>
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Pinturas: {{ App\Product::count() }} </h3>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
                <div class="col-12">
                    
                    <div class="card">
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <div class="datatable datatable-bordered datatable-head-custom datatable-default datatable-primary datatable-loaded" id="kt_datatable" style="">
                            <table class="table">
                                <thead>
                                    <tr >
                                        <th class="datatable-cell datatable-cell-sort">
                                            <span >#</span>
                                        </th>
                                        <th class="datatable-cell datatable-cell-sort">
                                            <span >Cliente</span>
                                        </th>

                                        <th class="datatable-cell datatable-cell-sort">
                                            <span >Status</span>
                                        </th>

                                        <th class="datatable-cell datatable-cell-sort">
                                            <span >Total</span>
                                        </th>
                                        <th class="datatable-cell datatable-cell-sort">
                                            <span >Fecha</span>
                                        </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(App\Payment::with("productPurchases", "user", "guestUser", "productPurchases.productFormatSize", "productPurchases.productFormatSize.product", "productPurchases.productFormatSize.format", "productPurchases.productFormatSize.size")->has("productPurchases")
                ->has("productPurchases.productFormatSize")->has( "productPurchases.productFormatSize.product")->has( "productPurchases.productFormatSize.format")->has( "productPurchases.productFormatSize.size")
                ->take(10)->orderBy('id', 'desc')->get() as $payment)
                                    <tr>
                                        <th>{{ $payment->order_id }}</th>
                                        @if($payment->user)
                                        <td>{{ $payment->user->name }}</td>
                                        @endif
                                        @if($payment->guestUser)
                                        <td>{{ $payment->guestUser->name }}</td>
                                        @endif
                                        <td style="text-transform: capitalize;">{{  $payment->status }}</td>
                                        <td>$ {{  number_format($payment->total, 2, ",", ".") }}</td>
                                        <td>{{ $payment->created_at->format("d-m-Y") }}</td>
                                        
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
        
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
@endsection