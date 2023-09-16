<div class="px-2">
    <ul class="list-inside text-sm">
        @foreach($getRecord()->prescriptions as $prescription)
            <li>{{ $prescription->medicine->name.'('.$prescription->medicine->dose.')'.' '.$prescription->number.' Notes('.$prescription->instruction.')'  }}</li>
        @endforeach
    </ul>
</div>
