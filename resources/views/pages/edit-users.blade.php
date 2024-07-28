<x-app-layout title="Edit Data User" is-header-blur="true">
    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">

        <!-- Notification -->
        <div id="delete_success" class="fixed bottom-5 right-5 bg-green-500 text-white px-6 py-2 rounded-md shadow-md hidden transition-all duration-300 z-1">
            User deleted successfully.
        </div>
        <div id="delete_failed" class="fixed bottom-5 right-5 bg-red-500 text-white px-6 py-2 rounded-md shadow-md hidden transition-all duration-300 z-1">
            Failed to delete user.
        </div>
        <div id="create_success" class="fixed bottom-5 right-5 bg-green-500 text-white px-6 py-2 rounded-md shadow-md hidden transition-all duration-300 z-1">
            User created successfully.
        </div>
        <div id="create_failed" class="fixed bottom-5 right-5 bg-red-500 text-white px-6 py-2 rounded-md shadow-md hidden transition-all duration-300 z-1">
            Failed to create user.
        </div>
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
                        <a class="text-primary hover:underline" href="{{ route('users') }}">Users</a> 
                    </li>
                    <svg x-ignore xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <li class="flex items-center space-x-2">
                        <a class="text-primary hover:underline" href="{{ route('edit-user-form', $user->id) }}">Edit User</a> 
                    </li>
                </ul>
            </div>
        </div>

        <form action="{{ route('user-update', $user->id) }}" method="POST">
            @method('PUT') @csrf
            
            <div class="flex flex-col items-center justify-between space-y-1 py-5 sm:flex-row sm:space-y-0 lg:py-6">
                <div class="flex items-center space-x-1">
                    <i class='bx bx-message-square-edit text-3xl'></i>
                    <h2 class="text-xl font-medium text-slate-700 line-clamp-1 dark:text-navy-50">
                        Edit User
                    </h2>
                </div>  
                
            </div>
    
            <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
                <div class="col-span-12 lg:col-span-8">
                    <div class="card h-full">
                        <div class="tabs flex flex-col">
                            <div class="tab-content p-4 sm:p-5">
                                <div class="space-y-5">
                                    <div class="space-y-5">
                                        <button class="btn size-9 border border-primary p-0 font-medium text-primary hover:bg-primary hover:text-white focus:bg-primary focus:text-white active:bg-primary/90 dark:border-accent dark:text-accent-light dark:hover:bg-accent dark:hover:text-white dark:focus:bg-accent dark:focus:text-white dark:active:bg-accent/90">
                                            <i class='bx bxs-user-detail text-sm+'></i>
                                        </button> 
                                        <div>
                                            <div class="mt-5 gap-4 sm:grid-cols-2 sm:gap-5 lg:gap-6">
                                                <label class="block">
                                                    <span class="font-medium text-slate-600 dark:text-navy-100">Full Name</span>
                                                    <span class="relative mt-1.5 flex">
                                                      <input
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                        placeholder="User Name"
                                                        value="{{ $user->fullname }}"
                                                        type="text"
                                                      />
                                                      <span
                                                        class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                                                      >
                                                      <i class='bx bx-user-circle text-base'></i> 
                                                      </span>
                                                    </span>
                                                  </label>
        
                                                  <label class="mt-5 block">
                                                    <span class="font-medium text-slate-600 dark:text-navy-100">Email</span>
                                                    <span class="relative mt-1.5 flex">
                                                      <input
                                                        class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                                        placeholder="user@example.com"
                                                        name="email"
                                                        value="{{ $user->email }}"
                                                        type="email"
                                                      />
                                                      <span
                                                        class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                                                      >
                                                      <i class='bx bx-envelope text-base'></i>
                                                      </span>
                                                    </span>
                                                  </label>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="flex space-x-2 mt-18">
                                        <button class="btn min-w-[7rem] bg-primary font-medium text-white hover:bg-[#60F166] focus:bg-[#60F166] active:bg-[#60F166]">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-4">
                    <div class="card space-y-5 p-4 sm:p-5">
                        <label class="mt-5 block">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Weight (*kg)</span>
                            <span class="relative mt-1.5 flex">
                              <input
                                class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Type weight..."
                                name="weight"
                                value="{{ $user->weight }}"
                                type="number"
                              />
                            </span>
                        </label>
                        <label class="mt-5 block">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Height (*cm)</span>
                            <span class="relative mt-1.5 flex">
                              <input
                                class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                placeholder="Type height..."
                                name="height"
                                value="{{ $user->height }}"
                                type="number"
                              />
                            </span>
                        </label>
                        <label class="block">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Gender</span>
                            <select class="mt-1.5 w-full" x-init="$el._x_tom = new Tom($el, { create: true, sortField: { field: 'text', direction: 'desc' } })" name="gender">
                                <option value="">Select the gender</option>
                                <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </label>                               
                        <label for="birthday" class="block">
                            <span class="font-medium text-slate-600 dark:text-navy-100">Birthday</span>
                            <label class="relative flex">
                                <input
                                  x-init="$el._x_flatpickr = flatpickr($el,{altInput: true,altFormat: 'F j, Y',dateFormat: 'Y-m-d'})"
                                  class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent mt-1.5 px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"
                                  placeholder="Choose date..."
                                  name="birthday"
                                  type="text"
                                  value="{{ $user->birthday }}"
                                />
                                <span
                                  class="pointer-events-none absolute flex h-full w-10 mt-1 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent"
                                >
                                  <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="size-5 transition-colors duration-200"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                  >
                                    <path
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                  </svg>
                                </span>
                              </label>
                        </label>                 
                    </div>
                </div>
            </div>
        </form>
    </main>
</x-app-layout>
