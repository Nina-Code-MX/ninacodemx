<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\ServiceForm;
use App\Models\Service as ServiceModel;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServiceCreate extends Component
{
    use WithFileUploads;

    public ServiceForm $service_form;

    public function mount(ServiceModel $model)
    {
        $this->service_form->setService($model);
    }

    public function render()
    {
        return view('livewire.admin.service-create', [])
            ->layout('components.layouts.admin', []);
    }

    public function updated($field)
    {
        if ($field === 'service_form.image_upload') {
            $this->validateOnly($field);
        }
    }

    public function save()
    {
        $errguid = \Str::uuid()->toString();

        $validatedData = $this->validate();

        if ($validatedData['image_upload'] && get_class($validatedData['image_upload']) === 'Livewire\\Features\\SupportFileUploads\\TemporaryUploadedFile') {
            $validatedData['image_upload']->store('assets/service', 's3');
            $validatedData['image'] = [
                'disk' => 's3',
                'extension' => $validatedData['image_upload']->getClientOriginalExtension(),
                'key' => 'assets/service/' . $validatedData['image_upload']->hashName(),
                'name' => $validatedData['image_upload']->getClientOriginalName()
            ];
        }

        try {
            ServiceModel::create($validatedData);

            return redirect()->route('admin.service.listing', [], 302);
        } catch (QueryException $e) {
            \Log::error('ServiceEdit', ['line' => __LINE__, 'error' => $e->getMessage(), 'service_id' => $this->service_form->id, 'guid' => $errguid, 'validatedData' => $validatedData]);
            $this->addError('generic', 'Unable to update the record, if the problem persists please contact the administrator. guid: ' . $errguid);
        }
    }
}
