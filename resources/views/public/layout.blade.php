<?php
   use App\Models\Web\Identitas;

   $identitas = Identitas::find(1);
 ?>
<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- Display -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Identity -->
    <title>{{ $title . ' | ' ?? '' }}{{ $identitas->name }}</title>
    <meta name="description" content="{{ $title }}">
    <meta name="description" content="{{ $identitas->name }}">
    <meta name="author" content="Codings">
    <link rel="shortcut icon" href="{{ asset('/img/identitas/'.$identitas->favicon) }}" type="image/x-icon" />

    <!-- Vendor Style Sheet -->
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/vendor/preloader.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/vendor/font-family.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/vendor/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/vendor/menu-engine.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/vendor/menu-grid.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/vendor/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/vendor/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/vendor/dynamic-slider.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/vendor/bricklayer.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/vendor/lightbox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/vendor/aos.min.css') }}" />

    <!-- Main Style Sheet -->
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('public_assets/assets/css/main.css') }}" />
    @livewireStyles
    @stack('styles')
    @livewireScripts
</head>

<body class="shock-body">

    <!-- Preloader -->
    <div id="preloader" class="preloader white" data-delay="0" data-limit="3000">
        <img src="{{ asset('public_assets/assets/images/logo-gradient.svg') }}" class="emblem" alt="Emblem" />
    </div>

    <!-- Header -->
    @livewire('public.component.header')

    <!-- Main -->
    {{ $slot }}

    <!-- Scroll to Top -->
    <div class="side-widget to-right invert-color mix-blend-difference">
        <div class="item align-v-bottom">
            <a href="#" class="link hover-up">
                <span class="widget float-icon">
                    <i class="fa-solid fa-arrow-up-long icon"></i>
                </span>
            </a>
        </div>
    </div>

    <!-- Footer -->
    @livewire('public.component.footer')

    <!-- Cursor -->
    <svg class="cursor-effect primary" width="220" height="220" viewBox="0 0 220 220">
        <defs>
            <filter id="cursor-effect-filter" x="-50%" y="-50%" width="200%" height="200%"
                filterUnits="objectBoundingBox">
                <feTurbulence type="fractalNoise" baseFrequency="0" numOctaves="1" result="warp"></feTurbulence>
                <feOffset dx="-30" result="warpOffset"></feOffset>
                <feDisplacementMap xChannelSelector="R" yChannelSelector="G" scale="20" in="SourceGraphic"
                    in2="warpOffset"></feDisplacementMap>
            </filter>
        </defs>
        <circle class="cursor-effect-inner" cx="110" cy="110" r="20"></circle>
    </svg>

    <!-- Vendor JavaScript -->
    <script src="{{ asset('public_assets/assets/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/preloader.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/inview.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/menu-engine.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/menu-grid.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/swiper.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/anime.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/dynamic-slider.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/shuffle.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/stickybits.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/bricklayer.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/lightbox.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/typed.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/progressbar.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/map-styles.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/magnetic-effect.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/gsap.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/aos.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/lax.min.js') }}"></script>
    <script src="{{ asset('public_assets/assets/js/vendor/cursor-effect.min.js') }}"></script>

    <!-- Main JavaScript -->
    <script src="{{ asset('public_assets/assets/js/main.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('plugins/sweetalert/sweatalert2@11') }}"></script>
    <script src="{{ asset('plugins/sweetalert/toastr.min.js') }}"></script>
    <script>
        const SwalModal = (icon, title, html) => {
            Swal.fire({
                icon,
                title,
                html
            })
        }

        const SwalConfirm = (icon, title, html, confirmButtonText, method, params, callback) => {
            Swal.fire({
                icon,
                title,
                html,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText,
                reverseButtons: true,
            }).then(result => {
                if (result.value) {
                    return livewire.emit(method, params)
                }

                if (callback) {
                    return livewire.emit(callback)
                }
            })
        }

        const SwalAlert = (icon, title, text, timeout = 1000) => {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: timeout,
                timerProgressBar: true,
                showCloseButton: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                icon,
                title,
                text,
            })
        }

        document.addEventListener('DOMContentLoaded', () => {
            this.livewire.on('swal:modal', data => {
                SwalModal(data.icon, data.title, data.text)
            })

            this.livewire.on('swal:confirm', data => {
                SwalConfirm(data.icon, data.title, data.text, data.confirmText, data.method, data
                    .params,
                    data.callback)
            })

            this.livewire.on('swal:alert', data => {
                SwalAlert(data.icon, data.title, data.text, data.timeout)
            })
        });

    </script>
    @stack('script')
</body>

</html>
