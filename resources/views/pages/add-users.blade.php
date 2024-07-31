<x-app-layout title="Add Data User" is-header-blur="true">
    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-6 flex flex-col items-center justify-between space-y-2 text-center sm:flex-row sm:space-y-0 sm:text-left">
            <div class="flex items-center space-x-4 py-5 lg:py-6">
                <a class="text-xl font-medium text-slate-800 dark:text-navy-50 lg:text-xl" href="{{ route('dashboard') }}">
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
                        <a class="text-primary hover:underline" href="{{ route('add-user-form') }}">Add User</a> 
                    </li>
                </ul>
            </div>
        </div>

        <form action="{{ route('user-store') }}" method="POST">
            @method('POST') @csrf

            @if ($errors->has('error'))
                <div class="alert flex space-x-2 rounded-lg border border-error px-1 py-1 text-error text-tiny+ mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <p>{{ $errors->first('error') }}</p>
                </div>
            @endif


            <div class="flex flex-col items-center justify-between space-y-1 py-5 sm:flex-row sm:space-y-0 lg:py-6">
                <div class="flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h2 class="text-xl font-medium text-slate-700 line-clamp-1 dark:text-navy-50">
                        New User
                    </h2>
                </div>
                <div>
                    <div class="flex justify-center space-x-2">
                        <button class="btn min-w-[7rem] bg-primary font-medium text-white hover:bg-[#60F166] focus:bg-[#60F166] active:bg-[#60F166]">
                            Add
                        </button>
                    </div>
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
                                            <i class='bx bxs-user-plus text-sm+'></i>
                                        </button> 
                                        <div>
                                            <div
                                                x-data="pages.formValidation.initFormValidationExample"
                                                class="mt-5 gap-4 sm:grid-cols-2 sm:gap-5 lg:gap-6">
                                                <div>
                                                    <label for="fullname" class="block">
                                                        <div class="flex-row">
                                                            <span class="font-medium text-slate-600 dark:text-navy-100">Full Name</span>
                                                            <span
                                                                class="text-tiny+ text-error float-end"
                                                                x-show="username.blurred && username.errorMessage"
                                                                x-text="username.errorMessage"
                                                            ></span>
                                                        </div>
                                                        <input
                                                        x-effect="username.errorMessage = getErrorMessage(username.value, username.validate)"
                                                        class="form-input mt-1.5 w-full rounded-lg border bg-transparent px-3 py-2 placeholder:text-slate-400/70"
                                                        placeholder="Full Name"
                                                        name="fullname"
                                                        type="text"
                                                        :class="{
                                                            'border-slate-300 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent':!username.blurred,
                                                            'border-error': (username.blurred && username.errorMessage),
                                                            'border-success': (username.blurred && !username.errorMessage)
                                                        }"
                                                        x-model="username.value"
                                                        @blur="username.blurred = true"
                                                        />
                                                    </label>
                                                </div>
        
                                                <div class="mt-5">
                                                    <label class="block">
                                                        <div class="flex-row">
                                                            <span class="font-medium text-slate-600 dark:text-navy-100">Full Name</span>
                                                            <span
                                                                class="text-tiny+ text-error float-end"
                                                                x-show="email.blurred && email.errorMessage"
                                                                x-text="email.errorMessage"
                                                            ></span>
                                                        </div>
                                                        <input
                                                        x-effect="email.errorMessage = getErrorMessage(email.value, email.validate)"
                                                        class="form-input mt-1.5 w-full rounded-lg border bg-transparent px-3 py-2 placeholder:text-slate-400/70"
                                                        placeholder="userexample@gmail.com"
                                                        name="email"
                                                        type="text"
                                                        :class="{
                                                            'border-slate-300 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent': !email.blurred,
                                                            'border-error': (email.blurred && email.errorMessage),
                                                            'border-success': (email.blurred && !email.errorMessage)
                                                        }"
                                                        x-model="email.value"
                                                        @blur="email.blurred = true"
                                                        />
                                                    </label>
                                                </div>
        
                                                <div class="mt-5">
                                                    <label class="block">
                                                        <span>Password</span>
                                                        <input
                                                        x-effect="minmaxLength.errorMessage = getErrorMessage(minmaxLength.value, minmaxLength.validate)"
                                                        class="form-input mt-1.5 w-full rounded-lg border bg-transparent px-3 py-2 placeholder:text-slate-400/70"
                                                        placeholder="Minimum 8 char"
                                                        name="password"
                                                        type="password"
                                                        :class="{
                                                            'border-slate-300 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent': !minmaxLength.blurred,
                                                            'border-error': (minmaxLength.blurred && minmaxLength.errorMessage),
                                                            'border-success': (minmaxLength.blurred && !minmaxLength.errorMessage)
                                                        }"
                                                        x-model="minmaxLength.value"
                                                        @blur="minmaxLength.blurred = true"
                                                        />
                                                    </label>
                                                    <span
                                                        class="text-tiny+ text-error"
                                                        x-show="minmaxLength.blurred && minmaxLength.errorMessage"
                                                        x-text="minmaxLength.errorMessage"
                                                    ></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-4">
                    <div class="card space-y-5 p-4 sm:p-5">
                        <div >
                            <label class="block">
                                <div x-data="pages.formValidation.initFormValidationExample">
                                    <div class="flex-row">
                                        <span class="font-medium text-slate-600 dark:text-navy-100">Weight (*kg)</span>
                                        <span class="text-tiny+ text-error float-end" x-show="username.blurred && username.errorMessage"x-text="username.errorMessage"></span>
                                    </div>
                                    <label class="block">
                                        <input
                                        x-effect="username.errorMessage = getErrorMessage(username.value, username.validate)"
                                        class="form-input mt-1.5 w-full rounded-lg border bg-transparent px-3 py-2 placeholder:text-slate-400/70"
                                        placeholder="Type weight..."
                                        name="weight"
                                        type="number"
                                        :class="{
                                            'border-slate-300 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent':!username.blurred,
                                            'border-error': (username.blurred && username.errorMessage),
                                            'border-success': (username.blurred && !username.errorMessage)
                                        }"
                                        x-model="username.value"
                                        @blur="username.blurred = true"
                                        />
                                    </label>
                                </div>
                            </label>
                        </div>
                        <label class="block">
                            <div x-data="pages.formValidation.initFormValidationExample">
                                <div class="flex-row">
                                    <span class="font-medium text-slate-600 dark:text-navy-100">Height (*cm)</span>
                                    <span class="text-tiny+ text-error float-end" x-show="username.blurred && username.errorMessage"x-text="username.errorMessage"></span>
                                </div>
                                <label class="block">
                                    <input
                                    x-effect="username.errorMessage = getErrorMessage(username.value, username.validate)"
                                    class="form-input mt-1.5 w-full rounded-lg border bg-transparent px-3 py-2 placeholder:text-slate-400/70"
                                    placeholder="Type height..."
                                    name="height"
                                    type="number"
                                    :class="{
                                        'border-slate-300 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent':!username.blurred,
                                        'border-error': (username.blurred && username.errorMessage),
                                        'border-success': (username.blurred && !username.errorMessage)
                                    }"
                                    x-model="username.value"
                                    @blur="username.blurred = true"
                                    />
                                </label>
                            </div>
                        </label>
                        <div x-data="pages.formValidation.initFormValidationExample">
                            <label class="block">
                                <div class="flex-row">
                                    <span class="font-medium text-slate-600 dark:text-navy-100">Gender</span>
                                    <span
                                        class="text-tiny+ text-error float-end"
                                        x-show="gender.blurred && gender.errorMessage"
                                        x-text="gender.errorMessage"
                                    ></span>
                                </div>
                                <select
                                    x-effect="gender.errorMessage = getErrorMessage(gender.value, gender.validate)"
                                    class="mt-1.5 w-full rounded-lg border bg-transparent px-3 py-2"
                                    name="gender"
                                    :class="{
                                        'border-slate-300 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent': !gender.blurred,
                                        'border-error': (gender.blurred && gender.errorMessage),
                                        'border-success': (gender.blurred && !gender.errorMessage)
                                    }"
                                    x-model="gender.value"
                                    @blur="gender.blurred = true"
                                >
                                    <option value="">Select the gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </label>
                        </div>                    
                        <div x-data="pages.formValidation.initFormValidationExample">
                            <label class="block">
                                <div class="flex-row">
                                    <span class="font-medium text-slate-600 dark:text-navy-100">Date of Birth</span>
                                    <span
                                        class="text-tiny+ text-error float-end"
                                        x-show="dob.blurred && dob.errorMessage"
                                        x-text="dob.errorMessage"
                                    ></span>
                                </div>
                                <span class="relative mt-1.5 flex">
                                    <input
                                        x-init="$el._x_flatpickr = flatpickr($el,{altInput: true,altFormat: 'F j, Y',dateFormat: 'Y-m-d'})"
                                        x-effect="dob.errorMessage = getErrorMessage(dob.value, dob.validate)"
                                        class="form-input peer w-full rounded-lg border bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70"
                                        placeholder="Choose date..."
                                        name="birthday"
                                        type="text"
                                        :class="{
                                            'border-slate-300 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent': !dob.blurred,
                                            'border-error': (dob.blurred && dob.errorMessage),
                                            'border-success': (dob.blurred && !dob.errorMessage)
                                        }"
                                        x-model="dob.value"
                                        @blur="dob.blurred = true"
                                    />
                                    <span
                                        class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary dark:text-navy-300 dark:peer-focus:text-accent">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-colors duration-200"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </span>
                                </span>
                            </label>
                        </div>                    
                    </div>
                </div>
            </div>
        </form>
    </main>
</x-app-layout>
