<html>
<head>
<title>create family item</title>
</head>
<body>
<p>
{{ Form::open(array('url' => 'families/create')) }}
{{ Form::label('mobile', 'mobile') }}
{{ Form::text('mobile') }}
{{ Form::label('nickname', 'nickname') }}
{{ Form::text('nickname') }}
{{ Form::label('type', 'type') }}
{{ Form::text('type') }}

{{ Form::submit('Click Me!') }}
{{ Form::close() }}

</p>
</body>
</html>