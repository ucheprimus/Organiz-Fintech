        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <style>
                    p{
                        color: white
                    }
                </style>
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="index.html" class="logo">
                        <img
                            src="/admin/assets/img/kaiadmin/logo_light.svg"
                            alt="navbar brand"
                            class="navbar-brand"
                            height="20" />
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item active">
                            <a
                                href="#dashboard"
                                class="collapsed"
                                aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                                <span class="caret"></span>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Components</h4>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#base">
                                <i class="fas fa-layer-group"></i>
                                <p>Create Officers Account</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="base">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{route('adminbranchindex')}}">
                                            <span class="sub-item">Branch</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('adminrole')}}">
                                            <span class="sub-item">Role</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('adminmanager')}}">
                                            <span class="sub-item">Manager</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('adminloanofficer')}}">
                                            <span class="sub-item">Officers</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('adminunion')}}">
                                            <span class="sub-item">Union </span>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('client')}}">
                                <i class="fas fa-th-list"></i>
                                <p>Clients / Accounts</p>
                            </a>
                         
                        </li>

                        <li class="nav-item">
                            <a href="{{route('adminunion')}}">
                                <i class="fas fa-th-list"></i>
                                <p>Unions</p>
                            </a>
                         
                        </li>
                        
                  
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#tables">
                                <i class="fas fa-table"></i>
                                <p>Loans</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="tables">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{route('loantype')}}">
                                            <span class="sub-item">Loan Options</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('giveloan')}}">
                                            <span class="sub-item">Give Loans</span>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{route('viewloan')}}">
                                            <span class="sub-item">View Loans</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#maps">
                                <i class="fas fa-map-marker-alt"></i>
                                <p>Repayment/Loan</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="maps">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{route('repayment')}}">
                                            <span class="sub-item">Repay Loan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="maps/jsvectormap.html">
                                            <span class="sub-item">Jsvectormap</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#charts">
                                <i class="far fa-chart-bar"></i>
                                <p>Savings / Withdrawal</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="charts">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{route('user_savings')}}">
                                            <span class="sub-item">Savings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('withdraw')}}">
                                            <span class="sub-item">Withdraw</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="widgets.html">
                                <i class="fas fa-desktop"></i>
                                <p>Widgets</p>
                                <span class="badge badge-success">4</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../documentation/index.html">
                                <i class="fas fa-file"></i>
                                <p>Documentation</p>
                                <span class="badge badge-secondary">1</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#submenu">
                                <i class="fas fa-bars"></i>
                                <p>Menu Levels</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="submenu">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a data-bs-toggle="collapse" href="#subnav1">
                                            <span class="sub-item">Level 1</span>
                                            <span class="caret"></span>
                                        </a>
                                        <div class="collapse" id="subnav1">
                                            <ul class="nav nav-collapse subnav">
                                                <li>
                                                    <a href="#">
                                                        <span class="sub-item">Level 2</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <span class="sub-item">Level 2</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="collapse" href="#subnav2">
                                            <span class="sub-item">Level 1</span>
                                            <span class="caret"></span>
                                        </a>
                                        <div class="collapse" id="subnav2">
                                            <ul class="nav nav-collapse subnav">
                                                <li>
                                                    <a href="#">
                                                        <span class="sub-item">Level 2</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="sub-item">Level 1</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>