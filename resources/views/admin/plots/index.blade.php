@extends('admin.layouts.app')
@section('title', 'Plots | Lumbini Innovate')
@section('content')
<div class="container-fluid py-3">
    <div class="mb-4 card-header">
        <h4 class="mb-0 text-muted" style="font-size: 12px;">
            <a href="" class="text-decoration-none text-muted">Plots</a>
        </h4>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Plots List</h5>
            <div>
                <a href="{{route('admin.plots.create')}}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Add Plots
                </a>
            </div>
        </div>

        <div class="card-body">
            <!-- Search Bar -->
            <div class="mb-4">
                <form action="" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search properties..."
                            value="{{ request('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Property Table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>P.Number</th>
                            <th>ParentProperty</th>
                            <th>Sq.Meter</th>
                            <th>TotalPrice</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($plots as $plot)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $plot->title }}</td>
                            <td>{{ $plot->plot_number }}</td>
                            <td>{{ $plot->landParcel->title ?? 'N/A' }}</td>
                            <td>{{ $plot->area }}</td>
                            <td>{{ $plot->total_price }}</td>
                            <td>{{ $plot->remarks }}</td>
                            <td>{{ $plot->status }}</td>
                            <td>
                                <div class="d-flex" style="gap:8px;">
                                    <!-- View details for all plots -->
                                    <a href="{{route('admin.plots.view',['id'=>$plot->id])}}"
                                        class="btn btn-sm btn-info" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Show sell button for available/reserved -->
                                    @if($plot->status == 'available' || $plot->status == 'reserved')
                                    <a href="{{route('admin.plots.sell',['id'=>$plot->id])}}"
                                        class="btn btn-sm btn-success" title="Sell Plot">
                                        <i class="fas fa-dollar-sign"></i>
                                    </a>
                                    @endif

                                    <!-- Edit is allowed when not sold -->
                                    @if($plot->status != 'sold')
                                    <a href="{{route('admin.plots.edit',['id'=>$plot->id])}}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.plots.destroy', ['id' => $plot->id]) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No Plots found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            @if($plots->hasPages())
            <div class="mt-3 d-flex justify-content-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm">
                        {{-- Previous Page Link --}}
                        @if($plots->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">&laquo;</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $plots->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach($plots->getUrlRange(1, $plots->lastPage()) as $page => $url)
                        @if($page == $plots->currentPage())
                        <li class="page-item active">
                            <span class="page-link">{{ $page }}</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if($plots->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $plots->nextPageUrl() }}"
                                rel="next">&raquo;</a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <span class="page-link">&raquo;</span>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection