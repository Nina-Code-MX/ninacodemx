<?php

namespace App\Livewire\Admin;

use App\Models\Article as ArticleModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class ArticleListing extends Component
{
    public function render()
    {

        $article = ArticleModel::orderBy('created_at', 'desc')->paginate(50);

        return view('livewire.admin.article-listing', ['article' => $article])
            ->layout('components.layouts.admin', []);
    }

    public function delete($article_id)
    {
        $errguid =\Str::uuid();

        try {
            ArticleModel::findOrFail($article_id)->delete();
        } catch (ModelNotFoundException $e) {
            \Log::error('ArticleListing', ['line' => __LINE__, 'error' => $e->getMessage(), 'article_id' => $article_id, 'guid' => $errguid]);
            $this->addError('generic', 'The record does not exist.');
        } catch (\Exception $e) {
            \Log::error('ArticleListing', ['line' => __LINE__, 'error' => $e->getMessage(), 'article_id' => $article_id, 'guid' => $errguid]);
            $this->addError('generic', 'Unable to delete the record, if the problem persists please contact the administrator. Error guid: ' . $errguid);
        }
    }
}
