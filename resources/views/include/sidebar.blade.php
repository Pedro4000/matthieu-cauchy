<div class="sidebar_content sticky-top" style="padding-top: 10px; margin-top: 25px;">
  <ul class="flex-column">
    <li class="">
      <span class="sb-main">Matthieu<br> Cauchy</span>
    </li>
    @foreach($types as $type)
      <li class="sb-secondary pl-2 mt-4">
      <span class="sb-span">{{ $type->nom }}</span>
        @if($type->albums)
        <ul class="sb-ter aplati mt-2 pl-3">
          @foreach($type->albums as $album)
            <li><a href="{{ route('album', [ 'album' => $album->nom ]) }}"><span class="sb-span">{{ $album->nom }}</span></a></li>
          @endforeach
        </ul>
        @endif
      </li>
    @endforeach
    </li>
    <li class="sb-secondary pl-2 mt-4">
      <span class="sb-span">about</span>
    </li>
    <li class="sb-secondary pl-2 mt-4">
      <span class="sb-span">contact</span>
    </li>
  </ul>
</div>

