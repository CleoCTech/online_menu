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
                        @error('category') <span class="text-danger error">{{ $message }}</span>@enderror

                    </div>
                </form>

            </div>
            <div>
                <!-- Table -->
                <div class="tab-content" id="tabContent">
                    <!--Tab pane -->
                    <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                        <div class="table-responsive border-0 overflow-y-hidden">
                            <table class="table mb-0 text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="border-0 text-uppercase">
                                            #
                                        </th>
                                        <th scope="col" class="border-0 text-uppercase">
                                            Name
                                        </th>
                                        <th scope="col" class="border-0 text-uppercase">
                                            ACTION
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count($categories) >0)
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach ($categories as $item)
                                        <tr>
                                            <td class="border-top-0">
                                                <a href="#" class="text-inherit">
                                                    <div class="d-lg-flex align-items-start" style="margin-left: -1rem;">
                                                        <div class="ms-lg-3 mt-2 mt-lg-0">
                                                            <h6 class="mb-1 text-primary-hover">
                                                                {{ $i }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="border-top-0">
                                                <a href="#" class="text-inherit">
                                                    <div class="d-lg-flex align-items-start" style="margin-left: -1rem;">
                                                        <div class="ms-lg-3 mt-2 mt-lg-0">
                                                            <h6 class="mb-1 text-primary-hover">
                                                                {{ $item->name }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                            <td class="align-middle border-top-0">
                                                <a wire:click='delete({{ $item->id }})' href="#" class="btn btn-outline-danger btn-sm" style="font-size: 0.575rem !important;">Delete</a>
                                            </td>
                                        </tr>
                                        @php
                                            $i=$i+1;
                                        @endphp
                                        @endforeach
                                    @else
                                    <tr>
                                        <h2 class="text-muted">No records found</h2>
                                    </tr>
                                    @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{ $categories->links('components.pagination-links') }}
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
