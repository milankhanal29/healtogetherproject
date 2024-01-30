@section('admincontent')
@extends('admin.admin-nav')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News List</title>
</head>
<body>
    
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('News List') }}</div>
                <div class="card-body">
                    @if (count($news) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($news as $newsItem)
                                    <tr>
                                        <td>{{ $newsItem->title }}</td>
                                        <td>
                                            @if (str_word_count($newsItem->content) > 20)
                                                <div class="news-content">
                                                    <span class="truncated-content">
                                                        {{ implode(' ', array_slice(str_word_count($newsItem->content, 2), 0, 20)) . ' ...' }}
                                                    </span>
                                                    <span class="full-content" style="display: none;">{{ $newsItem->content }}</span>
                                                    <button class="btn btn-link btn-sm show-more" onclick="showMore(this)">Show More</button>
                                                    <button class="btn btn-link btn-sm show-less" style="display: none;" onclick="showLess(this)">Show Less</button>
                                                </div>
                                            @else
                                                {{ $newsItem->content }}
                                            @endif
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('admin.deletenews', $newsItem->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No news found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function showMore(button) {
        const newsContent = button.parentElement;
        const truncatedContent = newsContent.querySelector('.truncated-content');
        const fullContent = newsContent.querySelector('.full-content');
        const showMoreButton = newsContent.querySelector('.show-more');
        const showLessButton = newsContent.querySelector('.show-less');
        truncatedContent.style.display = 'none';
        fullContent.style.display = 'inline';
        showMoreButton.style.display = 'none';
        showLessButton.style.display = 'inline';
    }

    function showLess(button) {
        const newsContent = button.parentElement;
        const truncatedContent = newsContent.querySelector('.truncated-content');
        const fullContent = newsContent.querySelector('.full-content');
        const showMoreButton = newsContent.querySelector('.show-more');
        const showLessButton = newsContent.querySelector('.show-less');
        truncatedContent.style.display = 'inline';
        fullContent.style.display = 'none';
        showMoreButton.style.display = 'inline';
        showLessButton.style.display = 'none';
    }
</script>
@endsection