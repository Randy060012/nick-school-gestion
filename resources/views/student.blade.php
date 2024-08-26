@extends("layouts.master")

@section("content")

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="border-bottom pb-2 mb-4">List of registered students</h3>
    <div class="mt-4">
        <!-- <div class="d-flex justify-content-between mb-2 ">
            {{ $students->links() }}
            <div><a href="{{route('Student.create')}}" class="btn btn-primary">Create new student</a></div>
        </div> -->
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
                    <th scope="col">First-Name</th>
                    <th scope="col">Last-Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <th scope="row">{{ $loop->index +1 }}</th>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->prenom }}</td>
                    <td class="d-grid gap-2 d-md-flex justify-content-center">
                        <button type="button" value="{{$student->id}}" class="btn btn-warning editbtn">
                            Edit
                        </button>
                        <a href="#" class="btn btn-danger" onclick="if(confirm('Voulez-vous vraiment supprimer cet etudiant ?')){document.getElementById('form-{{$student->id}}').submit()}">Delete</a>
                        <form id="form-{{$student->id}}" action="{{route('Student.delete',['student'=>$student->id])}}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Ajout de la classe 'modal-lg' pour agrandir le modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ url('student-update', $student->id) }}">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="stud_id" id="stud_id" />
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Name of student</label>
                                <input type="text" class="form-control" name="name" id="edit_name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Last name of student</label>
                                <input type="text" class="form-control" name="prenom" id="edit_prenom">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Classe</label>
                        <select class="form-control" name="classe_id" id="edit_classe">
                            <option value=""></option>
                            @foreach($classes as $classe)
                            @if($classe->id == $student->classe_id)
                            <option value="{{ $classe->id }}" selected>{{ $classe->libelle }}</option>
                            @else
                            <option value="{{ $classe->id }}">{{ $classe->libelle }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $(document).on('click', '.editbtn', function() {
            var stud_id = $(this).val();
            $('#editModal').modal('show');
            // Appel de la fonction fetchstudent avec l'ID de l'étudiant
            fetchstudent(stud_id);
            function fetchstudent(studentId) {
                $.ajax({
                    type: "GET",
                    url: "/student-edit/" + studentId,
                    success: function(response) {
                        // Vérifiez si le statut de la réponse est 200 (OK)
                        if (response.status === 200) {
                            var student = response.student;
                            $('#edit_name').val(student.name);
                            $('#edit_prenom').val(student.prenom);
                            $('#edit_classe').val(student.classe_id);
                            $('#stud_id').val(student.id);
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>

@endsection
