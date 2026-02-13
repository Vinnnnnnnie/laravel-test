<x-recipe-layout>
    @php 
    $user = auth()->user();
    @endphp
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="bg-gray-100 dark:bg-gray-900 p-4 flex flex-col">
        <h2>Edit User</h2>
        <form class='flex flex-col gap-4' action='{{ route('users.update') }}' method='POST' enctype="multipart/form-data">
            @csrf
            <div class='dark:bg-gray-950 bg-gray-50 w-full flex justify-center align-items-center'>
                <img id='image-preview' src='{{ route('image.users',$user->image_path) }}' class='aspect-auto h-fit max-h-80 self-center'>
            </div>
            <div class='flex flex-col'>
                <label class='text-xl font-semibold' for="image" class='form-label'>Image</label>
                <input type="file" id="image" class='form-control w-full' name="image">
            </div>
            <div class='flex flex-col'>
                <label class='text-xl font-semibold' for="name">Name</label>
                <input class='bg-gray-200 dark:bg-gray-800 p-2' type="text" id="name" name="name" value='{{ $user->name }}' required>
            </div>
            <div class='flex flex-col'>
                <label class='text-xl font-semibold' for="bio">Description</label>
                <textarea class='bg-gray-200 dark:bg-gray-800 p-2' type="text" id="bio" name="bio">{{ $user->bio }}</textarea>
            </div>
            <button class='bg-gray-200 cursor-pointer hover:bg-gray-300 dark:hover:bg-gray-700 dark:bg-gray-800 p-2' type='submit'>Save Changes</button>
        </form>
    </div>
</x-recipe-layout>
<script>
    function readURL(input) {
        if (input.target.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                document.getElementById('image-preview').src = e.target.result;
            }
            
            reader.readAsDataURL(input.target.files[0]);
        }
    }
    document.getElementById('image').addEventListener('change', (e) => {
        readURL(e);
    })
</script>
