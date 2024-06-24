<?php

namespace App\Livewire\Forms;

use App\Models\Article as ArticleModel;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ArticleForm extends Form
{
    public ?ArticleModel $article;

    public $id = null;

    #[Validate('max:255|min:2|required|string', as: 'admin/article.name', translate: true)]
    public $title = '';

    #[Validate('max:255|required|string', as: 'admin/article.slug', translate: true)]
    public $slug = '';

    #[Validate('min:1|min:1|string', as: 'admin/article.excerpt', translate: true)]
    public $excerpt = '';

    #[Validate('required|string', as: 'admin/article.content', translate: true)]
    public $content = '';

    #[Validate('nullable|array', as: 'admin/article.image', translate: true)]
    public $image = '';

    #[Validate('required|exists:users,id', as: 'admin/article.user_id', translate: true)]
    public $user_id;

    #[Validate('image|max:10240|nullable', as: 'admin/article.image', translate: true)]
    public $image_upload = null;

    public function setArticle(ArticleModel $article)
    {
        $this->article = $article;
        $this->id = $article->id;
        $this->title = $article->title;
        $this->slug = $article->slug;
        $this->excerpt = $article->excerpt;
        $this->content = $article->content;
        $this->image = $article->image;
        $this->user_id = $article->user_id;
        $this->image_upload = null;
    }
}
