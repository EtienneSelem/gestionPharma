@extends('back.layout')

@section('css')
    <style>
        #holder img {
            height: 100%;
            width: 100%;
        }
    </style>
@endsection

@section('main')

    <form enctype="multipart/form-data"
        method="post" 
        action="{{ Route::currentRouteName() === 'fournisseurs.edit' ? route('fournisseurs.update', $fournisseur->id) : route('fournisseurs.store') }}">

        @if(Route::currentRouteName() === 'fournisseurs.edit')
            @method('PUT')
        @endif
        
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
                    type='info'
                    :outline="true"
                    title=''>
                    <x-back.input
                        title='Name'
                        name='name'
                        :value="isset($fournisseur) ? $fournisseur->name : ''"
                        input='text'
                        :required="true">
                    </x-back.input>
                    <x-back.input
                        title='Adresse'
                        name='adresse'
                        :value="isset($fournisseur) ? $fournisseur->adresse : ''"
                        input='textarea'
                        :required="true">
                    </x-back.input>
                    <x-back.input
                        title='Telephone'
                        name='telephone'
                        :value="isset($fournisseur) ? $fournisseur->telephone : ''"
                        input='text'
                        :required="true">
                    </x-back.input>
                  
                </x-back.card>

                <button type="submit" class="btn btn-primary">@lang('Submit')</button>

              </div>
        </div>


    </form>

@endsection



