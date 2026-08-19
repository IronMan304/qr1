<x-app-layout>
<div class="content">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Subjects List</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-sm-12">
            <div class="card card-table show-entire">
                <div class="card-body">

                    <div class="page-table-header mb-2">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="doctor-table-blk">
                                <h3>Subjects</h3>
                                <div class="doctor-search-blk">
                                          <div class="add-group">
                                                <a href="{{ route('subjects.create') }}" class="btn btn-primary ms-2">
                                                    <img src="{{ asset('assets/img/icons/plus.svg') }}" alt> 
                                                </a>
                                        </div>
                                </div>
                                </div>
                                 
                            </div>
                        
                            <div class="col-auto text-end float-end ms-auto download-grp">

                                            <!-- Create button -->
         
                                <!-- Search -->
                                <div class="top-nav-search table-search-blk">
                                    <form method="GET" action="{{ route('subjects.index') }}">
                                        <input type="text" name="search" class="form-control"
                                               placeholder="Search here"
                                               value="{{ request('search') }}">
                                        <button type="submit" class="btn">
                                            <img src="{{ asset('assets/img/icons/search-normal.svg') }}" alt>
                                        </button>
                                    </form>
                                </div>

                                <!-- Date filter -->
                                <div class="top-nav-search table-search-blk">
                                    <form method="GET" action="{{ route('subjects.index') }}">
                                        <input type="date" name="date" class="form-control"
                                               value="{{ request('date') }}"
                                               onchange="this.form.submit()">
                                    </form>
                                </div>

                                <!-- Status filter (optional if you add status column) -->
                                <div class="top-nav-search table-search-blk">
                                    <form method="GET" action="{{ route('subjects.index') }}">
                                        <select class="form-control" name="statusFilter" onchange="this.form.submit()">
                                            <option value="">-- All Status --</option>
                                            <option value="active" {{ request('statusFilter')=='active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ request('statusFilter')=='inactive' ? 'selected' : '' }}>Inactive</option>
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
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($paginated as $subject)
                                    <tr>
                                        <td>{{ $subject->code }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->description }}</td>
                                        <td>
                                            {{--<a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-sm btn-info">View</a>--}}
                                            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No subjects found</td>
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
</div>
</x-app-layout>
