

  @extends('layouts.user_type.auth')

  @section('content')
  
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
      <div class="container-fluid py-4">
          <div class="row">
              <div class="col-12">
                  <div class="card mb-4">
                      <div class="card-header pb-0">
                          <h6>Projects</h6>
                      </div>
                      <div class="card-body px-0 pt-0 pb-2">
                          <div class="table-responsive p-0">
                              <table class="table align-items-center mb-0">
                                  <thead>
                                      <tr>
                                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Project</th>
                                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Role</th>
                                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Start Date</th>
                                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">End Date</th>
                                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($projects as $project)
                                      <tr>
                                          <td>
                                              <p class="text-xs font-weight-bold mb-0">{{ $project->name }}</p>
                                              <p class="text-xs text-secondary mb-0">{{ $project->description }}</p>
                                            </td>
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
                                          <td class="text-xs font-weight-bold mb-0">{{ $project->role }}</td>
                                          <td class="text-center">{{ $project->start_date }}</td>
                                          <td class="text-center">{{ $project->end_date }}</td>
                                          <td class="text-center">
                                              <a href="{{ route('projects.edit', $project->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit project">
                                                  Edit
                                              </a>
                                              <a href="{{ route('tasks.index', ['project' => $project->id]) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="View tasks">
                                                  View Tasks
                                              </a>
                                              <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" class="btn btn-link text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete project">
                                                      Delete
                                                  </button>
                                              </form>
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
      </div>
  </main>
  
  @endsection
  