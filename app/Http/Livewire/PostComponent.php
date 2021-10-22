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
    public Post $post;

    protected $rules = [
        'post.title' => 'required|string|max:191',
        'post.body' => 'required|string|max:191',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function default()
    {
        $this->view = 'create';
        $this->post = new Post;
    }

    public function edit($id)
    {
        $this->view = 'edit';
        $this->post = Post::find($id);
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

        $this->post->save();

        $this->edit($this->post->id);
    }

    public function update()
    {
        $this->validate();

        $this->post->save();

        $this->default();
    }

    public function destroy(Post $post)
    {
        Post::destroy($post->id);
    }
}
