@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid py-4">
    <h2>Create Team</h2>
    <form method="post" action="{{ route('teams.store') }}">
        
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Team Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="organization">Select Organization</label>
                    <select class="form-control" id="organization" name="organization_id" required>
                        <option value="">Select Organization</option>
                        @foreach($organizations as $organization)
                            <option value="{{ $organization->id }}">{{ $organization->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="members">Select Members</label>
                    <select class="form-control" id="members" name="members[]" multiple required>
                        <!-- @foreach($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach -->
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="team_head">Select Team Head</label>
                    <select class="form-control" id="team_head" name="team_head" required>
                        <!-- @foreach($members as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach -->
                    </select>
                </div>
            </div>
        </div>

        @foreach($members as $member)
            <input type="hidden" name="selected_members[]" value="{{ $member->id }}">
        @endforeach

        <button type="submit" class="btn btn-primary">Create Team</button>
    </form>
</div>


<script>
const organizations = @json($organizations);

document.getElementById('organization').addEventListener('change', function () {
    
    const membersSelectElement = document.getElementById('members');
    const teamHeadElement = document.getElementById('team_head');
    membersSelectElement.innerHTML = '';

    const selectedOrgId = this.value;
    
    if (!selectedOrgId) {
        return;
    }

    const selectedOrg = organizations.find(organization => organization.id == selectedOrgId);
    const orgMembers = JSON.parse(selectedOrg.members);

    Object.entries(orgMembers).forEach((member) => {
        [key, value] = member;

        const optionElement = document.createElement('option');
        optionElement.value = JSON.stringify(value); // Submit entire object
        optionElement.text = `${value.name}`;
        membersSelectElement.appendChild(optionElement);
        const optionElementTeam = document.createElement('option');
        optionElementTeam.value = `${value.id}`; // Submit entire object
        optionElementTeam.text = `${value.name}`;
        teamHeadElement.appendChild(optionElementTeam); 
    });
    

});

document.querySelector('form').addEventListener('submit', function () {
    // Add a hidden input field to send the selected team ID to the controller
    const selectedOrgId = document.getElementById('organization').value;
    const hiddenOrgIdInput = document.createElement('input');
    hiddenOrgIdInput.type = 'hidden';
    hiddenOrgIdInput.name = 'organization_id';
    hiddenOrgIdInput.value = selectedOrgId;
    this.appendChild(hiddenOrgIdInput);

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
