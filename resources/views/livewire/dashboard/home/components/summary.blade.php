<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body">
                    <div class="
                d-flex
                align-items-center
                justify-content-between
                mb-3
                lh-1
              ">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">All Requests</span>
                        </div>
                        <div>
                            <span class="fe fe-shopping-bag fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1"> {{ $requests }}</h2>
                    <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+{{ $todayRequests }}</span>
                    <span class="ms-1 fw-medium">New requests today</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body">
                    <div class="
                d-flex
                align-items-center
                justify-content-between
                mb-3
                lh-1
              ">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">Dishes / Drinks</span>
                        </div>
                        <div>
                            <span class="fe fe-calendar fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $dishes }}</h2>
                    <span class="text-danger fw-semi-bold">{{ $activeDishes }}+</span>
                    <span class="ms-1 fw-medium">Active Dishes</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body">
                    <div class="
                d-flex
                align-items-center
                justify-content-between
                mb-3
                lh-1
              ">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">Orders</span>
                        </div>
                        <div>
                            <span class="fe fe-credit-card fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">0</h2>
                    <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+0</span>
                    <span class="ms-1 fw-medium">New Orders</span>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-12 col-12">
            <!-- Card -->
            <div class="card mb-4">
                <!-- Card body -->
                <div class="card-body">
                    <div class="
                d-flex
                align-items-center
                justify-content-between
                mb-3
                lh-1
              ">
                        <div>
                            <span class="fs-6 text-uppercase fw-semi-bold">Tables</span>
                        </div>
                        <div>
                            <span class="fe fe-credit-card fs-3 text-primary"></span>
                        </div>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $tables }}</h2>
                    <span class="text-success fw-semi-bold"><i class="fe fe-trending-up me-1"></i>+{{ $activeTables }}</span>
                    <span class="ms-1 fw-medium">Service/Active Tables</span>
                </div>
            </div>
        </div>
    </div>
</div>
