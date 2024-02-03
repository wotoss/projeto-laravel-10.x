<h1>New Suporte !!</h1>

<form action="{{ route('supports.store') }}" method="POST">
   <!--
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

    <!--
        Seria um token como se fosse um captcha que ele torna o formulário
        unico,  não deixando ataques (csfr)
    -->
    {{-- <input type="hidden" value="{{ csrf_token(); }}" name="_token"> --}}
    @csrf();
    <input type="text" placeholder="Assunto" name="subject" value="{{ old('subject')}}">
    <textarea name="body" cols="30" rows="5" placeholder="Descrição">{{ old('body') }}</textarea>
    <button type="submit">Enviar</button>
</form>