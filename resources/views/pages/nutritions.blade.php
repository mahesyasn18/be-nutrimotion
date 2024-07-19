<x-app-layout title="Nutritions" is-header-blur="true">
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
                    <a class="text-primary hover:underline" href="{{ route('nutritions') }}">Nutritions</a> 
                </li>
            </ul>
        </div>

        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            Nutrition
                        </th>
                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                            LIST OF FOODS
                        </th>
                    </tr>
                </thead>
                <tbody x-data="{ expanded: null }">
                    @foreach($columns as $index => $column)
                        <tr class="border-y border-transparent">
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                {{ $column }}
                            </td>
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <button @click="expanded === {{ $index }} ? expanded = null : expanded = {{ $index }}" class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                    <i :class="expanded === {{ $index }} && '-rotate-180'" class="fas fa-chevron-down text-sm transition-transform"></i>
                                </button>
                                <div x-show="expanded === {{ $index }}" x-collapse>
                                    <div class="px-4 pb-4 sm:px-5">
                                        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                                            <table class="is-hoverable w-full text-left">
                                                <thead>
                                                    <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                        <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                            #
                                                        </th>
                                                        <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                            FOOD NAME
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($nutritions as $nutrition)
                                                        @if(isset($nutrition->food))
                                                            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                                    {{ $nutrition->food->id }}
                                                                </td>
                                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                                    {{ $nutrition->food->food_name }}
                                                                </td>
                                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                                    <a href="{{ route('food-detail', $nutrition->food->id) }}"><i class='bx bx-chevron-right text-2xl text-blue-400 hover:text-blue-600'></i></a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</x-app-layout>
