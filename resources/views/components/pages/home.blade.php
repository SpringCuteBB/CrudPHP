<div class="flex flex-col pt-[4.6rem] px-20">
    <h1 class="roboto-condensed font-bold text-5xl">CrudPHP</h1>
    <p class="pt-[3rem] pb-[2rem]">
        CrudPHP is a personal project by Ismael Valenzuela Mañas. This project
        was made with Laravel, Typescript, TailwindCSS and much more
        tecnologies... This website is a full C.R.U.D were you can Create, Read,
        Update and Delete offers from a pizzeria (or whatever you want) using a
        system of login and a personal API.
    </p>
    <hr class="pb-[2rem]" />
    <h2 class="roboto-condensed font-bold text-3xl mb-3">Offers</h2>

    <div class="grid grid-cols-2 mb-3">
        <div class="span-col-1 flex justify-start gap-1">
            <input
                type="text"
                name="search"
                placeholder="Type here..."
                id="search"
                class="w-[80%] p-2 border border-gray-200 rounded-md"
            />
            <input
                type="button"
                value="Search"
                id="searchButton"
                class="bg-gray-200 text-gray-500 font-bold h-full px-4 rounded-md hover:cursor-pointer hover:bg-gray-300 transition-all"
            />
        </div>
        <div class="span-col-1 flex justify-end gap-5 items-center">
            <x-svgs.filter-svg />
            <button
                class="bg-gray-900 py-2 px-4 rounded-md text-white font-bold hover:cursor-pointer hover:bg-gray-800 transition-all"
            >
                + Create offer
            </button>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200 text-gray-500">
                <tr>
                    <th
                        class="py-2 px-4 border-b border-gray-200 rounded-tl-md"
                    >
                        Title
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200">Company</th>
                    <th class="py-2 px-4 border-b border-gray-200">Type</th>

                    <th class="py-2 px-4 border-b border-gray-200">
                        Start date
                    </th>
                    <th class="py-2 px-4 border-b border-gray-200">End date</th>
                    <th
                        class="py-2 px-4 border-b border-gray-200 rounded-tr-md"
                    >
                        Creator
                    </th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
