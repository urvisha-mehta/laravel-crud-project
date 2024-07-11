<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Eloquent</title>
</head>
<body>
  <div class="content-wrapper">
    <div class="p-3">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-6">
            <h1>@yield('title')</h1>
          </div>
        </div>
      </div>
    </div>
  </div>    

  <div class="content-wrapper">
    <div class="p-3">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12">
            @yield('content')
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>