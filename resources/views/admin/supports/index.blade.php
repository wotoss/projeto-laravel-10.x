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


<!--vou passar o nome da rota e não a url-->
<!--poderia passar url mas se um dia eu mudar a url perderia o que foi feito-->
 <a href="{{ route('supports.create')}}">Criar Dúvidas</a> 
<table>
    <thead>
        <th>assunto</th>
        <th>status</th>
        <th>descrição</th>
        <th></th>
    </thead>

    <tbody>
        @foreach ($supports->items() as $support)
            <tr>
                <!--já assim eu faço o preenchimento por array-->
                <!--<td>{//{ //$support['subject'] }}</td>-->
                <!--aqui como se trata de um objeto vou receber as informções desta forma-->
                <!--assim eu faço o preenchimento por objeto-->
                <td>{{ $support->subject }}</td>
                <!--passei esta o (endereço function) lá no meu composer para ficar de forma global-->
                <td>{{ getStatusSupport($support->status) }}</td>
                <td>{{ $support->body }}</td>
                <td>
                    <!--se o objeto fosse array pegaria assim 
                    <a href="{//{ route('supports.show', $support['id']) }}">ir</a>
                    <a href="{//{ route('supports.edit', $support['id']) }}">Editar</a>
                    -->
                    <!--se o objeto fosse array pegaria assim-->
                    <a href="{{ route('supports.show', $support->id) }}">ir</a>
                    <a href="{{ route('supports.edit', $support->id) }}">Editar</a>
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

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