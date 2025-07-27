<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
<div class="shrink-0 flex items-center">
    <a href="{{ route('dashboard') }}" class="text-2xl font-extrabold text-green-500 tracking-wide" style="font-family: 'Pacifico', cursive;">
        Dinelytics
    </a>
</div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500' }} text-sm font-medium leading-5 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        Dashboard
                    </a>
                    <a href="{{ route('dishes.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dishes.index') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500' }} text-sm font-medium leading-5 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        Dishes
                    </a>
                    <a href="{{ route('orders.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('orders.index') ? 'border-indigo-400 text-gray-900' : 'border-transparent text-gray-500' }} text-sm font-medium leading-5 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                        Orders
                    </a>
                </div>
            </div>

            <!-- Hamburger Button (Mobile) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('dashboard') ? 'border-indigo-400 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-600' }} text-base font-medium hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">
                Dashboard
            </a>
            <a href="{{ route('dishes.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('dishes.index') ? 'border-indigo-400 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-600' }} text-base font-medium hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">
                Dishes
            </a>
            <a href="{{ route('orders.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('orders.index') ? 'border-indigo-400 bg-indigo-50 text-indigo-700' : 'border-transparent text-gray-600' }} text-base font-medium hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800">
                Orders
            </a>
        </div>
    </div>
</nav>
