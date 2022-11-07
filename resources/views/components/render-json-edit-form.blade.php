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
                    <div class="ms-3" id="block-{{$id}}">
                        @if(is_array($item))
                            <div class="mt-4 input-group">
                                <input type="text"
                                       class="form-control"
                                       placeholder="JSON key"
                                       aria-label="JSON key"
                                       name="{{$name}}[key][{{$key}}]"
                                       value="{{$key}}"
                                       required>
                                <button type="button"
                                        onclick="removeRow('block-{{$id}}')"
                                        class="btn btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd"
                                              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </div>
                            <x-render-json-edit-form
                                :data="$item"
                                :id="$id.'-'.$key"
                                :name="$name.'['.$key.']'"/>
                        @else
                            <div class="input-group mb-3" id="block-{{$id}}-{{$loop->iteration}}">
                                <input type="text"
                                       class="form-control"
                                       name="{{$name}}[key][{{$key}}]"
                                       value="{{$key}}"
                                       placeholder="JSON key"
                                       aria-label="JSON key"
                                       required>
                                <span class="input-group-text">:</span>
                                <input type="text"
                                       class="form-control"
                                       name="{{$name}}[{{$key}}]"
                                       value="{{$item}}"
                                       placeholder="JSON value"
                                       aria-label="JSON value">
                                <button type="button" onclick="removeRow('block-{{$id}}-{{$loop->iteration}}')"
                                        class="btn btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-trash" viewBox="0 0 16 16">
                                        <path
                                            d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd"
                                              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<script>
    function removeRow(selector) {
        $(`#${selector}`).remove();
    }
</script>
