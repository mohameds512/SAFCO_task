<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User - {{ $user->name }}</h5>

            </div>
            <div class="modal-body">
                <!-- Include your edit form here -->
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="roles" class="col-md-4 col-form-label text-md-end">{{ __('Roles') }}</label>

                        <div class="col-md-6">
                            <select id="roles" name="roles[]" class="form-control @error('roles') is-invalid @enderror" multiple>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('roles')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary p-2">Update User</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
