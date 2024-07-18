<x-app-layout title="Add Data User" is-header-blur="true">
    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">

        <!-- Notification -->
        <div id="delete_success" class="fixed bottom-5 right-5 bg-green-500 text-white px-6 py-2 rounded-md shadow-md hidden transition-all duration-300 z-1">
            Food deleted successfully.
        </div>
        <div id="delete_failed" class="fixed bottom-5 right-5 bg-red-500 text-white px-6 py-2 rounded-md shadow-md hidden transition-all duration-300 z-1">
            Failed to delete food.
        </div>
        <div id="create_success" class="fixed bottom-5 right-5 bg-green-500 text-white px-6 py-2 rounded-md shadow-md hidden transition-all duration-300 z-1">
            Food created successfully.
        </div>
        <div id="create_failed" class="fixed bottom-5 right-5 bg-red-500 text-white px-6 py-2 rounded-md shadow-md hidden transition-all duration-300 z-1">
            Failed to create food.
        </div>
        <div id="edit_success" class="fixed bottom-5 right-5 bg-green-500 text-white px-6 py-2 rounded-md shadow-md hidden transition-all duration-300 z-1">
            Food updated successfully.
        </div>
        <div id="edit_failed" class="fixed bottom-5 right-5 bg-red-500 text-white px-6 py-2 rounded-md shadow-md hidden transition-all duration-300 z-1">
            Failed to update food.
        </div>


        <script>
            // Menampilkan notifikasi sesuai dengan session yang ada
            @if(session('delete_success'))
                showNotification('delete_success');
            @elseif(session('delete_failed'))
                showNotification('delete_failed');
            @elseif(session('create_success'))
                showNotification('create_success');
            @elseif(session('create_failed'))
                showNotification('create_failed');
            @elseif(session('edit_success'))
                showNotification('edit_success');
            @elseif(session('edit_failed'))
                showNotification('edit_failed');
            @endif
        
            // Fungsi untuk menampilkan notifikasi dengan animasi
            function showNotification(id) {
                document.getElementById(id).classList.remove('hidden');
                setTimeout(function() {
                    document.getElementById(id).classList.add('hidden');
                }, 5000); // Hilangkan notifikasi setelah 3 detik
            }
        </script>

        <div class="mt-6 flex flex-col items-center justify-between space-y-2 text-center sm:flex-row sm:space-y-0 sm:text-left">
            <div class="flex items-center space-x-4 py-5 lg:py-6">
                <a class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-xl" href="{{ route('index') }}">
                    Nutrimotion
                </a>
                <svg x-ignore xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                    <li class="flex items-center space-x-2">
                        <a class="text-primary hover:underline" href="{{ route('foods') }}">Foods</a> 
                    </li>
                    <svg x-ignore xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <li class="flex items-center space-x-2">
                        <a class="text-primary hover:underline" href="{{ route('add-user-form') }}">Add Food</a> 
                    </li>
                </ul>
            </div>
        </div>

        <form action="{{ route('food-store') }}" enctype="multipart/form-data" method="POST">
            @method('POST')
            @csrf
        
            @if ($errors->has('error'))
                <div class="alert flex space-x-2 rounded-lg border border-error px-1 py-1 text-error text-tiny+ mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <p>{{ $errors->first('error') }}</p>
                </div>
            @endif
        
            <div class="col-span-12 grid lg:col-span-8">
                <div class="card">
                    <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                        <div class="flex items-center space-x-2">
                            <div
                                class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-2 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                                <i class='bx bx-message-square-add text-xl'></i>
                            </div>
                            <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                                Add Food
                            </h4>
                        </div>
                    </div>
                    <div class="space-y-4 p-4 sm:p-5">

                        <div class="grid grid-cols-1 gap-4">
                            <div class="grid grid-cols-2 gap-4">
                                <label for="food_name" class="block">
                                    <span>Food Name</span>
                                    <input
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        name="food_name" id="food_name" placeholder="Enter food name..." type="text" />
                                </label>

                                <label for="barcode_number" class="block">
                                    <span>Barcode</span>
                                    <input
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        name="barcode_number" id="barcode_number" placeholder="Enter food barcode..." type="number"/>
                                </label>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <label class="block">
                                <span>Food Type</span>
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    name="food_type" id="food_type" placeholder="Enter food type..." type="text" />
                            </label>
        
                            <div class="grid grid-cols-2 gap-4">
                                <label class="block">
                                    <span>Food Category</span>
                                    <input
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        name="food_category" id="food_category" placeholder="Enter food category..." type="text" />
                                </label>
        
                                <label class="block">
                                    <span>Size</span>
                                    <input
                                        class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                        name="size" id="size" placeholder="Input size..." type="number" />
                                </label>
                            </div>
                        </div>
                        <div>
                            <span>Images</span>
                            <div class="filepond fp-bordered fp-grid mt-1.5 [--fp-grid:2]">
                                <input type="file" name="picture" id="picture" x-init="$el._x_filepond = FilePond.create($el)" multiple />
                            </div>
                        </div>
                        
                        <div class="flex justify-end space-x-2 pt-4">
                            <button type="submit" class="btn min-w-[7rem] bg-primary font-medium text-white hover:bg-[#60F166] focus:bg-[#60F166] active:bg-[#60F166]">
                                Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>        
    </main>
</x-app-layout>
