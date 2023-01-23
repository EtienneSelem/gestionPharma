@extends('back.layout')

@section('main')

<div class="row">
    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>


    </div>
    <!-- /.row -->

    <form method="post" action="{{route('paniervente.store') }}">

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


                <button type="submit" class="btn btn-primary">@lang('Ajouter au panier de vente')</button>

            </div>
            
        </div>

    </form>

@endsection


