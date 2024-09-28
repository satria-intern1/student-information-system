<div>
    <label for="table-search" class="sr-only">Search</label>
    <div class="relative mt-1">
        <form action="{{$route}}" method="GET">

            <div class="absolute flex inset-y-4 items-center ps-3">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>

            <div class="flex">
                <input type="text" id="table-search" name="query"class="block ps-10 py-1 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="{{ $placeholder }}">
                <div class="ml-1 text-sm text-white border font-medium border-gray-300 bg-indigo-500 hover:bg-indigo-600 rounded-lg w-[72px] flex items-center justify-center">
                    <button type="submit" class="w-full">Search</button>
                </div>
                <a href="{{$route}}" class="ml-1 text-sm text-white border font-medium border-gray-300 bg-indigo-500 hover:bg-indigo-600 rounded-lg w-[48px] flex items-center justify-center">
                    <button class="w-full">Back</button>
                </a>
            </div>

        </form>
        
    </div>
</div>