<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }} width=device-width, initial-scale=1">

    <title>jobs.at coding exercise</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

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
    <div class="row justify-content-md-center">
      <div class="col-lg-10 mx-auto ">
        <div class="job-form-box">
              <h2 class="heading">Find a <span class="accent">job</span> you will <span class="accent">love</span>.</h2>
            <form>
                <div class="form-group">
                    <input type="text" class="form-control search-holder" id="search-title" placeholder="search for job title... "name="search-title">
                </div>    
            </form>
          </div>
        </div>
        <div class="col-lg-10 mt-5">
            <table role="table" class="table table-hover" id="job-results">
                <thead role="rowgroup">
                    <tr role="row">
                        <th  role="columnheader" scope="col">Title</th>
                        <th  role="columnheader" scope="col">Company</th>
                        <th  role="columnheader" scope="col">Location</th>
                        <th  role="columnheader" scope="col">Published at</th>
                        <th  role="columnheader" scope="col">Description</th>
                        <th  role="columnheader" scope="col">Status</th>
                    </tr>
                </thead>
                <tbody role="rowgroup">

                    @foreach($jobs as $job)
                        <tr role="row">
                            <td role="cell">
                                {{ $job->title }}
                            </td>
                            <td role="cell">
                                {{ $job->company->name }}
                            </td>
                            <td role="cell">
                                {{ $job->location }}
                            </td>
                            <td role="cell" >
                                {{ $job->published_at }}
                            </td>
                            <td role="cell" class="justify-content-center">
                                <button class="btn" data-toggle="modal" data-target="#jobModal-{{ $job->id }}">
                                   <i class="fa fa-lg fa-eye description" aria-hidden="true"></i>
                                </button>

                                <!-- Modal view for Description -->
                                <div class="modal fade" id="jobModal-{{ $job->id }}" tabindex="-1" role="dialog" aria-labelledby="jobModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h3 class="modal-title" id="ModalLabel-{{ $job->title }}">{{ $job->title }}</h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true" class="white-text">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <span class="modal-text">JOB DESCRIPTION:</span><br>
                                       {{ $job->description }}
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            </td>
                            <td role="cell" class="justify-content-center">
                                <!-- Checking if active or inactive Job -->
                                @if($job->active =='1')         
                                    <i class="fa fa-lg job-active fa-check-circle"></i>
                              @else
                                    <i class="fa fa-lg job-inactive fa-times-circle"></i>
                              @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
  
  <!-- search for jobs by title -->
  <script type="text/javascript">
      $('#search-title').on('keyup',function(){
          var value = $("#search-title").val();

          if(value.length === 0){
              // if no search argument then show all jobs
              clearJobs();
          } else {
              hideJobsThatDontHaveThisName(value);
          }
      });
      
      function hideJobsThatDontHaveThisName(name) {
          $('table tbody tr').each(function (index, element) {
              var title = '';

              try {
                  title = $(element).children("td:first-child").html();
              } catch (e) {
              }

              if(title.toLowerCase().indexOf(name.toLowerCase()) < 0){
                  $(element).hide();
              } else {
                  $(element).show();
              }
          });
      }

      function clearJobs()
      {
        $('table tbody tr').each(function (index, element) {
            $(element).show();
        });
      }
  </script>
</body>
</html>