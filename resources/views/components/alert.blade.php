<div class="alert alert-danger">
<!--
    Neste foreach
1- vou verificar se tem os erros
2- esta variavel e injetada automaticamento em todas as nossas views
3- faço com any -> para verificar se existi algum erro
-->
    @if ($errors->any())
        @foreach ($errors as $error)
        <!--aqui eu imprimo este erro-->
            {{ $error }}
        @endforeach  
    @endif
<!---->
    {{ $slot }}
</div>