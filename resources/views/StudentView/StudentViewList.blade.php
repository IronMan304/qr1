<x-app-layout>
<div class="content">
	<div class="page-header">
		<div class="row">
			<div class="col-sm-12">
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="/">Dashboard</a></li>
					<li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
					<li class="breadcrumb-item active">Students List</li>
				</ul>
			</div>
		</div>
	</div>
	{{--<livewire:flash-message.flash-message />--}}
	<div class="row d-flex justify-content-center">
		<div class="col-sm-12">
			<div class="card card-table show-entire">
				<div class="card-body">

					<div class="page-table-header mb-2">
						<div class="row align-items-center">
							<div class="col">
								<div class="doctor-table-blk">
									<h3>Student List</h3>
									<div class="doctor-search-blk">
										<div class="add-group">
											{{--<a wire:click="createSource" wire:loading.attr="disabled" class="btn btn-primary ms-2"><img src="{{ asset('assets/img/icons/plus.svg') }}" alt>
											</a>--}}
										</div>
									</div>
								</div>
							</div>
							<div class="col-auto text-end float-end ms-auto download-grp">
								<div class="top-nav-search table-search-blk">
								
    <form method="GET" action="{{ route('students.index') }}">
        <input type="text" name="search" class="form-control"
               placeholder="Search here"
               value="{{ request('search') }}">
        <button type="submit" class="btn">
            <img src="{{ asset('assets/img/icons/search-normal.svg') }}" alt>
        </button>
    </form>




								</div>
                                <div class="top-nav-search table-search-blk">
    <form method="GET" action="{{ route('students.index') }}">
        <input type="date" name="date" class="form-control"
               value="{{ request('date') }}"
               onchange="this.form.submit()">
    </form>
</div>

         <div class="top-nav-search table-search-blk">
    <form method="GET" action="{{ route('students.index') }}">
        <select class="form-control" name="statusFilter" onchange="this.form.submit()">
            <option value="">-- All Status --</option>
            <option value="granted" {{ $statusFilter=='granted' ? 'selected' : '' }}>Granted</option>
            <option value="denied" {{ $statusFilter=='denied' ? 'selected' : '' }}>Denied</option>
            {{--<option value="pending" {{ $statusFilter=='pending' ? 'selected' : '' }}>Pending</option>--}}
        </select>
    </form>
</div>

<div class="top-nav-search table-search-blk">
    <form method="GET" action="{{ route('students.index') }}">
        <select class="form-control" name="authorized" onchange="this.form.submit()">
            <option value="">-- All Authorization --</option>
            <option value="true" {{ $authorizedOnly=='true' ? 'selected' : '' }}>Authorized</option>
            <option value="false" {{ $authorizedOnly=='false' ? 'selected' : '' }}>Not Authorized</option>
        </select>
    </form>
</div>



         
							</div>
						</div>
					</div>

				<div class="table-responsive">
    <table class="table border-0 custom-table comman-table mb-0">
    <thead>
        <tr>
            <th>UID</th>
            <th>Name</th>
            <th>Status</th>
            <th>Timestamp</th>
            <th>Authorized</th>
        </tr>
    </thead>
    <tbody>
     @forelse ($paginated as $cardInfo)
    <tr>
        <td>{{ $cardInfo['uid'] ?? 'No UID' }}</td>
        <td>{{ $cardInfo['name'] ?? 'No Name' }}</td>
        <td>{{ $cardInfo['status'] ?? 'No Status' }}</td>
        <td>{{ $cardInfo['timeReadable'] ?? 'No Timestamp' }}</td>
        <td>{{ $cardInfo['authorized'] ? 'Yes' : 'No' }}</td>
    </tr>
@empty
    <tr>
        <td colspan="5">No records found</td>
    </tr>
@endforelse

    </tbody>
</table>
{{ $paginated->links('pagination::bootstrap-5') }}




</div>
				</div>
			</div>
		</div>
	</div>
	{{-- Modal --}}

	{{--<div wire.ignore.self class="modal fade" id="sourceModal" tabindex="-1" role="dialog" aria-labelledby="sourceModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
		<div class="modal-dialog modal-dialog-centered">
			<livewire:source.source-form />
		</div>
	</div>-}}
</div>

{{--@section('custom_script')
@include('layouts.scripts.source-scripts')
@endsection--}}
</x-app-layout>
