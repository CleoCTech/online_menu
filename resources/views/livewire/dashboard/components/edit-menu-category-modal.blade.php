<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="modal-body px-0">
        <div class="card mb-4">
            <!-- Card Body -->
            <div class="card-body">
                <!-- Form -->
                <form class="row">
                    <div class="mb-3 col-12 col-md-12">
                        <label class="form-label" for="fname">Category Name</label>
                        <input wire:model.defer='catName' type="text" id="fname" class="form-control @error('catName') is-invalid @enderror" placeholder="Category Name" required />
                        @error('catName') <span class="text-danger error">{{ $message }}</span>@enderror
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
