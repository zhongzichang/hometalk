<html>
<head>
<title>message create</title>
</head>
<body>
{{ Form::open(array('url' => 'message','files'=>true)) }}
{{ Form::label('group_id', 'group_id') }}
{{ Form::text('group_id') }}
{{ Form::label('res_type', 'res_type') }}
{{ Form::text('res_type') }}
{{ Form::label('file', 'file') }}
{{ Form::file('file') }}
{{ Form::submit('Click Me!') }}
{{ Form::close() }}
</body>
</html>