@extends('layouts.user_type.auth')

@section('content')

  <!-- <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Money</p>
                <h5 class="font-weight-bolder mb-0">
                  $53,000
                  <span class="text-success text-sm font-weight-bolder">+55%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Today's Users</p>
                <h5 class="font-weight-bolder mb-0">
                  2,300
                  <span class="text-success text-sm font-weight-bolder">+3%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">New Clients</p>
                <h5 class="font-weight-bolder mb-0">
                  +3,462
                  <span class="text-danger text-sm font-weight-bolder">-2%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales</p>
                <h5 class="font-weight-bolder mb-0">
                  $103,430
                  <span class="text-success text-sm font-weight-bolder">+5%</span>
                </h5>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
 
  <div class="row mt-4">
    <div class="col-lg-12 mb-lg-0 mb-4">
      <div class="card z-index-2">
        <div class="card-body p-3">
          <h6 class="ms-2 mt-4 mb-0"> Projects </h6>
          <p class="text-sm ms-2"> (<span class="font-weight-bolder">{{$projectInProgressCount}}</span>) in progress </p>
          <div class="status-card-container">
            <div class="status-card">
                <span style="display: flex; align-items:center; padding:3px">
             
                <h4 class="not-started">Not Started</h4>
              </span>
                <p class="not-started">{{$projectNotStarted}}</p>
            </div>
            <div class="status-card">
                <span style="display: flex; align-items:center; padding:3px">
         
                  <h4 class="in-progress">In Progress</h4>
                </span>
                <p class="in-progress">{{$projectInProgressCount}}</p>
            </div>
            <div class="status-card">
              <span style="display: flex; align-items:center; padding:3px">
            
              <h4 class="completed">Completed</h4>
            </span>
            <p class="completed">{{$projectCompleteCount}}</p>
            </div>
            <div class="status-card">
              <span style="display: flex; align-items:center; padding:3px">
           
              <h4 class="cancelled" >Cancelled</h4>
            </span>
            <p class="cancelled">{{$projectCancelledCount}}</p>
            </div>
        </div>
        
        <h6 class="ms-2 mt-4 mb-0"> Tasks </h6>
          <p class="text-sm ms-2"> (<span class="font-weight-bolder">{{$taskInProgressCount}}</span>) in progress </p>
          <div class="status-card-container">
            <div class="status-card">
                <span style="display: flex; align-items:center; padding:3px">
             
                <h4 class="not-started">Not Started</h4>
              </span>
                <p class="not-started">{{$taskNotStarted}}</p>
            </div>
            <div class="status-card">
                <span style="display: flex; align-items:center; padding:3px">
         
                  <h4 class="in-progress">In Progress</h4>
                </span>
                <p class="in-progress">{{$taskInProgressCount}}</p>
            </div>
            <div class="status-card">
              <span style="display: flex; align-items:center; padding:3px">
            
              <h4 class="completed">Completed</h4>
            </span>
            <p class="completed">{{$taskCompletedCount}}</p>
            </div>
            <div class="status-card">
              <span style="display: flex; align-items:center; padding:3px">
           
              <h4 class="cancelled" >Cancelled</h4>
            </span>
            <p class="cancelled">{{$taskCancelledCount}}</p>
            </div>
        </div>
          <div class="container border-radius-lg">
            <div class="row">  
              <div class="col-3 py-3 ps-0">
                <div class="d-flex mb-2">
                  <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-info text-center me-2 d-flex align-items-center justify-content-center">
                    <svg fill="#000000" height="10px" width="10px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 297 297" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 297 297">
                      <g>
                        <path d="M226.717,76c19.385,0,35.156-15.77,35.156-35.155c0-19.385-15.771-35.155-35.156-35.155   c-19.385,0-35.155,15.771-35.155,35.155C191.562,60.229,207.332,76,226.717,76z"/>
                        <path d="M70.295,76c19.385,0,35.155-15.77,35.155-35.155c0-19.385-15.771-35.155-35.155-35.155   C50.91,5.689,35.14,21.46,35.14,40.844C35.14,60.229,50.91,76,70.295,76z"/>
                        <path d="m285.579,177.951h-105.6c-6.448,10.652-18.146,17.787-31.479,17.787s-25.031-7.135-31.479-17.787h-105.6c-6.297,0-11.421,5.124-11.421,11.421v45.804c0,6.297 5.124,11.421 11.421,11.421h71.317v-4.181c0-15.695 10.005-29.576 24.895-34.54 0.06-0.02 0.119-0.039 0.179-0.058l10.229-3.138c1.776-0.543 3.691-0.435 5.393,0.308l25.065,10.94 25.065-10.94c1.703-0.745 3.617-0.851 5.393-0.308l10.229,3.138c0.06,0.019 0.119,0.038 0.179,0.058 14.891,4.964 24.895,18.845 24.895,34.54v4.181h71.317c6.297,0 11.421-5.124 11.421-11.421v-45.804c0.002-6.297-5.122-11.421-11.419-11.421z"/>
                        <path d="m112.019,163.503c-0.184-1.488-0.29-2.999-0.29-4.536 0-16.91 11.478-31.182 27.05-35.457v-1.069c0-13.378-8.597-25.241-21.31-29.406l-.059-.019-18.595-3.079c-1.583-0.487-3.274,0.351-3.843,1.912l-21.098,57.891c-1.217,3.34-5.94,3.34-7.158,0l-21.098-57.89c-0.46-1.261-1.649-2.051-2.925-2.051-0.302,0-19.513,3.214-19.513,3.214-12.817,4.271-21.381,16.153-21.381,29.589v42.764c2.976-1.198 6.222-1.863 9.621-1.863h100.599z"/>
                        <path d="m127.289,158.968c0,11.696 9.515,21.212 21.211,21.212s21.211-9.515 21.211-21.212-9.515-21.212-21.211-21.212-21.211,9.515-21.211,21.212z"/>
                        <path d="m184.528,222.664l-7.379-2.264-25.538,11.146c-1.984,0.866-4.239,0.866-6.223,0l-25.537-11.146-7.379,2.264c-8.482,2.866-14.174,10.792-14.174,19.752v39.538c0,5.168 4.189,9.357 9.357,9.357h81.691c5.168,0 9.357-4.189 9.357-9.357v-39.538c0-8.959-5.693-16.885-14.175-19.752z"/>
                        <path d="m185.271,158.968c0,1.536-0.106,3.048-0.29,4.536h100.598c3.4,0 6.645,0.666 9.621,1.863v-42.925c0-13.378-8.597-25.241-21.31-29.406l-.059-.019-18.595-3.079c-1.583-0.487-3.273,0.351-3.843,1.912l-21.098,57.889c-1.217,3.34-5.94,3.34-7.157,0l-21.098-57.889c-0.46-1.261-1.649-2.051-2.925-2.051-0.302,0-19.513,3.214-19.513,3.214-12.817,4.271-21.381,16.153-21.381,29.589v0.909c15.571,4.275 27.05,18.547 27.05,35.457z"/>
                        <path d="m78.239,88.253c-0.84-0.915-2.068-1.376-3.31-1.376h-9.266c-1.242,0-2.47,0.46-3.31,1.376-1.3,1.417-1.489,3.464-0.566,5.063l4.953,7.467-2.319,19.56 4.566,12.147c0.445,1.221 2.173,1.221 2.618,0l4.566-12.147-2.319-19.56 4.953-7.467c0.923-1.599 0.734-3.646-0.566-5.063z"/>
                        <path d="m234.66,88.253c-0.84-0.915-2.068-1.376-3.31-1.376h-9.266c-1.242,0-2.47,0.46-3.31,1.376-1.3,1.417-1.489,3.464-0.566,5.063l4.953,7.467-2.319,19.56 4.566,12.147c0.445,1.221 2.173,1.221 2.618,0l4.566-12.147-2.319-19.56 4.953-7.467c0.923-1.599 0.735-3.646-0.566-5.063z"/>
                      </g>
                    </svg>
                  </div>
                  <p class="text-xs mt-1 mb-0 font-weight-bold">Organizations</p>
                </div>
                <h4 class="font-weight-bolder">{{$organizationsCount}}</h4>
                <div class="progress w-75">
                  <div class="progress-bar bg-dark w-90" role="progressbar" aria-valuenow="{{$organizationsCount}}" aria-valuemin="0" aria-valuemax="10" style="width: {{ $organizationsCount }}%;"></div>
                </div>
              </div>
              <div class="col-3 py-3 ps-0">
                <div class="d-flex mb-2">
                  <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-warning text-center me-2 d-flex align-items-center justify-content-center">
                    <svg width="10px" height="10px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>credit-card</title>
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(453.000000, 454.000000)">
                              <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                              <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </div>
                  <p class="text-xs mt-1 mb-0 font-weight-bold">Teams</p>
                </div>
                <h4 class="font-weight-bolder">{{$teamsCount}}</h4>
                <div class="progress w-75">
                  <div class="progress-bar bg-dark w-30" role="progressbar" aria-valuenow="{{$teamsCount}}" aria-valuemin="0" aria-valuemax="10" style="width: {{ $projectsCount }}%;"></div>
                </div>
              </div>
              
              <div class="col-3 py-3 ps-0">
                <div class="d-flex mb-2">
                  <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-danger text-center me-2 d-flex align-items-center justify-content-center">
                    <svg width="10px" height="10px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>settings</title>
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(304.000000, 151.000000)">
                              <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                              <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                              <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </div>
                  <p class="text-xs mt-1 mb-0 font-weight-bold">Projects</p>
                </div>
                <h4 class="font-weight-bolder">{{$projectsCount}}</h4>
                <div class="progress w-75">
                  <div class="progress-bar bg-dark w-50" role="progressbar" aria-valuenow="{{$projectsCount}}" aria-valuemin="0" aria-valuemax="10" style="width: {{ $projectsCount }}%;"></div>
                </div>
              </div>
             <di class="col-3 py-3 ps-0">
                <div class="d-flex mb-2">
                  <div class="icon icon-shape icon-xxs shadow border-radius-sm bg-gradient-primary text-center me-2 d-flex align-items-center justify-content-center">
                    <svg width="10px" height="10px" viewBox="0 0 40 44" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>document</title>
                      <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-1870.000000, -591.000000)" fill="#FFFFFF" fill-rule="nonzero">
                          <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(154.000000, 300.000000)">
                              <path class="color-background" d="M40,40 L36.3636364,40 L36.3636364,3.63636364 L5.45454545,3.63636364 L5.45454545,0 L38.1818182,0 C39.1854545,0 40,0.814545455 40,1.81818182 L40,40 Z" opacity="0.603585379"></path>
                              <path class="color-background" d="M30.9090909,7.27272727 L1.81818182,7.27272727 C0.814545455,7.27272727 0,8.08727273 0,9.09090909 L0,41.8181818 C0,42.8218182 0.814545455,43.6363636 1.81818182,43.6363636 L30.9090909,43.6363636 C31.9127273,43.6363636 32.7272727,42.8218182 32.7272727,41.8181818 L32.7272727,9.09090909 C32.7272727,8.08727273 31.9127273,7.27272727 30.9090909,7.27272727 Z M18.1818182,34.5454545 L7.27272727,34.5454545 L7.27272727,30.9090909 L18.1818182,30.9090909 L18.1818182,34.5454545 Z M25.4545455,27.2727273 L7.27272727,27.2727273 L7.27272727,23.6363636 L25.4545455,23.6363636 L25.4545455,27.2727273 Z M25.4545455,20 L7.27272727,20 L7.27272727,16.3636364 L25.4545455,16.3636364 L25.4545455,20 Z"></path>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                  </div>
                  <p class="text-xs mt-1 mb-0 font-weight-bold">Tasks</p>
                </div>
                 <h4 class="font-weight-bolder">{{$tasksCount}}</h4>
                <div class="progress w-75">
                  <div class="progress-bar bg-dark w-60" role="progressbar" aria-valuenow="{{$tasksCount}}" aria-valuemin="0" aria-valuemax="10" style="width: {{ $tasksCount }}%;"></div>
                </div> 
            </di>
          </div>
        </div>
      </div>
    </div>
  
  </div>
  <div class="row my-4">
    <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Projects</h6>
              <p class="text-sm mb-0">
                <i class="fa fa-check text-info" aria-hidden="true"></i>
                <span class="font-weight-bold ms-1">{{ $projectCompleteCount }} done</span> this month
              </p>
            </div>
            <div class="col-lg-6 col-5 my-auto text-end">
              <div class="dropdown float-lg-end pe-4">
                <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-ellipsis-v text-secondary"></i>
                </a>
                <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                  <li><a class="dropdown-item border-radius-md" href="">Action</a></li>
                  <li><a class="dropdown-item border-radius-md" href="">Another action</a></li>
                  <li><a class="dropdown-item border-radius-md" href="">Something else here</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Projects</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Members</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Start Date</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                </tr>
              </thead>
              <tbody >
                  @foreach($projects as $project)
                  <tr>
                      <td>
                          <p class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ $project->name }}</p>
                      </td>
                      <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                        <div class="card" style="height: {{ count(json_decode($project->members, true)) * 50 }}px;">                          
                          @foreach(json_decode($project->members) as $member)
                              @if(is_object($member) && isset($member->name))
                                <p class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                    {{ $member->name }}
                                </p>
                              @endif
                          @endforeach
                        </div>
                      </td>
                      <td class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{ $project->start_date }}</td>
                      <td class="text-center">
                          @if($project->status === 'not started')
                          <span class="badge badge-sm bg-gradient-warning">Not Started</span>
                          @elseif($project->status === 'in progress')
                          <span class="badge badge-sm bg-gradient-info">In Progress</span>
                          @elseif($project->status === 'completed')
                          <span class="badge badge-sm bg-gradient-success">Completed</span>
                          @else
                          <span class="badge badge-sm bg-gradient-danger">Cancelled</span>
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
  </div>

  <style>
    .status-card-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 20px 0;

    @media (max-width: 992px) {
     .status-card{
      width: 170px !important;
      p{
      font-size: 18px;
   
    }
    h4{
        font-size: 22px;
    }
  }

    }
    @media screen and (max-width: 800px) {
      .status-card{
      width: 153px !important;
      p{
      font-size: 16px;
    }
    h4{
        font-size: 19px;
    }
  }
  }
  @media screen and (max-width: 740px) {
    /* flex-wrap: wrap;   */
   
    display: flex;
    flex-wrap: wrap;

  
  .status-card {
    width: calc(50% - 10px) !important;
    margin: 5px;
  }
  .status-card p {
    font-size: 20px;
    font-weight: 500;
  }   
 
  }
  @media screen and (max-width: 450px) {
    flex-direction: column;
    .status-card {
    width: 90% !important;
  }
  .status-card p {
    font-size: 18px;
    font-weight: 500;
  }
  .status-card h4 {
    font-size: 22px;
    font-weight: 700;
  }
  }
}

    .status-card {
    width: 200px;
    padding: 10px;
    height: 150px;
    background-color: #ffffff;
    border-radius: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #000;
    font-size: 24px;
    font-weight: bold;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    p{
      font-size: 20px;
    font-weight: 500;
        /* color: #000; */
    }
    h4{
        font-size: 24px;
        font-weight: 700;
        /* color: #000;      */
        padding:3px;
    }
    .completed{
      color:  #98ec2d
    }
    .in-progress{
      color: #21d4fd;
    }
    .cancelled{
      color: #ea0606;
    }
    .not-started{
      color: #fbcf33;
  }
}
</style>
@endsection
@push('dashboard')
  <script>
    window.onload = function() {
      var ctx = document.getElementById("chart-bars").getContext("2d");

      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
            label: "Sales",
            tension: 0.4,
            borderWidth: 0,
            borderRadius: 4,
            borderSkipped: false,
            backgroundColor: "#fff",
            data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
            maxBarThickness: 6
          }, ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
              },
              ticks: {
                suggestedMin: 0,
                suggestedMax: 500,
                beginAtZero: true,
                padding: 15,
                font: {
                  size: 14,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
                color: "#fff"
              },
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false
              },
              ticks: {
                display: false
              },
            },
          },
        },
      });


      var ctx2 = document.getElementById("chart-line").getContext("2d");

      var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
      gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

      var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

      gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
      gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
      gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

      new Chart(ctx2, {
        type: "line",
        data: {
          labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
          datasets: [{
              label: "Mobile apps",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#1d2c4a",
              borderWidth: 3,
              backgroundColor: gradientStroke1,
              fill: true,
              data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
              maxBarThickness: 6

            },
            {
              label: "Websites",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 0,
              borderColor: "#3A416F",
              borderWidth: 3,
              backgroundColor: gradientStroke2,
              fill: true,
              data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
              maxBarThickness: 6
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false,
            }
          },
          interaction: {
            intersect: false,
            mode: 'index',
          },
          scales: {
            y: {
              grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                padding: 10,
                color: '#b2b9bf',
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
            x: {
              grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
              },
              ticks: {
                display: true,
                color: '#b2b9bf',
                padding: 20,
                font: {
                  size: 11,
                  family: "Open Sans",
                  style: 'normal',
                  lineHeight: 2
                },
              }
            },
          },
        },
      });
    }
  </script>
@endpush

