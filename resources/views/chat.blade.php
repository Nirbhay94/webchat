
{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="row">--}}
{{--<div class="col-md-10">--}}
{{--<div class="panel panel-default">--}}
{{--<div id="app" >--}}
{{--<h1>Chat</h1>--}}
{{--<chat-log v-bind:messages="messages"></chat-log>--}}
{{--<chat-composer v-on:sentmessage="addMessage"></chat-composer>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endsection--}}


@extends('layouts.app')

@section('content')
    <div id="app">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">

                    <h1>Chat</h1>
                    <chat-log v-bind:messages="messages"></chat-log>
                    <chat-composer v-on:sentmessage="addMessage"></chat-composer>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-default">
                    <h4>Members Online</h4>
                    <chat-members v-bind:members="members"></chat-members>
                </div>
            </div>
        </div>
        <chat-boxes v-bind:members="members"></chat-boxes>
    </div>
@endsection