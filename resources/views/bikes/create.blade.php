<x-layout>
    <h2>Create a New Bike</h2>
    <form method="POST" action="/bikes">
        @csrf
        <div>
            <label for="name">Bike Year:</label>
            <input type="number" id="year" name="year" required>
        </div>
        <div>
            <label for="type">Bike Make:</label>
            <input type="text" id="make" name="make" required>
        </div>
        <div>
            <label for="type">Bike Model:</label>
            <input type="text" id="model" name="model" required>
        </div>
        <button type="submit">Create Bike</button>
    </form>
</x-layout>