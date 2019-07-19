<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jobs.at coding exercise</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="#">Jobs.AT Project</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="/">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link post" href="{{ url('/create') }}">Post a job</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">
    <div class="row justify-content-md-center align-self-center">
      <div class="col-md-8 col-sm-12">
        <div class="col-lg-12 col-md-12 col-sm-12 mt-5 ">
          <div class="card">
            <div class="card-header"> Post your job </div>
            <div class="card-body">
              <!-- Create new job form -->
                <form method="POST" action="/save" autocomplete="off">@if(count($errors))
                      <div class="alert alert-danger">
                        <strong>Whoops!</strong> Something went wrong!
                        <br/>
                        <ul>
                          @foreach($errors->all() as $error)
                          <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                    @endif
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                     <label for="title"> Title </label>
                     <input type="text" name="title" class="form-control"> 
                     <span class="text-danger">{{ $errors->first('title') }}</span>
                  </div>
                  <div class="form-group">
                    <label for="company"> Company </label>
                    <select class="form-control" name="company_id">
                      <option value="#">--Choose company--</option>
                      @foreach($companies as $company)
                       <option value="{{ $company->id }}">{{ $company->name }}</option>
                      @endforeach
                     </select>
                  </div> 
                  <div class="form-group">
                     <label for="description"> Description </label>
                     <textarea name="description" class="form-control"></textarea>
                  </div> 
                  <div class="form-group">
                     <label for="location"> Location </label>
                     <input type="text" name="location" class="form-control"> 
                  </div> 
                  <div class="form-group text-right">
                     <button type="submit" class="btn btn-primary">Save</button>
                     <a class="btn btn-danger btn-close" href="{{ ('/') }}">Cancel</a>
                  </div>   
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>

</html>
