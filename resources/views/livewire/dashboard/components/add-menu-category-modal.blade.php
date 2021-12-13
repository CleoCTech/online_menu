<div>

    {{--  <x-modal wire:model="show" :pageTitle="$pageTitle" :list="$list" >
        <div class="pt-4">
            <!-- Form -->
            <form class="row">
                <div class="mb-3 col-12 col-md-12">
                    <label class="form-label" for="fname">Category Name</label>
                    <input wire:model.defer='catName' type="text" id="fname" class="form-control @error('tableName') is-invalid @enderror" placeholder="Category Name" required />
                    @error('catName') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
            </form>

        </div>

    </x-modal>  --}}
    <div class="modal-body px-0">
        <div class="card mb-4">
            <!-- Card Body -->
            <div class="card-body">
                <!-- Form -->
                <form class="row">
                    <div class="mb-3 col-12 col-md-12">
                        <label class="form-label" for="fname">Category Name</label>
                        <input wire:model.defer='catName' type="text" id="fname" class="form-control @error('tableName') is-invalid @enderror" placeholder="Category Name" required />
                        @error('catName') <span class="text-danger error">{{ $message }}</span>@enderror
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

