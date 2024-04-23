<div class="card shadow rounded-4 text-white bg-{{$attributes->get('color')}} {{$attributes->get('class')}}">
    <div class="card-body">
        {{ $slot }}
    </div>
</div>