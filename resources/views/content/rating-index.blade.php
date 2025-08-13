<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Rate A Book!</title>
</head>

<body>
    <div class="container">
        <h1>Insert Rating</h1>

        <form action="{{ route('rating.insert') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="author_id">Book Author: </label>
                <select name="author_id" id="author_id" class="form-control" required>
                    <option value="">Pilih Author</option>
                    @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->author_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-2">
                <label for="book_id">Book Name: </label>
                <select name="book_id" id="book_id" class="form-control" required>
                    <option value="">Pilih Buku</option>
                </select>
            </div>

            <div class="form-group mt-2">
                <label for="rating">Rating</label>
                <input type="number" name="rating" min="1" max="10" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <script>
        $(document).ready(function() {
            $('#author_id').change(function() {
                var authorId = $(this).val();
                if (authorId) {
                    $.ajax({
                        url: '{{route("ajax.getBookByAuthor")}}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            "author_id": authorId,
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            $('#book_id').empty();
                            $('#book_id').append('<option value="">Pilih Buku</option>');
                            $.each(data, function(key, book) {
                                $('#book_id').append('<option value="' + book.id + '">' + book.book_title + '</option>');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    $('#book_id').empty();
                    $('#book_id').append('<option value="">Pilih Buku</option>');
                }
            });
        });
    </script>
</body>

</html>