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
<x-layout>
    <div class='form'>
        <h2>Register</h2>
        <form class='flex flex-col gap-4' method="POST" action="{{ route('register') }}">
            @csrf
            <div class='flex flex-col'>
                <label class='form-label' for="name">Name</label>
                <input class='form-control' type="text" id="name" name="name" value='{{ old('name') }}' required>
            </div>
            <div class='flex flex-col'>
                <label class='form-label' for="email">Email</label>
                <input class='form-control' type="email" id="email" name="email" value='{{ old('email') }}' required>
            </div>
            <div class='flex flex-col'>
                <label class='form-label' for="password">Password</label>
                <input class='form-control' type="password" id="password" name="password" required>
            </div>
            <div class='flex flex-col'>
                <label class='form-label' for="password_confirmation">Confirm Password</label>
                <input class='form-control' type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button class='btn' type="submit">Register</button>
        </form>
    </div>
</x-layout>