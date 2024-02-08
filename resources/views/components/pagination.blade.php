@if (isset($paginator)) <!--se existir (isset(o paginator, eu já entro no if - realizando a paginação))-->
   @php 
   //estou criando um (queryParams) estou verificando (se existi a variavel $appends porque ela pode não ser informada).
   //se passar o apends eu verifico se é do tipo (array) que dizer se passou o valor correto
   //estou usando (http_buil_query($appends)) (simplesmente para converter os dados)
   //exemplo: http_buil_query($appends) exemplo: filter=valor&valor (seria o formato do builder_query
     $queryParams = (isset($appends) && gettype($appends) === 'array') ? '&' . http_build_query($appends) : ''
   @endphp
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        <!--ele esta verificando se esta na primeira pagina-->
        @if ($paginator->isFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                {!! __('pagination.previous') !!}
            </span>
        @else
        <!--caso eu não esteja no if acima na 1º pagina ele entra no else e mostra a opção de nextpage(continuar)-->
            <a href="?page={{ $paginator->getNumberPreviousPage() }}{{ $queryParams }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        {{-- Next Page Link --}}
         @if (!$paginator->isLastPage())
            <a href="?page={{ $paginator->getNumberNextPage() }}{{ $queryParams }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                {!! __('pagination.next') !!}
            </span>
        @endif 
    </nav>
@endif
