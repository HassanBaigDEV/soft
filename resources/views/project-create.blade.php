{{-- @extends('layouts.user_type.auth')

@section('content')

<form>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <input type="text" placeholder="Regular" class="form-control" disabled />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <div class="input-group mb-4">
            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
            <input class="form-control" placeholder="Search" type="text">
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <div class="input-group mb-4">
            <input class="form-control" placeholder="Birthday" type="text">
            <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group has-success">
          <input type="text" placeholder="Success" class="form-control is-valid" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group has-danger">
          <input type="email" placeholder="Error Input" class="form-control is-invalid" />
        </div>
      </div>
    </div>
  </form>
  <div class="form-group">
    <label for="exampleFormControlInput1">Email address</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Example select</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1" checked="">
    <label class="custom-control-label" for="customCheck1">Check this custom checkbox</label>
  </div>
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" checked="">
    <label class="form-check-label" for="flexSwitchCheckDefault">Checked switch</label>
  </div>
@endsection --}}

@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid py-4">
    <h2>Create Project</h2>
    <form method="post" action="">
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
<!-- Include the following JavaScript code at the end of your Blade file -->
<script>
    // Get the teams
    const teams = @json($teams);

    // Event listener for team select change
    document.getElementById('team').addEventListener('change', function () {
        // Get the selected team ID
        const selectedTeamId = this.value;

        //get the members of the selected team
        const selectedTeam = teams.find(team => team.id == selectedTeamId);
        const teamMembers = JSON.parse(selectedTeam.members); 
        console.log(teamMembers)

        const membersSelectElement = document.getElementById('members');
        membersSelectElement.innerHTML = '';

   
        // Loop through the members and add the options
        Object.entries(teamMembers).forEach(([key, value]) => {
            console.log(key, value);
    const optionElement = document.createElement('option');
    optionElement.value = value; // Use the value property of the object property
    if(key=='name'){
        optionElement.text = `${value}`; // Display key and value in the option text
    }    
    // optionElement.text = `${key}: ${value}`; // Display key and value in the option text
    membersSelectElement.appendChild(optionElement);    
    });
            
    });
</script>


@endsection

