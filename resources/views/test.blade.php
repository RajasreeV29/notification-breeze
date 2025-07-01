@extends('layouts.app')

@push('styles')
<title>Residents</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
/* Keep all your existing CSS styles */
</style>
@endpush

@section('content')
<div class="table-responsive">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Manage <b>Residents</b></h2>
                </div>
                <div class="col-sm-6 d-flex align-items-center justify-content-end">
                    <form id="statusFilterForm" class="me-2">
                        <select id="statusFilter" class="form-control">
                            <option value="">-- Filter by Status --</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </form>
                    <a href="{{ route('resident.create') }}" class="btn btn-success ms-2">
                        <i class="material-icons">&#xE147;</i> <span>Add New Resident</span>
                    </a>
                </div>

                <div class="dropdown" style="display:inline-block; float:right; margin-right:20px;">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="notificationBell" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell" style="font-size: 1.5rem;"></i>
                        <span id="notifCount" class="badge badge-danger position-absolute" style="top:0; right:0; {{ auth()->user()->unreadNotifications->count() ? '' : 'display:none;' }}">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationBell">
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <a class="dropdown-item" href="#">
                                {{ $notification->data['message'] }}
                            </a>
                        @empty
                            <span class="dropdown-item text-muted">No new notifications</span>
                        @endforelse
                    </div>
                    <form id="markAsReadForm" action="{{ route('notifications.markAsRead') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div id="residentTable">
            @include('resident.partials.resident-table', ['residents' => $residents])
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bell = document.getElementById('notificationBell');
    const dropdown = new bootstrap.Dropdown(bell);
    let timer;

    bell.addEventListener('shown.bs.dropdown', function() {
        if (timer) clearTimeout(timer);
        timer = setTimeout(() => {
            document.getElementById('markAsReadForm').submit();
        }, 2000);
    });

    bell.addEventListener('hidden.bs.dropdown', function() {
        if (timer) clearTimeout(timer);
    });

    // AJAX filter logic
    $('#statusFilter').on('change', function () {
        var status = $(this).val();
        $.ajax({
            url: "{{ route('resident.index') }}",
            type: "GET",
            data: { status: status },
            success: function (data) {
                $('#residentTable').html(data);
            },
            error: function () {
                alert('Error fetching filtered residents');
            }
        });
    });
});
</script>
@endpush
