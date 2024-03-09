@extends('admin.layouts.app')
<!--passo minha section title e depois passo o titulo-->
@section('title', 'Detalhes da Dúvida {$support->subject}')

<!--aqui eu passo o meu header e insiro o titulo-->
@section('header')
<h1 class="text-lg text-black-500">Dúvida !! {{ $support->subject }}</h1>
@endsection

<!---agora podemos importar a nossa section deste endereço (admin.layouts.app)-->
@section('content')
<ul>
    <li>Assunto: {{ $support->subject }}</li>
    <li>Status: {{ $support->status }} </li>
    <li>Descrição: {{ $support->body }}</li>
</ul>

<form action="{{ route('supports.destroy', $support->id ) }}" method="post">
     <!--tambem preciso colocar o csrf que é o nosso token de validação do formulario se não dá erro--> 
     <!--se não pode dar o erro 419 expiração-->
     @csrf()
     <!--vou indicar qual é o verbo http-->
     <!--ele irá criar um input hiddem como o verbo Delete-->
     @method('DELETE')
    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Deletar</button>
</form>
@endsection


