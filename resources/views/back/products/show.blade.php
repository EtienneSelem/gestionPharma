@extends('back.layout')

@section('main')

<div class="row">
    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Sales</span>
            <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">{{isset($produit) ? $produit->name : ''}} </span>
            <span class="info-box-number">{{isset($produit) ? $produit->price : ''}} </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <form method="post" action="{{route('panier.store') }}">

        @csrf

        <div class="row">
            
            <div class="col-md-12">
                
                <x-back.validation-errors :errors="$errors" />

                @if(session('ok'))
                    <x-back.alert 
                        type='success'
                        title="{!! session('ok') !!}">
                    </x-back.alert>
                @endif

                <x-back.card
                    type='primary'
                    title="Quantité">
                    <x-back.input
                        id="quantity"
                        name='quantity'
                        value="1" 
                        min="1"
                        input='number'
                        :required="true">
                    </x-back.input>
                    <input type="hidden" id="id" name="id"  value="{{ $produit->id }}">
                </x-back.card>


                <button type="submit" class="btn btn-primary">@lang('Ajouter au panier')</button>

            </div>
            
        </div>

    </form>

@endsection


