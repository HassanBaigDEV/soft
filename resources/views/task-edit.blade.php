@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid py-4">
    <h2>Edit Task</h2>
    <form method="post" action="{{ route('tasks.update', $task->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Task Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $task->name) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="team">Assigned to</label>
                    <select class="form-control" id="assigned_to" name="assigned_to" required>
                        <option value="">Select Member</option>
                        {{--@foreach($members as $member)
                            @php
                                $selected = collect($task->members)->contains('id', $member['id']) ? 'selected' : '';
                            @endphp
                            <option value="{{ $member['id'] }}" {{ $selected }}>{{ $member['name'] }}</option>
                        @endforeach--}}
                    </select>
                </div>
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Task Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $task->description) }}</textarea>
                </div>
            </div>
           
    
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Task Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="not started" {{ $task->status == 'not started' ? 'selected' : '' }}>Not Started</option>
                        <option value="in progress" {{ $task->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $task->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date) }}" required>
                </div>
            </div>
        </div>

      
        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</div>
@endsection
