@extends('back.layout') 

@section('main')

    @if($totalvt)
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pannier vente</h1>
                </div>
                
                </div>
            </div>
        </section>
        <form id="form" action="{{ route('ventes.store') }}" method="POST">
            @csrf      
            @if(session()->has('message'))
                <div class="alert alert-block alert-danger">
                  <h4>Erreur !</h4>
                  {{ session('message') }}
                </div>
            @endif
        <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-12">
                
                <!-- Main content -->
                <div class="invoice p-3 mb-3" id="wrapper">
            
                <!-- Table row -->
                <div class="row">
                    <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Product</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contentvt as $item)
                                <tr>
                                    <td class="col-md-2">
                                        {{ $item->quantity }}
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ number_format($item->quantity * $item->price, 2, ',', ' ') }} Fc</td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
                        @if($totalvt)
                           
                                <button id="commande" type="submit" style="width: 100%;background: #192a56;
                                color:#fff;border-radius: 20px;height:40px;">Vender</button>
                        @endif
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                    <p class="lead">Amount Due 2/22/2014</p>

                    <div class="table-responsive">
                        <table class="table">
                        <tr>
                            <th>Total:</th>
                            <td>{{ number_format($totalvt, 2, ',', ' ') }} Fc</td>
                        </tr>
                        </table>
                    </div>
                    </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    </div>
                
                </div>
                </div>
            </div>
            </section>
        </form>
    @endif

@endsection

