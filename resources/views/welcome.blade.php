@extends('shopify-app::layouts.default')

@section('content')
<h1>Shop Name: {{ $shopApi['body']['shop']['name'] }}</h1>
<h2>Shop Domain: {{ $shopApi['body']['shop']['domain'] }}</h2>
<h3>Shop Email: {{ $shopApi['body']['shop']['email'] }}</h3>
{{-- @foreach($shop as $api)
<h1>{{ $api->name}}</h1>
@endforeach --}}
@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: 'Dashboard',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
    </script>
@endsection