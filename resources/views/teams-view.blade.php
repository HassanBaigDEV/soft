@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Teams</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="/teams/create" class="btn btn-primary" style="margin-right:10px">
                                <i class="fa fa-plus"></i> New Team
                            </a>
                        </div>
                        <div class="table-responsive p-0" style="overflow-x: hidden">
                            <table class="table align-items-center mb-0" id="teams-table">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Team</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Organization</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Team Head</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teams as $team)
                                    <tr>
                                        <td>
                                            <a href="" class="text-decoration-none">
                                                <p class="font-weight-bold mb-0" style="font-size: 16px;">{{ $team->name }}</p>
                                            </a>
                                        </td>
                                        <td class="text-center" style="font-size: 15px;">
                                            {{ \App\Models\Organization::find($team->organization_id)->name }}
                                        </td>
                                        <td class="text-center" style="font-size: 15px;">
                                            @php
                                                $teamHead = \App\Models\User::find($team->team_head);
                                            @endphp
                                            @if($teamHead)
                                                @if($teamHead->id == auth()->id())
                                                    You
                                                @else
                                                    {{ $teamHead->name }}
                                                @endif
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if(auth()->user()->id === $team->team_head)
                                            <div class="dropdown">
                                                <a href="#" class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                                                    <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                                    <li>
                                                        <a href="{{ route('teams.edit', $team->id) }}" class="dropdown-item text-secondary font-weight-bold text-xs border-none background-none" style="margin-right:10px">
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item text-secondary font-weight-bold text-xs border-none background-none" data-toggle="tooltip" data-original-title="Delete team">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                            @else
                                             <!-- Disable action buttons -->
                                             <button class="btn btn-link text-secondary mb-0" disabled>
                                                        <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                                </button>
                                            @endif
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
