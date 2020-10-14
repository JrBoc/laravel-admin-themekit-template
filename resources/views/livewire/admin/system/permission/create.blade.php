<div class="row" x-data="create()">
    <div class="col-12">
        <form action="#" x-on:submit.prevent="create()">
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
