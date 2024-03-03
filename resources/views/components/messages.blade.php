<!--
  1º eu só vou exibir esta mensagem de sucesso se exstir um (acesso flache)
  quando eu cadastro um registro eu crio uma sessão e quando eu utilizo ela, 
  esta sessão apga em seguida
  Resumo:
   Eu exibo uma mensagem e quando eu atualizo a pagina esta mensagem não existe mais.

   Explicado o que é um (acesso flache), então vamos lá...

   * Se exite esta mensagem eu vou mostrar o valor dele
-->
@if(session()->has('message'))
<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-2" role="alert">
    <div class="flex">
      <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
      <div>
        <!--
            aqui neste momento eu pego o conteudo da minha mensagem.
            session('message')->get('message')
        -->
        <p class="text-sm">{{ session('message') }}</p>
      </div>
    </div>
</div>
@endif