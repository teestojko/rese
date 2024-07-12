<!DOCTYPE html>
<html>
<head>
    <title>Thanks</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <h1>Thank You!</h1>
                <p>Your payment has been processed.</p>
                <a href="{{ url('/') }}" class="btn btn-primary">Return Home</a>
            </div>
        </div>
    </div>
</body>
</html>
