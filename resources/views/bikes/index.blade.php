<x-layout>
    <h2>List of all Bikes</h2>
    <ul>
        @foreach($bikes as $bike)
            <li>
                <x-card href="/bikes/{{ $bike['id'] }}" :highlight='$bike["make"] === "BMW"'>
                    <h3>{{ $bike['year'] }} {{ $bike['make'] }} {{ $bike['model'] }}</h3>
                </x-card>
            </li>
        @endforeach
    </ul>
    <a href="/bikes/create">Create a New Bike</a>
</x-layout>

