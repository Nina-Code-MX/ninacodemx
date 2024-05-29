<?php

namespace App\Livewire\Forms;

use App\Models\Service as ServiceModel;
use Livewire\Attributes\Validate;
use Livewire\Form;

class ServiceForm extends Form
{
    public ?ServiceModel $service;

    public $id = null;
    
    #[Validate('max:255|min:1|required|string', as: 'admin/service.name', translate: true)]
    public $name = '';

    #[Validate('max:255|min:1|required|string', as: 'admin/service.excerpt', translate: true)]
    public $excerpt = '';

    #[Validate('max:255|min:1|required|string', as: 'admin/service.description', translate: true)]
    public $description = '';

    #[Validate('max:255|min:1|required|string', as: 'admin/service.slug', translate: true)]
    public $slug = '';

    #[Validate('nullable|array', as: 'admin/service.image', translate: true)]
    public $image = '';

    #[Validate('min:0|required|numeric', as: 'admin/service.order', translate: true)]
    public $order = 0;

    #[Validate('image|max:10240|nullable', as: 'admin/service.image', translate: true)]
    public $image_upload = null;

    public function setService(ServiceModel $service)
    {
        $this->service = $service;
        $this->id = $service->id;
        $this->name = $service->name;
        $this->excerpt = $service->excerpt;
        $this->description = $service->description;
        $this->slug = $service->slug;
        $this->image = $service->image;
        $this->order = $service->order;
        $this->image_upload = null;
    }
}
