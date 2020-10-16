<div x-data="login()">
    <form x-on:submit.prevent="login()">
        <div>
            @if (session()->has('login_successful'))
                <div class="alert alert-success bg-success text-white shadow animated fadeInUp">
                    <i class="ik ik-check"></i> Login Successful. Redirecting Shortly.
                </div>
            @endif
        </div>
        <div class="form-group">
            <input wire:model.defer="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" {{ $disabled ? 'disabled="disabled"' : '' }}>
            <i class="ik ik-user"></i>
            @include('inc.invalid-feedback', ['name' => 'email'])
        </div>
        <div class="form-group">
            <input wire:model.defer="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" {{ $disabled ? 'disabled="disabled"' : '' }}>
            <i class="ik ik-lock"></i>
            @include('inc.invalid-feedback', ['name' => 'password'])
        </div>
        <div class="row">
            <div class="col text-left">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" wire:model.defer="remember_me" class="custom-control-input" id="remember_me" {{ $disabled ? 'disabled="disabled"' :'' }}>
                    <label class="custom-control-label" for="remember_me">Remember Me</label>
                </div>
            </div>
        </div>
        <div class="sign-btn text-center">
            <button type="submit" class="btn btn-theme" wire:loading.attr="disabled" wire:target="login" {{ $disabled ? 'disabled="disabled"' : '' }}>
                <span wire:loading wire:target="login">
                    <i class="fa fa-pulse fa-spinner"></i> Signing In...
                </span>
                <span wire:loading.remove wire:target="login">
                    Sign In
                </span>
            </button>
        </div>
    </form>
</div>

@push('after_scripts')
<script>
    function login() {
        return {
            login() {
                $(document).find('.invalid-feedback').remove();
                $(document).find('.is-invalid').removeClass('is-invalid');

                @this.call('login')
            }
        }
    }

    $(function() {
        $(document).on('redirectToDashboard', function() {
             setTimeout(function() {
                 window.location.replace('{{ route("admin.dashboard") }}');
            }, 2500);
        });
    });
</script>
@endpush
