@extends('back.layout') 

@section('main')

    @if($total)
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pannier</h1>
            </div>
            
            </div>
        </div>
        </section>

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
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($content as $item)
                                <tr>
                                <td class="col-md-2">
                                    <form action="{{ route('panier.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input name="quantity" class="form-control" type="text" style="height: 2rem" min="1" value="{{ $item->quantity }}">
                                    </form> 
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ number_format($item->quantity * $item->price, 2, ',', ' ') }} Fc</td>
                                <td><form action="{{ route('panier.destroy', $item->id) }}"method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="col-md-1 col-sm-1 col-xs-1"><i class="fa fa-trash delete-Item"style="cursor: pointer"></i></div>
                                </form></td>
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
                        <a href="{{ route('commandes.create') }}">
                            <input type="text" value="Commander" class="btn btn-primary">
                        </a>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                    <p class="lead">Amount Due 2/22/2014</p>

                    <div class="table-responsive">
                        <table class="table">
                        <tr>
                            <th>Total:</th>
                            <td>{{ number_format($total, 2, ',', ' ') }} Fc</td>
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
    @endif

@endsection

@section('javascript')

    <script>

        document.addEventListener('DOMContentLoaded', () => {
            const quantities = document.querySelectorAll('input[name="quantity"]');
            quantities.forEach( input => {
                input.addEventListener('input', e => {
                    if(e.target.value < 1) {
                        e.target.value = 1;
                    } else {
                        e.target.parentNode.parentNode.submit();
                        document.querySelector('#wrapper').classList.add('hide');
                        document.querySelector('#action').classList.add('hide');
                        document.querySelector('#loader').classList.remove('hide');
                    }
                });
            });

            const deletes = document.querySelectorAll('.delete-Item');
                deletes.forEach( icon => {
                    icon.addEventListener('click', e => {
                        e.target.parentNode.parentNode.submit();
                        document.querySelector('#wrapper').classList.add('hide');
                        document.querySelector('#loader').classList.remove('hide');
                    });
                });
         });
    </script>
    @endsection