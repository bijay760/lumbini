@extends('admin.layouts.app')
@section('title', 'Properties | Lumbini Innovate')
@section('content')
<div class="container-fluid py-3">
    <div class="mb-4 card-header">
        <h4 class="mb-0 text-muted" style="font-size: 12px;">
            <a href="" class="text-decoration-none text-muted">Properties</a>
        </h4>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Property List</h5>
            <div class="d-flex justify-content-between align-items-center" style="gap:6px;">
                <div>
                    <a href="{{route('admin.properties.create')}}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add Property
                    </a>
                </div>
                <!-- @if(count($landParcels)>1)
                        <div>
                            <a href="{{route('admin.properties.merge')}}" class="btn btn-sm btn-danger">
                                <i class="fas fa-plus"></i> Merge Property
                            </a>
                        </div>
                    @endif -->
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
                            <th>Location</th>
                            <th>Kitta</th>
                            <th>Dhoor</th>
                            <th>Sq.meter</th>
                            <th>Sq.meter(Rem.)</th>
                            <th>T.Amount</th>
                            <th>Pu.Date</th>
                            <th>From</th>
                            <!-- <th>Has child</th> -->
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="height: 30px;">
                            <td style="padding: 3px; font-size: 15px; text-align:center;"></td>
                            <td style="padding: 3px; font-size: 15px; text-align:center;"></td>
                            <td style="padding: 3px; font-size: 15px; text-align:center;"></td>
                            <td style="padding: 3px; font-size: 15px; text-align:center;"></td>
                            <td style="padding: 3px; font-size: 15px; text-align:center;"><b>{{$totalDhoor}}</b></td>
                            <td style="padding: 3px; font-size: 15px; text-align:center;"><b>{{$totalSqMeter}}</b></td>
                            <td style="padding: 3px; font-size: 15px; text-align:center;"><b>{{$total_available}}</b>
                            </td>
                            <td style="padding: 3px; font-size: 15px; text-align:center;"><b>{{$totalThaliAmount}}</b>
                            </td>
                            <td style="padding: 3px; font-size: 15px; text-align:center;"></td>
                            <td style="padding: 3px; font-size: 15px; text-align:center;"></td>
                            <td style="padding: 3px; font-size: 15px; text-align:center;"></td>
                            <td style="padding: 3px; font-size: 15px; text-align:center;"></td>
                            <td style="padding: 3px; font-size: 15px; text-align:center;"></td>
                        </tr>
                        @foreach($landParcels as $landParcel)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $landParcel->title }}</td>
                            <td>{{ $landParcel->district }}<br>{{$landParcel->municipality}}
                                , {{$landParcel->ward_no}}</td>
                            <td style="text-align: center;">{{ $landParcel->kitta_no }}</td>
                            <td style="text-align: center;">{{ $landParcel->dhoor }}</td>
                            <td style="text-align: center;">{{ $landParcel->total_area }}</td>
                            <td style="text-align: center;">{{ $landParcel->available_area }}</td>
                            <td style="text-align: center;">{{ $landParcel->thali_amount}}</td>
                            <td>{{ _date($landParcel->purchase_date)}}</td>
                            <td>{{ $landParcel->purchase_from}}</td>
                            <!-- <td><a href="{{route('admin.properties.child_properties',['id'=>$landParcel->id])}}">{{$landParcel->has_child}}</a></td> -->
                            <td>
                                @if($landParcel->is_approved)
                                <span class="badge bg-success">Approved</span>
                                @else
                                <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex" style="gap:8px;">
                                    <a href="{{route('admin.properties.view',['id'=>$landParcel->id])}}"
                                        class="btn btn-sm btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{route('admin.properties.plotting',['id'=>$landParcel->id])}}"
                                        class="btn btn-sm btn-outline-success" title="Plotting">
                                        <i class="fas fa-th"></i>
                                    </a>
                                    <a href="{{route('admin.properties.edit',['id'=>$landParcel->id])}}"
                                        class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.properties.delete', ['id' => $landParcel->id]) }}"
                                        method="POST" style="display: inline-block;"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($landParcels->hasPages())
            <div class="mt-3 d-flex justify-content-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm">
                        {{-- Previous Page Link --}}
                        @if($landParcels->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link">&laquo;</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $landParcels->previousPageUrl() }}" rel="prev">&laquo;</a>
                        </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach($landParcels->getUrlRange(1, $landParcels->lastPage()) as $page => $url)
                        @if($page == $landParcels->currentPage())
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
                        @if($landParcels->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $landParcels->nextPageUrl() }}"
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