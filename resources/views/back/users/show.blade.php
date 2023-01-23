@extends('back.layout')

@section('main') 
  <div class="card">
    <h5 class="card-header">Identité</h5>
    <div class="card-body">
      <dl class="row">
        <dt class="col-sm-3">Nom</dt>
        <dd class="col-sm-9">{{ $user->name }}</dd>           
        <dt class="col-sm-3">Email</dt>
        <dd class="col-sm-9"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></dd>      
        <dt class="col-sm-3 text-truncate">Date d'inscription</dt>
        <dd class="col-sm-9">{{ $user->created_at->format('d/m/Y') }}</dd>
        <dt class="col-sm-3 text-truncate">Dernière mise à jour</dt>
        <dd class="col-sm-9">{{ $user->updated_at->format('d/m/Y') }}</dd>
        <dt class="col-sm-3 text-truncate">Rôle</dt>
        <dd class="col-sm-9">{{ $user->role }}</dd>        
      </dl>
    </div>
  </div>

  

  @if($user->orders->isNotEmpty())
    <div class="card">
      <h5 class="card-header">Commandes</h5>
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Référence</th>
              <th>Date</th>
              <th>Fournisseur</th>
              <th></th>
            </tr>
          </thead>    
          <tbody>
              @foreach($user->orders as $order)
              <tr>
                <td>{{ $order->reference }}</td>
                <td>{{ $order->created_at->calendar() }}</td>
                <td>{{ $order->fournisseur->name }}</td>
                <td style="text-align: center"><a href="{{ route('commandes.show', $order->id) }}" class="btn btn-primary btn-sm">Voir</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  @endif


  <div class="form-group row mb-0">
    <div class="col-md-12">
      <a class="btn btn-primary" href="{{ route('users.index') }}" role="button"><i class="fas fa-arrow-left"></i> Retour à la liste des clients</a>    
    </div>
  </div><br>

@endsection