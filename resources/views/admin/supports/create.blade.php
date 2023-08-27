<h1>Nova Dúvida</h1>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif

<form action="{{ route('supports.store') }}" method="POST">
    @include('admin.supports.partials.form')
    <button type="submit">Enviar</button>
</form>