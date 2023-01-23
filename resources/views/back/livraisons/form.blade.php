@extends('back.layout')

@section('main')

    <div class="row">
        <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-12">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Commande livrée</span>
            <span class="info-box-number"></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
    </div>
    
    <form 
        method="post" 
        action="{{ Route::currentRouteName() === 'products.edit' ? route('products.update', $products->id) : route('livraison.store') }}">

        @if(Route::currentRouteName() === 'products.edit')
            @method('PUT')
        @endif
        
        @csrf

        <div class="row">
        
            <div class="col-md-8">
                
                <x-back.validation-errors :errors="$errors" />

                @if(session('alert'))
                    <x-back.alert 
                        type='success'
                        title="{!! session('alert') !!}">
                    </x-back.alert>
                @endif

                <x-back.card
                    type='primary'
                    title='Produits'
                    >
                    <x-back.input
                        name='fournisseur'
                        input='select'
                        :values="isset($product) ? $product->categories : collect()"
                        :options="$products">
                    </x-back.input>
                </x-back.card>

                <x-back.card
                    type='primary'
                    title='Fournisseurs'
                    >
                    <x-back.input
                        name='product'
                        input='select'
                        :values="isset($product) ? $product->categories : collect()"
                        :options="$fournisseurs">
                    </x-back.input>
                </x-back.card>

                
                <button type="submit" class="btn btn-primary">@lang('Valider')</button>

            </div>

            <div class="col-md-4">
                <x-back.card
                    type='warning'
                    title='Quantités'
                    :required="true">
                   <input type="number" name="quantity" class="form-control">
                </x-back.card>
            
                <x-back.card
                    type='info'
                    title='Prix'
                    :required="true">
                   <input type="number" name="prix" class="form-control">
                </x-back.card>

                <x-back.card
                    type='Primary'
                    title='Total Net'
                    :required="true">
                   <input type="number" name="total" class="form-control">
                </x-back.card>

            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <x-back.card
                type='default'
                title='LIvraison'
                :required="true">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Fournisseur</th>
                            <th>Produits</th>
                            <th>Qté Livrée</th>
                            <th>Prix Unitaire</th>
                            <th>Montant</th>
                            <th></th>
                        </tr>
                    </thead>    
                    <tbody>
                      
                
                    </tbody>
                    </table>
                </x-back.card>
    
            </div>

        </div>

    </form>



@endsection


