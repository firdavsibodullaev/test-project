<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RenderJsonShow extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $data, public string $id = 'main')
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
        return view('components.render-json-show', [
            'data' => $this->data,
            'id' => $this->id
        ]);
    }
}
