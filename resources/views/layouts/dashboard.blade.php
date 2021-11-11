<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Turn App') }}</title>

        <!-- Favicon icon-->
        {{-- <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon/favicon.ico" /> --}}

        <!-- Libs CSS -->

        <link href="{{ asset('admin-assets/assets/fonts/feather/feather.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin-assets/assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}"
            rel="stylesheet" />
        <link href="{{ asset('admin-assets/assets/libs/dragula/dist/dragula.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin-assets/assets/libs/@mdi/font/css/materialdesignicons.min.css') }}"
            rel="stylesheet" />
        <link href="{{ asset('admin-assets/assets/libs/prismjs/themes/prism.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin-assets/assets/libs/dropzone/dist/dropzone.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin-assets/assets/libs/magnific-popup/dist/magnific-popup.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin-assets/assets/libs/bootstrap-select/dist/css/bootstrap-select.min.css') }}"
            rel="stylesheet" />
        <link href="{{ asset('admin-assets/assets/libs/@yaireo/tagify/dist/tagify.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin-assets/assets/libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin-assets/assets/libs/tippy.js/dist/tippy.css') }}" rel="stylesheet" />
        <link href="{{ asset('admin-assets/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}"
            rel="stylesheet" />

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Theme CSS -->
        <link rel="stylesheet" href="{{ asset('admin-assets/assets/css/theme.min.css') }}" />
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        @livewireStyles

    </head>

    <body>


        <div id="db-wrapper">

            {{-- #navvar --}}
            @auth
            @livewire('dashboard.inc.navbar')
            @endauth

            <div id="page-content">
                @auth
                @livewire('dashboard.inc.topbar')
                @endauth

                {{ $slot }}

            </div>


            @stack('modals')

            @livewireScripts
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
            </script>
            <x-livewire-alert::scripts />

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                crossorigin="anonymous">
            </script>

            <!-- Script -->
            <!-- Libs JS -->
            <script src="{{ asset('admin-assets/assets/libs/jquery/dist/jquery.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/odometer/odometer.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js') }}">
            </script>
            <script src="{{ asset('admin-assets/assets/libs/bootstrap-select/dist/js/bootstrap-select.min.js') }}">
            </script>
            {{-- <script src="{{ asset('admin-assets/assets/libs/flatpickr/dist/flatpickr.min.js') }}" defer></script> --}}
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script src="{{ asset('admin-assets/assets/libs/inputmask/dist/jquery.inputmask.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/quill/dist/quill.min.js') }}"></script>
            <script
                src="{{ asset('admin-assets/assets/libs/file-upload-with-preview/dist/file-upload-with-preview.min.js') }}">
            </script>
            <script src="{{ asset('admin-assets/assets/libs/dragula/dist/dragula.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/bs-stepper/dist/js/bs-stepper.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/jQuery.print/jQuery.print.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/prismjs/prism.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/prismjs/components/prism-scss.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/@yaireo/tagify/dist/tagify.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/tiny-slider/dist/min/tiny-slider.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/@popperjs/core/dist/umd/popper.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/tippy.js/dist/tippy-bundle.umd.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/typed.js/lib/typed.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/jsvectormap/dist/js/jsvectormap.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('admin-assets/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}">
            </script>
            <script
                src="{{ asset('admin-assets/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
            </script>
            <script
                src="{{ asset('admin-assets/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
            </script>

            <!-- clipboard -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>
            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
            <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
            <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js" defer></script>

            <script src="{{ asset('admin-assets/assets/js/theme.min.js') }}"></script>

            @stack('scripts')


    </body>

</html>
