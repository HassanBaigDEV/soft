@extends('layouts.user_type.auth')

@section('content')

<main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Organizations</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="d-flex justify-content-end mb-3">
                            <a href="" class="btn btn-primary" style="margin-right:10px" data-bs-toggle="modal" data-bs-target="#newOrganizationModal">
                                <i class="fa fa-plus"></i> New 
                            </a>
                        </div>
                        <div class="table-responsive p-0" style="overflow-x: hidden">
                            <table class="table align-items-center mb-0" id="organizations-table">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Organization</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Members</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Invite Code</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($organizations as $organization)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $organization->name }}</p>
                                            </td>
                                            <td class="text-center">
                                                {{ count(json_decode($organization->members, true)) }}
                                            </td>
                                            <td class="text-center">
                                                <span class="d-none" id="organization-invite-code-{{ $organization->id }}">{{ $organization->invite_code }}</span>
                                                <i class="fas fa-copy copy-icon" data-organization-id="{{ $organization->id }}" style="cursor: pointer;"></i>
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                                                        <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                                        <li>
                                                            <a href="" class="dropdown-item text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit project">
                                                                Edit
                                                            </a>
                                                        </li>
                                                      
                                                        <li>
                                                            <form action="" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-secondary font-weight-bold text-xs border-none background-none" data-toggle="tooltip" data-original-title="Delete project">
                                                                    Delete
                                                                </button>
                                                            </form>
                                                        </li>
                                                        
                                                    </ul>
                                                  </div>
                                                 
                                                 
                                                 
                                              </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="modal fade" id="newOrganizationModal" tabindex="-1" role="dialog" aria-labelledby="newOrganizationModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="newOrganizationModalTitle">Create or Join Organization</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <!-- Left panel for joining existing organization -->
                                                <h6>Join Existing Organization</h6>
                                                <form class="join-organization-modal-form" method="POST" action="{{route('organizations.join') }}" >
                                                    <div class="mb-3">
                                                        <label for="invite_code" class="form-label">Invitation Code:</label>
                                                        <input type="text" class="form-control" id="invite_code" placeholder="Enter invitation code" name="invite_code">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mx-auto d-block">Join</button>
                                                </form>
                                            </div>
                                            <div class="col-md-6 border-start">
                                                <!-- Right panel for creating a new organization -->
                                                <h6>Create New Organization</h6>
                                                <form class="create-organization-modal-form" method="POST" action="{{route('organizations.store') }}"> 
                                                    <!-- Add form fields for creating a new organization -->
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mx-auto d-block">Create</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



{{-- @section('styles') --}}
    <!-- Add your additional styles here if needed -->
    <style>
        .copy-icon {
            color: #007bff;
        }

        .copy-icon:hover {
            text-decoration: underline;
        }

    </style>
{{-- @endsection --}}

{{-- @section('scripts') --}}
    <!-- Add your additional scripts here if needed -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const copyIcons = document.querySelectorAll('.copy-icon');

            copyIcons.forEach(icon => {
                icon.addEventListener('click', function () {
                    const organizationId = this.getAttribute('data-organization-id');
                    const inviteCode = document.getElementById('organization-invite-code-' + organizationId).innerText;
                    console.log(inviteCode);

                    // Copy to clipboard
                    const tempInput = document.createElement('input');
                    tempInput.value = inviteCode;
                    document.body.appendChild(tempInput);
                    tempInput.select();
                    document.execCommand('copy');
                    document.body.removeChild(tempInput);

                    // Optionally, you can provide user feedback (e.g., show a tooltip, alert, etc.)
                    // https://clipboardjs.com/ to provide user feedback

                    console.log('Invite code copied to clipboard:', inviteCode);
                });
            });
        });
    </script>
@endsection
