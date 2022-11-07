@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Record') .' '. $post->id }}</div>
                    <div class="card-body">
                        <form action="{{route('update', $post->id)}}" method="post">
                            @csrf
                            @method('put')
                            <x-render-json-edit-form
                                :data="$post->data"
                                :name="'data'"/>
                            <input type="submit" class="btn btn-success" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
