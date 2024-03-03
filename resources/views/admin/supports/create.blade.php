
<!--
  1º passar o nosso extends 
  2º e fazer o nosso path, caminho ou endereço
-->
@extends('admin.layouts.app')

<!--passo minha section title e depois passo o titulo-->
@section('title', 'Criar Novo Tópico')

<!--aqui eu passo o meu header e insiro o titulo-->
@section('header')
<h1 class="text-lg text-black-500">Nova Dúvida !!</h1>
@endsection

<!---agora podemos importar a nossa section deste endereço (admin.layouts.app)-->
@section('content')
   <form action="{{ route('supports.store') }}" method="POST">
    <!--
        Inicio a leitura do path(caminho) apartir da views
        pasta admin.
        pasta supports.
        pasta partials.
        nome-do-arquivo form (sem a extensão blade.php)
    -->
    @include('admin.supports.partials.form') 
   </form>

   @endsection