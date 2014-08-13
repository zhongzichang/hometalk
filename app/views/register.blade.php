<html>
<head>
<title>register</title>
</head>
<body>
{{ Form::open(array('url' => 'register')) }}
{{ Form::label('mobile', 'mobile') }}
{{ Form::text('mobile') }}
{{ Form::label('password', 'password') }}
{{ Form::password('password') }}
{{ Form::submit('Click Me!') }}
{{ Form::close() }}
</body>
</html>