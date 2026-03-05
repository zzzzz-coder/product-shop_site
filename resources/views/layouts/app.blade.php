<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Каталог</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .group-menu a { color: blue; text-decoration: none; }
        .group-menu a.active { color: green; font-weight: bold; }
    </style>
</head>
<body>

<div style="width:300px; float:left;">
    <h4>Группы</h4>

    @include('partials.group-tree', [
        'groups' => $groupTree,
        'currentGroup' => $currentGroup ?? null
    ])

</div>

<div style="margin-left:320px;">
    @yield('content')
</div>

</body>
</html>