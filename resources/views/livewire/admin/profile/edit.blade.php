<div class="card" x-data="edit()">
    <div class="card-body">
        <form action="#" x-on:submit.prevent="update()">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="text-right" x-show="!editable">
                        <button type="button" class="btn btn-secondary" x-on:click="editable = true">EDIT PROFILE</button>
                    </div>
                    <div class="form-group">
                        <label>Name: {!! $editable ? '<span class="text-red">*</span>' : '' !!}</label>
                        <input wire:model.defer="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" {{ !$editable ? 'disabled="disabled"' : '' }}>
                        @include('inc.invalid-feedback', ['name' => 'name'])
                    </div>
                    <div class="form-group">
                        <label>Email: {!! $editable ? '<span class="text-red">*</span>' : '' !!}</label>
                        <input wire:model.defer="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" {{ !$editable ? 'disabled="disabled"' : '' }}>
                        @include('inc.invalid-feedback', ['name' => 'email'])
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
    function edit() {
        return {
            update() {
                if (this.editable) {
                    SwalConfirm.fire({
                        text: 'Are you sure you want to update your profile details?',
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
                @this.call('clear');
            },
            editable: @entangle('editable')
        }
    }
</script>
@endpush
