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
                <section class="page-header-ui page-header-ui-dark bg-img-repeat bg-secondary" id="about" style="background-image: url({{asset('assets/img/pattern-shapes.png')}}) ">
                    <div class="container px-5">
                        <div class="row gx-5 d-flex justify-content-center align-items-center">
                            <div class="col-lg-6 mb-5">
                                <div class="card rounded-3 text-dark">
                                    <div class="card-header py-4 text-center fw-bold text-uppercase">
                                        {{ __('Reset Password') }}
                                    </div>
                                    <div class="card-body">
                                        {{-- @isset($url)
                                        {!!Form::open(['method'=>'POST', 'action'=>'{{ url("login/$url") }}', 'autocomplete'=>'off'])!!}
                                        @else
                                        {!!Form::open(['method'=>'POST', 'action'=>"{{ route('login')) }}", 'autocomplete'=>'off'])!!}
                                        @endisset --}}
                                        @isset($url)
                                        <form method="POST" action='{{ url("$url") }}' aria-label="{{ __('Reset Password') }}">
                                        @else
                                        <form method="POST" action="{{ route('password.update') }}" aria-label="{{ __('Reset Password') }}">
                                        @endisset
                                        @csrf

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <input type="hidden" name="token" value="{{ $token }}">

                                            <div class="mb-3">
                                                <label class="small text-gray-600" for="userEmail">Email address</label>
                                                <input name="email" value="{{ $email }}" class="form-control" id="userEmail"
                                                    type="email" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small text-gray-600" for="password">Password</label>
                                                <input name='password' class="form-control" id="password"
                                                    type="password" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small text-gray-600" for="password">Confirm Password</label>
                                                <input name='password_confirmation' class="form-control" id="password"
                                                    type="password" />
                                            </div>
                                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                                <div></div> <a href="{{ route('restraunt-signin') }}" class="text-primary">Sign In Instead?</a>
                                            </div>
                                            <div class="d-grid">
                                                <button  class="btn btn-primary fw-500"
                                                    type="submit">
                                                    Reset Password
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js "
            crossorigin="anonymous "></script>
        <script src="{{ asset('assets/js/scripts.js ') }}"></script>

    </body>

</html>
