<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\TeamForm;
use App\Models\Team as TeamModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;

class TeamEdit extends Component
{
    use WithFileUploads;

    public TeamForm $team_form;

    public function mount(TeamModel $model)
    {
        $this->team_form->setTeam($model);
    }

    public function render()
    {
        return view('livewire.admin.team-edit', [])
            ->layout('components.layouts.admin', []);
    }

    public function updated($field)
    {
        if ($field === 'team_form.image_upload') {
            $this->validateOnly($field);
        }
    }

    public function save()
    {
        $errguid = \Str::uuid();

        $validatedData = $this->validate();

        if ($validatedData['image_upload'] && get_class($validatedData['image_upload']) === 'Livewire\\Features\\SupportFileUploads\\TemporaryUploadedFile') {
            $validatedData['image_upload']->store('assets/team', 's3');
            $validatedData['image'] = [
                'disk' => 's3',
                'extension' => $validatedData['image_upload']->getClientOriginalExtension(),
                'key' => 'assets/team/' . $validatedData['image_upload']->hashName(),
                'name' => $validatedData['image_upload']->getClientOriginalName()
            ];
        }

        try {
            $this->team_form->team->update($validatedData);

            return redirect()->route('admin.team.listing', [], 302);
        } catch (QueryException $e) {
            \Log::error('TeamEdit', ['line' => __LINE__, 'error' => $e->getMessage(), 'team_id' => $this->team_form->id, 'guid' => $errguid]);
            $this->addError('generic', 'Unable to update the record, if the problem persists please contact the administrator. guid: ' . $errguid);
        } catch (ModelNotFoundException $e) {
            \Log::error('TeamEdit', ['line' => __LINE__, 'error' => $e->getMessage(), 'team_id' => $this->team_form->id, 'guid' => $errguid]);
            $this->addError('generic', 'Unable to update the record, if the problem persists please contact the administrator. guid: ' . $errguid);
        }
    }
}
