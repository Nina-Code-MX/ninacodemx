<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\TranslateForm;
use App\Models\Translation as TranslationModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Illuminate\Support\Collection;

class TranslateEdit extends Component
{
    public TranslateForm $translate_form;
    public Collection $models;
    public Collection $model_data;

    public function mount(TranslationModel $model)
    {
        $this->translate_form->setTranslate($model);
        $this->getModelData();
    }

    public function render()
    {
        $this->getModels();

        return view('livewire.admin.translate-edit', [])
            ->layout('components.layouts.admin', []);
    }

    public function getModels()
    {
        $this->models = collect(scandir(app_path('Models')))
            ->reject(fn ($model) => !preg_match('/\.php$/', $model))
            ->reject(fn ($model) => $model === 'Translation.php')
            ->reject(fn ($model) => $model === 'TeamSocial.php')
            ->map(fn ($model) => ['id' => str_replace('.php', '', $model), 'value' => str_replace('.php', '', $model)]);
    }

    public function getModelData()
    {
        if ($this->translate_form->model_name) {
            $model = 'App\Models\\' . $this->translate_form->model_name;
            $this->model_data = $model::all()->map(fn ($item) => ['id' => $item->id, 'value' => '[' . $item->id . '] ' . $item->select_value]);
        }
    }

    public function updated($field)
    {
        if ($field === 'translate_form.model_name') {
            $this->getModelData();
            $this->translate_form->model_id = '';
        }
    }

    public function save()
    {
        $errguid = \Str::uuid()->toString();
        $validatedData = $this->validate();

        try {
            $validatedData['value'] = json_decode($validatedData['value'], true);
            $this->translate_form->translation->update($validatedData);

            return redirect()->route('admin.translate.listing', [], 302);
        } catch (QueryException $e) {
            \Log::error('TranslateEdit', ['line' => __LINE__, 'error' => $e->getMessage(), 'translation_id' => $this->translate_form->id, 'guid' => $errguid]);
            $this->addError('generic', 'Unable to update the record, if the problem persists please contact the administrator. guid: ' . $errguid);
        } catch (ModelNotFoundException $e) {
            \Log::error('TramslateEdit', ['line' => __LINE__, 'error' => $e->getMessage(), 'translation_id' => $this->translate_form->id, 'guid' => $errguid]);
            $this->addError('generic', 'Unable to update the record, if the problem persists please contact the administrator. guid: ' . $errguid);
        }
    }
}
