<div class="px-2">
    <ul class="list-inside text-sm">
    @foreach($getRecord()->labExaminations as $examination)
        <li>{{ $examination->lab->name.' - '.$examination->result  }}</li>
    @endforeach
    </ul>
</div>
