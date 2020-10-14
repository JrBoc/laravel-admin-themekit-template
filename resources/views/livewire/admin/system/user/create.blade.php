<div class="row" x-data="create()">
    <div class="col-12">
        <form action="#" x-on:submit.prevent="create()">
            <div class="form-group">
                <label>Name: <span class="text-red">*</span></label>
                <input wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                @include('inc.invalid-feedback', ['name' => 'name'])
            </div>
            <div class="form-group">
                <label>Email: <span class="text-red">*</span></label>
                <input wire:model.defer="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                @include('inc.invalid-feedback', ['name' => 'email'])
            </div>
            <div class="form-group">
                <label>Password: <span class="text-red">*</span></label>
                <div class="input-group mb-0">
                    <input wire:model.defer="password" :type="!showPassword ? 'password' : 'text'" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    <div class="input-group-append">
                        <button
                            type="button"
                            data-toggle="tooltip"
                            class="btn btn-light ik border border-gray-800"
                            :data-original-title="!showPassword ? 'Show' : 'Hide'"
                            :class="showPassword ? 'ik-eye-off' : 'ik-eye'"
                            x-on:click="showPassword = showPassword ? false : true"
                            tabindex="-1"
                        ></button>
                    </div>
                </div>
                @include('inc.invalid-feedback', ['name' => 'password'])
            </div>
            <div class="form-group">
                <label>Password Confirmation: <span class="text-red">*</span></label>
                <div class="input-group mb-0">
                    <input wire:model.defer="password_confirmation" :type="!showPasswordConfirmation ? 'password' : 'text'" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Password Confirmation">
                    <div class="input-group-append">
                        <button
                            type="button"
                            data-toggle="tooltip"
                            class="btn btn-light ik border border-gray-800"
                            :data-original-title="!showPasswordConfirmation ? 'Show' : 'Hide'"
                            :class="showPasswordConfirmation ? 'ik-eye-off' : 'ik-eye'"
                            x-on:click="showPasswordConfirmation = showPasswordConfirmation ? false : true"
                            tabindex="-1"
                        ></button>
                    </div>
                </div>
            </div>
            <div class="form-group mb-2">
                <label>Roles: <span class="text-red">*</span></label>
                <div class="card card-body card-sm p-2 mb-0 shadow-none border @error('roles') border-danger @else border-gray-500 @enderror">
                    @foreach ($stored_roles as $r)
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" wire:model.defer="roles" class="custom-control-input" id="create_user_{{ $r->id }}" value="{{ $r->id }}">
                        <label class="custom-control-label" for="create_user_{{ $r->id }}">{{ $r->name }}</label>
                    </div>
                    @endforeach
                </div>
                @include('inc.invalid-feedback', ['name' => 'roles'])
            </div>
            <div class="form-group">
                <label>Status: <span class="text-red">*</span></label>
                <select wire:model.defer="status" class="form-control @error('status') is-invalid @enderror">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                @include('inc.invalid-feedback', ['name' => 'status'])
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-outline-primary" style="width: 49%">SUBMIT</button>
                <button type="button" x-on:click="clear()" class="btn btn-light" style="width: 49%">CLOSE</button>
            </div>
        </form>
    </div>
</div>

@push('after_scripts')
<script>
    function create() {
        return {
            showPassword: false,
            showPasswordConfirmation: false,
            create() {
                SwalConfirm.fire({
                    text: 'Are you sure you want to create a new User?',
                    preConfirm: function (choice) {
                        if (choice) {
                            @this.call('create');
                        }
                        return choice;
                    },
                }).then(function (choice) {
                    if (choice.value) {
                        SwalLoading.fire();
                    }
                });
            },
            clear() {
                $('#mdl_create').modal('hide');
            }
        }
    }

    $(function () {
        $('#mdl_create').on('hide.bs.modal', function () {
            $(this).find('[x-data]')[0].__x.$data.showPassword = false;
            $(this).find('[x-data]')[0].__x.$data.showPasswordConfirmation = false;

            @this.call('clear');
        });
    });
</script>
@endpush
