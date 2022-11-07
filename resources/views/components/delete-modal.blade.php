<div class="modal fade" id="deleteModal"
     data-url="{{$url}}"
     data-bs-backdrop="static"
     data-bs-keyboard="false"
     tabindex="-1"
     aria-labelledby="deleteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Delete record!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <h3>Are you sure?</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="$('#deleteForm').submit()">Delete</button>
            </div>
        </div>
    </div>
</div>
<form action="" method="post" id="deleteForm">
    @csrf
    @method('delete')
</form>
<script>
    $(function () {
        $(document).on('hide.bs.modal', '#deleteModal', function () {
            $('#deleteForm').attr('action', '');
        });
    });
</script>
