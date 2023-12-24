@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid py-4">
    <h2>Edit Project</h2>
    <form method="post" action="{{ route('projects.update', $project->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Project Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $project->name) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="team">Select Team</label>
                    <select class="form-control" id="team" name="team_id" required>
                        <option value="">Select Team</option>
                        @if($team)                            
                            <option value="{{ $team->id }}" {{ $project->team_id == $team->id ? 'selected' : '' }}>{{ $team->name }}</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Project Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $project->description) }}</textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="members">Select Members</label>
                    <select class="form-control" id="members" name="members[]" >
                    @foreach($members as $memberId => $member)
                        @php
                            $selected = collect(json_decode($project->members, true))->contains('id', $member['id']) ? 'selected' : '';
                        @endphp
                        <option value="{{ $member['id'] }}" {{ $selected }}>
                            {{ $member['name'] }}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div> 

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Project Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="not started" {{ $project->status == 'not started' ? 'selected' : '' }}>Not Started</option>
                        <option value="in progress" {{ $project->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $project->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $project->start_date) }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $project->end_date) }}" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Project</button>
    </form>
</div>

<script>
    // Get the teams
    const teams = @json($teams) ?? [];

    // Event listener for team select change
    document.getElementById('team').addEventListener('change', function () {
        // Get the selected team ID
        const membersSelectElement = document.getElementById('members');
        membersSelectElement.innerHTML = '';

        const selectedTeamId = this.value;
        
        if (!selectedTeamId) {
            return;
        }

        const selectedTeam = teams.find(team => team.id == selectedTeamId);
        const teamMembers = JSON.parse(selectedTeam.members);

        // Loop through the members and add the options
        teamMembers.forEach((member) => {
        const optionElement = document.createElement('option');
        optionElement.value = JSON.stringify(member); // Submit entire object
        optionElement.text = `${member.name}`;
        membersSelectElement.appendChild(optionElement);
        });

    });

    document.querySelector('form').addEventListener('submit', function () {
        // Add a hidden input field to send the selected team ID to the controller
        const selectedTeamId = document.getElementById('team').value;
        const hiddenTeamIdInput = document.createElement('input');
        hiddenTeamIdInput.type = 'hidden';
        hiddenTeamIdInput.name = 'team_id';
        hiddenTeamIdInput.value = selectedTeamId;
        this.appendChild(hiddenTeamIdInput);

        // Add a hidden input field to send the selected members to the controller
        const selectedMembers = Array.from(document.getElementById('members').selectedOptions)
            .map(option => JSON.parse(option.value));
        const hiddenMembersInput = document.createElement('input');
        hiddenMembersInput.type = 'hidden';
        hiddenMembersInput.name = 'members';
        hiddenMembersInput.value = JSON.stringify(selectedMembers);
        this.appendChild(hiddenMembersInput);
    });
</script>

@endsection
