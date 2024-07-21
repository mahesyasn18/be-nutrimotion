`<x-app-layout title="Edit Data Food" is-header-blur="true">
    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <!-- Notification -->
        <div id="edit_success" class="fixed bottom-5 right-5 bg-green-500 text-white px-6 py-2 rounded-md shadow-md hidden transition-all duration-300 z-1">
            User updated successfully.
        </div>
        <div id="edit_failed" class="fixed bottom-5 right-5 bg-red-500 text-white px-6 py-2 rounded-md shadow-md hidden transition-all duration-300 z-1">
            Failed to update user.
        </div>


        <script>
            // Menampilkan notifikasi sesuai dengan session yang ada
            @if(session('edit_success'))
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
                        <a class="text-primary hover:underline" href="{{ route('edit-food-form', $food->id) }}">{{ $food->food_name }}</a> 
                    </li>
                </ul>
            </div>
        </div>

        <form action="{{ route('food-update', $food->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
        
            @if ($errors->has('error'))
                <div class="alert flex space-x-2 rounded-lg border border-error px-1 py-1 text-error text-tiny+ mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <p>{{ $errors->first('error') }}</p>
                </div>
            @endif
        
            <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6" x-data="{ step: 1 }">
                <!-- Step Indicator -->
                <div class="col-span-12 lg:col-span-4 lg:place-items-center mt-14 ml-18">
                    <div>
                        <ol class="steps is-vertical line-space [--size:2.75rem] [--line:.5rem]">
                            <li class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500" :class="{ 'before:bg-primary': step === 1 }">
                                <div :class="step === 1 ? 'bg-primary text-white' : 'bg-slate-200 text-slate-500' " class="step-header mask is-hexagon">
                                    <i class="fa-solid fa-layer-group text-base"></i>
                                </div>
                                <div class="text-left">
                                    <p class="text-xs text-slate-400 dark:text-navy-300">Step 1</p>
                                    <h3 class="text-base font-medium" :class="step === 1 ? 'text-primary dark:text-accent-light' : '' ">General</h3>
                                </div>
                            </li>
                            <li class="step space-x-4 pb-12 before:bg-slate-200 dark:before:bg-navy-500" :class="{ 'before:bg-primary': step === 2 }">
                                <div :class="step === 2 ? 'bg-primary text-white' : 'bg-slate-200 text-slate-500' " class="step-header mask is-hexagon">
                                    <i class="fa-solid fa-list text-base"></i>
                                </div>
                                <div class="text-left">
                                    <p class="text-xs text-slate-400 dark:text-navy-300">Step 2</p>
                                    <h3 class="text-base font-medium" :class="step === 2 ? 'text-primary dark:text-accent-light' : '' ">Nutrition</h3>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
        
                <!-- Form Content -->
                <div class="col-span-12 lg:col-span-8">
                    <div class="card">
                        <div class="border-b border-slate-200 p-4 dark:border-navy-500 sm:px-5">
                            <div class="flex items-center space-x-2">
                                <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-primary/10 p-2 text-primary dark:bg-accent-light/10 dark:text-accent-light">                
                                    <i class='bx bx-message-square-edit text-xl'></i>
                                </div>
                                <h4 class="text-lg font-medium text-slate-700 dark:text-navy-100">
                                    Edit Food
                                </h4>
                            </div>
                        </div>
                        <div class="space-y-4 p-4 sm:p-5">
                            <!-- Step 1: General Information -->
                            <div x-show="step === 1">
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <label for="food_name" class="block">
                                            <span>Food Name</span>
                                            <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                name="food_name" id="food_name" value="{{ old('food_name', $food->food_name) }}" placeholder="Enter food name..." type="text" />
                                        </label>
        
                                        <label for="barcode_number" class="block">
                                            <span>Barcode</span>
                                            <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                name="barcode_number" id="barcode_number" value="{{ old('barcode_number', $food->barcode_number) }}" placeholder="Enter food barcode..." type="number"/>
                                        </label>
                                    </div>
                                </div>
        
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mt-4">
                                    <label class="block">
                                        <span>Food Type</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                            name="food_type" id="food_type" value="{{ old('food_type', $food->food_type) }}" placeholder="Enter food type..." type="text" />
                                    </label>
        
                                    <div class="grid grid-cols-2 gap-4">
                                        <label class="block">
                                            <span>Food Category</span>
                                            <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                name="food_category" id="food_category" value="{{ old('food_category', $food->food_category) }}" placeholder="Enter food category..." type="text" />
                                        </label>
        
                                        <label class="block">
                                            <span>Size</span>
                                            <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                name="size" id="size" value="{{ old('size', $food->size) }}" placeholder="Input size..." type="number" />
                                        </label>
                                    </div>
                                </div>
        
                                <div class="flex justify-end space-x-2 mt-10">
                                    <button type="button" @click="step = 2"
                                        class="btn space-x-2 btn min-w-[7rem] bg-primary font-medium text-white hover:bg-[#60F166] focus:bg-[#60F166] active:bg-[#60F166]">
                                        <span>Next</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
        
                            <!-- Step 2: Nutrition Inputs -->
                            <div x-show="step === 2">
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
                                    <label class="block col-span-2">
                                        <span>Per Serving (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="per_serving" id="per_serving" value="{{ old('barcode_number', $food->nutritionFact->per_serving) }}" placeholder="Per Serving..." type="number" />
                                    </label>
                                    <label class="block col-span-2">
                                        <span>Kalori (kkal)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="kalori" id="kalori" value="{{ old('kalori', $food->nutritionFact->kalori) }}" placeholder="Calories..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Lemak Total (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="lemak_total" id="lemak_total" value="{{ old('lemak_total', $food->nutritionFact->lemak_total) }}" placeholder="Total Fat..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Lemak Jenuh (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="lemak_jenuh" id="lemak_jenuh" value="{{ old('lemak_jenuh', $food->nutritionFact->lemak_jenuh) }}" placeholder="Saturated Fat..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Protein (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="protein" id="protein" value="{{ old('protein', $food->nutritionFact->protein) }}" placeholder="Protein..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Total Karbohidrat (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="karbohidrat_total" id="karbohidrat_total" value="{{ old('karbohidrat_total', $food->nutritionFact->karbohidrat_total) }}" placeholder="Total Carbohydrate..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Gula (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="gula" id="gula" value="{{ old('gula', $food->nutritionFact->gula) }}" placeholder="Sugar..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Garam (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="garam" id="garam" value="{{ old('garam', $food->nutritionFact->garam) }}" placeholder="Salt..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Serat (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="serat" id="serat" value="{{ old('serat', $food->nutritionFact->serat) }}" placeholder="Fiber..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Vitamin A (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="vit_a" id="vit_a" value="{{ old('vit_a', $food->nutritionFact->vit_a) }}" placeholder="Vitamin A..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Vitamin C (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="vit_c" id="vit_c" value="{{ old('vit_c', $food->nutritionFact->vit_c) }}" placeholder="Vitamin C..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Vitamin D (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="vit_d" id="vit_d" value="{{ old('vit_d', $food->nutritionFact->vit_d) }}" placeholder="Vitamin D..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Vitamin E (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="vit_e" id="vit_e" value="{{ old('vit_e', $food->nutritionFact->vit_e) }}" placeholder="Vitamin E..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Vitamin K (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="vit_k" id="vit_k" value="{{ old('vit_k', $food->nutritionFact->vit_k) }}" placeholder="Vitamin K..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Vitamin B1 (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="vit_b1" id="vit_b1" value="{{ old('vit_b1', $food->nutritionFact->vit_b1) }}" placeholder="Vitamin B1..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Vitamin B2 (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="vit_b2" id="vit_b2" value="{{ old('vit_b2', $food->nutritionFact->vit_b2) }}" placeholder="Vitamin B2..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Vitamin B3 (mg)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="vit_b3" id="vit_b3" value="{{ old('vit_b3', $food->nutritionFact->vit_b3) }}" placeholder="Vitamin B3..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Vitamin B5 (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="vit_b5" id="vit_b5" value="{{ old('vit_b5', $food->nutritionFact->vit_b5) }}" placeholder="Vitamin B5..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Vitamin B6 (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="vit_b6" id="vit_b6" value="{{ old('vit_b6', $food->nutritionFact->vit_b6) }}" placeholder="Vitamin B6..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Vitamin B12 (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="vit_b12" id="vit_b12" value="{{ old('vit_b12', $food->nutritionFact->vit_b12) }}" placeholder="Vitamin B12..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Biotin (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="biotin" id="biotin" value="{{ old('biotin', $food->nutritionFact->biotin) }}" placeholder="Biotin..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Kolin (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="kolin" id="kolin" value="{{ old('kolin', $food->nutritionFact->kolin) }}" placeholder="Kolin..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Kalsium (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="kalsium" id="kalsium" value="{{ old('kalsium', $food->nutritionFact->kalsium) }}" placeholder="Calcium..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Fosfor (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="fosfor" id="fosfor" value="{{ old('fosfor', $food->nutritionFact->fosfor) }}" placeholder="Fosfor..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Magnesium (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="magnesium" id="magnesium" value="{{ old('magnesium', $food->nutritionFact->magnesium) }}" placeholder="Magnesium..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Natirum (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="natirum" id="natrium" value="{{ old('natrium', $food->nutritionFact->natrium) }}" placeholder="Natrium..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Kalium (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="kalium" id="kalium" value="{{ old('kalium', $food->nutritionFact->kalium) }}" placeholder="Kalium..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Mangan (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="mangan" id="mangan" value="{{ old('mangan', $food->nutritionFact->mangan) }}" placeholder="Mangan..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Tembaga (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="tembaga" id="tembaga" value="{{ old('tembaga', $food->nutritionFact->tembaga) }}" placeholder="Tembaga..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Kromium (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="kromium" id="kromium" value="{{ old('kromium', $food->nutritionFact->kromium) }}" placeholder="Kromium..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Besi (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="besi" id="besi" value="{{ old('besi', $food->nutritionFact->besi) }}" placeholder="Besi..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Iodium (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="iodium" id="iodium" value="{{ old('iodium', $food->nutritionFact->iodium) }}" placeholder="Iodium..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Seng (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="seng" id="seng" value="{{ old('seng', $food->nutritionFact->seng) }}" placeholder="Seng..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Selenium (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="selenium" id="selenium" value="{{ old('selenium', $food->nutritionFact->selenium) }}" placeholder="Selenium..." type="number" />
                                    </label>
                                    <label class="block">
                                        <span>Fluor (g)</span>
                                        <input class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                               name="fluor" id="fluor" value="{{ old('fluor', $food->nutritionFact->fluor) }}" placeholder="fluor..." type="number" />
                                    </label>                                    
                                </div>
        
                                <div class="flex justify-between space-x-2 mt-10">

                                    <button type="button" @click="step = 1" class="btn bg-gray-200"
                                        class="btn space-x-2 bg-slate-150 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span>Prev</span>
                                    </button>

                                    <button type="submit" class="btn space-x-2 btn min-w-[7rem] bg-primary font-medium text-white hover:bg-[#60F166] focus:bg-[#60F166] active:bg-[#60F166]">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
</x-app-layout>
