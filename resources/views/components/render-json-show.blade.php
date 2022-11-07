<div class="accordion" id="accordion-{{$id}}">
    <div class="accordion-item">
        <h2 class="accordion-header" id="heading-{{$id}}">
            <button class="btn btn-sm btn-light accordion-button"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapse-{{$id}}"
                    aria-expanded="true"
                    aria-controls="collapse-{{$id}}"
                    style="cursor: pointer">
            </button>
        </h2>
        <div id="collapse-{{$id}}" class="accordion-collapse collapse show" aria-labelledby="heading-{{$id}}"
             data-bs-parent="#accordion-{{$id}}">
            <div class="accordion-body">
                @foreach($data as $key => $item)
                    <div class="ms-3">
                        @if(is_array($item))
                            <div>@quotes($key) <span class="text-secondary">({{gettype($item)}})</span>:</div>
                            <x-render-json-show
                                :data="$item"
                                :id="$id.'-'.$key"/>
                        @else
                            @quotes($key) <span class="text-secondary">({{gettype($item)}})</span>: @quotes($item),
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
