<x-app-layout title="{{ $activity->activity_name }}" is-header-blur="true">
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
                    <a class="text-primary hover:underline" href="{{ route('activities') }}">Activities</a> 
                </li>
            </ul>
            <svg x-ignore xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a class="text-primary hover:underline" href="{{ route('activity-detail', $activity->id) }}">{{ $activity->activity_name }}</a> 
                </li>
            </ul>
        </div>

        <div class="card p-4 lg:p-6">
            <div class="space-y-9 p-4 sm:p-5">
                    <div class="flex justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="avatar size-24">
                                @if ($activity->photo)
                                    <img class="rounded-full" src="{{ $activity->photo }}" alt="Activity Image">
                                @else
                                    <img class="rounded-full" src="{{asset('images/illustrations/activity.png')}}" alt="avatar"/>
                                @endif
                                <div
                                  class="absolute right-0 m-1.5 size-4 rounded-full border-2 border-white bg-primary dark:border-navy-700 dark:bg-accent"
                                ></div>
                              </div>
                            <div>
                                <p class="font-medium text-3xl text-slate-700 dark:text-navy-100">
                                    {{ $activity->activity_name }}
                                </p>
                            </div>
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
                                {{ $totalCalories }}
                            </span>
                            <span class="text-slate-600 text-sm font-normal">grams</span>                            
                        </p>
                        <p class="mt-3 text-base font-medium tracking-wide text-slate-600">
                            Total Calories
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
                            Calories
                        </h2>
                    </div>
                    <div class="mt-3">  
                        <!-- Nutrition progress -->
                        <div class="mt-4 grid grid-cols-4 gap-3 sm:mt-5 sm:grid-cols-4 sm:gap-5 sm:px-5 lg:mt-6">
                            <div class="card col-span-2 justify-between p-5">
                                <p class="font-medium">Jumlah Kalori Rendah</p>
                                <div class="flex items-center justify-between pt-4">
                                    <p class="text-slate-700 dark:text-navy-100">
                                        <span class="text-slate-800 font-semibold text-3xl">
                                            {{ $activity->jumlah_kalori_rendah ?? 0 }}
                                        </span>
                                        <span class="text-slate-600 text-sm font-normal">kkal</span>                                        
                                    </p>
                                    <i class='text-orange-500 bx bx-signal-2 text-5xl'></i>
                                </div>
                            </div>

                            <div class="card col-span-2 justify-between p-5">
                                <p class="font-medium">Jumlah Kalori Sedang</p>
                                <div class="flex items-center justify-between pt-4">
                                    <p class="text-slate-700 dark:text-navy-100">
                                        <span class="text-slate-800 font-semibold text-3xl">
                                            {{ $activity->jumlah_kalori_sedang ?? 0 }}
                                        </span>
                                        <span class="text-slate-600 text-sm font-normal">kkal</span>                                       
                                    </p>
                                    <i class='text-yellow-500 bx bx-signal-3 text-5xl'></i>
                                </div>
                            </div>

                            <div class="card col-span-4 justify-between p-5">
                                <p class="font-medium">Jumlah Kalori Tinggi</p>
                                <div class="flex items-center justify-between pt-4">
                                    <p class="text-slate-700 dark:text-navy-100">
                                        <span class="text-slate-800 font-semibold text-3xl">
                                            {{ $activity->jumlah_kalori_tinggi ?? 0 }}
                                        </span>
                                        <span class="text-slate-600 text-sm font-normal">kkal</span> 
                                    </p>
                                    <i class='text-green-500 bx bx-signal-4 text-5xl'></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            
            <div class="is-scrollbar-hidden min-w-full overflow-x-auto mt-10">
                <table class="w-full text-left">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">#</th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">User</th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Tanggal</th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Kalori</th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">Detail</th>
                        </tr>
                    </thead>
                    <tbody x-data="{ expanded: null }">
                        @foreach($activity->detailDailyActivity as $index => $detail)
                        <tr class="border-y border-transparent">
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ $loop->iteration }}
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ $detail->dailyActivity->user->fullname }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ $detail->dailyActivity->tanggal }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                {{ $detail->dailyActivity->kalori }} kkal
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <button @click="expanded === {{ $index }} ? expanded = null : expanded = {{ $index }}" class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <i :class="expanded === {{ $index }} && '-rotate-180'" class="fas fa-chevron-down text-sm transition-transform"></i>
                                </button>
                            </td>    
                        </tr>
                        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                            <td colspan="100" class="p-0">
                                <div x-show="expanded === {{ $index }}" x-collapse>
                                    <div class="px-4 pb-4 sm:px-5">
                                        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                                            <table class="is-hoverable w-full text-left">
                                                <thead>
                                                    <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                        <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">Durasi</th>
                                                        <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">Total Kalori</th>
                                                        <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">Waktu</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                            {{ $detail->durasi }} menit
                                                        </td>
                                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                            {{ $detail->total_kalori }} kkal
                                                        </td>
                                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                            {{ $detail->waktu }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="text-right">
                                            <button @click="expanded = null" class="btn mt-2 h-8 rounded px-3 text-xs+ font-medium text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25">
                                                Hide
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>                        
                </table>
            </div>

            <div class="flex flex-col justify-between space-y-4 px-4 py-4 sm:flex-row sm:items-center sm:space-y-0 sm:px-5">
            <div class="text-xs+">1 - 10 of 10 entries</div>
        </div>
    </main>
</x-app-layout>
