     <!--
        Seria um token como se fosse um captcha que ele torna o formulário
        unico,  não deixando ataques (csfr)
    -->
    {{-- <input type="hidden" value="{{ csrf_token(); }}" name="_token"> --}}
    @csrf()
    <!--estou utilizando o operador ternario-->
    <!--se tiver quero o valor de $support->subject (senão quero o outro valor (old))?? old('subject -->
    <input type="text" placeholder="Assunto" name="subject" value="{{$support->subject ?? old('subject') }}">
    <textarea name="body" cols="30" rows="5" placeholder="Descrição">{{$support->body ?? old('body') }}</textarea>
    <button type="submit">Enviar</button>