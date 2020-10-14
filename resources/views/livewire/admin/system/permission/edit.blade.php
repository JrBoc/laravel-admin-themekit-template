<div class="row" x-data="edit()">
    <div class="col-12">
        <form action="#" x-on:submit.prevent="update()">
            <div class="form-group">
                <label>Module: <span class="text-red">*</span></label>
                <input wire:model.defer="module" type="text" class="form-control @error('module') is-invalid @enderror" placeholder="Module">
                @include('inc.invalid-feedback', ['name' => 'module'])
            </div>
            <div class="form-group">
                <label>Permission: <span class="text-red">*</span></label>
                <input wire:model.defer="permission" type="text" class="form-control @error('permission') is-invalid @enderror" placeholder="Permission">
                @include('inc.invalid-feedback', ['name' => 'permission'])
            </div>
            <div class="d-flex justify-content-between">
                <button type="update" class="btn btn-outline-primary w-49">SUBMIT</button>
                <button type="button" x-on:click="clear()" class="btn btn-light w-49">CLOSE</button>
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
                    text: 'Are you sure you want to update this Permission?',
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
            }
        }
    }

    $(function () {
        $('#mdl_edit').on('hide.bs.modal', function () {
            @this.call('clear');
        });

        $('#dt_permissions').on('click', '.btn-edit', function () {
            SwalLoading.fire();

            @this.call('get', $(this).val());
        });

        $('#dt_permissions').on('click', '.btn-delete', function () {
            let id = $(this).val();

            SwalConfirm.fire({
                text: 'Are you sure you want to delete this Permission?',
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
