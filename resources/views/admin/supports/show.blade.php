<!--estou recenbendo da minha controller Support o método showl pela url o objeto compact -->
<h1>Detalhes da dúvidas {{ $support->id }}</h1>

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
    <button type="submit">Deletar</button>
</form>