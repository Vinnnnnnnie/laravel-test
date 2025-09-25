<x-layout>
    <h2>Create a New Bike</h2>
    <div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class='px-4 py-2 bg-red-200 rounded-lg'>
                @foreach ($errors->all() as $error)
                    <li class='text-red-500'>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>
    <form method="POST" action="{{ route('bikes.store') }}">
        @csrf
        <div>
            <label for="name">Bike Year:</label>
            <input type="number" id="year" name="year" value='{{ old('year') }}' required>
        </div>
        <div>
            <label for="type">Bike Make:</label>
            <input type="text" id="make" name="make" value='{{ old('make') }}' required>
        </div>
        <div>
            <label for="type">Bike Model:</label>
            <input type="text" id="model" name="model" value='{{ old('model') }}' required>
        </div>
        <div>
            <label for="type">Engine Size (cc):</label>
            <input type="number" id="engine_size" name="engine_size" value='{{ old('engine_size') }}' required>
        </div>
        <div>
            <label for="type">Colour:</label>
            <input type="text" id="colour" name="colour" value='{{ old('colour') }}' required>
        </div>
        <div>
            <label for="type">MOT:</label>
            <input type="checkbox" id="MOT" name="MOT" {{ old('MOT') ? 'checked' : ''  }}>
        </div>
        <div>
            <label for="type">Taxed:</label>
            <input type="checkbox" id="taxed" name="taxed" {{ old('taxed') ? 'checked' : ''}}>
        </div>
        <div>
            <label for="type">Insured:</label>
            <input type="checkbox" id="insured" name="insured" {{ old('insured') ? 'checked' : '' }}>
        </div>
        <div>
            <label for="garage_id">Garage:</label>
            <select id="garage_id" name="garage_id">
                <option value="">Select a Garage</option>
                @foreach($garages as $garage)
                    <option value="{{ $garage->id }}" {{ old('garage_id') == $garage->id ? 'selected' : '' }}>
                        {{ $garage->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit">Create Bike</button>
    </form>
</x-layout>