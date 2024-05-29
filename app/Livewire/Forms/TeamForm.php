<?php

namespace App\Livewire\Forms;

use App\Models\Team as TeamModel;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TeamForm extends Form
{
    public ?TeamModel $team;

    public $id = null;
    public $full_name = '';

    #[Validate('max:255|min:1|required|string', as: 'admin/team.first_name', translate: true)]
    public $first_name = '';

    #[Validate('max:255|min:1|required|string', as: 'admin/team.last_name', translate: true)]
    public $last_name = '';

    #[Validate('max:255|min:2|required|string', as: 'admin/team.title', translate: true)]
    public $title = '';

    #[Validate('nullable|array', as: 'admin/team.image', translate: true)]
    public $image = [];

    #[Validate('numeric|min:0|required', as: 'admin/team.order', translate: true)]
    public $order = 0;

    #[Validate('image|max:10240|nullable', as: 'admin/team.image', translate: true)]
    public $image_upload = null;

    public function setTeam(TeamModel $team)
    {
        $this->team = $team;
        $this->id = $team->id;
        $this->full_name = $team->full_name;
        $this->first_name = $team->first_name;
        $this->last_name = $team->last_name;
        $this->title = $team->title;
        $this->image = $team->image;
        $this->image = $team->image;
        $this->image_upload = null;
    }
}
