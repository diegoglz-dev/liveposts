<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $view = 'create';
    public $post_id, $title, $body;

    protected $rules = [
        'title' => 'required|string|max:191',
        'body' => 'required|string|max:191',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function default()
    {
        $this->title = '';
        $this->body = '';
        $this->view = 'create';
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $this->post_id = $post->id;
        $this->title = $post->title;
        $this->body = $post->body;
        $this->view = 'edit';
    }

    public function render()
    {
        return view('livewire.post-component', [
            'posts' => Post::orderBy('id', 'desc')->paginate(8)
        ]);
    }

    public function store()
    {
        $this->validate();

        $post = Post::create([
            'title' => $this->title,
            'body' => $this->body
        ]);

        $this->edit($post->id);
    }

    public function update()
    {
        $this->validate();

        $post = Post::find($this->post_id);

        $post->update([
            'title' => $this->title,
            'body' => $this->body
        ]);

        $this->default();
    }

    public function destroy($id)
    {
        Post::destroy($id);
    }
}
