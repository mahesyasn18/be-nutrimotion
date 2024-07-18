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
            <h1 class="text-3xl text-slate-800 font-bold">{{ $food->food_name }}</h1>

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
                            <span class="text-slate-800 font-semibold text-3xl">{{ $totalNutrition }}</span>
                            <span class="text-slate-600 text-sm font-normal">grams</span>
                        </p>
                        <p class="mt-3 text-base font-medium tracking-wide text-slate-600">
                            Total Nutritions
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
                            Nutritions
                        </h2>
                    </div>
                    <div class="mt-3">  
                        <!-- Nutrition progress -->
                        <div class="mt-4 grid grid-cols-4 gap-3 sm:mt-5 sm:grid-cols-4 sm:gap-5 sm:px-5 lg:mt-6">
                            @foreach(['kalori', 'protein', 'karbohidrat_total', 'lemak_total', 'gula'] as $field)
                                @if(isset($food->nutritionFact->$field))
                                    <div class="rounded-lg col-span-2 bg-slate-100 p-4 dark:bg-navy-600">
                                        <div class="flex justify-between space-x-1">
                                            <p class="text-2xl font-semibold text-slate-700 dark:text-navy-100">
                                                {{ $food->nutritionFact->$field }} <span class="text-sm+ font-normal">grams</span>
                                            </p>
                                        </div>
                                        <p class="mt-1 text-xs+">
                                            @if($field === 'kalori')
                                                Kalori
                                            @elseif($field === 'protein')
                                                Protein
                                            @elseif($field === 'karbohidrat_total')
                                                Total Carbohydrates
                                            @elseif($field === 'lemak_total')
                                                Total Fat
                                            @elseif($field === 'gula')
                                                Gula
                                            @endif
                                        </p>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </main>
</x-app-layout>
