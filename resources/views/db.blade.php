<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB Connection</title>
</head>
<body>
    @if(DB::connection()->getPdo())
        Successfully connected to the database => {{DB::connection()->getDatabaseName()}};
    @endif
</body>
</html>
