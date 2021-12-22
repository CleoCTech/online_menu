<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div wire:loading >
        @livewire('general.loader')
    </div>
    <div class="container-fluid p-4">
        <!-- Page header -->
        @livewire('dashboard.home.components.page-haeder',
        ['title' => 'Menu',
        'rightActionBtn' => 'Add Menu',
        'rightBtnClass' => 'btn btn-primary',
        'pageThread' => false,
        'getModal' => false,
        'nextPage' => 'create-dish',
        'pageTitle' => '',
        'icon' => true,
        'threads' => []])
        <!-- Page header End -->

        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Card -->
                <div class="card rounded-3">
                    <!-- Card header -->
                    <div class="card-header border-bottom-0 p-0 bg-white">
                        <div>
                            <!-- Nav -->
                            <ul class="nav nav-lb-tab" id="tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="courses-tab" data-bs-toggle="pill" href="#courses" role="tab"
                                        aria-controls="courses" aria-selected="true">All</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="approved-tab" data-bs-toggle="pill" href="#approved" role="tab"
                                        aria-controls="approved" aria-selected="false">Active</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pending-tab" data-bs-toggle="pill" href="#pending" role="tab"
                                        aria-controls="pending" aria-selected="false">Inactive
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="p-4 row">
                        <!-- Form -->
                        <form class="d-flex align-items-center col-12 col-md-12 col-lg-12">
                            <span class="position-absolute ps-3 search-icon">
                                <i class="fe fe-search"></i>
                            </span>
                            <input type="search" class="form-control ps-6" placeholder="Search Events" />
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
                                                    Name
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Menu Category
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Group Category
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    STATUS
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Frozen
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Allergenes
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    MORE
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    ACTION
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dishes as $item)
                                            <tr>
                                                <td class="border-top-0">
                                                    <a href="#" class="text-inherit">
                                                        <div class="d-lg-flex align-items-center">
                                                            <div>
                                                                <img src="/storage/public/{{ $resDetails->code }}/{{ $item->folder }}/{{ $item->filename }}" alt=""
                                                                    class="img-4by3-lg rounded" />
                                                            </div>
                                                            <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                <h4 class="mb-1 text-primary-hover">
                                                                    {{ $item->name }}
                                                                </h4>
                                                                <span class="text-inherit">Added on {{ date('d M y', strtotime($item->updated_at))}}</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        {{-- <img src="{{ Avatar::create($item->owner )->toBase64() }}" alt=""
                                                            class="rounded-circle avatar-xs me-2" /> --}}
                                                        <h5 class="mb-0">{{ $item->menuCategory->name }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        {{-- <img src="{{ Avatar::create($item->owner )->toBase64() }}" alt=""
                                                            class="rounded-circle avatar-xs me-2" /> --}}
                                                        <h5 class="mb-0">{{ $item->dishCategory->name }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    @if ($item->status == "Inactive")
                                                    <span class="badge-dot  bg-warning me-1 d-inline-block align-middle "></span>Inactive
                                                    @elseif($item->status == "Active")
                                                    <span class="badge-dot  bg-success me-1 d-inline-block align-middle "></span>Active
                                                    @endif

                                                </td>
                                                <td class="align-middle border-top-0">
                                                    @if ($item->frozen)
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                       Yes
                                                    </label>
                                                    @else
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        No
                                                    </label>
                                                        {{-- <input wire:click='frozen' wire:model.defer='frozen' class="form-check-input" type="checkbox" value=""> --}}
                                                    @endif
                                                    {{-- <a wire:click='show({{ $item->id }})'  href="#" class="btn btn-outline-primary btn-sm">View</a> --}}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    @if ($item->allergnes)
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                       Yes
                                                    </label>
                                                    @else
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        No
                                                    </label>
                                                        {{-- <input wire:click='frozen' wire:model.defer='frozen' class="form-check-input" type="checkbox" value=""> --}}
                                                    @endif
                                                    {{-- <a wire:click='show({{ $item->id }})'  href="#" class="btn btn-outline-primary btn-sm">View</a> --}}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <a wire:click='show({{ $item->id }})'  href="#" class="btn btn-outline-primary btn-sm">View</a>
                                                </td>

                                                <td class="align-middle border-top-0">
                                                    @if ($item->status == "Inactive")
                                                    <a wire:click='activate({{ $item->id }})' href="#" class="btn btn-outline-success btn-sm">Activate</a>
                                                    @elseif($item->status == "Active")
                                                    <a wire:click='deactivate({{ $item->id }})' href="#" class="btn btn-outline-warning btn-sm ">Deactivate</a>
                                                    @endif
                                                    <a wire:click='delete({{ $item->id }})' href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                                                </td>

                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--Tab pane -->
                            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                                <div class="table-responsive border-0 overflow-y-hidden">
                                    <table class="table mb-0 text-nowrap">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Name
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Menu Category
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Group Category
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    STATUS
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Frozen
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Allergenes
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    MORE
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    ACTION
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dishes as $item)
                                            @if ($item->status == 'Active')
                                            <tr>
                                                <td class="border-top-0">
                                                    <a href="#" class="text-inherit">
                                                        <div class="d-lg-flex align-items-center">
                                                            <div>
                                                                <img src="/storage/public/{{ $resDetails->code }}/{{ $item->folder }}/{{ $item->filename }}" alt=""
                                                                    class="img-4by3-lg rounded" />
                                                            </div>
                                                            <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                <h4 class="mb-1 text-primary-hover">
                                                                    {{ $item->name }}
                                                                </h4>
                                                                <span class="text-inherit">Added on {{ date('d M y', strtotime($item->updated_at))}}</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        {{-- <img src="{{ Avatar::create($item->owner )->toBase64() }}" alt=""
                                                            class="rounded-circle avatar-xs me-2" /> --}}
                                                        <h5 class="mb-0">{{ $item->menuCategory->name }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        {{-- <img src="{{ Avatar::create($item->owner )->toBase64() }}" alt=""
                                                            class="rounded-circle avatar-xs me-2" /> --}}
                                                        <h5 class="mb-0">{{ $item->dishCategory->name }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    @if ($item->status == "Inactive")
                                                    <span class="badge-dot  bg-warning me-1 d-inline-block align-middle "></span>Inactive
                                                    @elseif($item->status == "Active")
                                                    <span class="badge-dot  bg-success me-1 d-inline-block align-middle "></span>Active
                                                    @endif

                                                </td>
                                                <td class="align-middle border-top-0">
                                                    @if ($item->frozen)
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                       Yes
                                                    </label>
                                                    @else
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        No
                                                    </label>
                                                        {{-- <input wire:click='frozen' wire:model.defer='frozen' class="form-check-input" type="checkbox" value=""> --}}
                                                    @endif
                                                    {{-- <a wire:click='show({{ $item->id }})'  href="#" class="btn btn-outline-primary btn-sm">View</a> --}}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    @if ($item->allergnes)
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                       Yes
                                                    </label>
                                                    @else
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        No
                                                    </label>
                                                        {{-- <input wire:click='frozen' wire:model.defer='frozen' class="form-check-input" type="checkbox" value=""> --}}
                                                    @endif
                                                    {{-- <a wire:click='show({{ $item->id }})'  href="#" class="btn btn-outline-primary btn-sm">View</a> --}}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <a wire:click='show({{ $item->id }})'  href="#" class="btn btn-outline-primary btn-sm">View</a>
                                                </td>

                                                <td class="align-middle border-top-0">
                                                    @if ($item->status == "Inactive")
                                                    <a wire:click='activate({{ $item->id }})' href="#" class="btn btn-outline-success btn-sm">Activate</a>
                                                    @elseif($item->status == "Active")
                                                    <a wire:click='deactivate({{ $item->id }})' href="#" class="btn btn-outline-warning btn-sm ">Deactivate</a>
                                                    @endif
                                                    <a wire:click='delete({{ $item->id }})' href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                                                </td>

                                            </tr>
                                            @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!--Tab pane -->
                            <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                <div class="table-responsive border-0 overflow-y-hidden">
                                    <table class="table mb-0 text-nowrap">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Name
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Menu Category
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Group Category
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    STATUS
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Frozen
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Allergenes
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    MORE
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    ACTION
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dishes as $item)
                                            @if ($item->status == 'Inactive')
                                            <tr>
                                                <td class="border-top-0">
                                                    <a href="#" class="text-inherit">
                                                        <div class="d-lg-flex align-items-center">
                                                            <div>
                                                                <img src="/storage/public/{{ $resDetails->code }}/{{ $item->folder }}/{{ $item->filename }}" alt=""
                                                                    class="img-4by3-lg rounded" />
                                                            </div>
                                                            <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                <h4 class="mb-1 text-primary-hover">
                                                                    {{ $item->name }}
                                                                </h4>
                                                                <span class="text-inherit">Added on {{ date('d M y', strtotime($item->updated_at))}}</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        {{-- <img src="{{ Avatar::create($item->owner )->toBase64() }}" alt=""
                                                            class="rounded-circle avatar-xs me-2" /> --}}
                                                        <h5 class="mb-0">{{ $item->menuCategory->name }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        {{-- <img src="{{ Avatar::create($item->owner )->toBase64() }}" alt=""
                                                            class="rounded-circle avatar-xs me-2" /> --}}
                                                        <h5 class="mb-0">{{ $item->dishCategory->name }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    @if ($item->status == "Inactive")
                                                    <span class="badge-dot  bg-warning me-1 d-inline-block align-middle "></span>Inactive
                                                    @elseif($item->status == "Active")
                                                    <span class="badge-dot  bg-success me-1 d-inline-block align-middle "></span>Active
                                                    @endif

                                                </td>
                                                <td class="align-middle border-top-0">
                                                    @if ($item->frozen)
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                       Yes
                                                    </label>
                                                    @else
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        No
                                                    </label>
                                                        {{-- <input wire:click='frozen' wire:model.defer='frozen' class="form-check-input" type="checkbox" value=""> --}}
                                                    @endif
                                                    {{-- <a wire:click='show({{ $item->id }})'  href="#" class="btn btn-outline-primary btn-sm">View</a> --}}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    @if ($item->allergnes)
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                       Yes
                                                    </label>
                                                    @else
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        No
                                                    </label>
                                                        {{-- <input wire:click='frozen' wire:model.defer='frozen' class="form-check-input" type="checkbox" value=""> --}}
                                                    @endif
                                                    {{-- <a wire:click='show({{ $item->id }})'  href="#" class="btn btn-outline-primary btn-sm">View</a> --}}
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <a wire:click='show({{ $item->id }})'  href="#" class="btn btn-outline-primary btn-sm">View</a>
                                                </td>

                                                <td class="align-middle border-top-0">
                                                    @if ($item->status == "Inactive")
                                                    <a wire:click='activate({{ $item->id }})' href="#" class="btn btn-outline-success btn-sm">Activate</a>
                                                    @elseif($item->status == "Active")
                                                    <a wire:click='deactivate({{ $item->id }})' href="#" class="btn btn-outline-warning btn-sm ">Deactivate</a>
                                                    @endif
                                                    <a wire:click='delete({{ $item->id }})' href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                                                </td>

                                            </tr>
                                            @endif
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Footer -->
                    {{ $dishes->links('components.pagination-links') }}
                    {{-- {{ $events->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
