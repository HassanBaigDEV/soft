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
                                                <a href="" class="text-xs font-weight-bold mb-0">{{ $organization->name }}</a>                                             </td>
                                            <td class="text-center member-count" data-bs-toggle="modal" data-bs-target="#membersModal" data-organization-id="{{ $organization->id }}">
                                                {{ count(json_decode($organization->members, true)) }}
                                            </td>
                                            <td class="text-center">
                                                <span class="d-none" id="organization-invite-code-{{ $organization->id }}">{{ $organization->invite_code }}</span>
                                                <i class="fas fa-copy copy-icon" data-organization-id="{{ $organization->id }}" style="cursor: pointer;"></i>
                                            </td>
                                            <td class="text-center">
                                                @if(auth()->user()->id === $organization->owner_id)
                                                <div class="dropdown">
                                                    <a href="#" class="btn btn-link text-secondary mb-0" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                                                        <i class="fa fa-ellipsis-v text-xs" aria-hidden="true"></i>
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                                        <li>
                                                            <a href="{{route('organizations.edit', ['organization' => $organization->id ])}}" class="dropdown-item text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit project">
                                                                Edit
                                                            </a>
                                                        </li>
                                                      
                                                        <li>
                                                            <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-secondary font-weight-bold text-xs border-none background-none" data-toggle="tooltip" data-original-title="Delete project">
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
                        @if(count($organizations)!=0)
                        <div class="modal fade" id="membersModal" tabindex="-1" role="dialog" aria-labelledby="membersModalTitle" aria-hidden="true">
                            <!-- Members Modal Content -->
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                            
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="membersModalTitle">Organization Members</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Display members in a table/list -->
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>                                                   
                                                    <th>Action</th>                                               
                                                </tr>
                                            </thead>
                                            <tbody id="membersList">

                                                <!-- Members will be dynamically added here -->
                                                {{-- json_decode($organization->members, true --}}
                                                @foreach(json_decode($organization->members, true) as $member)
                                                    <tr>
                                                        <td>{{ $member['name'] }}</td>
                                                        {{-- find email based on id from User table --}}
                                                        
                                                        <td>{{ \App\Models\User::find($member['id'])->email }}</td>

                                                           

                                                        {{-- <td>{{ $member['email'] }}</td> --}}
                                                        @if(auth()->user()->id === $organization->owner_id)
                                                            <td>
                                                                <form action="{{ route('organizations.remove-member', ['organizationId' => $organization->id, 'memberId' => $member['id']]) }}" method="POST">
                                                                    {{-- {{ route('organizations.remove-member', ['organization' => $organization->id, 'member' => $member['id']]) }} --}}
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    
                                                                    <button type="submit" class="btn">
                                                                        <i class="cursor-pointer fas fa-trash text-secondary" aria-hidden="true"></i>                                                                    </button>                                                                </form>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if(auth()->user()->id === $organization->owner_id)
                                            <!-- Add Member Button -->
                                            <button class="btn btn-primary mx-auto d-block" data-bs-toggle="modal" data-bs-target="#addMemberModal">Add Member</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                            <!-- Add Member Modal Content -->
                            <!-- ... (your add member modal code) ... -->
                                                    <!-- Add Member Modal Content -->
                            <!-- Add Member Modal Content -->
                            <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addMemberModalTitle">Add Member</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Add member form -->
                                            {{-- {{ route('organizations.add-member', ['organization' => $organization->id]) }} --}}
                                          
                                                {{-- <div class="mb-3">
                                                    <label for="searchMember" class="form-label">Search for a User</label>
                                                    <select class="form-control" id="searchMember" name="memberId" data-live-search="true">
                                                        @foreach (\App\Models\User::all() as $user)
                                                            @if (!in_array($user->id, array_column(json_decode($organization->members, true), 'id')))
                                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>                                           
                                                </div> --}}
                                                <!-- Replace the select with an input field -->
                                                {{-- <form method="POST" action="{{ route('organizations.add-member', ['organizationId' => $organization->id]) }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="searchMember" class="form-label">Search for a User</label>
                                                        <input type="text" class="form-control" id="searchMember" placeholder="Search for a user" autocomplete="off">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Add Member</button>
                                                </form> --}}
                                                <form method="POST" action="{{ route('organizations.add-member', ['organizationId' => $organization->id]) }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="searchMember" class="form-label">Search for a User</label>
                                                        <input type="text" class="form-control" id="searchMember" name="searchMember" placeholder="Search for a user" autocomplete="off">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Add Member</button>
                                                </form>

                                               
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



{{-- @section('styles') --}}
    <!-- Add your additional styles here if needed -->
{{-- @endsection --}}
    <style>
        .member-count{
            cursor: pointer;
        }
        .copy-icon {
            color: #007bff;
        }

        .copy-icon:hover {
            text-decoration: underline;
        }
        .footer{
            margin-left: 17.125rem;

            @media screen and (max-width:1199.98px){
                margin-left: 0 !important;
            }
        }

    </style>



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Include Bootstrap Select CSS and JS files -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<!-- Include Bootstrap Typeahead CSS and JS files -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>

<!-- Your custom scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Bootstrap Select
        $('#searchMember').selectpicker();

        // Initialize Bootstrap Typeahead for suggestions
        $('#searchMember').typeahead({
            source: function (query, process) {
                // Fetch user suggestions using fetch
                fetch(`/users/search?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        // Process and return suggestions
                        process(data);
                        console.log(data);
                        
                    })
                    .catch(error => {
                        console.error('Error fetching user suggestions:', error);
                    });
            }
        });
    });
</script>
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
