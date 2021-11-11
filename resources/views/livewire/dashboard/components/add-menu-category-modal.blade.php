<div>
    {{-- Success is as dangerous as failure. --}}
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
                    {{-- <div class="mb-3 col-12 col-md-6">
                        <label class="form-label" for="lname">Last Name</label>
                        <input type="text" id="lname" class="form-control" placeholder="Last Name" required />
                    </div>
                    <div class="mb-3 col-12 col-md-12">
                        <label class="form-label" for="phone">Phone Number (Optional)</label>
                        <input type="text" id="phone" class="form-control" placeholder="Phone" required />
                    </div>

                    <div class="mb-3 col-12 col-md-12">
                        <label class="form-label" for="address1">Address Line 1</label>
                        <input type="text" id="address1" class="form-control" placeholder="Address" required />
                    </div>
                    <div class="mb-3 col-12 col-md-12">
                        <label class="form-label" for="address2">Address Line 2 (Optional)</label>
                        <input type="text" id="address2" class="form-control" placeholder="Address" required />
                    </div> --}}
                </form>

            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" x-on:click = "open = false">Close</button>
        <button type="button" wire:click='store' class="btn btn-primary">Save</button>
    </div>


</div>
@push('scripts')
<script type="text/javascript">
    console.log('here im');

//js cannot work from here, it needs to be in main livewire page. --i don't know why...
    function store(){
        // Livewire.emit('store')
        console.log('here im again');
    }

</script>
@endpush
