@extends('layouts.master')
@section('title', 'Contact Us')
@section('content')
<div class="container container-body">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ URL::to('/')}}">Home</a></li>
            <li class="active">Contact Us</li>
        </ol>
    </div>
    <div class="row">
        <h2 class="text-center primary-color">Contact Us</h2>
        <div class="col-md-3">
            <h4><strong>Contact Info</strong></h4>
            <br>
            <address>
                <strong>BuddhiJeevi Pvt. Ltd.,</strong><br>
                E-117, Brigade Courtyard<br>
                HMT Main Road, Jalahalli<br>
                Bangalore - 560013<br>
            </address>
            <address>
                <strong>Phone</strong><br>
                +91 9980388991
            </address>
            <address>
                <strong>Email</strong><br>
                <a href="mailto:support@buddhijeevi.comm">support@buddhijeevi.com</a>
            </address>
        </div>
        <div class="col-md-7">
            <h4><strong>Get in touch with us</strong></h4>
            <p>Have any queries ? Use below form to reach us.</p>
            <br>
            <form class="form-horizontal" name="RegForm1" id="FeedBackForm" method="post" action="/send-feedback-mail">
                @if(Session::has('message'))
                    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                @endif
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label for="inputname" class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputname" value="{{ old('name') }}" name="name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                  <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" value="{{ old('email') }}" name="email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputmobile" class="col-sm-2 control-label">Mobile</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="inputmobile" value="{{ old('phone') }}" name="phone">
                  </div>
                </div>
                <?php
                    $requestType = DB::table('tblrequesttype')->orderBy('aRequestID','asc')->get();
                ?>
                <div class="form-group">
                  <label for="requestType" class="col-sm-2 control-label">Request Type</label>
                  <div class="col-sm-10">
                    <select name="requestType" id="requestType" class="form-control">
                        <option value="">Select Option</option>
                        @foreach($requestType as $request)
                        <option value="{{$request->aRequestID}}"  {{ (Input::old("requestType") == $request->aRequestID ? "selected":"")}}  >{{$request->tRequestType}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <label for="messages" class="col-sm-2 control-label">Message</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" placeholder="Please tell us what more you would like to see!(max - 250 characters)" rows="3" cols="20"  name="messages" id="messages">{{ old('messages') }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        {!! captcha_image_html('ContactCaptcha') !!}
                        <input type="text" id="CaptchaCode" name="CaptchaCode">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-2">
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                    <div class="col-sm-2">
                        <p id="LoadingImag"></p>
                    </div>
                </div>
              </form>
        </div>        
    </div>
</div>
@endsection