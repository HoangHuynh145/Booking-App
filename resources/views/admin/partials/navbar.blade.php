<!-- Navbar -->
<nav
class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar">
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
  <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
    <i class="mdi mdi-menu mdi-24px"></i>
  </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
  <ul class="navbar-nav flex-row align-items-center ms-auto">
    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
          <img src="{{ asset('admin/assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
        </div>
      </a>
    </li>
  </ul>
</div>

<!-- Search Small Screens -->
<div class="navbar-search-wrapper search-input-wrapper d-none">
  <input
    type="text"
    class="form-control search-input container-fluid border-0"
    placeholder="Search..."
    aria-label="Search..." />
  <i class="mdi mdi-close search-toggler cursor-pointer"></i>
</div>
</nav>
<!-- / Navbar -->
