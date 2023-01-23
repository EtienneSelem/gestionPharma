@extends('back.layout')

@section('main')

  <div class="card">
    <h5 class="card-header">Commande
      <span class="badge badge-secondary">{{ $order->reference }}</span>
      <span class="badge badge-secondary">N° {{ $order->id }}</span>
    </h5>
    <div class="card-body">

      <div class="card">
        <h5 class="card-header">Produits</h5>
        <div class="card-body">
          @foreach ($order->products as $item)
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
    <a href="{{ route('commandes.show', $order->user->id) }}"><span class="badge badge-primary">{{ $order->user->name }}</span></a>
      <span class="badge badge-secondary">N° {{ $order->user->id }}</span>
    </h5>
    <div class="card-body">
      <div class="card">
        <div class="card-body">
          <dl class="row">
            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9"><a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a></dd>
            <dt class="col-sm-3 text-truncate">Date d'inscription</dt>
            <dd class="col-sm-9">{{ $order->user->created_at->format('d/m/Y') }}</dd>
            <dt class="col-sm-3 text-truncate">Commandes validées</dt>

          </dl>
        </div>
      </div>
    </div>
  </div>

@endsection
