<h2>Listado de Posts</h2>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Contenido</th>
            <th colspan="2">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <th>{{ $post->id }}</th>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>
                    <button class="btn btn-primary" wire:click="edit({{ $post->id }})">Editar</button>
                </td>
                <td>
                    <button class="btn btn-danger" wire:click="destroy({{ $post->id }})">Eliminar</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $posts->links() }}
