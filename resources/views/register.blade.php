<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">
        <h2>Register</h2>

        {{-- Display validation errors --}}
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Registration Form --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required autofocus>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" class="form-control"  name="email" id="email" value="{{ old('email') }}" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" class="form-control"  name="password" id="password" required>
            </div>

            <div>
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control"  name="password_confirmation" id="password_confirmation" required>
            </div>

            <div>
                <button type="submit" class="btn btn-default">Register</button>
            </div>
        </form>
    </div>
</body>
</html>
