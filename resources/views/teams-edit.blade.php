@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid py-4">
    <h2>Edit Team</h2>
    <form method="post" action="{{ route('teams.store') }}">
        
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Team Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $team->name) }}" required >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="organization_id">Select Organization</label>
                    <input type="text" class="form-control" id="organization" name="organization" value="{{ $organization->name }}" readonly required >               
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="members">Select Members</label>
                    <select class="form-control" id="members" name="members[]" multiple required>
                        @foreach($members as $member)
                            <option value="{{ $member['id'] }}">{{ $member['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="team_head">Select Team Head</label>
                    <select class="form-control" id="team_head" name="team_head" required>
                        @foreach($members as $member)
                            <option value="{{ $member['id'] }}">{{ $member['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        @foreach($members as $member)
            <input type="hidden" name="selected_members[]" value="{{ $member['id'] }}">
        @endforeach

        <button type="submit" class="btn btn-primary">Create Team</button>
    </form>
</div>
@endsection
