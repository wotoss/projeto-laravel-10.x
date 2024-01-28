<!--estou recenbendo da minha controller Support o método showl pela url o objeto compact -->
<h1>Detalhes da dúvidas {{ $support->id }}</h1>

<ul>
    <li>Assunto: {{ $support->subject }}</li>
    <li>Status: {{ $support->status }} </li>
    <li>Descrição: {{ $support->body }}</li>
</ul>