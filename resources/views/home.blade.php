@extends('layouts.dashboard')

@section('content')
<div class="cm65h c02a0 c8clx czy2i">

    

    <!-- Button that triggers the modal -->

    <!-- Add card link -->
    <a href="/loan_apply" class="btn cskjj cdjfl ccesj">
        <i class="fas fa-plus-circle"></i>

        <span class="cxohy cu2yz">Get a Loan</span>
    </a>


</div>

<!-- Cards -->
<div class="cw6jo cx0d7 cbze2">

    <!-- Line chart (Acme Plus) -->
    <div
        class="flex bg-white dark:bg-slate-800 rounded-sm border border-slate-200 dark:border-slate-700 cjre0 cwfr0 cae04 cvli5 czs6d">
        <div class="c3xi1 cbqel">
            <header class="flex cvu2h c8u10 c40sv">
                <!-- Icon -->
                <img src="/dashboard/images/icon-01.svg" width="32" height="32"
                    alt="Icon 01">
                <!-- Menu button -->
                <div class="inline-flex clvvc" x-data="{ open: false }">
                    <button class="rounded-full"
                        :class="open ? 'cuuxo c1v5y text-slate-500 dark:cqxhh' : 'cqxhh c0fgd cnwxp cziw9'"
                        aria-haspopup="true" @click.prevent="open = !open"
                        :aria-expanded="open">
                        <span class="cdw74">Menu</span>
                        <svg class="cjvls c5h61 cfowt" viewBox="0 0 32 32">
                            <circle cx="16" cy="16" r="2"></circle>
                            <circle cx="10" cy="16" r="2"></circle>
                            <circle cx="22" cy="16" r="2"></circle>
                        </svg>
                    </button>
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded c8g8w cwyww cvli5 cbey6 cfanx cuv0v co2jl cqczs c0tsw ctyk8"
                        @click.outside="open = false" @keydown.escape.window="open = false"
                        x-show="open" x-transition:enter="cbfn0 cjiz2 c3gpz cpugh"
                        x-transition:enter-start="opacity-0 c5ct0"
                        x-transition:enter-end="c04b9 cnt9w"
                        x-transition:leave="cbfn0 cjiz2 c3gpz" x-transition:leave-start="c04b9"
                        x-transition:leave-end="opacity-0" x-cloak="">
                        <ul>
                            <li>
                                <a class="text-sm flex cv3ih cux48 cj0iv cv09y cmg0a ck4vb ca4t4"
                                    href="#0" @click="open = false" @focus="open = true"
                                    @focusout="open = false">Option 1</a>
                            </li>
                            <li>
                                <a class="text-sm flex cv3ih cux48 cj0iv cv09y cmg0a ck4vb ca4t4"
                                    href="#0" @click="open = false" @focus="open = true"
                                    @focusout="open = false">Option 2</a>
                            </li>
                            <li>
                                <a class="text-sm flex crf5p c5plz cmg0a ck4vb ca4t4"
                                    href="#0" @click="open = false" @focus="open = true"
                                    @focusout="open = false">Remove</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <h2 class="text-slate-800 dark:text-slate-100 cxs1s cksqm c40sv">Your Borrowed
                transaction</h2>
            <div class="cnwxp cqxhh cxs1s c7akw cgoct cz85d">Sales</div>
            <div class="flex c8u10">
                <div class="text-3xl font-bold text-slate-800 dark:text-slate-100 mr-2">$24,780
                </div>
                <div class="text-sm rounded-full ckt3v cxs1s ccesj c9mle">+49%</div>
            </div>
        </div>
        <!-- Chart built with Chart.js 3 -->
        <!-- Check out src/js/dashboard-charts.js for config -->
        <div class="clsq7 cpif2 ci6ev">
            <!-- Change the height attribute to adjust the chart height -->
            <canvas id="dashboard-card-01" width="389" height="128"></canvas>
        </div>
    </div>

    <!-- Line chart (Acme Advanced) -->
    <div
        class="flex bg-white dark:bg-slate-800 rounded-sm border border-slate-200 dark:border-slate-700 cjre0 cwfr0 cae04 cvli5 czs6d">
        <div class="c3xi1 cbqel">
            <header class="flex cvu2h c8u10 c40sv">
                <!-- Icon -->
                <img src="/dashboard/images/icon-02.svg" width="32" height="32"
                    alt="Icon 02">
                <!-- Menu button -->
                <div class="inline-flex clvvc" x-data="{ open: false }">
                    <button class="rounded-full"
                        :class="open ? 'cuuxo c1v5y text-slate-500 dark:cqxhh' : 'cqxhh c0fgd cnwxp cziw9'"
                        aria-haspopup="true" @click.prevent="open = !open"
                        :aria-expanded="open">
                        <span class="cdw74">Menu</span>
                        <svg class="cjvls c5h61 cfowt" viewBox="0 0 32 32">
                            <circle cx="16" cy="16" r="2"></circle>
                            <circle cx="10" cy="16" r="2"></circle>
                            <circle cx="22" cy="16" r="2"></circle>
                        </svg>
                    </button>
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded c8g8w cwyww cvli5 cbey6 cfanx cuv0v co2jl cqczs c0tsw ctyk8"
                        @click.outside="open = false" @keydown.escape.window="open = false"
                        x-show="open" x-transition:enter="cbfn0 cjiz2 c3gpz cpugh"
                        x-transition:enter-start="opacity-0 c5ct0"
                        x-transition:enter-end="c04b9 cnt9w"
                        x-transition:leave="cbfn0 cjiz2 c3gpz" x-transition:leave-start="c04b9"
                        x-transition:leave-end="opacity-0" x-cloak="">
                        <ul>
                            <li>
                                <a class="text-sm flex cv3ih cux48 cj0iv cv09y cmg0a ck4vb ca4t4"
                                    href="#0" @click="open = false" @focus="open = true"
                                    @focusout="open = false">Option 1</a>
                            </li>
                            <li>
                                <a class="text-sm flex cv3ih cux48 cj0iv cv09y cmg0a ck4vb ca4t4"
                                    href="#0" @click="open = false" @focus="open = true"
                                    @focusout="open = false">Option 2</a>
                            </li>
                            <li>
                                <a class="text-sm flex crf5p c5plz cmg0a ck4vb ca4t4"
                                    href="#0" @click="open = false" @focus="open = true"
                                    @focusout="open = false">Remove</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <h2 class="text-slate-800 dark:text-slate-100 cxs1s cksqm c40sv">Amount Repaid</h2>
            <div class="cnwxp cqxhh cxs1s c7akw cgoct cz85d">Sales</div>
            <div class="flex c8u10">
                <div class="text-3xl font-bold text-slate-800 dark:text-slate-100 mr-2">$17,489
                </div>
                <div class="text-sm rounded-full cxs1s czppc ccesj c9mle">-14%</div>
            </div>
        </div>
        <!-- Chart built with Chart.js 3 -->
        <!-- Check out src/js/dashboard-charts.js for config -->
        <div class="clsq7 cpif2 ci6ev">
            <!-- Change the height attribute to adjust the chart height -->
            <canvas id="dashboard-card-02" width="389" height="128"></canvas>
        </div>
    </div>

    <!-- Line chart (Acme Professional) -->
    <div
        class="flex bg-white dark:bg-slate-800 rounded-sm border border-slate-200 dark:border-slate-700 cjre0 cwfr0 cae04 cvli5 czs6d">
        <div class="c3xi1 cbqel">
            <header class="flex cvu2h c8u10 c40sv">
                <!-- Icon -->
                <img src="/dashboard/images/icon-03.svg" width="32" height="32"
                    alt="Icon 03">
                <!-- Menu button -->
                <div class="inline-flex clvvc" x-data="{ open: false }">
                    <button class="rounded-full"
                        :class="open ? 'cuuxo c1v5y text-slate-500 dark:cqxhh' : 'cqxhh c0fgd cnwxp cziw9'"
                        aria-haspopup="true" @click.prevent="open = !open"
                        :aria-expanded="open">
                        <span class="cdw74">Menu</span>
                        <svg class="cjvls c5h61 cfowt" viewBox="0 0 32 32">
                            <circle cx="16" cy="16" r="2"></circle>
                            <circle cx="10" cy="16" r="2"></circle>
                            <circle cx="22" cy="16" r="2"></circle>
                        </svg>
                    </button>
                    <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded c8g8w cwyww cvli5 cbey6 cfanx cuv0v co2jl cqczs c0tsw ctyk8"
                        @click.outside="open = false" @keydown.escape.window="open = false"
                        x-show="open" x-transition:enter="cbfn0 cjiz2 c3gpz cpugh"
                        x-transition:enter-start="opacity-0 c5ct0"
                        x-transition:enter-end="c04b9 cnt9w"
                        x-transition:leave="cbfn0 cjiz2 c3gpz" x-transition:leave-start="c04b9"
                        x-transition:leave-end="opacity-0" x-cloak="">
                        <ul>
                            <li>
                                <a class="text-sm flex cv3ih cux48 cj0iv cv09y cmg0a ck4vb ca4t4"
                                    href="#0" @click="open = false" @focus="open = true"
                                    @focusout="open = false">Option 1</a>
                            </li>
                            <li>
                                <a class="text-sm flex cv3ih cux48 cj0iv cv09y cmg0a ck4vb ca4t4"
                                    href="#0" @click="open = false" @focus="open = true"
                                    @focusout="open = false">Option 2</a>
                            </li>
                            <li>
                                <a class="text-sm flex crf5p c5plz cmg0a ck4vb ca4t4"
                                    href="#0" @click="open = false" @focus="open = true"
                                    @focusout="open = false">Remove</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>
            <h2 class="text-slate-800 dark:text-slate-100 cxs1s cksqm c40sv">Your Savings Report
            </h2>
            <div class="cnwxp cqxhh cxs1s c7akw cgoct cz85d">Sales</div>
            <div class="flex c8u10">
                <div class="text-3xl font-bold text-slate-800 dark:text-slate-100 mr-2">$9,962
                </div>
                <div class="text-sm rounded-full ckt3v cxs1s ccesj c9mle">+29%</div>
            </div>
        </div>
        <!-- Chart built with Chart.js 3 -->
        <!-- Check out src/js/dashboard-charts.js for config -->
        <div class="clsq7 cpif2 ci6ev">
            <!-- Change the height attribute to adjust the chart height -->
            <canvas id="dashboard-card-03" width="389" height="128"></canvas>
        </div>
    </div>



    <!-- Card (Recent Activity) -->
    <div
        class="bg-white dark:bg-slate-800 rounded-sm border border-slate-200 dark:border-slate-700 crfq8 cae04 cvli5">
        <header class="dark:border-slate-700 cz8lz ctesa c3xi1 cib86">
            <h2 class="text-slate-800 dark:text-slate-100 cxs1s">Recent Activity</h2>
        </header>
        <div class="c0o4h">

            <!-- Card content -->
            <!-- "Today" group -->
            <div>
                <header class="rounded-sm cnwxp c6ham c1v5y cqxhh cxs1s cq06v c7akw cgoct cd5on">
                    Today</header>
                <ul class="c0pt2">
                    <!-- Item -->
                    <li class="flex ctq5c">
                        <div class="rounded-full cdjfl cop41 cpnzj cagg0 cx4we c3gmu">
                            <svg class="text-indigo-50 cjvls cx4we c3gmu" viewBox="0 0 36 36">
                                <path
                                    d="M18 10c-4.4 0-8 3.1-8 7s3.6 7 8 7h.6l5.4 2v-4.4c1.2-1.2 2-2.8 2-4.6 0-3.9-3.6-7-8-7zm4 10.8v2.3L18.9 22H18c-3.3 0-6-2.2-6-5s2.7-5 6-5 6 2.2 6 5c0 2.2-2 3.8-2 3.8z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="flex items-center dark:border-slate-700 text-sm cz8lz ctesa ci6ev cajf7">
                            <div class="flex cvu2h ci6ev">
                                <div class="cyf4r"><a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">Nick Mark</a> mentioned <a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">Sara Smith</a> in a new post</div>
                                <div class="cop41 ceily cu2yz">
                                    <a class="text-indigo-500 cu3o2 cvsfh cmg0a"
                                        href="#0">View<span class="hidden c5rjt">
                                            -&gt;</span></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Item -->
                    <li class="flex ctq5c">
                        <div class="rounded-full c43ap cop41 cpnzj cagg0 cx4we c3gmu">
                            <svg class="cjvls c7fh5 cx4we c3gmu" viewBox="0 0 36 36">
                                <path
                                    d="M25 24H11a1 1 0 01-1-1v-5h2v4h12v-4h2v5a1 1 0 01-1 1zM14 13h8v2h-8z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="flex items-center dark:border-slate-700 text-sm cz8lz ctesa ci6ev cajf7">
                            <div class="flex cvu2h ci6ev">
                                <div class="cyf4r">The post <a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">Post Name</a> was removed by <a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">Nick Mark</a></div>
                                <div class="cop41 ceily cu2yz">
                                    <a class="text-indigo-500 cu3o2 cvsfh cmg0a"
                                        href="#0">View<span class="hidden c5rjt">
                                            -&gt;</span></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Item -->
                    <li class="flex ctq5c">
                        <div class="rounded-full ckt3v cop41 cpnzj cagg0 cx4we c3gmu">
                            <svg class="c46th cjvls cx4we c3gmu" viewBox="0 0 36 36">
                                <path
                                    d="M15 13v-3l-5 4 5 4v-3h8a1 1 0 000-2h-8zM21 21h-8a1 1 0 000 2h8v3l5-4-5-4v3z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex items-center text-sm ci6ev cajf7">
                            <div class="flex cvu2h ci6ev">
                                <div class="cyf4r"><a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">Patrick Sullivan</a> published a new <a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">post</a></div>
                                <div class="cop41 ceily cu2yz">
                                    <a class="text-indigo-500 cu3o2 cvsfh cmg0a"
                                        href="#0">View<span class="hidden c5rjt">
                                            -&gt;</span></a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- "Yesterday" group -->
            <div>
                <header class="rounded-sm cnwxp c6ham c1v5y cqxhh cxs1s cq06v c7akw cgoct cd5on">
                    Yesterday</header>
                <ul class="c0pt2">
                    <!-- Item -->
                    <li class="flex ctq5c">
                        <div class="rounded-full cfh0a cop41 cpnzj cagg0 cx4we c3gmu">
                            <svg class="cjvls c7ksa cx4we c3gmu" viewBox="0 0 36 36">
                                <path
                                    d="M23 11v2.085c-2.841.401-4.41 2.462-5.8 4.315-1.449 1.932-2.7 3.6-5.2 3.6h-1v2h1c3.5 0 5.253-2.338 6.8-4.4 1.449-1.932 2.7-3.6 5.2-3.6h3l-4-4zM15.406 16.455c.066-.087.125-.162.194-.254.314-.419.656-.872 1.033-1.33C15.475 13.802 14.038 13 12 13h-1v2h1c1.471 0 2.505.586 3.406 1.455zM24 21c-1.471 0-2.505-.586-3.406-1.455-.066.087-.125.162-.194.254-.316.422-.656.873-1.028 1.328.959.878 2.108 1.573 3.628 1.788V25l4-4h-3z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="flex items-center dark:border-slate-700 text-sm cz8lz ctesa ci6ev cajf7">
                            <div class="flex cvu2h ci6ev">
                                <div class="cyf4r"><a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">240+</a> users have subscribed to <a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">Newsletter #1</a></div>
                                <div class="cop41 ceily cu2yz">
                                    <a class="text-indigo-500 cu3o2 cvsfh cmg0a"
                                        href="#0">View<span class="hidden c5rjt">
                                            -&gt;</span></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Item -->
                    <li class="flex ctq5c">
                        <div class="rounded-full cdjfl cop41 cpnzj cagg0 cx4we c3gmu">
                            <svg class="text-indigo-50 cjvls cx4we c3gmu" viewBox="0 0 36 36">
                                <path
                                    d="M18 10c-4.4 0-8 3.1-8 7s3.6 7 8 7h.6l5.4 2v-4.4c1.2-1.2 2-2.8 2-4.6 0-3.9-3.6-7-8-7zm4 10.8v2.3L18.9 22H18c-3.3 0-6-2.2-6-5s2.7-5 6-5 6 2.2 6 5c0 2.2-2 3.8-2 3.8z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex items-center text-sm ci6ev cajf7">
                            <div class="flex cvu2h ci6ev">
                                <div class="cyf4r">The post <a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">Post Name</a> was suspended by <a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">Nick Mark</a></div>
                                <div class="cop41 ceily cu2yz">
                                    <a class="text-indigo-500 cu3o2 cvsfh cmg0a"
                                        href="#0">View<span class="hidden c5rjt">
                                            -&gt;</span></a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    <!-- Card (Income/Expenses) -->
    <div
        class="bg-white dark:bg-slate-800 rounded-sm border border-slate-200 dark:border-slate-700 crfq8 cae04 cvli5">
        <header class="dark:border-slate-700 cz8lz ctesa c3xi1 cib86">
            <h2 class="text-slate-800 dark:text-slate-100 cxs1s">Income/Expenses</h2>
        </header>
        <div class="c0o4h">

            <!-- Card content -->
            <!-- "Today" group -->
            <div>
                <header class="rounded-sm cnwxp c6ham c1v5y cqxhh cxs1s cq06v c7akw cgoct cd5on">
                    Today</header>
                <ul class="c0pt2">
                    <!-- Item -->
                    <li class="flex ctq5c">
                        <div class="rounded-full c43ap cop41 cpnzj cagg0 cx4we c3gmu">
                            <svg class="cjvls c7fh5 cx4we c3gmu" viewBox="0 0 36 36">
                                <path
                                    d="M17.7 24.7l1.4-1.4-4.3-4.3H25v-2H14.8l4.3-4.3-1.4-1.4L11 18z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="flex items-center dark:border-slate-700 text-sm cz8lz ctesa ci6ev cajf7">
                            <div class="flex cvu2h ci6ev">
                                <div class="cyf4r"><a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">Qonto</a> billing</div>
                                <div class="cugmq cop41 cu2yz">
                                    <span
                                        class="text-slate-800 dark:text-slate-100 cmg0a">-$49.88</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Item -->
                    <li class="flex ctq5c">
                        <div class="rounded-full ckt3v cop41 cpnzj cagg0 cx4we c3gmu">
                            <svg class="c46th cjvls cx4we c3gmu" viewBox="0 0 36 36">
                                <path
                                    d="M18.3 11.3l-1.4 1.4 4.3 4.3H11v2h10.2l-4.3 4.3 1.4 1.4L25 18z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="flex items-center dark:border-slate-700 text-sm cz8lz ctesa ci6ev cajf7">
                            <div class="flex cvu2h ci6ev">
                                <div class="cyf4r"><a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">Cruip.com</a> Market Ltd 70 Wilson St
                                    London</div>
                                <div class="cugmq cop41 cu2yz">
                                    <span class="c2ttr cmg0a">+249.88</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Item -->
                    <li class="flex ctq5c">
                        <div class="rounded-full ckt3v cop41 cpnzj cagg0 cx4we c3gmu">
                            <svg class="c46th cjvls cx4we c3gmu" viewBox="0 0 36 36">
                                <path
                                    d="M18.3 11.3l-1.4 1.4 4.3 4.3H11v2h10.2l-4.3 4.3 1.4 1.4L25 18z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="flex items-center dark:border-slate-700 text-sm cz8lz ctesa ci6ev cajf7">
                            <div class="flex cvu2h ci6ev">
                                <div class="cyf4r"><a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">Notion Labs Inc</a></div>
                                <div class="cugmq cop41 cu2yz">
                                    <span class="c2ttr cmg0a">+99.99</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Item -->
                    <li class="flex ctq5c">
                        <div class="rounded-full ckt3v cop41 cpnzj cagg0 cx4we c3gmu">
                            <svg class="c46th cjvls cx4we c3gmu" viewBox="0 0 36 36">
                                <path
                                    d="M18.3 11.3l-1.4 1.4 4.3 4.3H11v2h10.2l-4.3 4.3 1.4 1.4L25 18z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="flex items-center dark:border-slate-700 text-sm cz8lz ctesa ci6ev cajf7">
                            <div class="flex cvu2h ci6ev">
                                <div class="cyf4r"><a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">Market Cap Ltd</a></div>
                                <div class="cugmq cop41 cu2yz">
                                    <span class="c2ttr cmg0a">+1,200.88</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Item -->
                    <li class="flex ctq5c">
                        <div class="rounded-full cthv8 cop41 cpnzj cagg0 cx4we c3gmu">
                            <svg class="cqxhh cjvls cx4we c3gmu" viewBox="0 0 36 36">
                                <path
                                    d="M21.477 22.89l-8.368-8.367a6 6 0 008.367 8.367zm1.414-1.413a6 6 0 00-8.367-8.367l8.367 8.367zM18 26a8 8 0 110-16 8 8 0 010 16z">
                                </path>
                            </svg>
                        </div>
                        <div
                            class="flex items-center dark:border-slate-700 text-sm cz8lz ctesa ci6ev cajf7">
                            <div class="flex cvu2h ci6ev">
                                <div class="cyf4r"><a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">App.com</a> Market Ltd 70 Wilson St London
                                </div>
                                <div class="cugmq cop41 cu2yz">
                                    <span
                                        class="text-slate-800 dark:text-slate-100 cgobz cmg0a">+$99.99</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- Item -->
                    <li class="flex ctq5c">
                        <div class="rounded-full c43ap cop41 cpnzj cagg0 cx4we c3gmu">
                            <svg class="cjvls c7fh5 cx4we c3gmu" viewBox="0 0 36 36">
                                <path
                                    d="M17.7 24.7l1.4-1.4-4.3-4.3H25v-2H14.8l4.3-4.3-1.4-1.4L11 18z">
                                </path>
                            </svg>
                        </div>
                        <div class="flex items-center text-sm ci6ev cajf7">
                            <div class="flex cvu2h ci6ev">
                                <div class="cyf4r"><a
                                        class="text-slate-800 dark:text-slate-100 cjd77 cpoo7 cmg0a"
                                        href="#0">App.com</a> Market Ltd 70 Wilson St London
                                </div>
                                <div class="cugmq cop41 cu2yz">
                                    <span
                                        class="text-slate-800 dark:text-slate-100 cmg0a">-$49.88</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>

</div>
@endsection