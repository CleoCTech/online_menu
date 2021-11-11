<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="modal-body px-0">
        <div class="card mb-4">
            <!-- Card Body -->
            <div class="card-body">
                <!-- Form -->
                <form class="row">
                    <div class="mb-3 col-12 col-md-12">
                        <label class="form-label" for="fname">Table Name</label>
                        <input wire:model.defer='tableName' type="text" id="fname" class="form-control @error('tableName') is-invalid @enderror " placeholder="Table Name" required />
                        @error('tableName') <span class="text-danger error">{{ $message }}</span>@enderror

                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" x-on:click = "open = false">Close</button>
        <button type="button" wire:click='store' class="btn btn-primary">Save</button>
    </div>
</div>
