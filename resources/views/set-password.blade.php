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
    <div id="" class="bg-white">
        <div id="">

            <main>
                <section class="bg-white pt-10" id="about">
                    <div class="container px-5">
                        <div class="row gx-5 d-flex justify-content-center align-items-center">
                            <div class="col-lg-6 mb-5">
                                <div class="card rounded-3 text-dark">
                                    <div class="card-header py-4 text-center fw-bold text-uppercase">
                                        Set a Password
                                    </div>
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @if (session()->get('error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session()->get('error') }}
                                            </div>
                                        @endif
                                        {!!Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\VerifyEmailController@verify', $token], 'autocomplete'=>'off'])!!}
                                        @csrf
                                            <div class="mb-3">
                                                <label class="small text-gray-600" for="password">Password</label>
                                                <input class="form-control" id="password" name="password" type="password" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="small text-gray-600" for="confirm_password">Confirm Password</label>
                                                <input class="form-control" id="confirm_password" name="confirm_password" type="password" type="password"/>
                                            </div>
                                            <div class="d-grid">
                                                <button class="btn btn-primary fw-500" type="submit">
                                                    Save Password
                                                </button>
                                            </div>
                                        {!!Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js " crossorigin="anonymous "></script>
    <script src="{{ asset('assets/js/scripts.js ') }}"></script>

</body>
</html>
