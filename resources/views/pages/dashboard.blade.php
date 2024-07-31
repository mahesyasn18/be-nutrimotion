<x-app-layout title="Dashboard" is-header-blur="true">
    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="flex items-center space-x-4 py-5 lg:py-6">
            <a class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-xl" href="{{ route('dashboard') }}">
                Nutrimotion
            </a>
            <svg x-ignore xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <ul class="hidden flex-wrap items-center space-x-2 sm:flex">
                <li class="flex items-center space-x-2">
                    <a class="text-primary hover:underline" href="{{ route('dashboard') }}">Dashboards</a> 
                </li>
            </ul>
        </div>
        
        <div class="grid grid-cols-14 sm:mt-5 sm:gap-5 lg:mt-3 lg:gap-6">
            <div class="col-span-12 lg:col-span-8 xl:col-span-9">
                <div class="card rounded-3xl col-span-12 bg-[#60F166] mt-12 bg- p-5 sm:col-span-8 sm:mt-0 sm:flex-row dark:bg-[#60F166]">
                    <div class="flex justify-center sm:order-last p-4">
                        <img class="-mt-16 h-40 sm:mt-0" src="{{ asset('images/illustrations/broccoli.png') }}" alt="image" />
                    </div>
                    <div class="mt-2 flex-1 p-6 text-slate-800 text-center sm:mt-0 sm:text-left">
                        <div class="mt-6">
                           <h3 class="text-3xl">Hello, 
                                @if (Auth::guard('admin')->check())
                                    <span class="font-semibold">{{ Auth::guard('admin')->user()->email }}</span>
                                @else
                                    <span class="font-semibold">Admin</span>
                                @endif 
                           </h3>

                            <p class="mt-3 leading-relaxed">Gunakan menu di samping untuk menavigasi dan mengelola pengguna, <br> makanan, serta aktivitas dengan mudah.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <div class="mt-3 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6">
                <div class="card rounded-2xl justify-between sm:p-5">
                    
                    <div>
                        <p class="font-medium">Users</p>
                        <p class="text-3xl font-semibold text-slate-700 dark:text-green-500">
                            {{ $userCount }}
                        </p>
                    </div>

                    <img class="h-32 object-contain my-6 sm:mt-0" src="{{ asset('images/illustrations/user.png') }}" alt="image" />

                    <div class="flex justify-end">
                        <a href="{{ route('users') }}">
                            <button
                                class="btn h-8 w-8 rounded-full bg-slate-150 p-0 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-45" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                </svg>
                            </button>
                        </a>
                    </div>
                    
                </div>
                
                <div class="card rounded-2xl justify-between sm:p-5">
                    
                    <div>
                        <p class="font-medium">Foods</p>
                        <p class="text-3xl font-semibold text-slate-700 dark:text-green-500">
                            {{ $foodCount }}
                        </p>
                    </div>

                    <img class="h-32 object-contain my-6 sm:mt-0" src="{{ asset('images/illustrations/food.png') }}" alt="image" />

                    <div class="flex justify-end">
                        <a href="{{ route('foods') }}">
                            <button
                                class="btn h-8 w-8 rounded-full bg-slate-150 p-0 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-45" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                </svg>
                            </button>
                        </a>
                    </div>
                    
                </div>

                <div class="card rounded-2xl justify-between sm:p-5">
                    
                    <div>
                        <p class="font-medium">Activities</p>
                        <p class="text-3xl font-semibold text-slate-700 dark:text-green-500">
                            {{ $activityCount }}
                        </p>
                    </div>

                    <img class="h-32 object-contain my-6 sm:mt-0" src="{{ asset('images/illustrations/activity.png') }}" alt="image" />

                    <div class="flex justify-end">
                        <a href="{{ route('activities') }}">
                            <button
                                class="btn h-8 w-8 rounded-full bg-slate-150 p-0 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-45" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                </svg>
                            </button>
                        </a>
                    </div>
                    
                </div>  
            </div>
        </div>
    </main>
</x-app-layout>
