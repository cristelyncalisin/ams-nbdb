<form action="{{ route('employees-destroy', [$employee->employee_id]) }}" method="post">
    @csrf
    @method('DELETE')
    <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
            <h3>Just a Warning!</h3>
            <p>Are you sure you want to <strong class="text-danger">delete</strong> this employee?</p>
        </div>
        
        <div class="col-12 text-center">
            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Proceed</button>
        </div>
    </div>
</form>