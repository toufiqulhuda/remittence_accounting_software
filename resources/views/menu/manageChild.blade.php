<ul>
@foreach($childs as $child)
    <li><input type="checkbox"/>
        {{ $child->title }}
    @if(count($child->children))
            @include('manageChild',['childs' => $child->children])
        @endif
    </li>
@endforeach
</ul>
