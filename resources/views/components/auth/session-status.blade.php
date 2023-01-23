@props(['status'])

@if ($status)
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><span class="icon fa fa-{{ $icon }}"></span>{{ $status}}</h5>
    </div>
@endif



