<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>{{ $title ?? 'Admin' }}</title>
  </head>
  <body>
    
    <div class="container" style="margin-top: 100px">
      <div class="row justify-content-center">
        <div class="col-md-4"> 
          <div class="card">
            <div class="card-header text-center">
              <h5>Login</h5>
            </div>
            <div class="card-body">
              @if ($errors->first())
                <div class="alert alert-danger" role="alert">
                  {{ $errors->first() }}
                </div>
              @endif
              @if ($message = Session::get('success'))
                <div class="alert alert-success">
                  {{ $message }}
                </div>
              @endif
              <form action="{{ route('auth') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password">
                </div>
                <hr>
                <button type="submit" class="btn btn-dark" style="width: 100%">Login</button>
                <hr>
                <a href="{{ route('register') }}" type="submit" class="btn btn-secondary" style="width: 100%">Register</a>
              </form>
            </div>
         </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>