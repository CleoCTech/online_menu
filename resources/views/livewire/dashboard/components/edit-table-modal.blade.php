<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="modal-body px-0">
        <div class="card mb-4">
            <!-- Card Body -->
            <div class="card-body">
                <!-- Form -->
                <form class="row">
                    <div class="mb-3 col-12 col-md-12">
                        <label class="form-label" for="fname">Table Name</label>
                        <input wire:change='onChange()' wire:model.defer='tableName' type="text" id="fname" class="form-control @error('tableName') is-invalid @enderror" placeholder="Table Name" required />
                        @error('tableName') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-3 col-12 col-md-12">
                        <label class="form-label" for="fname">Code</label>
                        <input wire:model.defer='code' type="text" id="fname" class="form-control @error('code') is-invalid @enderror" placeholder="Code" required />
                        @error('code') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" x-on:click = "open = false">Close</button>
        <button type="button" wire:click='store' class="btn btn-primary">Update</button>
    </div>
</div>
