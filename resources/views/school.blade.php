@extends("layouts.master")

@section("content")

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="border-bottom pb-2 mb-4">List of registration</h3>
    <div class="mt-4">
        <div class="d-flex justify-content-between mb-2 ">
            <div><a href="{{route('inscription')}}" class="btn btn-primary">New Registration</a></div>
        </div>
        @if(session()->has("successDelete"))
        <div class="alert alert-success">
            <h3> {{session()->get('successDelete')}}</h3>
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
        @if(session()->has("success"))
        <div class="alert alert-success">
            <h3> {{session()->get('success')}}</h3>
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
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="">
                    <th scope="col">#</th>
                    <th scope="col">Matricule</th>
                    <th scope="col">First-Name</th>
                    <th scope="col">Last-Name</th>
                    <th scope="col">Class</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $data)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <th>{{ $data->eleve ? $data->eleve->matricule : 'N/A' }}</th>
                    <td>{{ $data->eleve ? $data->eleve->name : 'N/A' }}</td>
                    <td>{{ $data->eleve ? $data->eleve->prenom : 'N/A' }}</td>
                    <td>{{ $data->classe ? $data->classe->libelle : 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>


@endsection
