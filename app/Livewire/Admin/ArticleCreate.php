<?php

namespace App\Livewire\Admin;

use App\livewire\Forms\ArticleForm;
use App\Models\Article as ArticleModel;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;

class ArticleCreate extends Component
{
    use WithFileUploads;

    public ArticleForm $article_form;

    public function mount(ArticleModel $model)
    {
        $this->article_form->setArticle($model);
    }

    public function render()
    {
        return view('livewire.admin.article-create', [])
            ->layout('components.layouts.admin', []);
    }

    public function updated($field)
    {
        if ($field === 'article_form.image_upload') {
           $this->validateOnly($field);
        }
    }

    public function save()
    {
        $errguid = \Str::uuid()->toString();
        $this->article_form->user_id = auth()->user()->id;
        $validatedData = $this->validate();

        if ($validatedData['image_upload'] && get_class($validatedData['image_upload']) === 'Livewire\\Features\\SupportFileUploads\\TemporaryUploadedFile'){
            $validatedData['image_upload']->store('assets/article', 's3');
            $validatedData['image'] = [
                'disk' => 's3',
                'extension' => $validatedData['image_upload']->getClientOriginalExtension(),
                'key' => 'assets/article/' . $validatedData['image_upload']->hashName(),
                'name' => $validatedData['image_upload']->getClientOriginalName()
            ];
        }

        try {
            ArticleModel::create($validatedData);

            return redirect()->route('admin.article.listing', [], 302);
        } catch (QueryException $e) {
            \Log::error('ArticleEdit', ['line' => __LINE__, 'error' => $e->getMessage(), 'article_id' => $this->article_form->id, 'guid' => $errguid, 'validatedData' => $validatedData]);
            $this->addError('generic', 'Unable to update the record, if the problem persists please contact the administrator. guid: ' . $errguid);
        }
    }
}
