@extends("layouts.app")
@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Records') }}</div>
                    <div class="card-body">
                        <table class="table table-striped text-center">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Records</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($records as $record)
                                <tr>
                                    <td>{{$record->id}}</td>
                                    <td>Record - {{$record->id}}</td>
                                    <td>
                                        <a href="{{route('show', $record->id)}}" class="btn btn-primary btn-sm">
                                            Show
                                        </a>
                                        <a href="{{route('edit', $record->id)}}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>
                                        <a href="javascript:void(0)"
                                           onclick="openModal({{$record->id}})"
                                           data-bs-toggle="modal"
                                           data-bs-target="#deleteModal"
                                           class="btn btn-danger btn-sm">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Empty!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$records->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-delete-modal :url="route('delete', 'URL')"/>
@endsection
@section("js")
    <script>
        function openModal(id) {
            const url = $('#deleteModal').attr('data-url').replace('URL', id);
            $('#deleteForm').attr('action', url);
        }
    </script>
@endsection
