<?php

namespace App\Livewire\Admin;

use App\Models\Service as ServiceModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class ServiceListing extends Component
{
    public function render()
    {
        $service = ServiceModel::orderBy('created_at', 'desc')->paginate(50);

        return view('livewire.admin.service-listing', ['service' => $service])
            ->layout('components.layouts.admin', []);
    }

    public function delete($service_id)
    {
        $errguid = \Str::uuid();

        try {
            ServiceModel::findOrFail($service_id)->delete();
        } catch (ModelNotFoundException $e) {
            \Log::error('TeamListing', ['line' => __LINE__, 'error' => $e->getMessage(), 'service_id' => $service_id, 'guid' => $errguid]);
            $this->addError('generic', 'The record does not exist.');
        } catch (\Exception $e) {
            \Log::error('TeamListing', ['line' => __LINE__, 'error' => $e->getMessage(), 'service_id' => $service_id, 'guid' => $errguid]);
            $this->addError('generic', 'Unable to delete the record, if the problem persists please contact the administrator. Error guid: ' . $errguid);
        }
    }
}
