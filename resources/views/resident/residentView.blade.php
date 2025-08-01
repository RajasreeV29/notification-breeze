@extends('layouts.app')

@push('styles')
<title>Residents</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
{{-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> --}}


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>  
body {
	color: #566787;
	background: #f5f5f5;
	font-family: 'Varela Round', sans-serif;
	font-size: 13px;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
	background: #fff;
	padding: 20px 25px;
	border-radius: 3px;
	min-width: 1000px;
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {        
	padding-bottom: 15px;
	background: #435d7d;
	color: #fff;
	padding: 16px 30px;
	min-width: 100%;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}
.table-title h2 {
	margin: 5px 0 0;
	font-size: 24px;
}
.table-title .btn-group {
	float: right;
}
.table-title .btn {
	color: #fff;
	float: right;
	font-size: 13px;
	border: none;
	min-width: 50px;
	border-radius: 2px;
	border: none;
	outline: none !important;
	margin-left: 10px;
}
.table-title .btn i {
	float: left;
	font-size: 21px;
	margin-right: 5px;
}
.table-title .btn span {
	float: left;
	margin-top: 2px;
}
table.table tr th, table.table tr td {
	border-color: #e9e9e9;
	padding: 12px 15px;
	vertical-align: middle;
}
table.table tr th:first-child {
	width: 60px;
}
table.table tr th:last-child {
	width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
	background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
	background: #f5f5f5;
}
table.table th i {
	font-size: 13px;
	margin: 0 5px;
	cursor: pointer;
}	
table.table td:last-child i {
	opacity: 0.9;
	font-size: 22px;
	margin: 0 5px;
}
table.table td a {
	font-weight: bold;
	color: #566787;
	display: inline-block;
	text-decoration: none;
	outline: none !important;
}
table.table td a:hover {
	color: #2196F3;
}
table.table td a.edit {
	color: #FFC107;
}
table.table td a.delete {
	color: #F44336;
}
table.table td i {
	font-size: 19px;
}
table.table .avatar {
	border-radius: 50%;
	vertical-align: middle;
	margin-right: 10px;
}
.pagination {
	float: right;
	margin: 0 0 5px;
}
.pagination li a {
	border: none;
	font-size: 13px;
	min-width: 30px;
	min-height: 30px;
	color: #999;
	margin: 0 2px;
	line-height: 30px;
	border-radius: 2px !important;
	text-align: center;
	padding: 0 6px;
}
.pagination li a:hover {
	color: #666;
}	
.pagination li.active a, .pagination li.active a.page-link {
	background: #03A9F4;
}
.pagination li.active a:hover {        
	background: #0397d6;
}
.pagination li.disabled i {
	color: #ccc;
}
.pagination li i {
	font-size: 16px;
	padding-top: 6px
}
.hint-text {
	float: left;
	margin-top: 10px;
	font-size: 13px;
}    
/* Custom checkbox */
.custom-checkbox {
	position: relative;
}
.custom-checkbox input[type="checkbox"] {    
	opacity: 0;
	position: absolute;
	margin: 5px 0 0 3px;
	z-index: 9;
}
.custom-checkbox label:before{
	width: 18px;
	height: 18px;
}
.custom-checkbox label:before {
	content: '';
	margin-right: 10px;
	display: inline-block;
	vertical-align: text-top;
	background: white;
	border: 1px solid #bbb;
	border-radius: 2px;
	box-sizing: border-box;
	z-index: 2;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	content: '';
	position: absolute;
	left: 6px;
	top: 3px;
	width: 6px;
	height: 11px;
	border: solid #000;
	border-width: 0 3px 3px 0;
	transform: inherit;
	z-index: 3;
	transform: rotateZ(45deg);
}
.custom-checkbox input[type="checkbox"]:checked + label:before {
	border-color: #03A9F4;
	background: #03A9F4;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	border-color: #fff;
}
.custom-checkbox input[type="checkbox"]:disabled + label:before {
	color: #b8b8b8;
	cursor: auto;
	box-shadow: none;
	background: #ddd;
}
/* Modal styles */
.modal .modal-dialog {
	max-width: 400px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
	padding: 20px 30px;
}
.modal .modal-content {
	border-radius: 3px;
	font-size: 14px;
}
.modal .modal-footer {
	background: #ecf0f1;
	border-radius: 0 0 3px 3px;
}
.modal .modal-title {
	display: inline-block;
}
.modal .form-control {
	border-radius: 2px;
	box-shadow: none;
	border-color: #dddddd;
}
.modal textarea.form-control {
	resize: vertical;
}
.modal .btn {
	border-radius: 2px;
	min-width: 100px;
}	
.modal form label {
	font-weight: normal;
}	
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
					<div class="col-sm-6 d-flex align-items-center">
					{{-- Filter Dropdown --}}
					<form id="statusFilterForm" class="me-2">
						<select id="statusFilter" class="form-control">
							<option value="">-- Filter by Status --</option>
							<option value="active">Active</option>
							<option value="inactive">Inactive</option>
							<option value="extract_names">Active Resident Name</option>
						</select>
					</form>
					 {{-- Add New Resident Button --}}
						<a href="{{ route('resident.create') }}" class="btn btn-success ms-2">
							<i class="material-icons">&#xE147;</i> <span>Add New Resident</span>
						</a>
					</div>

			<div class="dropdown" style="display:inline-block; float:right; margin-right:20px;">
					<button class="btn btn-dark dropdown-toggle" 
						type="button"
						id="notificationBell" 
						data-bs-toggle="dropdown" 
						aria-expanded="false">
						<i class="fa fa-bell" style="font-size: 1.5rem;"></i>
						<span id="notifCount" class="badge badge-danger position-absolute" 
						style="top:0; right:0; {{ auth()->user()->unreadNotifications->count() ? '' : 'display:none;' }}">
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

			<table class="table table-striped table-hover">
				<thead>
					<tr>
						
						<th style="color: red;">Resident Name</th>
						<th style="color: red;">Email</th>
						<th style="color: red;">Phone</th>
						<th style="color: red;">Gender</th>
						<th style="color: red;">status</th>
                        
						<th style="color: red;">Package Name</th>
						<th style="color: red;">Package Image</th>

						<th style="color: red;">Package Due Date</th>
							
					</tr>
				</thead>
				<tbody id="residentTableBody">
    @foreach($residents as $r)
        <tr>
            <td>{{ $r->res_name }}</td>
            <td>{{ $r->email }}</td>
            <td>{{ $r->phone }}</td>
            <td>{{ $r->gender}}</td>
            <td>{{ $r->status }}</td>
            <td>{{ $r->package?->package_name }}</td>
            <td>
                @if ($r->package)
                    <img src="{{ Storage::url($r->package->file_path) }}" style="width: 3cm">
                @endif
            </td>
            <td>{{ $r->package?->credit_due }}</td>
            <td>
                <button type="button" 
                    class="btn btn-success btn-sm" 
                    onclick="window.location='{{ route('resident.edit', $r->id) }}'">
                    Edit<i class="material-icons">&#xE254;</i>
                </button>
                <form action="{{ route('resident.destroy', $r->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this Package?')" title="Delete">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

			</table>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bell = document.getElementById('notificationBell');
    const dropdown = new bootstrap.Dropdown(bell);
    let timer;

    bell.addEventListener('shown.bs.dropdown', function() {
        // Clear existing timer
        if (timer) clearTimeout(timer);
        
        // Set new timer
        timer = setTimeout(() => {
            // Submit form
            document.getElementById('markAsReadForm').submit();
        }, 2000); // 3 seconds
    });

    bell.addEventListener('hidden.bs.dropdown', function() {
        if (timer) clearTimeout(timer);
    });
});
</script>
<script>

    $(document).ready(function () {
        $('#statusFilter').on('change', function () {
            let selectedStatus = $(this).val();

            $.ajax({
                url: '{{ route('residents.filter') }}',
                type: 'GET',
                data: { status: selectedStatus },
                success: function (response) {
                    let rows = '';
                    let thead = '';

                    if (selectedStatus === 'extract_names') {
                        thead = `
                            <tr>
                                <th style="color: red;">Resident Name</th>
                            </tr>
                        `;

                        response.forEach(function (name) {
                            rows += `
                                <tr>
                                    <td>${name}</td>
                                </tr>
                            `;
                        });
                    } else {
                        thead = `
                            <tr>
                                <th style="color: red;">Resident Name</th>
                                <th style="color: red;">Email</th>
                                <th style="color: red;">Phone</th>
                                <th style="color: red;">Gender</th>
                                <th style="color: red;">Status</th>
                                <th style="color: red;">Package Name</th>
                                <th style="color: red;">Package Image</th>
                                <th style="color: red;">Package Due Date</th>
                                <th>Actions</th>
                            </tr>
                        `;

                        response.forEach(function (r) {
                            rows += `
                                <tr>
                                    <td>${r.res_name}</td>
                                    <td>${r.email}</td>
                                    <td>${r.phone}</td>
                                    <td>${r.gender}</td>
                                    <td>${r.status}</td>
                                    <td>${r.package ? r.package.package_name : ''}</td>
                                    <td>${r.package ? `<img src='/storage/${r.package.file_path}' style='width:3cm;'>` : ''}</td>
                                    <td>${r.package ? r.package.credit_due : ''}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" onclick="window.location='/resident/${r.id}/edit'">
                                            Edit<i class="material-icons">&#xE254;</i>
                                        </button>
                                        <form action="/resident/${r.id}" method="POST" style="display:inline;">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Are you sure?')" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>`;
                        });
                    }

                    // Replace table head and body
                    $('thead').html(thead);
                    $('#residentTableBody').html(rows);
                },
                error: function () {
                    alert('Something went wrong while filtering.');
                }
            });
        });
    });

</script>
@endpush
  

	


