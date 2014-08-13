<html>
<head>
<title>login</title>
</head>
<body>
{{ Form::open(array('url' => 'login')) }}
{{ Form::label('mobile', 'mobile') }}
{{ Form::text('mobile') }}
{{ Form::label('password', 'password') }}
{{ Form::password('password') }}
{{ Form::submit('Click Me!') }}
{{ Form::close() }}
</body>
</html>