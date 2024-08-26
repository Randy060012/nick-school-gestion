@extends("layouts.master")
@section("content")
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="border-bottom pb-2 mb-4">Create new student</h3>
    <div class="mt-4">
        @if(session()->has("success"))
        <div class="alert alert-success">
            <h3>{{ session()->get('success') }}</h3>
        </div>
        <script>
            setTimeout(function() {
                var errorAlert = document.querySelector('.alert-success');
                errorAlert.style.opacity = '5';
                errorAlert.style.height = '5';
                errorAlert.style.padding = '5';
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 3000); // Disparaît après 3 secondes (3000 millisecondes)
            }, 3000);
        </script>
        @endif
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <script>
            setTimeout(function() {
                var errorAlert = document.querySelector('.alert-danger');
                errorAlert.style.opacity = '5';
                errorAlert.style.height = '5';
                errorAlert.style.padding = '5';
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 3000); // Disparaît après 3 secondes (3000 millisecondes)
            }, 3000);
        </script>
        @endif
        @if(session()->has("error"))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        <script>
            setTimeout(function() {
                var errorAlert = document.querySelector('.alert-danger');
                errorAlert.style.opacity = '5';
                errorAlert.style.height = '5';
                errorAlert.style.padding = '5';
                setTimeout(function() {
                    errorAlert.style.display = 'none';
                }, 3000); // Disparaît après 3 secondes (3000 millisecondes)
            }, 3000);
        </script>
        @endif

        <form style="width: 100%" method="post" action="{{ route('Student.ajouter') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name of student </label>
                        <input type="text" class="form-control" name="name" required pattern="[A-Z\s]+" title="The name must be in uppercase and can contain spaces only">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Last-name of student </label>
                        <input type="text" class="form-control" name="prenom" pattern="^[A-Z][a-zA-Z\s]*$" title="The first name must start with a capital letter and may contain spaces">
                    </div>
                </div>
            </div> 

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Classe</label>
                <select class="form-control" name="classe_id">
                    <option value=""></option>
                    @foreach($classes as $classe)
                    <option value="{{ $classe->id }}">{{ $classe->libelle }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('Student') }}" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </form>
    </div>
</div>
@endsection
