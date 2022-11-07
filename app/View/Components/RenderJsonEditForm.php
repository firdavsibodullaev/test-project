<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RenderJsonEditForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data, public string $name, public string $id = "main")
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.render-json-edit-form', [
            'data' => $this->data,
            'name' => $this->name,
            'id' => $this->id
        ]);
    }
}
