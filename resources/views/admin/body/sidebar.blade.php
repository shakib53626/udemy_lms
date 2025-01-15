<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rocker</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="bx bx-category"></i>
                </div>

                <div class="menu-title">Manage Category</div>
            </a>

            <ul>
                <li>
                    <a href="{{ route('all.category') }}"><i class='bx bx-radio-circle'></i>All Category</a>
                </li>

                <li>
                    <a href="{{ route('all.sub_category') }}"><i class='bx bx-radio-circle'></i>All Sub Category</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="bx bx-user"></i>
                </div>

                <div class="menu-title">Manage User</div>
            </a>

            <ul>
                <li>
                    <a href="{{ route('all.instructor') }}"><i class='bx bx-radio-circle'></i>All Instructor</a>
                </li>

            </ul>
        </li>

        {{-- <li class="menu-label">UI Elements</li> --}}

    </ul>
    <!--end navigation-->
</div>
