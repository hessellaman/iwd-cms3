<!-- De menubalk wordt dynamisch gegenereerd (behalve Tech-Zone home knop en archief) door het aanmaken, wijzigen, beheren, verwijderen van pagina's. Hiermee kunnen we dit tonen op het blog -->
@foreach ($pages as $page)
<li class="{{$page->present()->dropDownClass}}">
    <a class="nav-link" href="{{$page->url}}">
        {{ $page->title}}
        @if (count($page->children))
            <span class="caret"></span>
        @endif
    </a>

    @if (count($page->children))
        <ul class="dropdown-menu">
        @include('layouts.nav', ['pages'=>$page->children])
        </ul>
    @endif
</li>
@endforeach