@extends('back.layout') 

@section('main')

  <div class="card">
    <h5 class="card-header">Vente
      <span class="badge badge-secondary">{{ $vente->reference }}</span> 
      <span class="badge badge-secondary">N° {{ $vente->id }}</span>
    </h5>
    <h5 class="card-header">Numero Facture
        <span class="badge badge-primary"><a href="" style="color: #fff"> {{ $vente->invoice_number }}</a></span> 
    </h5>
    <div class="card-body">
      
      <div class="card">
        <h5 class="card-header">Produits</h5>
        <div class="card-body">
          @foreach ($vente->products as $item)
            <br>
            <div class="row">
              <div class="col m6 s12">
                {{ $item->name }} ({{ $item->quantity }} @if($item->quantity > 1) exemplaires) @else exemplaire) @endif
              </div>
              
            </div>
          @endforeach
          <hr><br>
          
          <br>
          
          
          
        </div>
      </div>
      
    </div>
  </div>

  <div class="card">
    <h5 class="card-header">User : 
    <a href="{{ route('ventes.show', $vente->user->id) }}"><span class="badge badge-primary">{{ $vente->user->name }}</span></a>  
      <span class="badge badge-secondary">N° {{ $vente->user->id }}</span>
    </h5>
    <div class="card-body">
      <div class="card">
        <div class="card-body">
          <dl class="row">  
            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9"><a href="mailto:{{ $vente->user->email }}">{{ $vente->user->email }}</a></dd>      
            <dt class="col-sm-3 text-truncate">Date d'inscription</dt>
            <dd class="col-sm-9">{{ $vente->user->created_at->format('d/m/Y') }}</dd>
            <dt class="col-sm-3 text-truncate">Ventes validées</dt>
           
          </dl>
        </div>
      </div>
    </div>
  </div>

@endsection