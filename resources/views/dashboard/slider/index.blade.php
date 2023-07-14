@extends('dashboard.layout')

@section('title')
    Slider
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Slides</h1>
    <a href="{{url('admin/slides/create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"> </i>
        New Slide
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success text-center" role="alert">
        {{session('success')}}
    </div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Slides
        </h6>
    </div>
    <div class="card-body">

        @if (session('deleted'))
        <div class="alert alert-danger" role="alert">
            {{session('deleted')}}
        </div>
        @endif

        <div class="table-responsive">
            
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th>Content</th>
                        <th>Photo</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                {{-- @if ($cats->all() != null) --}}
                @if ($slides->isNotEmpty())
                    <tbody>
                        @foreach ($slides as $slide)                        
                        <tr>
                            <td>
                                {{-- {{ $slide->content }} --}}
                                {!! $slide->content !!}
                            </td>

                            <td>
                                <img src="{{asset($slide->photo) }}" alt="" style="width: 200px; height : 150px">
                                {{-- <img src="{{url($slide->photo) }}" alt=""> --}}
                            </td>

                            <td>
                                <i class="fas fa-{{ $slide->active? 'check text-success': 'times text-danger'}} "> </i>
                            </td>

                            <td>
                                <form action="{{ url('admin/slides/'. $slide->id) }}" method="POST">

                                    <a href="{{ url("admin/slides/$slide->id") }}" class="btn btn-sm btn-info"> View </a>
                                    
                                           {{--  {{url('admin/slides/'. $slide->id.'/'.'edit/')}} --}}
                                    <a href="{{ url("admin/slides/$slide->id/edit") }}" class="btn btn-sm btn-warning"> Edit </a>

                                    @csrf
                                    @method('Delete')
                                    <button class="btn btn-sm btn-danger" type="submit"> Delete</button>

                                    {{-- MY WAY --}}
                                    {{-- @if ($slide->active)
                                        <a href="{{ url("admin/slides/deactivate/$slide->id") }}" class="btn btn-sm btn-dark"> Disable </a>
                                    @else
                                        <a href="{{ url("admin/slides/activate/$slide->id") }}" class="btn btn-sm btn-success"> Enable </a>
                                    @endif --}}

                                    {{-- ENG.MOHAMED ISMAIEL'S WAY --}}
                                    <a href="{{ url('/admin/toggle-slide-active/'.$slide->id) }}" class="btn btn-sm btn-{{ $slide->active? 'dark': 'success' }}">
                                        {{ $slide->active? 'Disable': 'Enable' }}
                                    </a>
                                </form>
                                <br>
                               

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                @else
                    <tr>
                        <td colspan="4">
                            <div class="alert alert-warning" role="alert">
                                There is no Slides Yet, U can Add a new Slide from here.....
                                <a href="/admin/slides/create">
                                    New Slide
                                </a>
                            </div>
                        </td>
                    </tr>
                @endif
            </table>

            {{$slides->links()}}


        </div>       
        
        
    </div>
</div>

@endsection()


