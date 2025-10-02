<x-layout>
    <div class='form'>
        <h2>Login</h2>
        <div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class='px-4 py-2 bg-red-200 rounded-lg mb-2'>
                    @foreach ($errors->all() as $error)
                        <li class='text-red-500'>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        </div>
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