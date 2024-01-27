<h1>Listagem de Supports !</h1>
<!--vou passar o nome da rota e não a url-->
<!--poderia passar url mas se um dia eu mudar a url perderia o que foi feito-->
 <a href="{{ route('supports.create')}}">Criar Dúvidas</a> 
<table>
    <thead>>
        <th>assunto</th>
        <th>status</th>
        <th>descrição</th>
        <th></th>
    </thead>

    <tbody>
        @foreach ($supports as $support)
            <tr>
                <td>{{ $support->subject }}</td>
                <td>{{ $support->status }}</td>
                <td>{{ $support->body }}</td>
                <td>
                    >
                </td>
            </tr>
        @endforeach
    </tbody>
</table>