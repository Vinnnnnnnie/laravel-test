<x-layout>
    {{-- Bike information --}}
    <h2>{{ $bike->year . ' ' . $bike->make . ' ' . ucfirst($bike->model)}}</h2>
    <p><strong>Engine Size: </strong>{{ $bike->engine_size }}</p>
    <p><strong>Colour: </strong>{{ ucfirst($bike->colour) }}</p
    <p><strong>MOT: </strong>{{ $bike->MOT ? 'Yes' : 'No' }}</p>
    <p><strong>Taxed: </strong>{{ $bike->taxed ? 'Yes' : 'No' }}</p>
    <p><strong>Insured: </strong>{{ $bike->insured ? 'Yes' : 'No' }}</p>
    {{-- Garage information --}}
    <div class='mt-4 p-4 border border-gray-300 rounded bg-white m-2'>
    <p><strong>Garage: </strong>{{ $bike->garage ? $bike->garage->name : 'No Garage Assigned' }}</p>
    <p><strong>Garage Location: </strong>{{ $bike->garage ? $bike->garage->location : 'N/A' }}</p>
    <p><strong>Garage Contact Number: </strong>{{ $bike->garage ? $bike->garage->contact_number : 'N/A' }}</p>
    </div>
    {{-- Buttons --}}
    <div class='flex gap-2'>
        <a class='btn' href="/bikes/{{ $bike->id }}/edit">Edit Bike</a>
        <form method="POST" action="{{ route('bikes.destroy', $bike->id) }}">
            @csrf
            @method('DELETE')
            <button class=btn type="submit">Delete Bike</button>
        </form>
        <a class='btn' href="/bikes">Back to all Bikes</a>
    </div>
</x-layout>
