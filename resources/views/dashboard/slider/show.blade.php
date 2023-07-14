@extends('dashboard.layout')

@section('title')
Show Slider
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Slide</h1>
    <a href="{{url('admin/slides')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-caret-left"> </i>
        Back To Slides
    </a>
</div>

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Show Slide
        </h6>
    </div>

    <div class="card-body">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th >Content</th>
            <td>{!!$slide->content!!}</td>
          </tr>

          <tr>
            <th >Status</th>
            <td> {{$slide->active}} </td>
          </tr>

          <tr>
            <th >Photo</th>
            <td>
                <img src="{{asset($slide->photo)}}" style="width: 400px;">
            </td>
          </tr>
          
        </tbody>
      </table>
    </div>
</div>

@endsection()


