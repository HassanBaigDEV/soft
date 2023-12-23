
@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tasks</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="d-flex justify-content-end mb-3">
                            {{-- <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="btn btn-success">
                                <i class="fa fa-plus"></i> New Task
                            </a> --}}
                            <a href="#" class="btn btn-success">
                                <i class="fa fa-plus"></i> New Task
                            </a>
                            
                            
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Task</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Assigned To</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                    <tr>
                                        <td class="text-center">
                                            @if($task->status === 'not started')
                                            <span class="badge badge-sm bg-gradient-warning">Not Started</span>
                                            @elseif($task->status === 'in progress')
                                            <span class="badge badge-sm bg-gradient-info">In Progress</span>
                                            @elseif($task->status === 'completed')
                                            <span class="badge badge-sm bg-gradient-success">Completed</span>
                                            @else
                                            <span class="badge badge-sm bg-gradient-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $task->name }}</p>
                                        </td>
                                        <td class="text-xs font-weight-bold mb-0">{{ $task->description }}</td>
                                        <td class="text-center">{{ $task->due_date }}</td>
                                        <td class="text-center">{{ $task->assigned_to }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit task">
                                                Edit
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Delete task">
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
