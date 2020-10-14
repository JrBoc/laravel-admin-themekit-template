<div class="row" x-data="edit()">
    <div class="col-12">
        <form action="#" x-on:submit.prevent="update()">
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
            <div class="form-group mb-2">
                <label>Roles: <span class="text-red">*</span></label>
                <div class="card card-body card-sm p-2 mb-0 shadow-none border @error('roles') border-danger @else border-gray-500 @enderror">
                    @if($editable)
                        @foreach ($stored_roles as $r)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" wire:model.defer="roles" class="custom-control-input" id="edit_user_{{ $r->id }}" value="{{ $r->id }}">
                            <label class="custom-control-label" for="edit_user_{{ $r->id }}">{{ $r->name }}</label>
                        </div>
                        @endforeach
                    @else
                        @foreach ($stored_roles as $r)
                            @if(in_array($r->id, $roles))
                                <label>{{ $r->name }}</label>
                            @endif
                        @endforeach
                    @endif
                </div>
                @include('inc.invalid-feedback', ['name' => 'roles'])
            </div>
            <div class="form-group">
                <label>Status: {!! $editable ? '<span class="text-red">*</span>' : '' !!}</label>
                <select wire:model.defer="status" class="form-control @error('status') is-invalid @enderror" {{ !$editable ? 'disabled="disabled"' : '' }}>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                @include('inc.invalid-feedback', ['name' => 'status'])
            </div>
            <div class="d-flex justify-content-between">
                <button type="button" x-show="editable" x-on:click="update()" class="btn btn-outline-primary w-49">SUBMIT</button>
                <button type="button" x-on:click="clear()" :class="editable ? 'w-49' : 'btn-block'" class="btn btn-light">CLOSE</button>
            </div>
        </form>
    </div>
</div>

@push('after_scripts')
<script>
    function edit() {
        return {
            update() {
                SwalConfirm.fire({
                    text: 'Are you sure you want to update this User?',
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
            },
            clear() {
                $('#mdl_edit').modal('hide');
            },
            editable: @entangle('editable')
        }
    }

    $(function () {
        $('#mdl_edit').on('hide.bs.modal', function () {
            @this.call('clear');
        });

        $('#dt_users').on('click', '.btn-view', function () {
            SwalLoading.fire();

            @this.call('get', $(this).val(), false);
        });

        $('#dt_users').on('click', '.btn-edit', function () {
            SwalLoading.fire();

            @this.call('get', $(this).val(), true);
        });

        $('#dt_users').on('click', '.btn-delete', function () {
            let id = $(this).val();

            SwalConfirm.fire({
                text: 'Are you sure you want to delete this User?',
                preConfirm: function (choice) {
                    if (choice) {
                        @this.call('destroy', id);
                    }
                    return choice;
                }
            }).then(function (choice) {
                if (choice.value) {
                    SwalLoading.fire();
                }
            });
        });
    });

</script>
@endpush
