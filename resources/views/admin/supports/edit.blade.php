<h1>Duvida !! {{ $support->id }}</h1>
<!--estou passando o nome do componente-->
<!--desta forma estou trasendo o foreach para esta tela edit através do meu component x-alert -->
<x-alert />
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
