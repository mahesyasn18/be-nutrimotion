<x-app-layout title="Add Data User" is-header-blur="true">
    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
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
                        <a class="text-primary hover:underline" href="{{ route('edit-food-form', $food->id) }}">Edit Food</a> 
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-span-12 grid lg:col-span-8">
            <div class="card">
                <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                    <div class="flex items-center space-x-2">
                        <div
                            class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-2 text-primary dark:bg-accent-light/10 dark:text-accent-light">
                            <i class='bx bx-message-square-edit text-xl'></i>
                        </div>
                        <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                            Edit Food
                        </h4>
                    </div>
                </div>
                <div class="space-y-4 p-4 sm:p-5">
                    <div class="grid grid-cols-1 gap-4">
                        <div class="grid grid-cols-2 gap-4">
                            <label class="block">
                                <span>Food Name</span>
        
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Enter food name..." type="text" value="{{ $food->food_name }}"/>
                            </label>

                            <label class="block">
                                <span>Barcode</span>
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Enter food barcode..." type="number" value="{{ $food->barcode_number }}"/>
                            </label>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <label class="block">
                            <span>Food Type</span>
                            <input
                                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Enter food type..." type="text" value="{{ $food->food_type }}"/>
                        </label>

                        <div class="grid grid-cols-2 gap-4">
                            <label class="block">
                                <span>Food Category</span>
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Enter food category..." type="text" value="{{ $food->food_category }}"/>
                            </label>

                            <label class="block">
                                <span>Size</span>
                                <input
                                    class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                    placeholder="Input size..." type="number" value="{{ $food->size }}"/>
                            </label>
                        </div>
                    </div>
                    <div>
                        <span>Images</span>
                        <div class="filepond fp-bordered fp-grid mt-1.5 [--fp-grid:2]">
                            <input type="file" x-init="$el._x_filepond = FilePond.create($el)" multiple />
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2 pt-4">
                        <button class="btn min-w-[7rem] bg-primary font-medium text-white hover:bg-[#60F166] focus:bg-[#60F166] active:bg-[#60F166]">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
