<!--recebendo o template--> 
<!--pasta admin.pastalayouts.arquivo.app--> 
@extends('admin.layouts.app')

<!--onde tiver (title) coloque Forum-->
@section('title', 'Fórum')

<!--onde tiver nosso (header) coloca este h1 -->
@section('header')
<!--eu passo o caminho ou path da partial-->
<!--sendo pasta-admin->pasta-supports->pasta-partial->arquivo-header.blade.php-->
@include('admin.supports.partials.header', compact('supports'))
@endsection

<!--crio a diretiva ()section) onde tiver nosso conteudo coloque aqui-->
<!--estou fechando esta section na ultima linha-->
@section('content')

<!--faço o include e passo o path em que esta o template-->
@include('admin.supports.partials.content')

<!--onde eu quero que exiba a paginação-->
<!--vou passar o (nome do arquivo) ou seja o (nome do nosso component-->
<!--Detalhe importante estou passando para o arquivo => pagination.blade.php
esta informação recebida pelo supports => :paginator-->
<x-pagination 
:paginator="$supports"
:appends="$filters"/> <!--no appends estou enviado o meu (parametro ou variavel filter)-->
<!--Or-->
<!--<x-pagination></x-pagination>-->

<!--fecho a section-->
@endsection