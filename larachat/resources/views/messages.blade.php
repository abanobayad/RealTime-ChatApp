@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form action="{{route('messages.store')}}" method="POST">
                @csrf
                <div class="form-group ">
                    <label class="form m-2" for="">Message</label>
                    <input class="form-control m-2" type="text" name="message" id="">
                </div>
                <div class="form-group">
                    <input class="btn btn-dark m-2" type="submit" value="Send">
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
