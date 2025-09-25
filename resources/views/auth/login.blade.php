<x-layout>
    <h2>Login</h2>

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
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value='{{ old('email') }}' required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</x-layout>