<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="modal-body px-0">
        <div class="card mb-4">
            <!-- Card Body -->
            <div class="card-body">
                <!-- Form -->
                <form class="row">
                    <div class="mb-3 col-12 col-md-12">
                        <label class="form-label" for="category">Category Name</label>
                        <input wire:model.defer='category' type="text" id="category" class="form-control @error('category') is-invalid @enderror " placeholder="Category Name" required />
                        {{-- @error('category') <span class="text-danger error">{{ $message }}</span>@enderror --}}

                    </div>
                </form>

            </div>

        </div>
    </div>
    <div class="modal-footer p-0">
        <button type="button" class="btn btn-secondary btn-sm" x-on:click = "open = false">Close</button>
        <button type="button" wire:click='store' class="btn btn-primary btn-sm">Save</button>
    </div>

    <style>
        .page-link{
            font-size: x-small !important;
        }
    </style>
</div>
