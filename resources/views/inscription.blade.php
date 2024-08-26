@extends("layouts.master")
@section("content")
<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="border-bottom pb-2 mb-4">New Student Registration - {{ session()->get('annee_libelle') }}</h3>
    <div class="mt-4">
        <form style="width: 100%" method="post" action="{{ route('register') }}">
            @csrf
            <div class="row">
                <div class="col-md-4" hidden>
                    <div class="mb-3">
                        <label for="annee_id" class="form-label">Year-School</label>
                        <input class="form-control" name="annee_id" type="text" value="{{ Session()->get('anneeId') }}" readonly>
                    </div>
                </div>
                <div class="col-md-4" hidden>
                    <div class="mb-3">
                        <label for="uid" class="form-label">Admission Id</label>
                        <input type="text" class="form-control @error('uid') is-invalid @enderror"
                            name="uid" id="uid" readonly value="E-5586"
                            title="The name must be in uppercase and can contain spaces only" value="{{ old('uid') }}">
                        @error('uid')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name of student</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" id="name" required pattern="[A-Z\s]+"
                            title="The name must be in uppercase and can contain spaces only" value="{{ old('name') }}">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Last-name of student</label>
                        <input type="text" class="form-control @error('prenom') is-invalid @enderror"
                            name="prenom" id="prenom" required pattern="^[A-Z][a-zA-Z\s]*$"
                            title="The first name must start with a capital letter and may contain spaces" value="{{ old('prenom') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="date_naissance" class="form-label">Birthday of student</label>
                        <input type="date" class="form-control @error('date_naissance') is-invalid @enderror"
                            name="date_naissance" id="date_naissance" required value="{{ old('date_naissance') }}">

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="sexe" class="form-label">Gender</label>
                        <select class="form-control @error('sexe') is-invalid @enderror" name="sexe" id="sexe" required>
                            <option value="" disabled selected>Select gender</option>
                            <option value="M" {{ old('sexe') == 'M' ? 'selected' : '' }}>Male</option>
                            <option value="F" {{ old('sexe') == 'F' ? 'selected' : '' }}>Female</option>
                        </select>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="classe_id" class="form-label">Class Name</label>
                        <select class="form-control select" name="classe_id" id="classe" required>
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="nom_tuteur" class="form-label">Tutor's Name</label>
                        <input type="text" class="form-control @error('nom_tuteur') is-invalid @enderror"
                            name="nom_tuteur" id="nom_tuteur" required pattern="^[A-Z][a-zA-Z\s]*$"
                            title="The last name must start with a capital letter and may contain spaces" value="{{ old('nom_tuteur') }}">

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="prenom_tuteur" class="form-label">Tutor's Last Name</label>
                        <input type="text" class="form-control @error('prenom_tuteur') is-invalid @enderror"
                            name="prenom_tuteur" id="prenom_tuteur" pattern="^[A-Z][a-zA-Z\s]*$"
                            title="The last name must start with a capital letter and may contain spaces" value="{{ old('prenom_tuteur') }}">

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="adresse_tuteur" class="form-label">Tutor's Address</label>
                        <input type="text" class="form-control @error('adresse_tuteur') is-invalid @enderror"
                            name="adresse_tuteur" id="adresse_tuteur" required value="{{ old('adresse_tuteur') }}">

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="telephone_tuteur" class="form-label">Tutor's Phone Number</label>
                        <input type="text" class="form-control @error('telephone_tuteur') is-invalid @enderror"
                            name="telephone_tuteur" id="telephone_tuteur" required value="{{ old('telephone_tuteur') }}">

                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('index-register') }}" class="btn btn-success">List</a>
                <a href="{{ route('Home') }}" class="btn btn-warning">Back</a>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-danger">Erase</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        getAllClasse();
    });

    var classes = [];

    function op(datas) {
        var liste = document.querySelector('#classe');
        var data = '<option value="" disabled selected>Select a class</option>';
        for (let respons of datas) {
            data += `<option value="${respons.id}">${respons.libelle}</option>`;
        }
        liste.innerHTML = data;
    }

    function getAllClasse() {
        console.log("Fetching classes...");
        $.ajax({
            url: "{{route('get-classe-annee')}}",
            type: 'GET',
            success: function(response) {
                console.log(response); // Inspect the response
                classes = response;
                op(classes);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching classes:", status, error);
            }
        });
    }
</script>

<style>
    .toast {
        opacity: 1 !important;
    }
</style>

@if(session()->has("success"))
<script>
    toastr.success("{{ session()->get('success') }}", null, {
        closeButton: true,
        progressBar: true,
        extendedTimeOut: 2000,
        timeOut: 5000,
    });
</script>
@endif

@if(session()->has("error"))
<script>
    toastr.error("{{ session()->get('error') }}", null, {
        closeButton: true,
        progressBar: true,
        extendedTimeOut: 2000,
        timeOut: 5000,
    });
</script>
@endif

@if($errors->any())
<script>
    toastr.error("{{ $errors->first() }}", null, {
        closeButton: true,
        progressBar: true,
        extendedTimeOut: 2000,
        timeOut: 5000,
    });
</script>
@endif

@endsection
