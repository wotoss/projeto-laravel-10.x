<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--para pegar o titulo-->
    <!--vou na pasta config passo o arquivo app.php e depois passo o que quero mostrar-->
    <!--neste caso o name da aplicação-->
    <title>@yield('title') - {{ config('app.name') }}</title>

    <!--passo o tailwindcss via (cdn) para carregamento-->
    <!--quando insiro ele na aplicação já começa a aplicar (classes do tailwindcss)-->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
    <section class="container px-4 mx-auto py-4">
        
           @yield('header')
        <!--cabecalho-->

        <div>
            <!--passo o nome do meu componente message-->
            <x-messages/>

            @yield('content')
            <!--assim eu trago meu conteudo via componente-->
        </div><!--conteudo-->
      
    </section>
</body>
</html>