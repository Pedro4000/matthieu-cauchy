<div class='sidebar m-4 p-3 bg-white border-b border-gray-200'>
  <ul class="nav flex-column p-0 m-0">
    <li class="nav-item my-4 ">
      <a class="nav-link p-4 {{ (Route::current()->getName() == 'admin.photo.index') ? 'active' : '' }}" href="{{ route('admin.photo.index') }}" title="gerer les photos">
        <i class="fas fa-calendar-check"></i><span class="d-none d-lg-inline"> photo</span>
      </a>
    </li>
    <li class="nav-item my-4 ">
      <a class="nav-link p-4 {{ (Route::current()->getName() == 'admin.album.index') ? 'active' : '' }}" href="{{ route('admin.album.index') }}" title="gerer les album">
        <i class="fas fa-edit"></i><span class="d-none d-lg-inline"> album</span>
      </a>
    </li> 
    <li class="nav-item my-4 ">
      <a class="nav-link p-4{{ (Route::current()->getName() == 'admin.type.index') ? 'active' : '' }}" href="{{ route('admin.type.index') }}" title="gerer les types">
        <i class="fas fa-edit"></i><span class="d-none d-lg-inline"> type</span>
      </a>
    </li>  
  </ul>
</div>