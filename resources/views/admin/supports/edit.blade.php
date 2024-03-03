
<!--
  1º passar o nosso extends 
  2º e fazer o nosso path, caminho ou endereço
-->
@extends('admin.layouts.app')

<!--passo minha section title e depois passo o titulo-->
@section('title', 'Criar Novo Tópico')

<!--aqui eu passo o meu header e insiro o titulo-->
@section('header')
<h1 class="text-lg text-black-500">Dúvida !! {{ $support->subject }}</h1>
@endsection

<!---agora podemos importar a nossa section deste endereço (admin.layouts.app)-->
@section('content')
    <!--
        Inicio a leitura do path(caminho) apartir da views
        pasta admin.
        pasta supports.
        pasta partials.
        nome-do-arquivo form (sem a extensão blade.php)
    -->
      <!--estou passando o nome do componente-->
<!--desta forma estou trasendo o foreach para esta tela edit através do meu component x-alert -->

<form action="{{ route('supports.update', $support->id) }}" method="POST">
        <!--temos uma limitação na request não temos o método Put então enviamos o POST por padrão-->
        <!--e fazemos o um input com value="PUT" e name="_method" para corrigir esta limitação-->
        <!--<input type="text" value="PUT" name="_method">-->
        <!--corrigo de forma simples methot(e o verbo que preciso) ele já cria de forma (oculta como input hidden);-->
    @method('PUT')
    @include('admin.supports.partials.form', [
        //passando para a partial o nosso suport
        'support' => $support
    ])
</form>

   @endsection


