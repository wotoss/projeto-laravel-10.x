<h1>Duvida !! {{ $support->id }}</h1>

<form action="{{ route('supports.update', $support->id) }}" method="POST">
    <!--
        Seria um token como se fosse um captcha que ele torna o formulário
        unico,  não deixando ataques (csfr)
    -->
    <!--{{--<input type="hidden" value="{{ csrf_token(); }}" name="_token">--}}-->
    @csrf()
    <!--temos uma limitação na request não temos o método Put então enviamos o POST por padrão-->
    <!--e fazemos o um input com value="PUT" e name="_method" para corrigir esta limitação-->
    <!--<input type="text" value="PUT" name="_method">-->
    <!--corrigo de forma simples methot(e o verbo que preciso) ele já cria de forma (oculta como input hidden);-->
    @method('PUT')
    <input type="text" placeholder="Assunto" name="subject" value="{{ $support->subject}}">
    <textarea cols="30" rows="5" placeholder="Descrição" name="body" value="{{ $support->body}}"></textarea>
    <button type="submit">Editar</button>
</form>