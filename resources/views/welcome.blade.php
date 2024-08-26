@extends("layouts.master")

@section("content")

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="border-bottom pb-2 mb-4">welcome to our app</h3>
    <h2 class="border-bottom pb-2 mb-4">{{Session()->get('annee_libelle')}}</h2>
    <td class="d-grid gap-2 d-md-flex justify-content-center">
        <a href="#" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#annee-modal">
            <i class="fas fa-plus"></i>
        </a>
    </td>
</div>

<!-- Modal -->
<div class="modal fade" id="annee-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Ajout de la classe 'modal-lg' pour agrandir le modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Year-School</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('ajout-annee')}}">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Begin</label>
                                <input type="text" class="form-control" name="debut" id="" required>
                            </div>
                            <br>
                            @error('debut')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">End</label>
                                <input type="text" class="form-control" name="fin" id="" required>
                            </div>
                            <br>
                            @error('fin')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
