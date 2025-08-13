<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Famous Authors</title>
</head>

<body>
    <h1>Top 10 Most Famous Author</h1>
    <table border="1" class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Author Name</th>
                <th scope="col">Voters</th>
            </tr>
        </thead>
        <tbody>
            @php($i = 1)
            @foreach ($authors as $author)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $author->author_name }}</td>
                <td>{{ $author->ratings_count ?? 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>