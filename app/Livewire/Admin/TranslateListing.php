<?php

namespace App\Livewire\Admin;

use App\Models\Translation as TranslationModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class TranslateListing extends Component
{
    public function render()
    {
        $translation = TranslationModel::orderBy('created_at', 'desc')->paginate(50);

        return view('livewire.admin.translate-listing', ['translation' => $translation])
            ->layout('components.layouts.admin', []);
    }

    public function delete($translate_id)
    {
        $errguid = \Str::uuid();

        try {
            TranslationModel::findOrFail($translate_id)->delete();
        } catch (ModelNotFoundException $e) {
            \Log::error('TeamListing', ['line' => __LINE__, 'error' => $e->getMessage(), 'translate_id' => $translate_id, 'guid' => $errguid]);
            $this->addError('generic', 'The record does not exist.');
        } catch (\Exception $e) {
            \Log::error('TeamListing', ['line' => __LINE__, 'error' => $e->getMessage(), 'translate_id' => $translate_id, 'guid' => $errguid]);
            $this->addError('generic', 'Unable to delete the record, if the problem persists please contact the administrator. Error guid: ' . $errguid);
        }
    }
}
