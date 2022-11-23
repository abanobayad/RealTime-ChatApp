@extends('layouts.app')
@section('content')

<style>
    .m_time{
        color: rgb(48, 45, 45);
        float: right;
        font-size: 12px;
    }

    .s_user{
        float: right;
    }
</style>
<div class="container">
    <div class="row m-auto p-1">
        <div class="col-md-6  p-2 rounded bg-primary m-auto">
            <h3 class="text-bold text-light text-center">Hello, {{Auth::user()->name}}</h3>
        </div>

    </div>

    {{-- Messages --}}
    <div class="row m-auto p-1">
        <div class="col-lg-8 col-md-12 m-auto bg-light">
            <div id="messages" >
                @foreach ($messages as $message)
                    @if ($message->user()->first()->id == Auth::id())
                    <div class="my-3" >
                        <div class="row ">
                            <div class="col-3">
                                <strong class="text-indigo">{{$message->user()->first()->name}}  : </strong>
                            </div>
                            <div class="col-6 py-1" style="background-color: rgb(148, 61, 230) ; color: white ; border-radius: 50px ">
                                <span>
                                    {{$message->message}}
                                </span>
                            </div>
                            <div class="col-3">
                                <span class="m_time"> {{$message->created_at->diffForHumans()}}</span></div>
                            </div>
                    </div>
                    @else
                        <div class="my-3" >
                            <div class="row " style="direction:ltr;">
                                <div class="col-3">
                                    <span class="text-muted" style="font-size: 12px">
                                        {{$message->created_at->diffForHumans()}}
                                    </span>
                                </div>
                                <div class="col-6 py-1 bg-warning" style="background-color: rgb(148, 61, 230) ; color: black; border-radius: 50px ">
                                    <span style="float: right">
                                        {{$message->message}}
                                    </span>
                                </div>
                                <div class="col-3">
                                    <strong class="s_user">: {{$message->user()->first()->name}}</strong>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach



        </div>
    </div>

    {{-- Start Form --}}
    <div class="row m-auto p-1 ">
        <div class="col-md-6  pt-2 m-auto">

            <div class="row m-auto">
                <div class="col-12 m-auto">
                    <form class="form" id="message_form" >
                        <input type="hidden" id="auth_id" value="{{Auth::id()}}">
                        <input id="username" type="hidden" name="username" disabled  class="form-control" value="{{Auth::user()->name}}">
                        <div class="form-group" >
                            <input id="message_input" type="text" name="message"   class="form-control" placeholder="Enter Message" >
                        </div>
                        <button id="message_sent" type="submit"  class="btn btn-sm btn-outline-dark  mt-1" style="float: right">Send</button>
                    </form>
                </div>
            </div>

        </div>

    </div>


</div>
@endsection
