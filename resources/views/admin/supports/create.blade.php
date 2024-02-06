<h1>New Suporte !!</h1>

   
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