@extends('layouts.user_type.auth')

@section('content')

<div class="container-fluid py-4">
    <h2>Edit Organization</h2>
    <form method="post" action="{{ route('organizations.update', $organization->id) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Organization Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $organization->name) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="owner">Organization Owner</label>
                    <input type="text" class="form-control" id="owner" name="owner" value="{{ $organization->owner->name }}" readonly>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="members">Edit Members</label>
                    <select class="form-control" id="members" name="members[]" multiple>
                        @foreach (\App\Models\User::all() as $user)
                             @if ($user->id !== $organization->owner->id)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                             @endif 
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="invite_code">Invite Code</label>
                    <input type="text" class="form-control" id="invite_code" name="invite_code"readonly  value="{{ old('invite_code', $organization->invite_code) }}" required>
                </div>
            </div>
        </div> 

        <button type="submit" class="btn btn-primary">Update Organization</button>
    </form>
</div>

<style>
    /* Add your additional styles here if needed */
</style>

<script>
    // Add your additional scripts here if needed
</script>

@endsection
