<nav class="grid grid-cols-12">
    <div
        class="xl:col-span-2 md:col-span-4 h-12 col-span-12 bg-gray-100 border border-gray-200 border-r-2 flex items-center px-2 justify-between">
        <x-svgs.rabduck-icon />
        <div class="flex items-center mr-2">
            @guest
                <button class="mr-3 text-gray-900 hover:text-[#fe136d] transition-all underline"
                    onclick="window.location.href='{{ route('register') }}'">Register</button>
                <button
                    class="bg-gray-900 hover:bg-[#fe136d] transition-all text-white rounded-md py-1 px-4 flex items-center"
                    onclick="window.location.href='{{ route('login') }}'">
                    <x-svgs.log-in-svg />
                    Login
                </button>
            @endguest

            @auth
                <x-dropdown align="right" width="28">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500  hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>Hello, <span class="text-[#fe136d] font-bold uppercase">{{ Auth::user()->name }}</span>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" class="text-red-500"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            @endauth
        </div>
    </div>
    <div
        class="xl:col-span-10 md:col-span-8 h-12 col-span-12 bg-gray-50 border border-gray-200 border-l-0 flex items-center px-4">
        <a href="{{ route('controlPanel') }}"> {{ __('Control Panel') }}</a>
        {{-- <x-svgs.arrow-svg /> --}}
    </div>
</nav>
