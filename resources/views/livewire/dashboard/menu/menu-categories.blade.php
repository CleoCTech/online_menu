<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div wire:loading >
        @livewire('general.loader')
    </div>
    <div class="container-fluid p-4">
        <!-- Page header -->
        @livewire('dashboard.home.components.page-haeder',
        ['title' => 'Menu Categories',
        'rightActionBtn' => 'Add Menu Category',
        'rightBtnClass' => 'btn btn-primary',
        'pageThread' => true,
        'getModal' => true,
        'nextPage' => 'dashboard.components.add-menu-category-modal',
        'pageTitle' => 'Add Menu Category',
        'icon' => true,
        'threads' => ['Admin', 'Menu Categories', 'Active' => 'All']])
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
                            <input wire:model="searchTerm" type="search" class="form-control ps-6" placeholder="Search Events" />
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
                                                    STATUS
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    More
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    ACTION
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if (count($menulist) >0)
                                                @php
                                                    $i=1;
                                                @endphp
                                                @foreach ($menulist as $item)

                                                <tr>
                                                    <td class="border-top-0">
                                                        <a href="#" class="text-inherit">
                                                            <div class="d-lg-flex align-items-center">
                                                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                    <h4 class="mb-1 text-primary-hover">
                                                                        {{ $i }}
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="border-top-0">
                                                        <a href="#" class="text-inherit">
                                                            <div class="d-lg-flex align-items-center">
                                                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                    <h4 class="mb-1 text-primary-hover">
                                                                        {{ $item->name }}
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        @if ($item->status == 0)
                                                        <span class="badge-dot  bg-warning me-1 d-inline-block align-middle "></span>Inactive
                                                        @elseif($item->status == 1)
                                                        <span class="badge-dot  bg-success me-1 d-inline-block align-middle "></span>Active
                                                        @endif

                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <a x-on:click="$dispatch('dlg-modal'); $wire.openModal('dashboard.components.edit-menu-category-modal', 'Edit Menu Category', '{{ $item->id }}')"  href="#" class="btn btn-outline-primary btn-sm">Eidt</a>
                                                    </td>

                                                    <td class="align-middle border-top-0">
                                                        @if ($item->status == 0)
                                                        <a wire:click="activate('{{ $item->id }}')" href="#" class="btn btn-outline-success btn-sm">Activate</a>
                                                        @elseif($item->status == 1)
                                                        <a wire:click="deactivate('{{ $item->id }}')" href="#" class="btn btn-outline-warning btn-sm">Deactivate</a>

                                                        @endif
                                                        <a wire:click="delete('{{ $item->id }}')" href="#" class="btn btn-outline-danger btn-sm">Delete</a>
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
                            <!--Tab pane -->
                            <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
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
                                                    STATUS
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    More
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    ACTION
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($menulist) >0)
                                            @php
                                                $i=1;
                                            @endphp
                                            @foreach ($menulist as $item)
                                            @if ($item->status == 1)

                                            <tr>
                                                <td class="border-top-0">
                                                    <a href="#" class="text-inherit">
                                                        <div class="d-lg-flex align-items-center">
                                                            <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                <h4 class="mb-1 text-primary-hover">
                                                                    {{ $i }}
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="border-top-0">
                                                    <a href="#" class="text-inherit">
                                                        <div class="d-lg-flex align-items-center">
                                                            <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                <h4 class="mb-1 text-primary-hover">
                                                                    {{ $item->name }}
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td class="align-middle border-top-0">
                                                    @if ($item->status == 0)
                                                    <span class="badge-dot  bg-warning me-1 d-inline-block align-middle "></span>Inactive
                                                    @elseif($item->status == 1)
                                                    <span class="badge-dot  bg-success me-1 d-inline-block align-middle "></span>Active
                                                    @endif

                                                </td>
                                                <td class="align-middle border-top-0">
                                                    <a x-on:click="$dispatch('dlg-modal'); $wire.openModal('dashboard.components.edit-menu-category-modal', 'Edit Menu Category', '{{ $item->id }}')"  href="#" class="btn btn-outline-primary btn-sm">Eidt</a>
                                                </td>

                                                <td class="align-middle border-top-0">
                                                    @if ($item->status == 0)
                                                    <a wire:click='activate({{ $item->id }})' href="#" class="btn btn-outline-success btn-sm">Activate</a>
                                                    @elseif($item->status == 1)
                                                    <a wire:click='deactivate({{ $item->id }})' href="#" class="btn btn-outline-warning btn-sm">Deactivate</a>

                                                    @endif
                                                    <a wire:click='delete({{ $item->id }})' href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                            @php
                                                $i=$i+1;
                                            @endphp
                                            @endif
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
                            <!--Tab pane -->
                            <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
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
                                                    STATUS
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    More
                                                </th>
                                                <th scope="col" class="border-0 text-uppercase">
                                                    ACTION
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @if (count($menulist) >0)
                                            @php
                                                $i=1;
                                            @endphp
                                            @foreach ($menulist as $item)
                                                @if ($item->status == 0)

                                                <tr>
                                                    <td class="border-top-0">
                                                        <a href="#" class="text-inherit">
                                                            <div class="d-lg-flex align-items-center">
                                                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                    <h4 class="mb-1 text-primary-hover">
                                                                        {{ $i }}
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="border-top-0">
                                                        <a href="#" class="text-inherit">
                                                            <div class="d-lg-flex align-items-center">
                                                                <div class="ms-lg-3 mt-2 mt-lg-0">
                                                                    <h4 class="mb-1 text-primary-hover">
                                                                        {{ $item->name }}
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        @if ($item->status == 0)
                                                        <span class="badge-dot  bg-warning me-1 d-inline-block align-middle "></span>Inactive
                                                        @elseif($item->status == 1)
                                                        <span class="badge-dot  bg-success me-1 d-inline-block align-middle "></span>Active
                                                        @endif

                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <a x-on:click="$dispatch('dlg-modal'); $wire.openModal('dashboard.components.edit-menu-category-modal', 'Edit Menu Category', '{{ $item->id }}')"  href="#" class="btn btn-outline-primary btn-sm">Edit</a>
                                                    </td>

                                                    <td class="align-middle border-top-0">
                                                        @if ($item->status == 0)
                                                        <a wire:click='activate({{ $item->id }})' href="#" class="btn btn-outline-success btn-sm">Activate</a>
                                                        @elseif($item->status == 1)
                                                        <a wire:click='deactivate({{ $item->id }})' href="#" class="btn btn-outline-warning btn-sm">Deactivate</a>

                                                        @endif
                                                        <a wire:click='delete({{ $item->id }})' href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                                                    </td>
                                                </tr>
                                                @php
                                                    $i=$i+1;
                                                @endphp
                                                @endif
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
                    <!-- Card Footer -->
                    {{ $menulist->links('components.pagination-links') }}
                </div>
            </div>
        </div>
    </div>
</div>
