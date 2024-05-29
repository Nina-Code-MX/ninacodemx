<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\PortfolioForm;
use App\Models\Portfolio as PortfolioModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;

class PortfolioEdit extends Component
{
    use WithFileUploads;

    public PortfolioForm $portfolio_form;

    public function mount(PortfolioModel $model)
    {
        $this->portfolio_form->setPortfolio($model);
    }

    public function render()
    {
        return view('livewire.admin.portfolio-edit', [])
            ->layout('components.layouts.admin', []);
    }

    public function updated($field)
    {
        if ($field === 'portfolio_form.tags') {
            $this->portfolio_form->tags = array_map('trim', explode(',', $this->portfolio_form->tags));
        }
    }

    public function save()
    {
        $errguid = \Str::uuid();

        $validatedData = $this->validate();

        try {
            $this->portfolio_form->portfolio->update($validatedData);

            return redirect()->route('admin.portfolio.listing', [], 302);
        } catch (QueryException $e) {
            \Log::error('PortfolioEdit', ['line' => __LINE__, 'error' => $e->getMessage(), 'portfolio_id' => $this->portfolio_form->id, 'guid' => $errguid]);
            $this->addError('generic', 'Unable to update the record, if the problem persists please contact the administrator. guid: ' . $errguid);
        } catch (ModelNotFoundException $e) {
            \Log::error('PortfolioEdit', ['line' => __LINE__, 'error' => $e->getMessage(), 'portfolio_id' => $this->portfolio_form->id, 'guid' => $errguid]);
            $this->addError('generic', 'The record does not exist.');
        }
    }
}
