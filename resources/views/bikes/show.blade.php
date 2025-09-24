<x-layout>
    <h2>{{ $bike->year . ' ' . $bike->make . ' ' . ucfirst($bike->model)}}</h2>
    <p><strong>Engine Size: </strong>{{ $bike->engine_size }}</p>
    <p><strong>Color: </strong>{{ ucfirst($bike->color) }}</p
    <p><strong>MOT: </strong>{{ $bike->MOT ? 'Yes' : 'No' }}</p>
    <p><strong>Taxed: </strong>{{ $bike->taxed ? 'Yes' : 'No' }}</p>
    <p><strong>Insured: </strong>{{ $bike->insured ? 'Yes' : 'No' }}</p>
    <div class='flex gap-2'>
        <a class='btn' href="/bikes/{{ $bike->id }}/edit">Edit Bike</a>
        <form method="POST" action="/bikes/{{ $bike->id }}/delete">
            @csrf
            @method('DELETE')
            <button class=btn type="submit">Delete Bike</button>
        </form>
        <a class='btn' href="/bikes">Back to all Bikes</a>
    </div>
</x-layout>
