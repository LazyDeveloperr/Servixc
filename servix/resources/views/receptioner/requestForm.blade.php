@extends('receptioner.layouts.base')

@section('content')
    <div class="ml-40">
            <div class="container">
                <div class="d-flex justify-content-between ">
                    <div class=" mt-2">
                        <h2 class="text-black-100">Service Request</h2>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('receptioner.all.request') }}" role="button" class="btn btn-primary btn-sm">Go Back</a>
                    </div>
                </div>
                <form action="{{ route('receptioner.request.form') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="w-full px-3 mb-5 col">
                            <label for="" class="text-black-100">Name</label>
                            <input type="text" name="owner_name" class="form-control" value="{{old('owner_name')}}">
                            @error('owner_name')
                                <p class="text-danger small">{{$message}} </p>
                            @enderror
                        </div>
                        <div class="mb-3 px-3 col">
                            <label for="" class="text-black-100">Product Name</label>
                            <input type="text" name="product_name" class="form-control">
                            @error('product_name')
                            <p class="text-danger small">{{$message}} </p>
                        @enderror
                        </div>
                        <div class="mb-3 px-3 col">
                            <label for="" class="text-black-100">Contact</label>
                            <input type="number" name="contact" class="form-control">
                            @error('contact')
                                <p class="text-danger small">{{$message}} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 px-3 col">
                            <label for="" class="text-black-100">Email</label>
                            <input type="email" name="email" class="form-control">
                            @error('email')
                                <p class="text-danger small">{{$message}} </p>
                            @enderror
                        </div>
                        <div class="mb-3 px-3 col">
                            <label for="" class="text-black-100">Brand</label>
                            <input type="text" name="brand" class="form-control">
                            @error('email')
                                <p class="text-danger small">{{$message}} </p>
                            @enderror
                        </div>
                        <div class="mb-3 px-3 col">
                            <label for="" class="text-black-100">Serial No</label>
                            <input type="text" name="serial_no" class="form-control">
                            @error('serial_no')
                                <p class="text-danger small">{{$message}} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="row ">
                        <div class="mb-3 px-3 col">
                            <label for="" class="text-black-100">Color</label>
                            <div class="flex">
                                <input type="text" name="color" class="form-control">
                                @error('color')
                                    <p class="text-danger small">{{$message}} </p>
                                @enderror
                            </div>
                        </div> 
                        <div class="mb-3 px-3 col">
                            <label for="" class="text-black-100">MAC</label>
                            <div class="flex">
                                <input type="text" name="MAC" class="form-control">
                                @error('MAC')
                                    <p class="text-danger small">{{$message}} </p>
                                @enderror
                            </div>
                        </div> 
                        
                        <div class="mb-3 px-3 col">
                            <label for="" class="text-black-100">Type</label>
                            <select name="type_id" class="form-control">
                                <option value="">Select Type</option>
                                @foreach ($Types as $item)
                                    <option value="{{$item->id}}">{{$item->typename}}</option>
                                @endforeach
                            
                            </select>
                            @error('type_id')
                            <p class="text-danger small">{{$message}} </p>
                        @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div id="my_camera"></div>
                            <br/>
                            <input type=button value="Take Snapshot" onClick="take_snapshot()">
                            <input type="hidden" name="image" class="image-tag">
                        </div>
                        <div class="col-md-6">
                            <div id="results">Your captured image will appear here...</div>
                        </div>
                    </div>
                    </div>
                    
                    <div class="mb-3 px-2">
                        <label for="" class="text-black-100">Problem</label>
                            <textarea type="text" name="problem"
                                class="form-control"></textarea>
                                @error('problem')
                                    <p class="text-danger small">{{$message}} </p>
                                @enderror
                        </div>
                        <div class="w-full">
                            <button class="btn btn-success w-100">Raise Request</button>
                    </div>
                </form>
                </div>
            </div>
       
    </div>
@endsection

@section('js')
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>

<script>
    Webcam.set({
        width: 490,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    
    Webcam.attach( '#my_camera' );
    
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>

@endsection