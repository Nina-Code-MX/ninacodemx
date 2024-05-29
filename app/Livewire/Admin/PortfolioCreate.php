<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\PortfolioForm;
use App\Models\Portfolio as PortfolioModel;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;

class PortfolioCreate extends Component
{
    use WithFileUploads;

    public PortfolioForm $portfolio_form;

    public function mount()
    {
        $this->portfolio_form->setPortfolio(new PortfolioModel());
    }

    public function render()
    {
        return view('livewire.admin.portfolio-create', [])
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
            PortfolioModel::create($validatedData);

            return redirect()->route('admin.portfolio.listing', [], 302);
        } catch (QueryException $e) {
            \Log::error('PortfolioEdit', ['line' => __LINE__, 'error' => $e->getMessage(), 'portfolio_id' => $this->portfolio_form->id, 'guid' => $errguid, 'validatedData' => $validatedData]);
            $this->addError('generic', 'Unable to create the record, if the problem persists please contact the administrator. guid: ' . $errguid);
        }
    }
}
