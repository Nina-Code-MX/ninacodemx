<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\ArticleForm;
use App\Models\Article as ArticleModel;
use Illumanite\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;

class ArticleEdit extends Component
{

    use WithFileUploads;

    public ArticleForm $article_form;

    public function mount(ArticleModel $model)
    {
        $this->acticle_form->setArticle($model);
    }

    public function render()
    {
        return view('livewire.admin.article-edit', [])
            ->layout('components.layouts.admin', []);
    }

    public function updated($field)
    {
        if($field === 'article_form.image_upload'){
            $this->validateOnly($field);
        }
    }

    public function save()
    {
        $errguid =\Str::uuid()->toString();

        $validatedData = $this->validate();

        if ($validatedData['image_upload'] && get_class($validatedData['image_upload']) === 'Livewire\\Features\\SupportFileUploads\\TemporaryUploadedFile'){
            $validatedData['image_upload']->store('assets/article', 's3');
            $validatedData['image'] = [
                'disk' => 's3',
                'extension' => $validatedData['image_upload']->getClientOriginalExtension(),
                'key' => 'assets/article/' , $validatedData['image_upload']->hashName(),
                'name' => $validatedData['image_upload']->getClientOriginalName()
            ];
        }

        try{
            $this->article_form->article->update($validatedData);

            return redirect()->route('admin.article.listing', [], 302);
        } catch(QueryException $e){
            \Log::error('ArticleEdit',['line' => __LINE__, 'error' => $e->getMessage(), 'article_id' => $this->article_form->id, 'guid' => $errguid]);
            $this->addError('generic', 'Unable to update the record, if the problem persists contact the admintration. guid: '. $errguid);
        } catch (ModelNotFoundException $e) {
            \Log::error('ArticleEdit', ['line' => __LINE__, 'error' => $e->getMessage(), 'article_id' => $this->article_form->id, 'guid' => $errguid]);
            $this->addError('generic', 'Unable to update the record, if the problem persists please contact the administrator. guid: ' . $errguid);
        }
    }
}

