@extends('layouts.app')


@section('content')

<div class="d-flex justify-content-end mb-2">

    <a href="{{route('tags.create')}}" class="btn btn-success">Add Tags</a>
</div>

<div class="card card-default">
    <div class="card-header">Tags</div>
    <div class="card-body">


        <table class="table">
            <thead>
                <th>Name</th>
                <th>Posts Count</th>

            </thead>
            <tbody>
                <tr>

                    @if($tag)

                    @foreach($tag as $tags)
                    <td>
                        {{$tags->name}}
                    </td>
                    <td>
                        {{$tags->posts->count()}}
                    </td>
                    <td>
                        <a href="{{route('tags.edit',$tags->id)}}" class="btn btn-info btn-sm">Edit</a>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm"
                            onclick="handleDelete({{$tags->id}})">Delete</button>
                    </td>


                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="POST" id="DeleteTagForm">
            @csrf
            @method('Delete')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p class="text-center text-bold">
                        Are you want to delete?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No GO back</button>
                    <button type="submit" class="btn btn-primary">Yes Delete<button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>


</div>
</div>



@endsection

@section('scripts')

<script>
function handleDelete(id) {


    console.log('deleting', id)
    var form = document.getElementById('DeleteTagForm')
    form.action = '/tags/' + id
    $('#deleteModal').modal('show')



}
</script>



@endsection
