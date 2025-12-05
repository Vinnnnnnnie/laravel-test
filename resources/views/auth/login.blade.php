<x-layout>
    <div class='form'>
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}" class='flex flex-col gap-4'>
            @csrf
            <div class='flex flex-col'>
                <label class='form-label' for="email">Email</label>
                <input class='form-control' type="email" id="email" name="email" value='{{ old('email') }}' required>
            </div>
            <div class='flex flex-col'>
                <label for="password" class='form-label'>Password</label>
                <input class='form-control' type="password" id="password" name="password" required>
            </div>
            <button type="submit" class='btn'>Login</button>
        </form>
    </div>
</x-layout>