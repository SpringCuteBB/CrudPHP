<div class="flex flex-col pt-[4.6rem] px-20">
    <h1 class="roboto-condensed font-bold text-5xl">CrudPHP</h1>
    <p class="pt-[3rem] pb-[2rem]">
        CrudPHP is a personal project by <span class="font-bold">Ismael Valenzuela Mañas</span>. This project
        was made with <span class="font-bold">Laravel, JavaScript, TailwindCSS</span> and much more
        tecnologies... This website is a full C.R.U.D were you can Create, Read,
        Update and Delete offers from a pizzeria (or whatever you want) using a
        system of login and a personal API.
    </p>
    <hr class="pb-[2rem]" />
    <div class="flex w-full gap-1">
        <h2 class="roboto-condensed font-bold text-3xl mb-3">Offers</h2>
        <img src="spinner.gif" class="w-5 h-5" id="spinner" alt="" style="display: none" />
    </div>

    <div class="grid grid-cols-2 mb-3 h-[48px]">
        <div class="span-col-1 flex justify-start gap-1">
            <input type="text" name="search" placeholder="Type here..." id="search"
                class="w-[80%] p-2 border border-gray-200 rounded-md" />
            <input type="button" value="Search" id="searchButton"
                class="bg-gray-200 text-gray-500 font-bold h-full px-6 rounded-md hover:cursor-pointer hover:bg-gray-300 transition-all" />
        </div>
        <div class="span-col-1 flex justify-end gap-5 items-center overflow-hidden">
            <div id="filters" class="filters overflow-hidden flex gap-2">
                <div class="flex flex-col">
                    <label for="startDate" class="text-sm">Start Date:</label>
                    <input type="date" name="startDate" id="startDate"
                        class="border border-gray-900 h-[1.7rem] rounded-md" />
                </div>
                <div class="flex flex-col">
                    <label for="endDate" class="text-sm">End Date:</label>
                    <input type="date" name="endDate" id="endDate"
                        class="border border-gray-900 h-[1.7rem] rounded-md" />
                </div>
                <div class="flex flex-col">
                    <label for="type" class="text-sm">Type:</label>
                    <select name="type" id="type" class="border border-gray-900 h-[1.7rem] rounded-md">
                        <option value="both">Both</option>
                        <option value="cupon">Coupon</option>
                        <option value="descuento">Discount</option>
                    </select>
                </div>
            </div>
            <x-svgs.filter-svg />
            <a class="bg-gray-900 py-2 px-4 rounded-md text-white font-bold hover:cursor-pointer hover:bg-gray-800 transition-all"
                href="{{ route('createNewOffer') }}">
                <span class="mr-2">+</span>
                Create offer
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200 text-gray-500">
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 rounded-tl-md">
                        ID
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200">Title</th>
                    <th class="py-2 px-4 border-b border-gray-200">Company</th>
                    <th class="py-2 px-4 border-b border-gray-200">Type</th>

                    <th class="py-2 px-4 border-b border-gray-200">
                        Start date
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200">End date</th>
                    <th class="py-2 px-4 border-b border-gray-200 rounded-tr-md">
                        Creator
                    </th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <div class="flex justify-center items-center mt-5 mb-8" id="pagination">
        <button id="previous"
            class="bg-gray-900 text-white border-2 disabled:bg-gray-700 disabled:cursor-default border-gray-900 pl-3 pr-2 rounded-tl-full rounded-bl-full hover:cursor-pointer hover:bg-gray-800 transition-all"
            disabled>
            {{ _('<') }}
        </button>
        <p class="actual-page px-8 border-t-2 border-b-2 border-gray-900" id="actualPage">
            1
        </p>
        <button id="next"
            class="bg-gray-900 text-white border-2 disabled:bg-gray-700 disabled:cursor-default border-gray-900 pl-2 pr-3 rounded-tr-full rounded-br-full hover:cursor-pointer hover:bg-gray-800 transition-all"
            disabled>
            {{ _('>') }}
        </button>
    </div>
</div>

@vite('resources/js/main.js')
