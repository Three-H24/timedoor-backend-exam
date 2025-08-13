<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>List of books with Filter</title>

    <style>
        .table {
            width: 100%;
        }

        .table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        a {
            display: inline-block;
            padding: 6px 12px;
            margin: 2px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <h1>List Of Books</h1>
    <form method="GET" action="{{ route('books.index') }}">
        <label for="search">Search: </label>
        <input type="text" name="search" value="{{ $search }}" placeholder="Cari buku ...">

        <label for="per_page">List Shown:</label>
        <select name="per_page" id="per_page" onchange="this.form.submit()">
            <option value="100" {{ $pages == 100 ? 'selected' : '' }}>100</option>
            <option value="200" {{ $pages == 200 ? 'selected' : '' }}>200</option>
            <option value="300" {{ $pages == 300 ? 'selected' : '' }}>300</option>
        </select>

        <button type="submit">Submit</button>
    </form>

    <p></p>
    <a class="btn btn-info" href="{{route('author.index')}}">Famous Author</a>
    <a class="btn btn-info" href="{{route('rating.index')}}">Rate a Book</a>
    <p></p>
    @if($books->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Book Name</th>
                <th scope="col">Category Name</th>
                <th scope="col">Author Name</th>
                <th scope="col">Average Rating</th>
                <th scope="col">Voters</th>
            </tr>
        </thead>
        <tbody>
            @php($i = 1)
            @foreach($books as $book)
            <tr style="color: black;">
                <td>{{$i++}}</td>
                <td>{{$book->book_title}}</td>
                <td>{{$book->category->category}}</td>
                <td>{{$book->author->author_name}}</td>
                <td>{{ number_format($book->ratings_avg_rating, 2) ?? 0}}%</td>
                <td>{{$book->ratings_count ?? 0}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p><strong><em>Data belum ada.</em></strong></p>
    @endif
</body>

</html>