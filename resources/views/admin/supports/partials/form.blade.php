     <!--
      Fazendo otimização:
      Posso para meu alert no editar e criar
      Mas passei aqui no forme e consigo usar de forma dinamica 
      e sem redundancia de codigo.
     -->
     <x-alert/>
     <!--
        Seria um token como se fosse um captcha que ele torna o formulário
        unico,  não deixando ataques (csfr)
    -->
    {{-- <input type="hidden" value="{{ csrf_token(); }}" name="_token"> --}}
    @csrf()
    <!--estou utilizando o operador ternario-->
    <!--se tiver quero o valor de $support->subject (senão quero o outro valor (old))?? old('subject -->
    <input type="text" placeholder="Assunto" name="subject" value="{{$support->subject ?? old('subject') }}" class="appearance-none block w-full bg-gray-200 text-gray-700
     border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">

    <textarea name="body" cols="30" rows="5" placeholder="Descrição" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight
    focus:outline-none focus:bg-white focus:border-gray-500">{{$support->body ?? old('body') }}</textarea>

    <button type="submit" class="shadow bg-purple-500 hover:bg-purple-400 focus:shdow-outline focus:outline-none
    text-white font-bold py-2 px-4 rounded">Enviar</button>

