<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Search History</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
        <h1>
            <a href="{{ route('search-history.filter') }}">User Search History</a>
        </h1>
        @php
        $yesterday = \Carbon\Carbon::now()->subDay();
        $lastWeek = \Carbon\Carbon::now()->subWeek();
        $lastMonth = \Carbon\Carbon::now()->subMonths(1)->startOfMonth();

        @endphp

        <form action="{{ route('search-history.filter') }}" method="get">

            <div class="row">
                <div class="col-md-4">
                    <h4>All Keywords:</h4>
                    @foreach($keywords as $keyword)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="keywords[]" value="{{ $keyword->id }}" id="{{ $keyword->id }}">
                            <label class="form-check-label" for="{{ $keyword->id }}">
                                {{ $keyword->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <h4>All Users:</h4>
                    @foreach($users as $user)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="users[]" value="{{ $user->id }}" id="{{ $user->id }}" >
                            <label class="form-check-label" for="{{ $user->id }}">
                                {{ $user->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <h4>Time Range:</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="yesterday" id="yesterday" value="{{ $yesterday->format('Y-m-d') }}">
                        <label class="form-check-label" for="yesterday">
                            See data from yesterday
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="last_week" id="last_week" value="{{ $lastWeek->format('Y-m-d') }}">
                        <label class="form-check-label" for="last_week">
                            See data from last week
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="last_month" id="last_month" value="{{ $lastMonth->format('Y-m-d') }}">
                        <label class="form-check-label" for="last_month">
                            See data from last month
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request()->get('start_date') }}">
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request()->get('end_date') }}">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        <hr>

        <table class="table">
            <thead>
                <tr>
                    <th>Search Keyword</th>
                    <th>User</th>
                    <th>Search Result Count</th>
                    <th>Search Timestamp</th>
                </tr>
            </thead>
            <tbody>
                @foreach($searches as $search)
                    <tr>
                        <td>{{ $search->search_keyword }}</td>
                        <td>{{ $search->user->name }}</td>
                        <td>{{ $search->search_result_count }}</td>
                        <td>{{ $search->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>