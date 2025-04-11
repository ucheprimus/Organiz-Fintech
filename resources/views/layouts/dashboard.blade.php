<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from preview.cruip.com/cubiq/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Nov 2024 06:14:40 GMT -->

<head>
    <meta charset="utf-8">
    <title>Mosaic HTML Demo - Home</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="/dashboard/css/vendors/flatpickr.min.css" rel="stylesheet">
    <link href="/dashboard/style.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <style>
        /* Basic flexbox layout for row */
        .input-row {
            display: flex;
            margin-bottom: 10px;
            justify-content: space-between;
            gap: 15px;
            /* Space between the input fields */
        }

        /* Each input container */
        .input-container {
            display: flex;
            align-items: center;
            position: relative;
            /* To position the icon inside */
            width: 100%;
        }

        /* Styling input fields */
        .input-field {
            flex: 1;
            padding-left: 30px;
            /* Make space for the icon */
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Icon inside input field */
        .icon {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
        }

        .icon-svg {
            width: 16px;
            height: 16px;
        }

        /* Make the layout responsive (stack inputs on smaller screens) */
        @media (max-width: 768px) {
            .input-row {
                flex-direction: column;
                /* Stack inputs vertically */
                gap: 8px;
                /* Reduced gap between stacked inputs */
            }

            .input-container {
                width: 100%;
                margin-bottom: 8px;
                /* Reduced margin between stacked inputs */
            }
        }
    </style>

    <style>
        /* Styling input fields */
        .input-field {
            flex: 1;
            /* Ensures the input field takes up all available space */
            padding-left: 30px;
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            /* Ensures full width */
        }

        /* Tooltip container */
        .tooltip-container {
            position: relative;
            display: inline-block;
            width: 100%;
            /* Make the tooltip container take up full width */
        }

        /* Keep the tooltip styling the same */
        .tooltip-text {
            visibility: hidden;
            background-color: #2b6bf5;
            color: #fff;
            text-align: center;
            border-radius: 4px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            /* Position above the input */
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip-text::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555555 transparent transparent transparent;
        }

        .tooltip-container:hover .tooltip-text,
        .tooltip-container input:focus+.tooltip-text {
            visibility: visible;
            opacity: 1;
        }
    </style>

    <script>
        if (localStorage.getItem('dark-mode') === 'false' || !('dark-mode' in localStorage)) {
            document.querySelector('html').classList.remove('dark');
            document.querySelector('html').style.colorScheme = 'light';
        } else {
            document.querySelector('html').classList.add('dark');
            document.querySelector('html').style.colorScheme = 'dark';
        }
    </script>
    <script defer data-domain='preview.cruip.com,rollup.cruip.com' src='/dashboard/plausible.cruip.com/js/script.js'>
    </script>
</head>

<body class="dark:text-slate-400 c8dhd cv09y cuuxo ce8n9 cpjyd" :class="{ 'sidebar-expanded': sidebarExpanded }"
    x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }" x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))">

    <script>
        if (localStorage.getItem('sidebar-expanded') == 'true') {
            document.querySelector('body').classList.add('sidebar-expanded');
        } else {
            document.querySelector('body').classList.remove('sidebar-expanded');
        }
    </script>

    <!-- Page wrapper -->
    <div class="flex cwyww ckbiy">

        @include('includes.dashboard_sidebar')

        <!-- Content area -->
        <div class="flex cbdnv cbdfh clvvc czs6d cqjbg">

            @include('includes.header_dashboard')

            <main class="ci6ev">
                <div class="cb8uw ce79r cyoj0 ck1uz ccet9 cw15p cdnix">

                    <!-- Welcome banner -->
                    <div class="rounded-sm cmu01 cwyww czl7n clvvc cutme czy2i cj19a">

                        <!-- Background illustration -->
                        <div class="pointer-events-none hidden c0h79 cbey6 co2jl c0j1l cgybn cto89" aria-hidden="true">
                            <svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs>
                                    <path id="welcome-a" d="M64 0l64 128-64-20-64 20z"></path>
                                    <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z"></path>
                                    <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z"></path>
                                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%"
                                        id="welcome-b">
                                        <stop stop-color="#A5B4FC" offset="0%"></stop>
                                        <stop stop-color="#818CF8" offset="100%"></stop>
                                    </linearGradient>
                                    <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%"
                                        id="welcome-c">
                                        <stop stop-color="#4338CA" offset="0%"></stop>
                                        <stop stop-color="#6366F1" stop-opacity="0" offset="100%"></stop>
                                    </linearGradient>
                                </defs>
                                <g fill="none" fill-rule="evenodd">
                                    <g transform="rotate(64 36.592 105.604)">
                                        <mask id="welcome-d" fill="#fff">
                                            <use xlink:href="#welcome-a"></use>
                                        </mask>
                                        <use fill="url(#welcome-b)" xlink:href="#welcome-a"></use>
                                        <path fill="url(#welcome-c)" mask="url(#welcome-d)" d="M64-24h80v152H64z">
                                        </path>
                                    </g>
                                    <g transform="rotate(-51 91.324 -105.372)">
                                        <mask id="welcome-f" fill="#fff">
                                            <use xlink:href="#welcome-e"></use>
                                        </mask>
                                        <use fill="url(#welcome-b)" xlink:href="#welcome-e"></use>
                                        <path fill="url(#welcome-c)" mask="url(#welcome-f)"
                                            d="M40.333-15.147h50v95h-50z"></path>
                                    </g>
                                    <g transform="rotate(44 61.546 392.623)">
                                        <mask id="welcome-h" fill="#fff">
                                            <use xlink:href="#welcome-g"></use>
                                        </mask>
                                        <use fill="url(#welcome-b)" xlink:href="#welcome-g"></use>
                                        <path fill="url(#welcome-c)" mask="url(#welcome-h)"
                                            d="M40.333-15.147h50v95h-50z"></path>
                                    </g>
                                </g>
                            </svg>
                        </div>



                        <!-- Content -->
                        <div class="clvvc">

                            <h1 class="text-slate-800 dark:text-slate-100 font-bold coif1 cm58s cz85d">

                                @if (Auth::check())
                                    Good day, {{ Auth::user()->name }} 👋
                                @else
                                    <script>
                                        // Optional: redirect to login
                                        window.location.href = "{{ route('login') }}";
                                    </script>
                                @endif

                            </h1>

                            <p class="cveja">Here is what’s happening between us Today</p>
                        </div>

                    </div>



                    <!-- Dashboard actions -->




                    @if (session('success') || session('error'))
                        <div id="messageContainer" class="d-flex justify-content-center align-items-center"
                            style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: rgba(255, 255, 255, 0.95); z-index: 1000; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">

                            <div
                                style="background: {{ session('error') ? 'red' : 'white' }}; padding: 2rem; border-radius: 20px; text-align: center;
                    max-width: 500px; width: 90%; box-shadow: 0 0 20px rgba(0,0,0,0.1); position: relative;">
                                <div style="font-size: 2rem; color: {{ session('error') ? 'white' : 'green' }};">
                                    {{ session('error') ? '❌' : '✅' }}
                                </div>
                                <h2
                                    style="margin-top: 1rem; font-weight: 700; font-size: 1.8rem; color: {{ session('error') ? 'white' : 'black' }};">
                                    {{ session('error') ? 'Error!' : 'Success!' }}
                                </h2>
                                <p style="margin-top: 0.5rem; color: {{ session('error') ? 'white' : '#333' }};">
                                    {{ session('error') ? session('error') : session('success') }}
                                </p>
                                <a href="{{ url()->previous() }}" class="btn btn-dark mt-3">Back</a>
                            </div>
                        </div>

                        {{-- Confetti for success only --}}
                        @if (session('success'))
                            <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
                            <script>
                                const duration = 2 * 1000;
                                const animationEnd = Date.now() + duration;
                                const defaults = {
                                    startVelocity: 30,
                                    spread: 360,
                                    ticks: 60,
                                    zIndex: 2000
                                };

                                function randomInRange(min, max) {
                                    return Math.random() * (max - min) + min;
                                }

                                const interval = setInterval(function() {
                                    const timeLeft = animationEnd - Date.now();
                                    if (timeLeft <= 0) {
                                        clearInterval(interval);
                                    }

                                    const particleCount = 50 * (timeLeft / duration);
                                    confetti(Object.assign({}, defaults, {
                                        particleCount,
                                        origin: {
                                            x: randomInRange(0.1, 0.9),
                                            y: Math.random() - 0.2
                                        }
                                    }));
                                }, 250);
                            </script>
                        @endif

                        <!-- Auto-close the message after 4 seconds -->
                        <script>
                            window.onload = function() {
                                setTimeout(() => {
                                    const container = document.getElementById('messageContainer');
                                    if (container) {
                                        container.style.display = 'none'; // Hide the message container after 4 seconds
                                    }
                                }, 3000); // 4 seconds delay
                            }
                        </script>
                    @endif

                    @yield('content')

                </div>
            </main>

        </div>

    </div>

    <script src="/dashboard/js/vendors/alpinejs.min.js" defer=""></script>
    <script src="/dashboard/js/main.js"></script>
    <script src="/dashboard/js/vendors/chart.js"></script>
    <script src="/dashboard/js/vendors/moment.js"></script>
    <script src="/dashboard/js/vendors/chartjs-adapter-moment.js"></script>
    <script src="/dashboard/js/dashboard-charts.js"></script>
    <script src="/dashboard/js/vendors/flatpickr.js"></script>
    <script src="/dashboard/js/flatpickr-init.js"></script>




    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>



    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>


</body>
<!-- Mirrored from preview.cruip.com/cubiq/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Nov 2024 06:14:43 GMT -->

</html>
