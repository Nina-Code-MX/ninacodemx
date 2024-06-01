<?php

namespace App\Livewire\Forms;

use App\Models\Translation as TranslationModel;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TranslateForm extends Form
{
    public ?TranslationModel $translation;

    public $id = null;

    #[Validate('min:1|required|integer', as: 'admin/translation.model_id', translate: true)]
    public $model_id = '';

    #[Validate('min:1|required|string', as: 'admin/translation.model_name', translate: true)]
    public $model_name = '';

    #[Validate('max:2|min:2|required|string', as: 'admin/translation.lang', translate: true)]
    public $lang = '';

    #[Validate('min:1|required|string', as: 'admin/translation.value', translate: true)]
    public $value = '';

    public function setTranslate(TranslationModel $translation)
    {
        $this->translation = $translation;
        $this->id = $translation->id;
        $this->model_id = $translation->model_id;
        $this->model_name = $translation->model_name;
        $this->lang = $translation->lang;
        $this->value = json_encode($translation->value ?? ['name' => ''], JSON_PRETTY_PRINT);
    }
}
