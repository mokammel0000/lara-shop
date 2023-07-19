@extends('dashboard.layout')

@section('title')
Show Category
@endsection()


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Categories</h1>
    <a href="{{url('admin/categories')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-caret-left"> </i>
        Back To Categories
    </a>
</div>

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Show Category
        </h6>
    </div>

    <div class="card-body">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th >Name</th>
            <td>{{$category->name}}</td>
          </tr>

          <tr>
            <th >Icon</th>
            <td>
                <i class="fas fa-{{$category->icon}}">
                <img src="{{url($category->icon)}}" alt=""></i>
            </td>
          </tr>

          <tr>
            <th >Photo</th>
            <td>
                <img src="{{asset($category->photo)}}" style="width: 400px;">
            </td>
          </tr>
          
        </tbody>
      </table>
    </div>
</div>

@endsection()


