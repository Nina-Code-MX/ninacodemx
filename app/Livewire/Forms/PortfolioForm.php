<?php

namespace App\Livewire\Forms;

use App\Models\Portfolio as PortfolioModel;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PortfolioForm extends Form
{
    public ?PortfolioModel $portfolio;

    public $id = null;
    public $project_date_human = null;

    #[Validate('max:255|min:1|required|string', as: 'admin/portfolio.name', translate: true)]
    public $name = '';

    #[Validate('max:255|min:1|required|string', as: 'admin/portfolio.description', translate: true)]
    public $description = '';

    #[Validate('max:255|min:2|nullable|string', as: 'admin/portfolio.url', translate: true)]
    public $url = '';

    #[Validate('date|required', as: 'admin/portfolio.project_date', translate: true)]
    public $project_date = '';

    #[Validate('nullable|array', as: 'admin/portfolio.tags', translate: true)]
    public $tags = [];

    public function setPortfolio(PortfolioModel $portfolio)
    {
        $this->portfolio = $portfolio;
        $this->id = $portfolio->id;
        $this->name = $portfolio->name;
        $this->description = $portfolio->description;
        $this->url = $portfolio->url;
        $this->project_date = $portfolio->project_date;
        $this->tags = $portfolio->tags;
        $this->project_date_human = $portfolio->project_date_human;
    }
}
