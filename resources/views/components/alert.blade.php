
@if ($errors->any()) <!--nosso if esta fora da div-->
    <div class="bg-orange-100 border-1-4 border-orange-500 text-orange-700 p-4 my-4" role="alert">
        <!--
            Neste foreach
        1- vou verificar se tem os erros
        2- esta variavel e injetada automaticamento em todas as nossas views
        3- faço com any -> para verificar se existi algum erro
        -->
            @foreach ($errors->all() as $error)
            <!--aqui eu imprimo este erro-->
            <p> {{ $error }} </p>
            @endforeach  
    </div>
@endif <!--fim - endif-->