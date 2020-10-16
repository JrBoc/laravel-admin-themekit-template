<div class="card" x-data="password()" id="card_password">
    <div class="card-body">
        <form action="#" x-on:submit.prevent="update()">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="text-right" x-show="!editable">
                        <button type="button" class="btn btn-secondary" x-on:click="editable = true">EDIT PASSWORD</button>
                    </div>
                    <div class="form-group">
                        <label>Current Password: {!! $editable ? '<span class="text-red">*</span>' : '' !!}</label>
                        <div class="input-group mb-0">
                            <input
                                wire:model.defer="current_password"
                                :type="!showCurrentPassword ? 'password' : 'text'"
                                class="form-control @error('current_password') is-invalid @enderror"
                                placeholder="Current Password"
                                {{ !$editable ? 'disabled="disabled"' : '' }}
                                >
                            <div class="input-group-append">
                                <button
                                    type="button"
                                    data-toggle="tooltip"
                                    class="btn btn-light ik border border-gray-800"
                                    :data-original-title="!showCurrentPassword ? 'Show' : 'Hide'"
                                    :class="showCurrentPassword ? 'ik-eye-off' : 'ik-eye'"
                                    x-on:click="showCurrentPassword = showCurrentPassword ? false : true"
                                    tabindex="-1"
                                    {{ !$editable ? 'disabled="disabled"' : '' }}
                                ></button>
                            </div>
                        </div>
                        @include('inc.invalid-feedback', ['name' => 'current_password'])
                    </div>
                    <div class="form-group">
                        <label>New Password: {!! $editable ? '<span class="text-red">*</span>' : '' !!}</label>
                        <div class="input-group mb-0">
                            <input
                                wire:model.defer="new_password"
                                :type="!showNewPassword ? 'password' : 'text'"
                                class="form-control @error('new_password') is-invalid @enderror"
                                placeholder="New Password"
                                {{ !$editable ? 'disabled="disabled"' : '' }}
                                >
                            <div class="input-group-append">
                                <button
                                    type="button"
                                    data-toggle="tooltip"
                                    class="btn btn-light ik border border-gray-800"
                                    :data-original-title="!showNewPassword ? 'Show' : 'Hide'"
                                    :class="showNewPassword ? 'ik-eye-off' : 'ik-eye'"
                                    x-on:click="showNewPassword = showNewPassword ? false : true"
                                    tabindex="-1"
                                    {{ !$editable ? 'disabled="disabled"' : '' }}
                                ></button>
                            </div>
                        </div>
                        @include('inc.invalid-feedback', ['name' => 'new_password'])
                    </div>
                    <div class="form-group">
                        <label>New Password Confirmation: {!! $editable ? '<span class="text-red">*</span>' : '' !!}</label>
                        <div class="input-group mb-0">
                            <input
                                wire:model.defer="new_password_confirmation"
                                :type="!showNewPasswordConfirmation ? 'password' : 'text'"
                                class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                placeholder="New Password Confirmation"
                                {{ !$editable ? 'disabled="disabled"' : '' }}
                                >
                            <div class="input-group-append">
                                <button
                                    type="button"
                                    data-toggle="tooltip"
                                    class="btn btn-light ik border border-gray-800"
                                    :data-original-title="!showNewPasswordConfirmation ? 'Show' : 'Hide'"
                                    :class="showNewPasswordConfirmation ? 'ik-eye-off' : 'ik-eye'"
                                    x-on:click="showNewPasswordConfirmation = showNewPasswordConfirmation ? false : true"
                                    tabindex="-1"
                                    {{ !$editable ? 'disabled="disabled"' : '' }}
                                ></button>
                            </div>
                        </div>
                        @include('inc.invalid-feedback', ['name' => 'new_password_confirmation'])
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" x-show="editable" class="btn btn-outline-primary w-49" style="display: none" {{ $editable ? 'disabled="disabled"' : '' }}>SUBMIT</button>
                        <button type="button" x-show="editable" x-on:click="clear()" class="btn btn-light w-49" style="display: none" {{ $editable ? 'disabled="disabled"' : '' }}>CANCEL</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('after_scripts')
<script>
    function password() {
        return {
            update() {
                if (this.editable) {
                    SwalConfirm.fire({
                        text: 'Are you sure you want to update your password?',
                        preConfirm: function (choice) {
                            if (choice) {
                                @this.call('update');
                            }
                            return choice;
                        },
                    }).then(function (choice) {
                        if (choice.value) {
                            SwalLoading.fire();
                        }
                    });
                }
            },
            clear() {
                this.showCurrentPassword = false,
                this.showNewPassword = false,
                this.showNewPasswordConfirmation = false,

                @this.call('clear');
            },
            showCurrentPassword: false,
            showNewPassword: false,
            showNewPasswordConfirmation: false,
            editable: @entangle('editable')
        }
    }

    $(function() {
        $('#card_password').on('clear', function() {
            $(this).find('[x-data]')[0].__x.$data.showCurrentPassword = false;
            $(this).find('[x-data]')[0].__x.$data.showNewPassword = false;
            $(this).find('[x-data]')[0].__x.$data.showNewPasswordConfirmation = false;
        })
    })
</script>
@endpush
