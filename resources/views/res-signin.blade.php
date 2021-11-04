<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="favicon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.1/font/bootstrap-icons.css">

</head>
<body>
    <div id="layoutDefault" class="bg-secondary">
        <div id="layoutDefault_content">

                <header class=" h-100
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
                                        Sign in
                                    </div>
                                    <div class="card-body">
                                        <form action="">
                                            <div class="mb-3">
                                                <label class="small text-gray-600" for="userEmail">Email address</label>
                                                <input class="form-control" id="userEmail" type="email" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small text-gray-600" for="restaurant">Password</label>
                                                <input class="form-control" id="restaurant" type="password" />
                                            </div>
                                            <div class="d-grid">
                                                <button class="btn btn-primary fw-500" type="submit">
                                                    Signin
                                                </button>
                                            </div>
                                        </form>
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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js " crossorigin="anonymous "></script>
    <script src="{{ asset('assets/js/scripts.js ') }}"></script>

</body>
</html>
