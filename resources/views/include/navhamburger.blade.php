<div class="navhamburger w-full">
    <div class='inline-block w-full text-center py-14 text-7xl pate-hamburger border-b border-current'>
        <p class="project_click_background inline p-3 pointer">Projets</p>
    </div>
    @if(isset($hasCommissionedPhotos) && $hasCommissionedPhotos)
    <div class='inline-block w-full text-center py-14 text-7xl  pate-hamburger border-b border-current'>
        <p class="commissions_click inline p-3 pointer">Commissions</p>
    </div>
    @endif
    <div class='inline-block w-full text-center py-14 text-7xl  pate-hamburger border-b border-current'>
        <p class="inline p-3 pointer bio_click">Bio</p>
    </div>
    <div class='inline-block w-full text-center py-14 text-7xl  pate-hamburger border-b border-current'>
        <p class="contact_click inline p-3 pointer">Contact</p>
    </div>
</div>