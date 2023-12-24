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
                                                <!-- Add your organization actions here if needed -->
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
