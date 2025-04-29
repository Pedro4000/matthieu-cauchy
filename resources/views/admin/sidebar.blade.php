<div class='sidebar m-4 p-3 bg-white border-b border-gray-200'>
  <ul class="nav navbar-dark flex flex-col p-0 m-0">
    <li class="nav-item  my-1">
    </li>
    <li class="nav-item my-1">
      <a class="nav-link px-4 py-2 inline-block w-full {{ request()->routeIs('admin.album.*') ? 'sidebar-active' : '' }}" href="{{ route('admin.album.index') }}" title="gerer les album">
        <i class="fas fa-images"></i><span class="hidden lg:inline"> Albums</span>
      </a>
    </li> 
    <li class="nav-item my-1">
      <a class="nav-link px-4 py-2 inline-block w-full {{ request()->routeIs('admin.a_propos.*') ? 'sidebar-active' : '' }}" href="{{ route('admin.a_propos.index') }}" title="gerer les types">
        <i class="fab fa-accessible-icon"></i><span class="hidden lg:inline"> About</span>
      </a>
    </li> 
    <li class="nav-item my-1">
      <a class="nav-link px-4 py-2 inline-block w-full {{ request()->routeIs('admin.contact.*') ? 'sidebar-active' : '' }}" href="{{ route('admin.contact.edit') }}" title="gerer les types">
        <i class="fa fa-align-justify"></i><span class="hidden lg:inline"> Contact</span>
      </a>
    </li> 
    <li class="nav-item my-1">
      <a class="nav-link px-4 py-2 inline-block w-full {{ request()->routeIs('admin.users.*') ? 'sidebar-active' : '' }}" href="{{ route('admin.users.index') }}" title="gerer les types">
        <i class="fas fa-users"></i><span class="hidden lg:inline"> Users</span>
      </a>
    </li> 
    <li class="nav-item my-1">
      <a class="nav-link px-4 py-2 inline-block w-full {{ request()->routeIs('admin.business.*') ? 'sidebar-active' : '' }}" href="{{ route('admin.business.index') }}" title="gerer les types">
        <i class="fa fa-money-bill"></i><span class="hidden lg:inline"> Business</span>
      </a>
    </li> 
  </ul>
</div>