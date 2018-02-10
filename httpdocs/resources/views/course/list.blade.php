@extends('layouts.master', array('container_class'=>'mtop10'))
@section('title', 'Course Catalogue')
@section('content')
<!-- section 1 ends-->

<div class="container">
    <div class="row">
        <div class="col-md-3">
<!--            @include('layouts/sidebar-filter')-->
            @include('layouts/right-sidebar-filter')
        </div>
        <div class="col-md-9" id="AllCoursesAndP">
            @include('course/batches')
        </div>        
    </div>
</div>
@endsection