<x-app-layout title="   Dashboard" is-header-blur="true">
    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 grid grid-cols-14 sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6">
            <div class="col-span-12 lg:col-span-8 xl:col-span-9">
                <div class="card col-span-12 mt-12 bg-gradient-to-r from-blue-500 to-blue-600 p-5 sm:col-span-8 sm:mt-0 sm:flex-row">
                    <div class="flex justify-center sm:order-last">
                        <img class="-mt-16 h-40 sm:mt-0" src="{{ asset('images/illustrations/doctor.svg') }}" alt="image" />
                    </div>
                    <div class="mt-2 flex-1 pt-2 text-center text-white sm:mt-0 sm:text-left">
                        @if (Auth::guard('admin')->check())
                            <h3 class="text-xl">
                                Hallo, <span class="font-semibold">{{ Auth::guard('admin')->user()->name }}</span>
                            </h3>
                        @else
                            <h3 class="text-xl">
                                Hallo, <span class="font-semibold">Admin</span>
                            </h3>
                        @endif

                        <p class="mt-2 leading-relaxed">Have a nice day at work</p>
                        <p>Progress is <span class="font-semibold">excellent!</span></p>

                        <button
                            class="btn mt-6 border border-white/10 bg-white/20 text-white hover:bg-white/30 focus:bg-white/30">
                            View Schedule
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
