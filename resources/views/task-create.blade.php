@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid py-4">
    <h2>Create Task</h2>
    <form method="post" action="{{ route('tasks.store', ['project' => $project->id]) }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Task Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Task Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="team">Select Members</label>
                    <select class="form-control" id="member" name="member_id[]" >
                        <option value="">Select Member</option>
                        @if($project)
                                @php
                                    $members = json_decode($project->members, true);
                                @endphp
                                @if($members)
                                    @foreach($members as $member)
                                        <option value="{{ $member }}">{{ $member }}</option>
                                    @endforeach
                                @endif
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Task Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="not started">Not Started</option>
                        <option value="in progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Assign Task</button>
    </form>
</div>
@endsection
