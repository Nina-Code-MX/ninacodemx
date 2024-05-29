<?php

namespace App\Livewire\Admin;

use App\Models\Portfolio as PortfolioModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class PortfolioListing extends Component
{
    public function render()
    {
        $portfolio = PortfolioModel::orderBy('created_at', 'desc')->paginate(50);

        return view('livewire.admin.portfolio-listing', ['portfolio' => $portfolio])
            ->layout('components.layouts.admin', []);
    }

    public function delete($portfolio_id)
    {
        $errguid = \Str::uuid();

        try {
            PortfolioModel::findOrFail($portfolio_id)->delete();
        } catch (ModelNotFoundException $e) {
            \Log::error('TeamListing', ['line' => __LINE__, 'error' => $e->getMessage(), 'portfolio_id' => $portfolio_id, 'guid' => $errguid]);
            $this->addError('generic', 'The record does not exist.');
        } catch (\Exception $e) {
            \Log::error('TeamListing', ['line' => __LINE__, 'error' => $e->getMessage(), 'portfolio_id' => $portfolio_id, 'guid' => $errguid]);
            $this->addError('generic', 'Unable to delete the record, if the problem persists please contact the administrator. Error guid: ' . $errguid);
        }
    }
}
