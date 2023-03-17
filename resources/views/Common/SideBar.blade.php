<!--///////////Page sidebar begin///////////////-->
<aside class="page-sidebar">
    <div class="h-100 flex-column d-flex" data-simplebar>
        <!--Aside-logo-->
        <div class="aside-logo p-3 position-relative">
            <a href="{{ route('admin.dashboard') }}" class="d-block pe-2">
                <div class="d-flex align-items-center flex-no-wrap text-truncate">
                    <!--Sidebar-icon-->
                    {{-- <span class="sidebar-icon fs-5 lh-1 text-white rounded-circle bg-primary"> --}}
                    <img src="{{ asset('/assets/media/avatars/mt-logo.jpeg') }}">
                    {{-- </span> --}}
                    {{-- <span class="sidebar-text">
                        <!--Sidebar-text-->
                        <span class="sidebar-text text-truncate fs-4 text-uppercase fw-bolder">
                            <img src="{{ asset('../assets/media/avatars/mt-logo.jpeg') }}">
                        </span>
                    </span> --}}
                </div>
            </a>
        </div>
        <!--Aside-Menu-->
        <div class="aside-menu pe-2 my-auto flex-column-fluid">
            <nav class="flex-grow-1 h-100" id="page-navbar">
                <!--:Sidebar nav-->
                <ul class="nav flex-column collapse-group collapse d-flex pt-4">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" data-bs-toggle=""
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.dashboard' ? 'active' : '' }} "
                            aria-expanded="false">
                            <!--Sidebar nav text-->
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24">
                                    <path
                                        d="M12.97 2.59a1.5 1.5 0 00-1.94 0l-7.5 6.363A1.5 1.5 0 003 10.097V19.5A1.5 1.5 0 004.5 21h4.75a.75.75 0 00.75-.75V14h4v6.25c0 .414.336.75.75.75h4.75a1.5 1.5 0 001.5-1.5v-9.403a1.5 1.5 0 00-.53-1.144l-7.5-6.363z">
                                    </path>
                                </svg>
                            </span>
                            <span class="sidebar-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a data-bs-toggle="collapse"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.courselist' || Route::current()->getName() == 'admin.coursedetail' || Route::current()->getName() == 'admin.demoVideo' || Route::current()->getName() == 'admin.classCategory' || Route::current()->getName() == 'admin.subjects' ? '' : '' }} "
                            aria-expanded="false" href="#ui-pages">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="24"
                                    height="24">
                                    <path fill-rule="evenodd"
                                        d="M4 1.75C4 .784 4.784 0 5.75 0h5.586c.464 0 .909.184 1.237.513l2.914 2.914c.329.328.513.773.513 1.237v8.586A1.75 1.75 0 0114.25 15h-9a.75.75 0 010-1.5h9a.25.25 0 00.25-.25V6h-2.75A1.75 1.75 0 0110 4.25V1.5H5.75a.25.25 0 00-.25.25v2.5a.75.75 0 01-1.5 0v-2.5zm7.5-.188V4.25c0 .138.112.25.25.25h2.688a.252.252 0 00-.011-.013l-2.914-2.914a.272.272 0 00-.013-.011zM5.72 6.72a.75.75 0 000 1.06l1.47 1.47-1.47 1.47a.75.75 0 101.06 1.06l2-2a.75.75 0 000-1.06l-2-2a.75.75 0 00-1.06 0zM3.28 7.78a.75.75 0 00-1.06-1.06l-2 2a.75.75 0 000 1.06l2 2a.75.75 0 001.06-1.06L1.81 9.25l1.47-1.47z">
                                    </path>
                                </svg>
                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Course</span>
                        </a>
                        <ul id="ui-pages"
                            class="sidebar-dropdown list-unstyled collapse {{ Route::current()->getName() == 'admin.courselist' || Route::current()->getName() == 'admin.coursedetail' || Route::current()->getName() == 'admin.demoVideo' || Route::current()->getName() == 'admin.classCategory' || Route::current()->getName() == 'admin.subjects' ? 'show' : '' }}">

                            <li class="sidebar-item "><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.courselist' ? 'active' : '' }}"
                                    href="{{ route('admin.courselist') }}">Category List</a></li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.coursedetail' ? 'active' : '' }}"
                                    href="{{ route('admin.coursedetail') }}">Category Detail</a></li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.classCategory' ? 'active' : '' }}"
                                    href="{{ route('admin.classCategory') }}">
                                    Standard List</a></li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.demoVideo' ? 'active' : '' }}"
                                    href="{{ route('admin.demoVideo') }}">
                                    Standard
                                    Videos</a></li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.subjects' ? 'active' : '' }}"
                                    href="{{ route('admin.subjects') }}">
                                    Subjects</a></li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a data-bs-toggle="collapse"
                            class="nav-link d-flex align-items-center text-truncate  {{ Route::current()->getName() == 'admin.states' || Route::current()->getName() == 'admin.centers' || Route::current()->getName() == 'admin.cities' ? '' : '' }}"
                            aria-expanded="false" href="#ui-pages1">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path
                                        d="M0 48C0 21.5 21.5 0 48 0H336c26.5 0 48 21.5 48 48V207l-42.4 17H304 272c-8.8 0-16 7.2-16 16v32 24.2V304c0 .9 .1 1.7 .2 2.6c2.3 58.1 24.1 144.8 98.7 201.5c-5.8 2.5-12.2 3.9-18.9 3.9H240V432c0-26.5-21.5-48-48-48s-48 21.5-48 48v80H48c-26.5 0-48-21.5-48-48V48zM80 224c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V240c0-8.8-7.2-16-16-16H80zm80 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V240c0-8.8-7.2-16-16-16H176c-8.8 0-16 7.2-16 16zM64 112v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zM176 96c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H176zm80 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H272c-8.8 0-16 7.2-16 16zM423.1 225.7c5.7-2.3 12.1-2.3 17.8 0l120 48C570 277.4 576 286.2 576 296c0 63.3-25.9 168.8-134.8 214.2c-5.9 2.5-12.6 2.5-18.5 0C313.9 464.8 288 359.3 288 296c0-9.8 6-18.6 15.1-22.3l120-48zM527.4 312L432 273.8V461.7c68.2-33 91.5-99 95.4-149.7z" />
                                </svg>

                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Centers</span>
                        </a>
                        <ul id="ui-pages1"
                            class="sidebar-dropdown list-unstyled collapse {{ Route::current()->getName() == 'admin.states' || Route::current()->getName() == 'admin.centers' || Route::current()->getName() == 'admin.cities' ? 'show' : '' }}">

                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.states' ? 'active' : '' }}"
                                    href="{{ route('admin.states') }}">State</a></li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.cities' ? 'active' : '' }}"
                                    href="{{ route('admin.cities') }}">City</a>
                            </li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.centers' ? 'active' : '' }}"
                                    href="{{ route('admin.centers') }}">Centers</a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.about') }}" data-bs-toggle=""
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.about' ? 'active' : '' }} "
                            aria-expanded="false">
                            <!--Sidebar nav text-->
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24">
                                    <path
                                        d="M12.97 2.59a1.5 1.5 0 00-1.94 0l-7.5 6.363A1.5 1.5 0 003 10.097V19.5A1.5 1.5 0 004.5 21h4.75a.75.75 0 00.75-.75V14h4v6.25c0 .414.336.75.75.75h4.75a1.5 1.5 0 001.5-1.5v-9.403a1.5 1.5 0 00-.53-1.144l-7.5-6.363z">
                                    </path>
                                </svg>
                            </span>
                            <span class="sidebar-text">About Us</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.achievment') }}" data-bs-toggle=""
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.achievment' ? 'active' : '' }} "
                            aria-expanded="false">
                            <!--Sidebar nav text-->
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-star"></i>
                            </span>
                            <span class="sidebar-text">Our Achievements</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.topper') }}" data-bs-toggle=""
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.topper' ? 'active' : '' }} "
                            aria-expanded="false">
                            <!--Sidebar nav text-->
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-graduation-cap"></i>
                            </span>
                            <span class="sidebar-text">Toppers</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a data-bs-toggle="collapse"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.boardOfDirectors' || Route::current()->getName() == 'admin.keyManagement' || Route::current()->getName() == 'admin.boardCommittee' || Route::current()->getName() == 'admin.boardDetail' ? '' : '' }}"
                            aria-expanded="false" href="#ui-pages2">
                            <span class="sidebar-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path
                                        d="M0 48C0 21.5 21.5 0 48 0H336c26.5 0 48 21.5 48 48V207l-42.4 17H304 272c-8.8 0-16 7.2-16 16v32 24.2V304c0 .9 .1 1.7 .2 2.6c2.3 58.1 24.1 144.8 98.7 201.5c-5.8 2.5-12.2 3.9-18.9 3.9H240V432c0-26.5-21.5-48-48-48s-48 21.5-48 48v80H48c-26.5 0-48-21.5-48-48V48zM80 224c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V240c0-8.8-7.2-16-16-16H80zm80 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V240c0-8.8-7.2-16-16-16H176c-8.8 0-16 7.2-16 16zM64 112v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zM176 96c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H176zm80 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V112c0-8.8-7.2-16-16-16H272c-8.8 0-16 7.2-16 16zM423.1 225.7c5.7-2.3 12.1-2.3 17.8 0l120 48C570 277.4 576 286.2 576 296c0 63.3-25.9 168.8-134.8 214.2c-5.9 2.5-12.6 2.5-18.5 0C313.9 464.8 288 359.3 288 296c0-9.8 6-18.6 15.1-22.3l120-48zM527.4 312L432 273.8V461.7c68.2-33 91.5-99 95.4-149.7z" />
                                </svg>

                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Management</span>
                        </a>
                        <ul id="ui-pages2"
                            class="sidebar-dropdown list-unstyled collapse {{ Route::current()->getName() == 'admin.boardOfDirectors' || Route::current()->getName() == 'admin.keyManagement' || Route::current()->getName() == 'admin.boardCommittee' || Route::current()->getName() == 'admin.boardDetail' ? 'show' : '' }}">

                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.boardOfDirectors' ? 'active' : '' }}"
                                    href="{{ route('admin.boardOfDirectors') }}">Board of Directors</a></li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.boardDetail' ? 'active' : '' }}"
                                    href="{{ route('admin.boardDetail') }} ">Board Directors Other Details</a>
                            </li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.keyManagement' ? 'active' : '' }}"
                                    href="{{ route('admin.keyManagement') }} ">Key Management</a>
                            </li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.boardCommittee' ? 'active' : '' }}"
                                    href="{{ route('admin.boardCommittee') }}"> Board Committee</a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a data-bs-toggle="collapse"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.gallery.category' || Route::current()->getName() == 'admin.gallary' || Route::current()->getName() == 'admin.gallery.video' ? '' : '' }} "
                            aria-expanded="false" href="#ui-pages3">
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-image"></i>
                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Gallery</span>
                        </a>
                        <ul id="ui-pages3"
                            class="sidebar-dropdown list-unstyled collapse {{ Route::current()->getName() == 'admin.gallery.category' || Route::current()->getName() == 'admin.gallary' || Route::current()->getName() == 'admin.gallery.video' ? 'show' : '' }}">

                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.gallery.category' ? 'active' : '' }}"
                                    href="{{ route('admin.gallery.category') }}">Gallery Category</a></li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.gallary' ? 'active' : '' }}"
                                    href="{{ route('admin.gallary') }}">Gallery Image</a></li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.gallery.video' ? 'active' : '' }}"
                                    href="{{ route('admin.gallery.video') }}">Gallery Video</a>
                            </li>


                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.media') }}" data-bs-toggle=""
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.media' ? 'active' : '' }} "
                            aria-expanded="false">
                            <!--Sidebar nav text-->
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-tv"></i>
                            </span>
                            <span class="sidebar-text">Media</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.award') }}" data-bs-toggle=""
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.award' ? 'active' : '' }} "
                            aria-expanded="false">
                            <!--Sidebar nav text-->
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-trophy"></i>
                            </span>
                            <span class="sidebar-text">Awards</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.csr') }}" data-bs-toggle=""
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.csr' ? 'active' : '' }} "
                            aria-expanded="false">
                            <!--Sidebar nav text-->
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-award"></i>
                            </span>
                            <span class="sidebar-text">CSR</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a data-bs-toggle="collapse"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.privacy_policy' || Route::current()->getName() == 'admin.terms' || Route::current()->getName() == 'admin.disclaimer' ? '' : '' }} "
                            aria-expanded="false" href="#ui-pages4">
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-layer-group"></i>
                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Policy</span>
                        </a>
                        <ul id="ui-pages4"
                            class="sidebar-dropdown list-unstyled collapse {{ Route::current()->getName() == 'admin.privacy_policy' || Route::current()->getName() == 'admin.terms' || Route::current()->getName() == 'admin.disclaimer' ? 'show' : '' }} ">

                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.privacy_policy' ? 'active' : '' }} "
                                    href="{{ route('admin.privacy_policy') }}">Privacy Policy</a></li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.terms' ? 'active' : '' }} "
                                    href="{{ route('admin.terms') }}">Terms
                                    & Conditions</a>
                            </li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.disclaimer' ? 'active' : '' }} "
                                    href="{{ route('admin.disclaimer') }}">Disclaimer</a>
                            </li>


                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.jobs') }}" data-bs-toggle="" aria-expanded="false"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.jobs' ? 'active' : '' }}">
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-street-view"></i>
                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Jobs</span>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a data-bs-toggle="collapse"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.corp.governance' || Route::current()->getName() == 'admin.invester.presentation' ? '' : '' }} "
                            aria-expanded="false" href="#ui-pages5">
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-users"></i>
                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Investor Relations</span>
                        </a>
                        <ul id="ui-pages5"
                            class="sidebar-dropdown list-unstyled collapse {{ Route::current()->getName() == 'admin.corp.governance' || Route::current()->getName() == 'admin.invester.presentation' ? 'show' : '' }}">

                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.corp.governance' ? 'active' : '' }}"
                                    href="{{ route('admin.corp.governance') }}">Corporate Governance</a></li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.invester.presentation' ? 'active' : '' }}"
                                    href="{{ route('admin.invester.presentation') }}">Investor Presentations</a>
                            </li>



                        </ul>
                    </li>

                    <li class="nav-item">
                        <a data-bs-toggle="collapse"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.release.category' || Route::current()->getName() == 'admin.press.release' ? '' : '' }} "
                            aria-expanded="false" href="#ui-pages6">
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-newspaper"></i>
                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text"> Press Release</span>
                        </a>
                        <ul id="ui-pages6"
                            class="sidebar-dropdown list-unstyled collapse {{ Route::current()->getName() == 'admin.release.category' || Route::current()->getName() == 'admin.press.release' ? 'show' : '' }}">

                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.release.category' ? 'active' : '' }}"
                                    href="{{ route('admin.release.category') }}">Releases Category</a>
                            </li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.press.release' ? 'active' : '' }}"
                                    href="{{ route('admin.press.release') }}">Releases</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a data-bs-toggle="collapse"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.report.category' || Route::current()->getName() == 'admin.report' ? '' : '' }} "
                            aria-expanded="false" href="#ui-pages7">
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-file"></i>
                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Reports</span>
                        </a>
                        <ul id="ui-pages7"
                            class="sidebar-dropdown list-unstyled collapse {{ Route::current()->getName() == 'admin.report.category' || Route::current()->getName() == 'admin.report' ? 'show' : '' }}">

                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.report.category' ? 'active' : '' }}"
                                    href="{{ route('admin.report.category') }}">Report Category</a>
                            </li>
                            <li class="sidebar-item"><a
                                    class="sidebar-link {{ Route::current()->getName() == 'admin.report' ? 'active' : '' }}"
                                    href="{{ route('admin.report') }}">Reports</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.contacts') }}" data-bs-toggle="" aria-expanded="false"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.contacts' ? 'active' : '' }}">
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-address-book"></i>
                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Contact Us</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.we.offer') }}" data-bs-toggle="" aria-expanded="false"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.we.offer' ? 'active' : '' }}">
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-gift"></i>
                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Offers</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.student.hear') }}" data-bs-toggle="" aria-expanded="false"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.student.hear' ? 'active' : '' }}">
                            <span class="sidebar-icon">
                                {{-- <i class="fa fa-solid fa-ear-listen"></i>
                                <i class="fa-light fa-ear-listen"></i> --}}
                                {{-- <i class="fa fa-solid fa-ear-listen"></i> --}}
                                {{-- <i class="fa fa-solid fa-buffer"></i> --}}

                                <i class="fa fa-solid fa-rss-square"></i>
                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Student Hear</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.socail.media') }}" data-bs-toggle="" aria-expanded="false"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.socail.media' ? 'active' : '' }}">
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-share"></i>
                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Social Media</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.meta.tag') }}" data-bs-toggle="" aria-expanded="false"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.meta.tag' ? 'active' : '' }}">
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-tag"></i>
                                {{-- <i class="fa fa-duotone fa-comet"></i> --}}
                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Meta Tags</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.enquiry') }}" data-bs-toggle="" aria-expanded="false"
                            class="nav-link d-flex align-items-center text-truncate {{ Route::current()->getName() == 'admin.enquiry' ? 'active' : '' }}">
                            <span class="sidebar-icon">
                                <i class="fa fa-solid fa-question-circle"></i>
                                {{-- <i class="fa fa-duotone fa-comet"></i> --}}
                            </span>
                            <!--Sidebar nav text-->
                            <span class="sidebar-text">Your Enquiry</span>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
        <!--Aside-footer-->

    </div>
</aside>
<!--///////////Page Sidebar End///////////////-->

<!--///Sidebar close button for 991px or below devices///-->
<div class="sidebar-close d-lg-none">
    <a href="#"></a>
</div>
<!--///.Sidebar close end///-->
