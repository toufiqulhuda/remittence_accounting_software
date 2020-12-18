<ul>
@foreach($childs as $child)
    <li>
        {{ $child->title }}
    @if(count($child->children))
            @include('manageChild',['childs' => $child->children])
        @endif
    </li>
@endforeach
</ul>
