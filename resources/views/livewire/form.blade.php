<div class="form-group my-4">
    <label for="title">Título</label>
    <input type="text" id="title" class="form-control" wire:model="post.title">
    @error('post.title') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="form-group my-4">
    <label for="body">Contenido</label>
    <textarea id="body" class="form-control" wire:model="post.body"></textarea>
    @error('post.body') <span class="text-danger">{{ $message }}</span> @enderror
</div>
