<div>
        @if(session('success'))
            <div class='bg-green-200 text-green-800 p-2 rounded mb-4 bold'>
                {{ session('success') }}
            </div>
        @endif
    </div>
<x-home-layout>
    <h2>List of all Bikes</h2>
    
    <a href="{{ route('bikes.create') }}">Create a New Bike</a>
    <ul>
        @foreach($bikes as $bike)
            <li>
                <x-card href="{{ route('bikes.show', $bike->id) }}" :highlight='$bike->make === "BMW"'>
                    <div style='display:flex;flex-direction:column;gap:0.5rem;'>
                        <h3>{{ $bike->year }} {{ $bike->make }} {{ ucfirst($bike->model) }}</h3>
                        <p><strong>Engine Size: {{ $bike->engine_size }}</strong></p>
                        <p><strong>Colour: {{ ucfirst($bike->colour) }}</strong></p>
                        <p><strong>Garage: {{ $bike->garage ? $bike->garage->name : 'No Garage Assigned' }}</strong></p>
                    </div>
                    
                </x-card>
            </li>
        @endforeach
    </ul>
    {{  $bikes->links() }}
</x-home-layout>

