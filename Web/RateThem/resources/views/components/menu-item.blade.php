<li class="nav-item">
    <a href="{{ $href }}" class="nav-link @if($active) active @endif">
        <i class="
      @if($sub)
            far fa-circle
@elseif($subsub)
            far fa-dot-circle
@endif
            nav-icon
@if($icon)
            fas fa-{{ $icon }}
        @endif

            "></i>
        <p>{{ $slot }}</p>
    </a>
</li>
