<div class="row" x-data="create()">
    <div class="col-12">
        <form action="#" x-on:submit.prevent="create()">
            <div class="form-group">
                <label>Role: <span class="text-red">*</span></label>
                <input wire:model.defer="role" type="text" class="form-control @error('role') is-invalid @enderror" placeholder="Role">
                @include('inc.invalid-feedback', ['name' => 'role'])
            </div>
            <div class="form-group mb-2">
                <label>Permissions: <span class="text-red">*</span></label>
                <div class="card card-body card-sm p-2 mb-0 shadow-none border @error('permissions') border-danger @else border-gray-500 @enderror">
                    @foreach ($stored_permissions as $p)
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" wire:model.defer="permissions" class="custom-control-input" id="create_permission_{{ $p->id }}" value="{{ $p->id }}">
                        <label class="custom-control-label" for="create_permission_{{ $p->id }}">{{ $p->module_permission }}</label>
                    </div>
                    @endforeach
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
    function create() {
        return {
            create() {
                SwalConfirm.fire({
                    text: 'Are you sure you want to create a new Permission?',
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
            @this.call('clear');
        });
    });
</script>
@endpush
