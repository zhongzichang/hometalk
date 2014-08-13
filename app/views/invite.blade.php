<html>
<head>
<title>invite</title>
</head>
<body>
{{ Form::open(array('url' => 'invite')) }}
{{ Form::label('invitee_id', 'invitee_id') }}
{{ Form::text('invitee_id') }}
{{ Form::label('group_id', 'group_id') }}
{{ Form::text('group_id') }}
{{ Form::submit('Click Me!') }}
{{ Form::close() }}
</body>
</html>