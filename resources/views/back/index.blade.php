@extends('back.layout') 

@section('main') 
  <div class="container-fluid">
      <div class="row">

        @if($users)
          <x-back.box
            type='success'
            :number='$users'
            title='New users'
            route='users.indexnew'
            model='user'>
          </x-back.box>
        @endif

        @if($products)
          <x-back.box
            type='info'
            :number='$products'
            title='New products'
            route='products.indexnew'
            model='product'>
          </x-back.box>
        @endif

        @if($orders)
          <x-back.box
            type='info'
            :number='$orders'
            title='New orders'
            route='products.index'
            model='product'>
          </x-back.box>
        @endif

        @if($ventes)
          <x-back.box
            type='info'
            :number='$ventes'
            title='New ventes'
            route='ventes.index'
            model='vente'>
          </x-back.box>
        @endif
        
      </div>      
  </div>
@endsection