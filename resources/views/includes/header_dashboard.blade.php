    <!-- Site header -->
    <header class="bg-white border-slate-200 dark:border-slate-700 cdcmt ctesa c33pt c0j1l c6cl9">
        <div class="ce79r cyoj0 cw15p">
            <div class="flex items-center cvu2h c8t80 cewcu">

                <!-- Header: Left side -->
                <div class="flex">
                    <!-- Hamburger button -->
                    <button class="text-slate-500 czq63 ciz2x" @click.stop="sidebarOpen = !sidebarOpen"
                        aria-controls="sidebar" :aria-expanded="sidebarOpen">
                        <span class="cdw74">Open sidebar</span>
                        <svg class="cjvls c6d7g c2vd0" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="5" width="16" height="2"></rect>
                            <rect x="4" y="11" width="16" height="2"></rect>
                            <rect x="4" y="17" width="16" height="2"></rect>
                        </svg>
                    </button>

                </div>

                <!-- Header: Right side -->
                <div class="flex items-center cqmfy">

                    <!-- Search button -->
                    <div x-data="{ searchOpen: false }">
                        <!-- Button -->
                        <button
                            class="flex items-center justify-center rounded-full cm36g c5a7p c1v5y cuuxo c5h61 cfowt"
                            :class="{ 'cthv8': searchOpen }"
                            @click.prevent="searchOpen = true;if (searchOpen) $nextTick(()=>{$refs.searchInput.focus();});"
                            aria-controls="search-modal">
                            <span class="cdw74">Search</span>
                            <svg class="c81wg ctg3f" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path class="text-slate-500 dark:text-slate-400 cjvls"
                                    d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z">
                                </path>
                                <path class="cnwxp cqxhh cjvls"
                                    d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z">
                                </path>
                            </svg>
                        </button>
                        <!-- Modal backdrop -->
                        <div class="bg-slate-900 czzr7 ce0g0 cppzw cqwoh c9elc" x-show="searchOpen"
                            x-transition:enter="cbfn0 cjiz2 c3gpz" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="c04b9" x-transition:leave="cbfn0 cjiz2 czfwc"
                            x-transition:leave-start="c04b9" x-transition:leave-end="opacity-0"
                            aria-hidden="true" x-cloak=""></div>
                        <!-- Modal dialog -->
                        <div id="search-modal"
                            class="flex justify-center cwyww c8u10 ce79r cppzw cvrow cqwoh c9elc cnexa cw15p"
                            role="dialog" aria-modal="true" x-show="searchOpen"
                            x-transition:enter="cbfn0 cxu1h c3gpz" x-transition:enter-start="opacity-0 c3kus"
                            x-transition:enter-end="c04b9 cnt9w" x-transition:leave="cbfn0 cxu1h c3gpz"
                            x-transition:leave-start="c04b9 cnt9w" x-transition:leave-end="opacity-0 c3kus"
                            x-cloak="">
                            <div class="bg-white dark:bg-slate-800 border dark:border-slate-700 rounded cemsv cudee ccg7u c3v41 cvli5 ccet9"
                                @click.outside="searchOpen = false"
                                @keydown.escape.window="searchOpen = false">
                                <!-- Search form -->
                                <form class="border-slate-200 dark:border-slate-700 ctesa">
                                    <div class="clvvc">
                                        <label for="modal-search" class="cdw74">Search</label>
                                        <input id="modal-search"
                                            class="bg-white dark:bg-slate-800 c06t4 cxiav c4iir cj0iv cpecx cxevc ccet9 cha6v ce64v cmh1i"
                                            type="search" placeholder="Search Anything…"
                                            x-ref="searchInput">
                                        <button class="c5ctt cbey6 cppzw cky0g" type="submit"
                                            aria-label="Search">
                                            <svg class="mr-2 crct7 cz58a cnwxp cqxhh cjvls cop41 cyhee c81wg ctg3f"
                                                viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z">
                                                </path>
                                                <path
                                                    d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                                <div class="ctq5c cib86">
                                    <!-- Recent searches -->
                                    <div class="c706i c6ey4">
                                        <div class="cnwxp cqxhh cxs1s c7akw cgoct c40sv ctq5c">Recent searches
                                        </div>
                                        <ul class="text-sm">
                                            <li>
                                                <a class="flex items-center text-slate-800 dark:text-slate-100 rounded cftk8 c6s7n cky0g cd5on"
                                                    href="#0" @click="searchOpen = false"
                                                    @focus="searchOpen = true" @focusout="searchOpen = false">
                                                    <svg class="cuxul c4s1j cnwxp cqxhh cjvls cop41 cagg0 c81wg ctg3f"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.707 14.293v.001a1 1 0 01-1.414 1.414L11.185 12.6A6.935 6.935 0 017 14a7.016 7.016 0 01-5.173-2.308l-1.537 1.3L0 8l4.873 1.12-1.521 1.285a4.971 4.971 0 008.59-2.835l1.979.454a6.971 6.971 0 01-1.321 3.157l3.107 3.112zM14 6L9.127 4.88l1.521-1.28a4.971 4.971 0 00-8.59 2.83L.084 5.976a6.977 6.977 0 0112.089-3.668l1.537-1.3L14 6z">
                                                        </path>
                                                    </svg>
                                                    <span>Form Builder - 23 hours on-demand video</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="flex items-center text-slate-800 dark:text-slate-100 rounded cftk8 c6s7n cky0g cd5on"
                                                    href="#0" @click="searchOpen = false"
                                                    @focus="searchOpen = true" @focusout="searchOpen = false">
                                                    <svg class="cuxul c4s1j cnwxp cqxhh cjvls cop41 cagg0 c81wg ctg3f"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.707 14.293v.001a1 1 0 01-1.414 1.414L11.185 12.6A6.935 6.935 0 017 14a7.016 7.016 0 01-5.173-2.308l-1.537 1.3L0 8l4.873 1.12-1.521 1.285a4.971 4.971 0 008.59-2.835l1.979.454a6.971 6.971 0 01-1.321 3.157l3.107 3.112zM14 6L9.127 4.88l1.521-1.28a4.971 4.971 0 00-8.59 2.83L.084 5.976a6.977 6.977 0 0112.089-3.668l1.537-1.3L14 6z">
                                                        </path>
                                                    </svg>
                                                    <span>Access Mosaic on mobile and TV</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="flex items-center text-slate-800 dark:text-slate-100 rounded cftk8 c6s7n cky0g cd5on"
                                                    href="#0" @click="searchOpen = false"
                                                    @focus="searchOpen = true" @focusout="searchOpen = false">
                                                    <svg class="cuxul c4s1j cnwxp cqxhh cjvls cop41 cagg0 c81wg ctg3f"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.707 14.293v.001a1 1 0 01-1.414 1.414L11.185 12.6A6.935 6.935 0 017 14a7.016 7.016 0 01-5.173-2.308l-1.537 1.3L0 8l4.873 1.12-1.521 1.285a4.971 4.971 0 008.59-2.835l1.979.454a6.971 6.971 0 01-1.321 3.157l3.107 3.112zM14 6L9.127 4.88l1.521-1.28a4.971 4.971 0 00-8.59 2.83L.084 5.976a6.977 6.977 0 0112.089-3.668l1.537-1.3L14 6z">
                                                        </path>
                                                    </svg>
                                                    <span>Product Update - Q4 2021</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="flex items-center text-slate-800 dark:text-slate-100 rounded cftk8 c6s7n cky0g cd5on"
                                                    href="#0" @click="searchOpen = false"
                                                    @focus="searchOpen = true" @focusout="searchOpen = false">
                                                    <svg class="cuxul c4s1j cnwxp cqxhh cjvls cop41 cagg0 c81wg ctg3f"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.707 14.293v.001a1 1 0 01-1.414 1.414L11.185 12.6A6.935 6.935 0 017 14a7.016 7.016 0 01-5.173-2.308l-1.537 1.3L0 8l4.873 1.12-1.521 1.285a4.971 4.971 0 008.59-2.835l1.979.454a6.971 6.971 0 01-1.321 3.157l3.107 3.112zM14 6L9.127 4.88l1.521-1.28a4.971 4.971 0 00-8.59 2.83L.084 5.976a6.977 6.977 0 0112.089-3.668l1.537-1.3L14 6z">
                                                        </path>
                                                    </svg>
                                                    <span>Master Digital Marketing Strategy course</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="flex items-center text-slate-800 dark:text-slate-100 rounded cftk8 c6s7n cky0g cd5on"
                                                    href="#0" @click="searchOpen = false"
                                                    @focus="searchOpen = true" @focusout="searchOpen = false">
                                                    <svg class="cuxul c4s1j cnwxp cqxhh cjvls cop41 cagg0 c81wg ctg3f"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.707 14.293v.001a1 1 0 01-1.414 1.414L11.185 12.6A6.935 6.935 0 017 14a7.016 7.016 0 01-5.173-2.308l-1.537 1.3L0 8l4.873 1.12-1.521 1.285a4.971 4.971 0 008.59-2.835l1.979.454a6.971 6.971 0 01-1.321 3.157l3.107 3.112zM14 6L9.127 4.88l1.521-1.28a4.971 4.971 0 00-8.59 2.83L.084 5.976a6.977 6.977 0 0112.089-3.668l1.537-1.3L14 6z">
                                                        </path>
                                                    </svg>
                                                    <span>Dedicated forms for products</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="flex items-center text-slate-800 dark:text-slate-100 rounded cftk8 c6s7n cky0g cd5on"
                                                    href="#0" @click="searchOpen = false"
                                                    @focus="searchOpen = true" @focusout="searchOpen = false">
                                                    <svg class="cuxul c4s1j cnwxp cqxhh cjvls cop41 cagg0 c81wg ctg3f"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M15.707 14.293v.001a1 1 0 01-1.414 1.414L11.185 12.6A6.935 6.935 0 017 14a7.016 7.016 0 01-5.173-2.308l-1.537 1.3L0 8l4.873 1.12-1.521 1.285a4.971 4.971 0 008.59-2.835l1.979.454a6.971 6.971 0 01-1.321 3.157l3.107 3.112zM14 6L9.127 4.88l1.521-1.28a4.971 4.971 0 00-8.59 2.83L.084 5.976a6.977 6.977 0 0112.089-3.668l1.537-1.3L14 6z">
                                                        </path>
                                                    </svg>
                                                    <span>Product Update - Q4 2021</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Recent pages -->
                                    <div class="c706i c6ey4">
                                        <div class="cnwxp cqxhh cxs1s c7akw cgoct c40sv ctq5c">Recent pages
                                        </div>
                                        <ul class="text-sm">
                                            <li>
                                                <a class="flex items-center text-slate-800 dark:text-slate-100 rounded cftk8 c6s7n cky0g cd5on"
                                                    href="#0" @click="searchOpen = false"
                                                    @focus="searchOpen = true" @focusout="searchOpen = false">
                                                    <svg class="cuxul c4s1j cnwxp cqxhh cjvls cop41 cagg0 c81wg ctg3f"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M14 0H2c-.6 0-1 .4-1 1v14c0 .6.4 1 1 1h8l5-5V1c0-.6-.4-1-1-1zM3 2h10v8H9v4H3V2z">
                                                        </path>
                                                    </svg>
                                                    <span><span class="cmg0a">Messages</span> - <span
                                                            class="dark:text-slate-400 c4s1j cv09y">Conversation
                                                            / … / Mike Mills</span></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="flex items-center text-slate-800 dark:text-slate-100 rounded cftk8 c6s7n cky0g cd5on"
                                                    href="#0" @click="searchOpen = false"
                                                    @focus="searchOpen = true" @focusout="searchOpen = false">
                                                    <svg class="cuxul c4s1j cnwxp cqxhh cjvls cop41 cagg0 c81wg ctg3f"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M14 0H2c-.6 0-1 .4-1 1v14c0 .6.4 1 1 1h8l5-5V1c0-.6-.4-1-1-1zM3 2h10v8H9v4H3V2z">
                                                        </path>
                                                    </svg>
                                                    <span><span class="cmg0a">Messages</span> - <span
                                                            class="dark:text-slate-400 c4s1j cv09y">Conversation
                                                            / … / Eva Patrick</span></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications button -->
                    <div class="inline-flex clvvc" x-data="{ open: false }">
                        <button
                            class="flex items-center justify-center rounded-full cm36g c5a7p c1v5y cuuxo c5h61 cfowt"
                            :class="{ 'cthv8': open }" aria-haspopup="true" @click.prevent="open = !open"
                            :aria-expanded="open">
                            <span class="cdw74">Notifications</span>
                            <svg class="c81wg ctg3f" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path class="text-slate-500 dark:text-slate-400 cjvls"
                                    d="M6.5 0C2.91 0 0 2.462 0 5.5c0 1.075.37 2.074 1 2.922V12l2.699-1.542A7.454 7.454 0 006.5 11c3.59 0 6.5-2.462 6.5-5.5S10.09 0 6.5 0z">
                                </path>
                                <path class="cnwxp cqxhh cjvls"
                                    d="M16 9.5c0-.987-.429-1.897-1.147-2.639C14.124 10.348 10.66 13 6.5 13c-.103 0-.202-.018-.305-.021C7.231 13.617 8.556 14 10 14c.449 0 .886-.04 1.307-.11L15 16v-4h-.012C15.627 11.285 16 10.425 16 9.5z">
                                </path>
                            </svg>
                            <div class="rounded-full cb57r c30al c43ap cbey6 cks13 co2jl cn3dd cg1ly c0j1l">
                            </div>
                        </button>
                        <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded c8g8w cwyww cvli5 cbey6 cfanx cbjxv cmxrn co2jl cqczs c4fxg c0tsw ctyk8"
                            @click.outside="open = false" @keydown.escape.window="open = false"
                            x-show="open" x-transition:enter="cbfn0 cjiz2 c3gpz cpugh"
                            x-transition:enter-start="opacity-0 c5ct0" x-transition:enter-end="c04b9 cnt9w"
                            x-transition:leave="cbfn0 cjiz2 c3gpz" x-transition:leave-start="c04b9"
                            x-transition:leave-end="opacity-0" x-cloak="">
                            <div class="cnwxp cqxhh cxs1s c7akw cyxrj cgoct cw15p cq2y6">Notifications</div>
                            <ul>
                                <li class="border-slate-200 dark:border-slate-700 cxzmn ctesa">
                                    <a class="block cu1if cikhx cw15p cajf7" href="#0"
                                        @click="open = false" @focus="open = true" @focusout="open = false">
                                        <span class="block text-sm c40sv">📣 <span
                                                class="text-slate-800 dark:text-slate-100 cmg0a">Edit your
                                                information in a swipe</span> Sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt mollit anim.</span>
                                        <span class="block cnwxp cqxhh cmg0a cgoct">Feb 12, 2021</span>
                                    </a>
                                </li>
                                <li class="border-slate-200 dark:border-slate-700 cxzmn ctesa">
                                    <a class="block cu1if cikhx cw15p cajf7" href="#0"
                                        @click="open = false" @focus="open = true" @focusout="open = false">
                                        <span class="block text-sm c40sv">📣 <span
                                                class="text-slate-800 dark:text-slate-100 cmg0a">Edit your
                                                information in a swipe</span> Sint occaecat cupidatat non
                                            proident, sunt in culpa qui officia deserunt mollit anim.</span>
                                        <span class="block cnwxp cqxhh cmg0a cgoct">Feb 9, 2021</span>
                                    </a>
                                </li>
                                <li class="border-slate-200 dark:border-slate-700 cxzmn ctesa">
                                    <a class="block cu1if cikhx cw15p cajf7" href="#0"
                                        @click="open = false" @focus="open = true" @focusout="open = false">
                                        <span class="block text-sm c40sv">🚀<span
                                                class="text-slate-800 dark:text-slate-100 cmg0a">Say goodbye to
                                                paper receipts!</span> Sint occaecat cupidatat non proident,
                                            sunt in culpa qui officia deserunt mollit anim.</span>
                                        <span class="block cnwxp cqxhh cmg0a cgoct">Jan 24, 2020</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Info button -->
                    <div class="inline-flex clvvc" x-data="{ open: false }">
                        <button
                            class="flex items-center justify-center rounded-full cm36g c5a7p c1v5y cuuxo c5h61 cfowt"
                            :class="{ 'cthv8': open }" aria-haspopup="true" @click.prevent="open = !open"
                            :aria-expanded="open">
                            <span class="cdw74">Info</span>
                            <svg class="c81wg ctg3f" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                                <path class="text-slate-500 dark:text-slate-400 cjvls"
                                    d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z">
                                </path>
                            </svg>
                        </button>
                        <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded c8g8w cwyww cvli5 cbey6 cfanx ca42r co2jl cqczs c0tsw ctyk8"
                            @click.outside="open = false" @keydown.escape.window="open = false"
                            x-show="open" x-transition:enter="cbfn0 cjiz2 c3gpz cpugh"
                            x-transition:enter-start="opacity-0 c5ct0" x-transition:enter-end="c04b9 cnt9w"
                            x-transition:leave="cbfn0 cjiz2 c3gpz" x-transition:leave-start="c04b9"
                            x-transition:leave-end="opacity-0" x-cloak="">
                            <div class="cnwxp cqxhh cxs1s c7akw cyxrj cgoct ck4vb cq2y6">Need help?</div>
                            <ul>
                                <li>
                                    <a class="text-sm text-indigo-500 flex items-center cu3o2 cvsfh cmg0a ck4vb ca4t4"
                                        href="#0" @click="open = false" @focus="open = true"
                                        @focusout="open = false">
                                        <svg class="w-3 h-3 text-indigo-300 mr-2 cwi5a cjvls cop41"
                                            viewBox="0 0 12 12">
                                            <rect y="3" width="12" height="9" rx="1"></rect>
                                            <path d="M2 0h8v2H2z"></path>
                                        </svg>
                                        <span>Documentation</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-sm text-indigo-500 flex items-center cu3o2 cvsfh cmg0a ck4vb ca4t4"
                                        href="#0" @click="open = false" @focus="open = true"
                                        @focusout="open = false">
                                        <svg class="w-3 h-3 text-indigo-300 mr-2 cwi5a cjvls cop41"
                                            viewBox="0 0 12 12">
                                            <path
                                                d="M10.5 0h-9A1.5 1.5 0 000 1.5v9A1.5 1.5 0 001.5 12h9a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0010.5 0zM10 7L8.207 5.207l-3 3-1.414-1.414 3-3L5 2h5v5z">
                                            </path>
                                        </svg>
                                        <span>Support Site</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-sm text-indigo-500 flex items-center cu3o2 cvsfh cmg0a ck4vb ca4t4"
                                        href="#0" @click="open = false" @focus="open = true"
                                        @focusout="open = false">
                                        <svg class="w-3 h-3 text-indigo-300 mr-2 cwi5a cjvls cop41"
                                            viewBox="0 0 12 12">
                                            <path
                                                d="M11.854.146a.5.5 0 00-.525-.116l-11 4a.5.5 0 00-.015.934l4.8 1.921 1.921 4.8A.5.5 0 007.5 12h.008a.5.5 0 00.462-.329l4-11a.5.5 0 00-.116-.525z">
                                            </path>
                                        </svg>
                                        <span>Contact us</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Dark mode toggle -->
                    <div>
                        <input type="checkbox" name="light-switch" id="light-switch"
                            class="light-switch cdw74">
                        <label
                            class="flex items-center justify-center rounded-full cm36g c5a7p c1v5y ckpvh cuuxo c5h61 cfowt"
                            for="light-switch">
                            <svg class="cz4az c81wg ctg3f" viewBox="0 0 16 16"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="cqxhh cjvls"
                                    d="M7 0h2v2H7V0Zm5.88 1.637 1.414 1.415-1.415 1.413-1.414-1.414 1.415-1.414ZM14 7h2v2h-2V7Zm-1.05 7.433-1.415-1.414 1.414-1.414 1.415 1.413-1.414 1.415ZM7 14h2v2H7v-2Zm-4.02.363L1.566 12.95l1.415-1.414 1.414 1.415-1.415 1.413ZM0 7h2v2H0V7Zm3.05-5.293L4.465 3.12 3.05 4.535 1.636 3.121 3.05 1.707Z">
                                </path>
                                <path class="text-slate-500 cjvls"
                                    d="M8 4C5.8 4 4 5.8 4 8s1.8 4 4 4 4-1.8 4-4-1.8-4-4-4Z"></path>
                            </svg>
                            <svg class="hidden cxc1u c81wg ctg3f" viewBox="0 0 16 16"
                                xmlns="http://www.w3.org/2000/svg">
                                <path class="cqxhh cjvls"
                                    d="M6.2 2C3.2 2.8 1 5.6 1 8.9 1 12.8 4.2 16 8.1 16c3.3 0 6-2.2 6.9-5.2C9.7 12.2 4.8 7.3 6.2 2Z">
                                </path>
                                <path class="text-slate-500 cjvls"
                                    d="M12.5 6a.625.625 0 0 1-.625-.625 1.252 1.252 0 0 0-1.25-1.25.625.625 0 1 1 0-1.25 1.252 1.252 0 0 0 1.25-1.25.625.625 0 1 1 1.25 0c.001.69.56 1.249 1.25 1.25a.625.625 0 1 1 0 1.25c-.69.001-1.249.56-1.25 1.25A.625.625 0 0 1 12.5 6Z">
                                </path>
                            </svg>
                            <span class="cdw74">Switch to light / dark version</span>
                        </label>
                    </div>

                    <!-- Divider -->
                    <hr class="c1v5y cthv8 cf8jv cpkw4 c6d7g">

                    <!-- User button -->
                    <div class="inline-flex clvvc" x-data="{ open: false }">
                        <button class="inline-flex justify-center items-center cky0g" aria-haspopup="true"
                            @click.prevent="open = !open" :aria-expanded="open">
                            <img class="rounded-full c5h61 cfowt" src="/dashboard/images/user-avatar-32.png"
                                width="32" height="32" alt="User">
                            <div class="flex items-center ccecr">
                                <span class="text-sm cipha cka7b cj0iv cmg0a ccecr cu2yz">Acme Inc.</span>
                                <svg class="w-3 h-3 cqxhh cjvls cop41 cixth" viewBox="0 0 12 12">
                                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z"></path>
                                </svg>
                            </div>
                        </button>
                        <div class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded c8g8w cwyww cvli5 cbey6 cfanx ca42r co2jl cqczs c0tsw ctyk8"
                            @click.outside="open = false" @keydown.escape.window="open = false"
                            x-show="open" x-transition:enter="cbfn0 cjiz2 c3gpz cpugh"
                            x-transition:enter-start="opacity-0 c5ct0" x-transition:enter-end="c04b9 cnt9w"
                            x-transition:leave="cbfn0 cjiz2 c3gpz" x-transition:leave-start="c04b9"
                            x-transition:leave-end="opacity-0" x-cloak="">
                            <div class="border-slate-200 dark:border-slate-700 ctesa cg8tu cz85d ck4vb cq2y6">
                                <div class="text-slate-800 dark:text-slate-100 cmg0a">Acme Inc.</div>
                                <div class="text-slate-500 dark:text-slate-400 cgoct cmsnn">Administrator</div>
                            </div>
                            <ul>
                                <li>
                                    <a class="text-sm text-indigo-500 flex items-center cu3o2 cvsfh cmg0a ck4vb ca4t4"
                                        href="settings.html" @click="open = false" @focus="open = true"
                                        @focusout="open = false">Settings</a>
                                </li>
                                <li>
                                    <a class="text-sm text-indigo-500 flex items-center cu3o2 cvsfh cmg0a ck4vb ca4t4"
                                        href="signin.html" @click="open = false" @focus="open = true"
                                        @focusout="open = false">Sign Out</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </header>