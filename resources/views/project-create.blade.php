@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid py-4">
    <h2>Create Project</h2>
    <form method="post" action="{{ route('projects.store') }}">
        
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Project Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="team">Select Team</label>
                    <select class="form-control" id="team" name="team_id" required>
                        <option value="">Select Team</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Project Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="members">Select Members</label>
                    <select class="form-control" id="members" name="members[]" multiple required>
                        <!-- Display members of the selected team -->
                        <!-- You can use JavaScript to dynamically update the options based on the selected team -->
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Project Status</label>
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

        <button type="submit" class="btn btn-primary">Create Project</button>
    </form>
</div>
<script>
const teams = @json($teams);

document.getElementById('team').addEventListener('change', function () {
    
    const membersSelectElement = document.getElementById('members');
    membersSelectElement.innerHTML = '';

    const selectedTeamId = this.value;
    
    if (!selectedTeamId) {
        return;
    }

    const selectedTeam = teams.find(team => team.id == selectedTeamId);
    const teamMembers = JSON.parse(selectedTeam.members);

    Object.entries(teamMembers).forEach((member) => {
        [key, value] = member;

        const optionElement = document.createElement('option');
        optionElement.value = JSON.stringify(value); // Submit entire object
        optionElement.text = `${value.name}`;
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