<x-app-layout title="{{ $food->food_name }}" is-header-blur="true">
    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
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
            </ul>
            <svg x-ignore xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a class="text-primary hover:underline" href="{{ route('food-detail', $food->id) }}">{{ $food->food_name }}</a> 
                </li>
            </ul>
        </div>

        <div class="card p-4 lg:p-6">
            <div class="space-y-9 p-4 sm:p-5">
                    <div class="flex justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="avatar size-24">
                                @if ($food->picture)
                                    <img class="rounded-full" src="{{ $food->picture }}" alt="Food Image">
                                @else
                                    <img class="rounded-full" src="{{asset('images/illustrations/add_foods.png')}}" alt="avatar"/>
                                @endif
                                <div
                                  class="absolute right-0 m-1.5 size-4 rounded-full border-2 border-white bg-primary dark:border-navy-700 dark:bg-accent"
                                ></div>
                              </div>
                            <div>
                                <p class="font-medium text-3xl text-slate-700 dark:text-navy-100">
                                    {{ $food->food_name }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between space-x-2">
                        <div>
                            <p class="text-xs+">Food Type</p>
                            <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                {{ $food->food_type }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs+">Food Category</p>
                            <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                {{ $food->food_category }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs+">Size</p>
                            <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                                {{ $food->size }}
                            </p>
                        </div>
                    </div>
                    <div class="mr-4 mb-1 inline-flex items-center space-x-2 font-inter">
                        <i class='bx bx-barcode-reader text-2xl'></i>
                        <div class="flex space-x-1 text-xs leading-6">
                            <span class="font-medium text-sm+ text-slate-700 dark:text-navy-100">Barcode : </span>
                            <span>
                                @if ($food->barcode_number == NULL)
                                    N/A
                                @else
                                    {{ $food->barcode_number }}
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

            <div class="grid mt-6 grid-cols-3 gap-4 sm:grid-cols-3 sm:gap-5 lg:gap-6">
                <div class="card col-span-1 bg-[#60F166] px-5 pb-5">
                    <div class="mt-20">
                        <div class="ax-transparent-gridline mt-5 w-full">
                            <div x-init="$nextTick(() => {
                                $el._x_chart = new ApexCharts($el, pages.charts.earningDark);
                                $el._x_chart.render()
                            });"></div>
                        </div>
                        <p class="mt-9 font-inter text-2xl font-semibold">
                            <span class="text-slate-800 font-semibold text-3xl">
                                {{ $food->nutritionFact?->per_serving ?? 0 }}
                            </span>
                            <span class="text-slate-600 text-sm font-normal">grams</span>                            
                        </p>
                        <p class="mt-3 text-base font-medium tracking-wide text-slate-600">
                            Per Serving
                        </p>
                    </div>
                    <div class="absolute bottom-0 right-0 overflow-hidden rounded-lg">
                        <img class="w-40 translate-x-1/4 translate-y-1/4 opacity-50"
                            src="{{ asset('images/illustrations/add_foods.png') }}" alt="image" />
                    </div>
                </div>
                
                <div class="col-span-2">
                    <div class="flex items-center justify-between">
                        <h2 class="ml-5 text-base font-medium tracking-wide text-slate-700 dark:text-navy-100">
                            Daily Nutritions
                        </h2>
                    </div>
                    <div class="mt-3">  
                        <!-- Nutrition progress -->
                        <div class="mt-4 grid grid-cols-4 gap-3 sm:mt-5 sm:grid-cols-4 sm:gap-5 sm:px-5 lg:mt-6">
                            <div class="card col-span-2 justify-between p-5">
                                <p class="font-medium">Kalori</p>
                                <div class="flex items-center justify-between pt-4">
                                    <p class="text-slate-700 dark:text-navy-100">
                                        <span class="text-slate-800 font-semibold text-3xl">
                                            {{ $food->nutritionFact?->kalori ?? 0 }}
                                        </span>
                                        <span class="text-slate-600 text-sm font-normal">kkal</span>                                        
                                    </p>
                                    <i class='text-green-500 bx bxs-bolt text-3xl'></i>
                                </div>
                            </div>

                            <div class="card col-span-2 justify-between p-5">
                                <p class="font-medium">Karbohidrat</p>
                                <div class="flex items-center justify-between pt-4">
                                    <p class="text-slate-700 dark:text-navy-100">
                                        <span class="text-slate-800 font-semibold text-3xl">
                                            {{ $food->nutritionFact?->karbohidrat_total ?? 0 }}
                                        </span>
                                        <span class="text-slate-600 text-sm font-normal">grams</span>                                        
                                    </p>
                                    <i class='text-orange-500 bx bxs-hot text-3xl'></i>
                                </div>
                            </div>

                            <div class="card col-span-2 justify-between p-5">
                                <p class="font-medium">Protein</p>
                                <div class="flex items-center justify-between pt-4">
                                    <p class="text-slate-700 dark:text-navy-100">
                                        <span class="text-slate-800 font-semibold text-3xl">
                                            {{ $food->nutritionFact?->protein ?? 0 }}
                                        </span>
                                        <span class="text-slate-600 text-sm font-normal">grams</span>  
                                    </p>
                                    <i class='text-blue-500 bx bxs-bone text-3xl'></i>
                                </div>
                            </div>

                            <div class="card col-span-2 justify-between p-5">
                                <p class="font-medium">Lemak</p>
                                <div class="flex items-center justify-between pt-4">
                                    <p class="text-slate-700 dark:text-navy-100">
                                        <span class="text-slate-800 font-semibold text-3xl">
                                            {{ $food->nutritionFact?->lemak_total ?? 0 }}
                                        </span>
                                        <span class="text-slate-600 text-sm font-normal">grams</span>  
                                    </p>
                                    <i class='text-yellow-500 bx bx-body text-3xl'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Other Nutritions -->
            <div class="flex flex-col mt-5 rounded-xl bg-info/10 py-3 dark:bg-navy-800 lg:flex-row">
                <div class="flex flex-col px-4 sm:px-5 lg:w-48 lg:shrink-0 lg:py-3">
                    <h3 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-lg">
                        Other Nutritions
                    </h3>
                    <p class="mt-3 grow text-xs">
                        Penting untuk memahami komposisi dan nilai <span class="font-semibold">nutrisi</span> dari makanan yang dikonsumsi.
                    </p>
                    <div class="mt-3 flex items-center space-x-2">
                        <i class='bx bxs-chevrons-right text-xl text-success'></i>
                    </div>
                </div>
                <div class="scrollbar-sm mt-5 flex space-x-4 overflow-x-auto px-4 sm:px-5 lg:mt-0 lg:pl-0">
                    @foreach(['lemak_jenuh', 'gula', 'garam', 'serat', 'vit_a', 'vit_d', 'vit_e', 'vit_k', 'vit_b1', 'vit_b2', 'vit_b3', 'vit_b5', 'vit_b6', 'folat', 'vit_b12', 'biotin', 'kolin', 'vit_c', 'kalsium', 'fosfor', 'magnesium', 'natrium', 'kalium', 'mangan', 'tembaga', 'kromium', 'besi', 'iodium', 'seng', 'selenium', 'fluor'] as $nutri)
                        <div class="flex w-36 shrink-0 flex-col items-center">
                            <div class="card mt-5 w-full rounded-2xl px-3 py-5 text-center">
                                <p class="mt-3 text-base font-medium text-slate-700 dark:text-navy-100">
                                    {{ ucwords(str_replace('_', ' ', $nutri)) }}
                                </p>
                                <div class="mt-6 flex justify-center space-x-1 font-inter">
                                    <p class="text-4xl font-medium text-green-600 dark:text-navy-100">
                                        {{ $food->nutritionFact->$nutri ?? 0 }}
                                    </p>
                                    <p class="mt-1 font-normal text-xs text-slate-500 dark:text-navy-100">
                                        gram
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </main>
</x-app-layout>
