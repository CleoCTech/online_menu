<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
        <div class="col-xl-7 col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card header -->
                <div class="
                  card-header
                  align-items-center
                  card-header-height
                  d-flex
                  justify-content-between
                  align-items-center
                ">
                    <div>
                        <h4 class="mb-0">Customer Requests</h4>
                    </div>
                    <div>
                        <div class="dropdown dropstart">
                            <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fe fe-more-vertical"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="courseDropdown1">
                                <span class="dropdown-header">Settings</span>
                                <a class="dropdown-item" href="#"><i
                                        class="fe fe-external-link dropdown-item-icon"></i>Export</a>
                                <a class="dropdown-item" href="#"><i class="fe fe-mail dropdown-item-icon"></i>Email
                                    Report</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fe fe-download dropdown-item-icon"></i>Download</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- Earning chart -->
                    {!! $areaChart->container() !!}

                    <script src="{{ $areaChart->cdn() }}"></script>
                    {{ $areaChart->script() }}
                    {{-- <div id="earning" class="apex-charts"></div> --}}
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-lg-12 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card header -->
                <div class="
                  card-header
                  align-items-center
                  card-header-height
                  d-flex
                  justify-content-between
                  align-items-center
                ">
                    <div>
                        <h4 class="mb-0">Top Table Requests</h4>
                    </div>
                    <div>
                        {{-- <div class="dropdown dropstart">
                            <a class="text-muted text-decoration-none" href="#" role="button" id="courseDropdown2"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fe fe-more-vertical"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="courseDropdown2">
                                <span class="dropdown-header">Settings</span>
                                <a class="dropdown-item" href="#"><i
                                        class="fe fe-external-link dropdown-item-icon"></i>Export</a>
                                <a class="dropdown-item" href="#"><i class="fe fe-mail dropdown-item-icon"></i>Email
                                    Report</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fe fe-download dropdown-item-icon"></i>Download</a>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <!-- Card body -->
                <div class="card-body">

                    {!! $chart->container() !!}

                    <script src="{{ $chart->cdn() }}"></script>
                    {{ $chart->script() }}
                    {{-- <div id="traffic" class="apex-charts d-flex justify-content-center">

                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <style>
        .apexcharts-legend {
            /* display: none !important; */
        }
    </style>
</div>
