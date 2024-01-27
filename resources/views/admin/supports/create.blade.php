<h1>New Suporte !!</h1>

<form action="{{ route('supports.store') }}" method="POST">
    <!--
        Seria um token como se fosse um captcha que ele torna o formulário
        unico,  não deixando ataques (csfr)
    -->
    {{-- <input type="hidden" value="{{ csrf_token(); }}" name="_token"> --}}
    @csrf();
    <input type="text" placeholder="Assunto" name="subject">
    <textarea name="body" cols="30" rows="5" placeholder="Descrição"></textarea>
    <button type="submit">Enviar</button>
</form>