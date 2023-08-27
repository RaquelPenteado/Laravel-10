<h1>Editar Dúvida {{ $support->id }}</h1>

<x-alert/>

<form action="{{ route('supports.update', $support->id) }}" method="POST">
    @csrf()
    @method('PUT')
    @include('admin.supports.partials.form', [
        'support' => $support
    ])
    <button type="submit">Atualizar</button>
</form>