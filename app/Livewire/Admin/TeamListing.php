<?php

namespace App\Livewire\Admin;

use App\Models\Team as TeamModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class TeamListing extends Component
{
    public function render()
    {
        $team = TeamModel::orderBy('created_at', 'desc')->paginate(50);

        return view('livewire.admin.team-listing', ['team' => $team])
            ->layout('components.layouts.admin', []);
    }

    public function delete($team_id)
    {
        $errguid = \Str::uuid();

        try {
            TeamModel::findOrFail($team_id)->delete();
        } catch (ModelNotFoundException $e) {
            \Log::error('TeamListing', ['line' => __LINE__, 'error' => $e->getMessage(), 'team_id' => $team_id, 'guid' => $errguid]);
            $this->addError('generic', 'The record does not exist.');
        } catch (\Exception $e) {
            \Log::error('TeamListing', ['line' => __LINE__, 'error' => $e->getMessage(), 'team_id' => $team_id, 'guid' => $errguid]);
            $this->addError('generic', 'Unable to delete the record, if the problem persists please contact the administrator. Error guid: ' . $errguid);
        }
    }
}
