@extends("layouts.master")

@section("content")

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h3 class="border-bottom pb-2 mb-4">Update student</h3>
    <div class="mt-4">
        @if(session()->has("success"))
        <div class="alert alert-success">
            <h3> {{session()->get('success')}}</h3>
        </div>
        @endif
        <form style="width:65%" method="post" aaction="{{route('Student.update', ['student'=>$student->id])}}">
            @csrf
            <input type="hidden" name="_method" value="put">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name of student</label>
                <input type="text" class="form-control" name="name" value="{{$student->name}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Last name of student</label>
                <input type="text" class="form-control" name="prenom" value="{{$student->prenom}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Classe</label>
                <select class="form-control" name="classe_id">
                    <option value=""></option>
                    @foreach($classes as $classe)
                    @if($classe->id ==$student->classe_id)
                    <option value="{{$classe->id}}" selected>{{$classe->libelle}}</option>
                    @else
                    <option value="{{$classe->id}}">{{$classe->libelle}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('Student')}}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>
@endsection
