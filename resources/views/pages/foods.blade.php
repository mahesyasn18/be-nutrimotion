<x-app-layout title="Foods" is-header-blur="true">
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

        <div class="mt-3 flex flex-col items-center justify-between space-y-2 text-center sm:flex-row sm:space-y-0 sm:text-left">
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
            </div>
    
            <a href="{{ route('add-food-form') }}">
                <button
                    class="btn space-x-2 bg-primary font-medium text-white shadow-lg shadow-primary/50 hover:bg-[#458d51] dark:bg-accent dark:shadow-accent/50 dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-50" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    <span>Add Food</span>
                </button>
            </a>
        </div>

        <div>
            <div class="flex items-center justify-between">
              <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                    List of Foods
              </h2>
              <div class="flex">
                <div class="flex items-center" x-data="{isInputActive:false}">
                  <label class="block">
                    <input
                      x-effect="isInputActive === true && $nextTick(() => { $el.focus()});"
                      :class="isInputActive ? 'w-32 lg:w-48' : 'w-0'"
                      class="form-input bg-transparent px-1 text-right transition-all duration-100 placeholder:text-slate-500 dark:placeholder:text-navy-200"
                      placeholder="Search here..."
                      type="text"
                    />
                  </label>
                  <button @click="isInputActive = !isInputActive" class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-4.5 w-4.5"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.5"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                      />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
            <div class="card mt-3">
                <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                        <tr>
                            <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                #
                            </th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                IMAGE
                            </th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                FOOD NAME
                            </th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                SIZE
                            </th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                MORE
                            </th>
                            <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody x-data="{ expanded: null }">
                            @foreach ($foods as $index => $food)
                                <tr class="border-y border-transparent">
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        {{ $food->id }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <div class="avatar flex">
                                            <img class="rounded-full" src="{{asset('images/illustrations/food.png')}}" alt="avatar"/>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                        {{ $food->food_name }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        {{ $food->size }}
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <button @click="expanded === {{ $index }} ? expanded = null : expanded = {{ $index }}" class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                            <i :class="expanded === {{ $index }} && '-rotate-180'" class="fas fa-chevron-down text-sm transition-transform"></i>
                                        </button>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <div
                                            x-data="usePopper({placement:'bottom-end',offset:4})"
                                            @click.outside="if(isShowPopper) isShowPopper = false"
                                            class="inline-flex"
                                        >
                                            <button
                                            x-ref="popperRef"
                                            @click="isShowPopper = !isShowPopper"
                                            class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25"
                                            >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"
                                                />
                                            </svg>
                                            </button>

                                            <div x-ref="popperRoot" class="popper-root" :class="isShowPopper && 'show'">
                                                <div class="popper-box rounded-md border border-slate-150 bg-white py-1.5 font-inter dark:border-navy-500 dark:bg-navy-700">
                                                    <ul>
                                                        <li>
                                                            <a href="{{ route('edit-food-form', $food->id) }}" class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                Edit
                                                            </a>
                                                        </li>
                                                        {{-- <li>
                                                            <a href="{{ route('food-detail', $food->id) }}" class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                Detail
                                                            </a>
                                                        </li> --}}
                                                        <li>
                                                            <form action="{{ route('food-destroy', $food->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this food?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="flex h-8 items-center px-3 pr-8 font-medium tracking-wide outline-none transition-all hover:bg-slate-100 hover:text-slate-800 focus:bg-slate-100 focus:text-slate-800 dark:hover:bg-navy-600 dark:hover:text-navy-100 dark:focus:bg-navy-600 dark:focus:text-navy-100">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
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
                                                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                                    FOOD CATEGORY
                                                                </th>
                                                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                                    FOOD TYPE
                                                                </th>
                                                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                                    BARCODE
                                                                </th>
                                                                <th class="whitespace-nowrap px-3 py-3 font-semibold uppercase text-slate-800 dark:text-navy-100 lg:px-5">
                                                                    TOTAL NUTRITIONS
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                                    {{ $food->food_category }}
                                                                </td>
                                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                                    {{ $food->food_type }}
                                                                </td>
                                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                                    @if ($food->barcode_number == NULL)
                                                                        NULL
                                                                    @else
                                                                        {{ $food->barcode_number }}
                                                                    @endif
                                                                </td>
                                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                                    {{ $totalNutrition[$food->id] }} gram
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                {{-- <div class="text-right">
                                                    <button @click="expanded = null" class="btn mt-2 h-8 rounded px-3 text-xs+ font-medium text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25">
                                                        Hide
                                                    </button>
                                                </div> --}}
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

                <ol class="pagination">
                    <li class="rounded-l-full bg-slate-150 dark:bg-navy-500">
                    <a href="#" class="flex h-8 w-8 items-center justify-center rounded-full text-slate-500 transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:text-navy-200 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                        >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19l-7-7 7-7"
                        />
                        </svg>
                    </a>
                    </li>
                    <li class="bg-slate-150 dark:bg-navy-500">
                    <a
                        href="#"
                        class="flex h-8 min-w-[2rem] items-center justify-center rounded-full px-3 leading-tight transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
                        >1</a
                    >
                    </li>
                    <li class="bg-slate-150 dark:bg-navy-500">
                    <a
                        href="#"
                        class="flex h-8 min-w-[2rem] items-center justify-center rounded-full bg-primary px-3 leading-tight text-white transition-colors hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90"
                        >2</a
                    >
                    </li>
                    <li class="bg-slate-150 dark:bg-navy-500">
                    <a
                        href="#"
                        class="flex h-8 min-w-[2rem] items-center justify-center rounded-full px-3 leading-tight transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
                        >3</a
                    >
                    </li>
                    <li class="bg-slate-150 dark:bg-navy-500">
                    <a
                        href="#"
                        class="flex h-8 min-w-[2rem] items-center justify-center rounded-full px-3 leading-tight transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
                        >4</a
                    >
                    </li>
                    <li class="bg-slate-150 dark:bg-navy-500">
                    <a
                        href="#"
                        class="flex h-8 min-w-[2rem] items-center justify-center rounded-full px-3 leading-tight transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
                        >5</a
                    >
                    </li>
                    <li class="rounded-r-full bg-slate-150 dark:bg-navy-500">
                    <a
                        href="#"
                        class="flex h-8 w-8 items-center justify-center rounded-full text-slate-500 transition-colors hover:bg-slate-300 focus:bg-slate-300 active:bg-slate-300/80 dark:text-navy-200 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90"
                    >
                        <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-4 w-4"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                        </svg>
                    </a>
                    </li>
                </ol>
                </div>
            </div>
          </div>
    </main>
</x-app-layout>
