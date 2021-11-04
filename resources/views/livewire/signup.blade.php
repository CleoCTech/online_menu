<div>
    {{-- The whole world belongs to you. --}}
    <!-- Page Header-->
    <div wire:loading wire:target='signup'>
        @livewire('general.loader')
    </div>
    @if ($varView == '')
    @if (session()->get('error'))
        <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
        </div>
    @endif
    <header class="
        page-header-ui page-header-ui-dark
        bg-img-repeat bg-secondary
      " style="background-image: url('assets/img/pattern-shapes.png')">
        <div class="page-header-ui-content">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-7">
                        <div class="
                  badge badge-marketing
                  rounded-pill
                  bg-secondary-soft
                  text-secondary
                  mb-3
                ">
                            Start today!
                        </div>
                        <h1 class="page-header-ui-title">
                            Lorem ipsum dolor sit amet, consectet
                        </h1>
                        <p class="page-header-ui-text">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quas illo dicta tempore sapiente
                            magnam consequatur veritatis, neque assumenda sunt veniam repellendus necessitatibus ipsa
                            inventore iste natus nemo quidem exercitationem nesciunt.
                        </p>
                    </div>
                    <div class="col-lg-5">
                        <div class="card rounded-3 text-dark">
                            <div class="card-header py-4">
                                Sign up for Online Menu
                            </div>
                            <div class="card-body">

                                    <div class="mb-3">
                                        <label class="small text-gray-600" for="userEmail">Email address</label>
                                        <input wire:model.defer='email' class="form-control" id="userEmail" type="email" />
                                        @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="small text-gray-600" for="restaurant">Restaurant</label>
                                        <input wire:model.defer='restraunt' class="form-control" id="restaurant" type="text" />
                                        @error('restraunt') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="d-grid">
                                        <button wire:click='signup' class="btn btn-primary fw-500" type="submit">
                                            Register Now
                                        </button>
                                    </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="svg-border-angled text-secondary">
            <!-- Angled SVG Border-->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none" fill="currentColor">
                <polygon points="0,100 100,0 100,100"></polygon>
            </svg>
        </div>
    </header>

    <section class="bg-white pt-10" id="about">
        <div class="container px-5">
            <div class="row gx-5">
                <div class="col-lg-8 mb-5">
                    <div class="
            badge badge-marketing
            rounded-pill
            bg-secondary-soft
            text-secondary
            mb-3
          ">
                        About Us
                    </div>
                    <h2>A better way to capture leads</h2>
                    <p class="lead">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam adipisci, assumenda molestiae
                        aperiam harum fugit, eveniet laudantium dolorem nobis minus exercitationem eius atque. Culpa
                        itaque mollitia eum quidem? Nemo, facere!
                    </p>
                </div>
            </div>
            <div class="row gx-5 mb-n10 z-1">
                <div class="col-lg-12 mb-5">Lorem ipsum dolor sit am</div>
            </div>
        </div>
        <div class="svg-border-angled text-white">
            <!-- Angled SVG Border-->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"
                fill="currentColor">
                <polygon points="0,100 100,0 100,100"></polygon>
            </svg>
        </div>
    </section>

    <section class="bg-white py-10">
        <div class="container px-lg-5">
            <!-- Page Features-->
            <div class="row gx-lg-5">
                <div class="col-lg-6 col-xxl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                    class="bi bi-collection"></i></div>
                            <h2 class="h6 text-uppercase fw-bold mb-4">Beta</h2>
                            <h2 class="h1 fw-bold">$199<span class="text-sm fw-normal ml-2">/ month</span></h2>
                            <div class="custom-separator my-4 mx-auto bg-primary"></div>
                            <p class="mb-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere
                                ipsam et
                                cumque do.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xxl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                    class="bi bi-cloud-download"></i></div>
                            <h2 class="h6 text-uppercase fw-bold mb-4">Alpha</h2>
                            <h2 class="h1 fw-bold">$199<span class="text-sm fw-normal ml-2">/ month</span></h2>
                            <div class="custom-separator my-4 mx-auto bg-primary"></div>
                            <p class="mb-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere
                                ipsam et
                                cumque do.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xxl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-4 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                    class="bi bi-card-heading"></i></div>
                            <h2 class="h6 text-uppercase fw-bold mb-4">Omega</h2>
                            <h2 class="h1 fw-bold">$199<span class="text-sm fw-normal ml-2">/ month</span></h2>
                            <div class="custom-separator my-4 mx-auto bg-primary"></div>
                            <p class="mb-0">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere
                                ipsam et
                                cumque do.
                            </p>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>

    <section class="bg-light py-10">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3 mb-md-0">
                    <img class="d-block mx-auto" src="assets/img/reviews.svg" alt="Illustration">
                </div>
                <div class="col-lg-1 d-none d-lg-block">
                    <hr class="hr-vertical mx-auto">
                </div>
                <div class="col-md-8 col-lg-7">
                    <div class="card border-0 shadow-sm">
                        <blockquote class="blockquote card-body">
                            <p>Eu&nbsp;massa, pharetra massa integer. Sed molestie sollicitudin morbi ultrices. Odio
                                is&nbsp;euismodtelle faucibus. Venenatis nunc, tristique turpis cras sodales.
                                In&nbsp;dui, viverra et&nbsp;ac. Id&nbsp;justo,
                                varius nunc, faucibus erat proin elit. Amet diam, aliquet nec quis&nbsp;vel. Donec
                                ut&nbsp;quisque in&nbsp;lorem sapien luctus pellentesque.</p>

                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-10" id="contact">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h4 class="text-primary">Ready to get started?</h4>
                    <p class="lead mb-0">Lorem ipsum dolor sit amet, consectet</p>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <a class="btn btn-transparent-dark fw-500" href="#!">Contact Us</a>
                </div>
            </div>
        </div>
    </section>
    @elseif($varView == 'feedback')
        @livewire('signup-feedback', ['link' => $email])
    @endif

</div>
