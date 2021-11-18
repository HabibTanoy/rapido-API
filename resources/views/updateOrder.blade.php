@extends('master')
@section('content')
    <h3 class="text-center my-4">Update Delivery Information</h3>
    <div class="d-flex justify-content-center" style="margin: 0 auto;">
        <form action="{{route('order-update', $order_update->id)}}" class="w-75" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="text1" class="col-3 col-form-label">Name</label>
                <div class="col-9">
                    <input id="text1" name="name" type="text" class="form-control" value="{{$order_update->name}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="text2" class="col-3 col-form-label">Phone Number</label>
                <div class="col-9">
                    <input id="text2" name="phone" type="text" class="form-control" value="{{$order_update->phone}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="text5" class="col-3 col-form-label">Address</label>
                <div class="col-9">
                    <input id="text5" name="address" type="text" class="form-control" value="{{$order_update->address}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="text3" class="col-3 col-form-label">Comment</label>
                <div class="col-9">
                    <input id="text3" name="comment" type="text" class="form-control" value="{{$order_update->comment}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="text3" class="col-3 col-form-label">Status</label>
                <div class="col-9">
                    <select class="form-select" name="update_status" aria-label="Default select example" value="{{$order_update->status}}">
                        <option selected>Select Status</option>
                        <option value="assigned">Assigned</option>
                        <option value="delivered">Delivered</option>
                        <option value="returned">Returned</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="text3" class="col-3 col-form-label">Agents</label>
                <div class="col-9">
                    <select class="form-select" name="agent_id" aria-label="Default select example" id="agent_id">
                        <option value="" disabled selected>Please Select An Agent</option>
                        @foreach($agents as $agent)
                            <option value="{{$agent['user_id']}}">{{$agent["name"]}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="agent_name" id="agent_name">
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
@endsection

        @push('scripts')
            <script>
                var agents = JSON.parse('{!! json_encode($agents) !!}');

                $('#agent_id').change(function () {
                    let agent_id = $('#agent_id option:selected').val();
                    agents.forEach(function (agent) {
                        if (parseInt(agent.user_id) == parseInt(agent_id)) {
                            $('#agent_name').val(agent.name);
                        }
                    });
                });
            </script>
    @endpush
