<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div wire:loading wire:target="store">
        @livewire('general.loader')
    </div>
    <div class="container-fluid p-4">
        <!-- Page header -->
        @livewire('dashboard.home.components.page-haeder',
        ['title' => 'Edit Dish/Drink',
        'rightActionBtn' => 'Back',
        'rightBtnClass' => 'btn btn-primary',
        'pageThread' => true,
        'getModal' => false,
        'nextPage' => 'menu-list',
        'pageTitle' => '',
        'icon' => true,
        'threads' => ['Admin', 'Edit Dish', 'Active' => 'Edit']])
        <!-- Page header End -->
        <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-12 col-12">
                <!-- Card -->
                <div class="card border-0 mb-4">
                    <!-- Card header -->
                    <div class="card-header">
                        <h4 class="mb-0">Edit Dish</h4>
                    </div>
                    <!-- Card body -->
                    <div class="card-body">
                        <div class="mb-4">
                            <h4 class="text-muted">
                                <i class="fe fe-info"></i> Dish Details
                            </h4>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <!-- Title -->
                                <label for="evntOwnerName" class="form-label">Dish Name<span
                                        class="text-danger">*</span></label>
                                <input wire:model.defer='dish_name' type="text" id="evntOwnerName"
                                    class="form-control text-dark"
                                    placeholder="Dish Name" />
                                @error('dish_name') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Menu Category
                                    <span class="text-danger">*</span></label>
                                <select wire:model.defer='menu_category_id' class="form-control" id="" data-width="100%">

                                    @foreach ($menuCategories as $menuCategory)
                                    @if($menuCategory->id == $menu_category_id)
                                    <option value="{{ $menuCategory->id }}" selected>{{ $menuCategory->name }}
                                    </option>
                                    @else
                                    <option value="{{ $menuCategory->id }}">{{ $menuCategory->name }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                                @error('menu_category_id') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Dish Category
                                    <span class="text-danger">*</span></label>
                                <select wire:model.defer='dish_category_id' class="form-control" id="" data-width="100%">
                                    <option selected disabled>Select Dish Category</option>
                                    @foreach ($dishCategories as $dishCategory)
                                    <option value="{{ $dishCategory->id }}">{{ $dishCategory->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('dish_category_id') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="my-4">
                            <h4 class="text-muted">
                                <i class="fe fe-info"></i> Price Details
                            </h4>
                        </div>
                        @foreach ($inputs as $key => $value)
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Price Category
                                    <span class="text-danger">*</span></label>
                                <input wire:model="pCatgeoriesIds.{{ $key }}" type="hidden">
                                <input wire:model="pCatgeories.{{ $key }}" type="text" id="evntOwnerName"
                                class="form-control text-dark" />
                                @error('pCatgeories.{{ $key }}') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Price
                                    <span class="text-danger">*</span></label>
                                <input wire:model.defer='prices.{{ $key }}' type="number" id="evntOwnerName"
                                class="form-control text-dark" />
                                @error('prices.{{ $key }}') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        @endforeach
                        <button x-on:click="$dispatch('dlg-modal');$wire.openModal('dashboard.components.add-price-category-modal', 'Add Price Category')" class="btn btn-primary btn-sm">Add New Price Category</button>
                        <div class="my-4">
                            <h4 class="text-muted">
                                <i class="fe fe-info"></i> Other Details
                            </h4>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="Image" class="form-label">Current Image</label>
                            {{-- <img style="max-height: 218px; max-width: 153px;"
                            src="/storage/event_flyers/{{$recent_post->cover_image}}"
                            class="img-fluid"> --}}
                            <img src="/storage/public/{{ $restaurantName->code }}/{{ $folder }}/{{ $filename }}" alt="" srcset="" class="image-fluid " alt="poster" style="width:100%">
                        </div>

                        <div class="row" x-data="{}">

                            <div wire:ignore class="mb-3 col-md-12">
                                <p class="alert alert-warning">Warning!. Uploading another image will delete the current image.</p>
                                <label for="evntPoster" class="form-label">Image <span
                                        class="text-danger">*</span></label>
                                <form action="#" class="dropzone mt-4 border-dashed">
                                    @csrf
                                    <div class="fallback">
                                        <input class="filepond--root" type="file" name="paperFile" id="test">
                                    </div>
                                </form>

                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-0 ml-1 form-check" style="margin-left: 1rem;">
                                    <input wire:click='frozen' wire:model.defer='frozen' class="form-check-input" type="checkbox" value="">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Frozen?
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-1 form-check" style="margin-left: 1rem;">
                                    <input wire:click='containAllergenes' wire:model.defer='containsAllergene'  class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Contains Allergenes?
                                    </label>
                                </div>
                            </div>
                            @if ($containsAllergene)
                            <div class="row" style="margin-left:1rem;">
                                <div class="mb-3 col-md-12">
                                    <label class="form-label">Check the allergenes in the box
                                        <span class="text-danger">*</span></label>
                                    <ul class="list-inline border border-2 border-primary">
                                        @foreach ($allergenes as $item)
                                        <li class="list-inline-item">
                                            <input id="allergene.{{ $item->id }}" wire:model='allergenesBucket.{{ $item->id }}'
                                             class="form-check-input" type="checkbox" checked
                                             >
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{ $item->name }}
                                            </label>
                                        </li>
                                        @endforeach

                                    </ul>
                                    <button x-on:click="$dispatch('dlg-modal');$wire.openModal('dashboard.components.add-allergene-modal', 'Add Allergenes')" class="btn btn-primary btn-sm">Add New Allergene</button>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <button wire:click='store' type="submit" class="btn w-full btn-primary">
                                        Update
                                    </button>
                                </div>
                            </div>
                            {{--  <div class="row">
                                <div class="col-md-12">
                                    <button wire:click='test' type="submit" class="btn w-full btn-primary">
                                        Test
                                    </button>
                                </div>
                            </div>  --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        var UPLOAD_FILES;
        const inputElement = document.querySelector('input[id="test"]');

        FilePond.registerPlugin(FilePondPluginImagePreview);
        const pond = FilePond.create( inputElement );

        FilePond.setOptions({
            allowReplace: true,
            acceptedFileTypes: 'image/jpeg, image/png',
            server: {
                process: {
                    url: '/upload',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    onload: (response) => {
                        this.UPLOAD_FILES = response;
                        // this.UPLOAD_FILES.push(response)
                    }, // saving response in global array
                },
            },

        });
    </script>
    <script>

        $("document").ready(function() {
            window.livewire.emit('getactualdishAllergnes');

        })

        window.addEventListener('allergnes-updated', event => {
            var dishAllergnes = event.detail.actualdishAllergnes;

            dishAllergnes.forEach((item, index)=>{
                var element = document.getElementById('allergene.' + item);
                element.click();
            })
            // $("#allergene.1").ready(function() {
            //     console.log('ready2');

            //     var element = document.getElementById('allergene.1');
            //     element.click();
            // });

        })

         const filepond_root = document.querySelector('.filepond--root');
         filepond_root.addEventListener('FilePond:processfilerevert', e => {
            $.ajax({
                url: "/destroy",
                type: 'POST',
                data : {"_token":"{{ csrf_token() }}", "UPLOAD_FILES": this.UPLOAD_FILES}  //pass the CSRF_TOKEN()
                // data: {'_token': '{{!! csrf_token() !!}}', 'UPLOAD_FILES': this.UPLOAD_FILES}
            })
         });

         window.addEventListener('resetFields', event => {
            // Dispatch the event.
            const btn = document.querySelector('.filepond--action-revert-item-processing');
            btn.click();
            console.log('created new');
        })
    </script>
</div>
