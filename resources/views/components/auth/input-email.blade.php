@props(['email' => ''])
<div class="input-group mb-3">
    <input  id="email" 
        type="email" 
        name="email"
        placeholder="@lang('Enter your email')"
        :value="{{ old('email', $email) }}" 
        required 
        autofocus 
        class="form-control" 
        placeholder="@lang('Email')">
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-envelope"></span>
        </div>
    </div>
</div>
