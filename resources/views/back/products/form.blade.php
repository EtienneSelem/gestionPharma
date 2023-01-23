@extends('back.layout')

@section('main')

    <form 
        method="post" 
        action="{{ Route::currentRouteName() === 'products.edit' ? route('products.update', $products->id) : route('products.store') }}">

        @if(Route::currentRouteName() === 'products.edit')
            @method('PUT')
        @endif
        
        @csrf

        <div class="row">
            <div class="col-md-8">
                
                <x-back.validation-errors :errors="$errors" />

                @if(session('ok'))
                    <x-back.alert 
                        type='success'
                        title="{!! session('ok') !!}">
                    </x-back.alert>
                @endif

                <x-back.card
                    type='primary'
                    title='Nom'>
                    <x-back.input
                        name='name'
                        :value="isset($product) ? $product->name : ''"
                        input='text'
                        :required="true">
                    </x-back.input>
                </x-back.card>

                <x-back.card
                    type='primary'
                    title='Prix'>
                    <x-back.input
                        name='price'
                        :value="isset($product) ? $product->price : ''"
                        input='text'
                        :required="true">
                    </x-back.input>
                </x-back.card>

                <x-back.card
                    type='primary'
                    title='Description'>
                    <x-back.input
                        name='description'
                        :value="isset($product) ? $product->description : ''"
                        input='textarea'
                        rows=10
                        :required="true">
                        
                    </x-back.input>
                </x-back.card>

                <button type="submit" class="btn btn-primary">@lang('Submit')</button>

            </div>
            <div class="col-md-4">

                <x-back.card
                    type='primary'
                    :outline="false"
                    title='Publication'>
                    <x-back.input
                        name='active'
                        :value="isset($post) ? $post->active : false"
                        input='checkbox'
                        label="Active">
                    </x-back.input>
                </x-back.card>
                
                <x-back.card
                    type='warning'
                    :outline="false"
                    title='Familles'
                    :required="true">
                    <x-back.input
                        name='categories'
                        :values="isset($product) ? $product->categories : collect()"
                        input='selectMultiple'
                        :options="$categories">
                    </x-back.input>
                </x-back.card>
                <x-back.card
                    type='warning'
                    :outline="false"
                    title='Forme'
                    >
                    <x-back.input
                        name='forme'
                        input='selects'
                        :options="$formes">
                    </x-back.input>
                </x-back.card>

                <x-back.card
                    type='warning'
                    :outline="false"
                    title='Date Fabrication'
                    >
                    <x-back.input
                        name='date_fabrication'
                        input='date'>
                    </x-back.input>
                </x-back.card>

                <x-back.card
                    type='warning'
                    :outline="false"
                    title='Date Peremption'
                   >
                    <x-back.input
                        name='date_peremption'
                        input='date'>
                    </x-back.input>
                </x-back.card>

            </div>
        </div>

    </form>

@endsection


