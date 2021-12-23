<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div wire:loading >
        @livewire('general.loader')
    </div>
    <div class="container-fluid p-4">
        <!-- Page header -->
        @livewire('dashboard.home.components.page-haeder',
        ['title' => 'Customer Requests',
        'rightActionBtn' => 'Go to Dashboard',
        'rightBtnClass' => 'btn btn-primary',
        'pageThread' => true,
        'getModal' => false,
        'nextPage' => 'dashboard',
        'pageTitle' => '',
        'icon' => true,
        'threads' => ['Admin', 'Table Requests', 'List' => 'All']])
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
                                        aria-controls="approved" aria-selected="false">Successful</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pending-tab" data-bs-toggle="pill" href="#pending" role="tab"
                                        aria-controls="pending" aria-selected="false">Unsuccessful
                                    </a>
                                </li>
                                <li class="nav-item" style="margin-left: 29.5rem;">
                                    <div x-data="{ show: false }" class="dropdown xl:ml-auto mt-1 xl:mt-0 float-right">
                                        <button @click="show = !show"  class="dropdown-toggle btn btn-outline-secondary font-normal" aria-expanded="false"> Filter by Table
                                        </button>
                                        <ul  @click="show = !show"  :class="{ 'show': show }" class=" dropdown-menu w-40" aria-labelledby="dropdownMenuButton1">
                                            @foreach ($tables as $table)
                                            <li wire:click="filter('{{ $table->code }}')"><a class="dropdown-item" href="#">{{ $table->code }}</a></li>
                                            @endforeach
                                        </ul>

                                    </div>
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
                            <input wire:model="searchTerm" type="search" class="form-control ps-6" placeholder="Search By Table Code" />
                        </form>
                        <h2 class="fw-bold mb-1">  {{ $count }}
                            @if ($count == 1)
                               Record
                           @elseif ($count == 0)
                                No records found
                            @else
                                Records
                           @endif
                        </h2>
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
                                                    Table Code
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Ip Address
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Device
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Mac Address
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    OS
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Browser
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Screen Resolution
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Status
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($requests as $item)
                                            <tr>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">#{{ $item->table_code }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->ip_address }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->device_type }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->mac_address }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->os }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->browser }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->screen_resolution }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    @if ($item->status == 'Successful')
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Successful
                                                    </label>
                                                    @else
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Unsuccesful
                                                    </label>
                                                    @endif
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
                                                    Table Code
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Ip Address
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Device
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Mac Address
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    OS
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Browser
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Screen Resolution
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Status
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($requests as $item)
                                            @if ($item->status == 'Successful')
                                            <tr>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">#{{ $item->table_code }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->ip_address }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->device_type }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->mac_address }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->os }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->browser }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->screen_resolution }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    @if ($item->status == 'Successful')
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Successful
                                                    </label>
                                                    @else
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Unsuccesful
                                                    </label>
                                                    @endif
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
                                                    Table Code
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Ip Address
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Device
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Mac Address
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    OS
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Browser
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Screen Resolution
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    Status
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($requests as $item)
                                            @if ($item->status == 'Unsuccessful')
                                            <tr>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">#{{ $item->table_code }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->ip_address }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->device_type }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->mac_address }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->os }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->browser }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <div class="d-flex align-items-center">
                                                        <h5 class="mb-0">{{ $item->screen_resolution }}</h5>
                                                    </div>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    @if ($item->status == 'Successful')
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Successful
                                                    </label>
                                                    @else
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Unsuccesful
                                                    </label>
                                                    @endif
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
                    {{ $requests->links('components.pagination-links') }}
                    {{-- {{ $events->links() }} --}}
                </div>
            </div>
        </div>
    </div>

    <style>
        .show {
            display: block !important;
        }

    </style>

</div>
