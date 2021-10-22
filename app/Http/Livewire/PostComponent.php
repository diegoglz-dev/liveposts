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
    public $title, $body;

    public function default()
    {
        $this->title = '';
        $this->body = '';
        $this->view = 'create';
    }

    public function edit($id)
    {
        $post = Post::find($id);
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
        $this->validate(
            [
                'title' => 'required',
                'body' => 'required'
            ]
        );

        $post = Post::create([
            'title' => $this->title,
            'body' => $this->body
        ]);

        $this->edit($post->id);
    }

    public function destroy($id)
    {
        Post::destroy($id);
    }
}
