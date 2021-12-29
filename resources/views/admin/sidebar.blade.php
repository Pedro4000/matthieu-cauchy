<div class='sidebar m-4 p-3 bg-white border-b border-gray-200'>
  <ul class="nav flex flex-col p-0 m-0">
    <li class="nav-item my-1">
      <a class="nav-link px-4 py-2 inline-block w-full {{ (Route::current()->getName() == 'admin.photo.index') ? 'sidebar-active' : '' }}" href="{{ route('admin.photo.index') }}" title="gerer les photos">
        <i class="fas fa-camera"></i><span class="hidden lg:inline"> photo</span>
      </a>
    </li>
    <li class="nav-item my-1">
      <a class="nav-link px-4 py-2 inline-block w-full {{ (Route::current()->getName() == 'admin.album.index') ? 'sidebar-active' : '' }}" href="{{ route('admin.album.index') }}" title="gerer les album">
        <i class="fas fa-images"></i><span class="hidden lg:inline"> album</span>
      </a>
    </li> 
    <li class="nav-item my-1">
      <a class="nav-link px-4 py-2 inline-block w-full {{ (Route::current()->getName() == 'admin.type.index') ? 'sidebar-active' : '' }}" href="{{ route('admin.type.index') }}" title="gerer les types">
        <i class="fas fa-venus-double"></i><span class="hidden lg:inline"> type</span>
      </a>
    </li>  
    <li class="nav-item my-1">
      <a class="nav-link px-4 py-2 inline-block w-full {{ (Route::current()->getName() == 'admin.a_propos.index') ? 'sidebar-active' : '' }}" href="{{ route('admin.a_propos.index') }}" title="gerer les types">
        <i class="fab fa-accessible-icon"></i><span class="hidden lg:inline"> à propos</span>
      </a>
    </li> 
  </ul>
</div>