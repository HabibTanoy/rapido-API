@extends('master')
@section('content')
    <h2 class="text-center mt-5 mb-4">Create Delivery Details</h2>
    <div class="d-flex justify-content-center" style="margin: 0 auto;">
        <form action="{{route('order-create')}}" class="w-75" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="text1" class="col-3 col-form-label">Name</label>
                <div class="col-9">
                    <input id="text1" name="name" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="text2" class="col-3 col-form-label">Phone Number</label>
                <div class="col-9">
                    <input id="text2" name="phone" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="text5" class="col-3 col-form-label">Address</label>
                <div class="col-9">
                    <input id="text5" name="address" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="text5" class="col-3 col-form-label">Price</label>
                <div class="col-9">
                    <input id="text5" name="price" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="text3" class="col-3 col-form-label">Comment</label>
                <div class="col-9">
                    <input id="text3" name="comment" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="text3" class="col-3 col-form-label">Status</label>
                <div class="col-9">
                    <select class="form-select" name="create_status" aria-label="Default select example">
                        <option value="created">Created</option>
                        <option value="assigned">Assigned</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="text3" class="col-3 col-form-label">Delivery Types</label>
                <div class="col-9">
                    <select class="form-select" name="create_types" aria-label="Default select example">
                        <option value="Regular">Regular</option>
                        <option value="Express">Express</option>
                        <option value="Next Day">Next Day</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="text3" class="col-3 col-form-label">Agents</label>
                <div class="col-9">
                    <select class="form-select" name="agent_id" aria-label="Default select example">
                        @foreach($agents as $agent)
                            <option value="{{$agent['user_id']}}">{{$agent["name"]}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Add Delivery</button>
            </div>
        </form>

@endsection
