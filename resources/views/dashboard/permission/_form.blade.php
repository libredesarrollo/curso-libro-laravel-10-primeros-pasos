@csrf

<label for="">Name</label>
<input class="form-control" type="text" name="name" value="{{ old('name', $permission->name) }}">

<button class="btn btn-success mt-3" type="submit">Send</button>
