@csrf

<label for="">Name</label>
<input class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}">

<label for="">Email</label>
<input class="form-control" type="email" name="email" value="{{ old('email', $user->email) }}">

<label for="">Password</label>
<input class="form-control" type="password" name="password" value="">

<label for="">Password Confirmation</label>
<input class="form-control" type="password" name="password_confirmation" value="">

<button class="btn btn-success mt-3" type="submit">Send</button>
