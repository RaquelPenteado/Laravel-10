<h1>Listagem dos Suportes</h1>

<a href="{{ route('supports.create') }}">Nova Dúvida</a>

<table>
    <thead>
        <th>Assunto</th>
        <th>Status</th>
        <th>Descrição</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($supports as $support)
            <tr>
                <td>{{ $support->subject }}</td>
                <td>{{ $support->status }}</td>
                <td>{{ $support->body }}</td>
                <td>-Ação-</td>
            </tr>
        @endforeach
    </tbody>
</table>
