@props([
    'outline' => true, 
    'type', 
    'title', 
])

<div class="card @if($outline) card-outline @endif card-{{ $type }}">
    @if($title)
      <div class="card-header">
          <h3 class="card-title">{{ __($title) }}</h3>
          <div class="card-tools pull-right">
              <button 
                  type="button" 
                  class="btn btn-tool" 
                  data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
              </button>
          </div>
      </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>