<div class='text-center pt-8 text-8xl lg:text-xl flex justify-around hidden desktop-nav'>	
  <div class='inline-block {{ isset($hasCommissionedPhotos) && $hasCommissionedPhotos ? 'w-1/5' : 'w-1/4' }} h-10'>
    <p class="project_click_background inline p-3 pointer">Projets</p>
  </div>
  @if(isset($hasCommissionedPhotos) && $hasCommissionedPhotos)
  <div class='inline-block w-1/5 h-10'>
    <a href="{{ route('commissions') }}" class="inline p-3">Commissions</a>
  </div>
  @endif
  <div class='inline-block {{ isset($hasCommissionedPhotos) && $hasCommissionedPhotos ? 'w-1/5' : 'w-1/4' }} h-10'>
    <p class="inline p-3 pointer bio_click">Bio</p>
  </div>
  <div class='inline-block {{ isset($hasCommissionedPhotos) && $hasCommissionedPhotos ? 'w-1/5' : 'w-1/4' }} h-10'>
    <p class="contact_click inline p-3 pointer">Contact</p>
  </div>  
</div>

<div class='text-right pt-6 lg:pt-0 text-8xl lg:hidden pointer hamburger-nav'>	
  <div class='inline-block pr-10 hamburger-click'>
    <label class="hamburger-expand">☰</label>
    <label class="hamburger-shrink hidden">X</label>
  </div>
</div>

