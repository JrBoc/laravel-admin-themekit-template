<div class="row" x-data="edit()">
    <div class="col-12">
        <form action="#" x-on:submit.prevent="update()">
            <div class="form-group">
                <label>Role: <span class="text-red">*</span></label>
                <input wire:model.defer="role_name" type="text" class="form-control @error('role_name') is-invalid @enderror" placeholder="Role" {{ !$editable ? 'disabled' : ''}}>
                @include('inc.invalid-feedback', ['name' => 'role_name'])
            </div>
            <div class="form-group mb-2">
                <label>Permissions: <span class="text-red">*</span></label>
                <div class="card card-body card-sm p-2 mb-0 shadow-none border @error('permissions') border-danger @else border-gray-500 @enderror">
                    @if($editable)
                        @foreach ($stored_permissions as $p)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" wire:model.defer="permissions" class="custom-control-input" id="edit_permission_{{ $p->id }}" value="{{ $p->id }}">
                            <label class="custom-control-label" for="edit_permission_{{ $p->id }}">{{ $p->module_permission }}</label>
                        </div>
                        @endforeach
                    @else
                        @foreach ($stored_permissions as $p)
                            @if(in_array($p->id, $permissions))
                                <label>{{ $p->module_permission }}</label>
                            @endif
                        @endforeach
                    @endif
                </div>
                @include('inc.invalid-feedback', ['name' => 'permissions'])
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
    function edit() {
        return {
            update() {
                SwalConfirm.fire({
                    text: 'Are you sure you want to update this Role?',
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

        $('#dt_roles').on('click', '.btn-view', function () {
            SwalLoading.fire();

            @this.call('get', $(this).val(), false);
        });

        $('#dt_roles').on('click', '.btn-edit', function () {
            SwalLoading.fire();

            @this.call('get', $(this).val(), true);
        });

        $('#dt_roles').on('click', '.btn-delete', function () {
            let id = $(this).val();

            SwalConfirm.fire({
                text: 'Are you sure you want to delete this Role?',
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
