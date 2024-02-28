<div class="sm:flex sm:items-center sm:justify-between">

    <div>
    <div class="flex items-center gap-x-3">
        <h1 class="text-lg text-black-500">Forum</h1> 

        <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">{{ $supports->total() }} dúvidas</span>
    </div>
    </div>

    <div class="flex items-center mt-4 gap-x-3">
        <a href="{{ route('supports.create') }}" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm text-gray-700 transition-colors duration-200 bg-white border rounded-lg gap-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12"></path>
        </svg>
            <span>Nova Dúvida</span>
        </a>
    </div>
</div>

<div class="mt-6 md:flex md:items-center md:justify-between">
    <div class="relative flex items-center mt-4 md:mt-0">
      
        <input type="text" placeholder="Procurar" class="block w-full py-1.5" />
    </div>
</div>