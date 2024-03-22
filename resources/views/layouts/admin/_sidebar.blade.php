<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/image3.png')}}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="" aria-expanded="false">
                        <span>
                          <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Administration</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.role.index') }}" aria-expanded="false">
                        <span>
                          <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Roles</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.user.index') }}" aria-expanded="false">
                    <span>
                      <i class="ti ti-user"></i>
                    </span>
                        <span class="hide-menu">{{ __('Utilisateurs') }}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.voiture.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-car"></i>
                </span>
                        <span class="hide-menu">{{ __('Voitures') }}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.chauffeur.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-user-circle"></i>
                </span>
                        <span class="hide-menu">{{ __('Chauffeurs') }}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.contrat.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-file-invoice"></i>
                </span>
                        <span class="hide-menu">{{ __('Contrats') }}</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('admin.location.index') }}" class="sidebar-link" aria-expanded="false">
                        <span>
                            <i class="ti ti-car-crane"></i>
                        </span>
                        <span class="hide-menu">
                            {{__('Locations')}}
                        </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('admin.client.index') }}" aria-expanded="false">
                <span>
                  <i class="ti ti-user-check"></i>
                </span>
                        <span class="hide-menu">{{ __('Clients') }}</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Profil Utilisateur</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('login')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                        <span class="hide-menu">Login</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('register')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                        <span class="hide-menu">Register</span>
                    </a>
                </li>

            </ul>
            <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
                <div class="d-flex">
                    <div class="unlimited-access-title me-3">
                        <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Aller à l'accueil</h6>
                        <a href="{{route ('index')}}" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Home</a>
                    </div>

                </div>
            </div>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
