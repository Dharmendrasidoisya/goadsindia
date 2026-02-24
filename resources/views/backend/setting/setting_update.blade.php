@extends('admin.admin_dashboard')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script> --}}

<div class="page-content"> 
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Site Setting</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Site Setting</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ms-auto">
                 
                    </div>
                </div>
                <!--end breadcrumb-->
                <div class="container">
                    <div class="main-body">
                        <div class="row">
                             
<div class="col-lg-8">
    <div class="card">
        <div class="card-body">

        <form method="post" action="{{ route('site.setting.update') }}" enctype="multipart/form-data" >
            @csrf
        
        <input type="hidden" name="id" value="{{ $setting->id }}">

		 <!-- About Me -->
         <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">About Company</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <textarea name="about_title" class="form-control ">{{ $setting->about_title }}</textarea>
            </div>
        </div>
			<div class="row mb-3">
				<div class="col-sm-3">
					<h6 class="mb-0">About Company Description</h6>
				</div>
				<div class="col-sm-9 text-secondary">
					<textarea name="about_me" class="form-control" id="editor1">{{ $setting->about_me }}</textarea>
				</div>
			</div>
             <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Mobile Number</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{-- <input type="checkbox" class="form-check-input" id="support_phone_checkbox" name="support_phone_checkbox" value="1" {{ $setting->support_phone ? 'checked' : '' }}> --}}
                    <input type="text" class="form-control" name="support_phone" value="{{ $setting->support_phone }}" {{ $setting->support_phone ? '' : 'disabled' }}>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Mobile Number 2</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" name="phone_one" class="form-control" value="{{ $setting->phone_one }}" />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">WhatsApp Number</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    {{-- <input type="checkbox" class="form-check-input" id="whatsapp_no_checkbox" name="whatsapp_no_checkbox" value="1" {{ $setting->whatsapp_no ? 'checked' : '' }}> --}}
                    <input type="text" name="whatsapp_no" class="form-control" value="{{ $setting->whatsapp_no }}" {{ $setting->whatsapp_no ? '' : 'disabled' }}>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="email" name="email" class="form-control" value="{{ $setting->email }}" />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Email 2</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="email" name="email2" class="form-control" value="{{ $setting->email2 }}" />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Email 3</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="email" name="email3" class="form-control" value="{{ $setting->email3 }}" />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Company Address </h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" name="company_address" class="form-control" value="{{ $setting->company_address }}" />
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Header About Address </h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" name="header_about_address" class="form-control" value="{{ $setting->header_about_address }}" />
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Facebook</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" name="facebook" class="form-control" value="{{ $setting->facebook }}" />
                </div>
            </div>


<div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Twitter</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" name="twitter" class="form-control" value="{{ $setting->twitter }}" />
                </div>
            </div>



<div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Youtube</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" name="youtube" class="form-control" value="{{ $setting->youtube }}" />
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Instagram</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" name="instagram" class="form-control" value="{{ $setting->instagram }}" />
                </div>
            </div>
			            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">linkedin</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" name="linkedin" class="form-control" value="{{ $setting->linkedin }}" />
                </div>
            </div>

            {{-- <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">CopyRight</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="text" name="copyright" class="form-control" value="{{ $setting->copyright }}" />
                </div>
            </div> --}}



            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Logo</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="file" name="logo" class="form-control"  id="image"   />
                </div>
            </div>



            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0"> </h6>
                </div>
                <div class="col-sm-9 text-secondary">
                     <img id="showImage" src="{{ asset($setting->logo)   }}" alt="Admin" style="width:100px; height: auto;"  >
                </div>
            </div>



            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0">Footer Logo</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    <input type="file" name="footerlogo" class="form-control" id="image"   />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-3">
                    <h6 class="mb-0"> </h6>
                </div>
                <div class="col-sm-9 text-secondary">
                     <img id="showImage" src="{{ asset($setting->footerlogo)   }}" alt="Admin" style="width:100px; height: auto;"  >
                </div>
            </div>

            <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Footer Brochure (PDF)</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="file" name="brochure" class="form-control" accept="application/pdf" />
                                            @if (!empty($setting->brochure))
                                                <div class="mt-2">
                                                    <a href="{{ asset($setting->brochure) }}" target="_blank">View Current Brochure</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 text-secondary">
                    <input type="submit" class="btn btn-primary px-4" value="Save" />
                </div>
            </div>
        </div>

        </form>



    </div>
     



                            </div>
                        </div>
                    </div>
                </div>
            </div>



            {{-- <script>
    $(document).ready(function() {
        CKEDITOR.replace('about_me');
    });
</script> --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });


</script>
<script>
                $(document).ready(function() {
                    $('#support_phone_checkbox').change(function() {
                        if ($(this).is(':checked')) {
                            $('#whatsapp_no_checkbox').prop('checked', false);
                            $('input[name="whatsapp_no"]').prop('disabled', true);
                            $('input[name="support_phone"]').prop('disabled', false);
                        } else {
                            $('input[name="support_phone"]').prop('disabled', true);
                        }
                    });
            
                    $('#whatsapp_no_checkbox').change(function() {
                        if ($(this).is(':checked')) {
                            $('#support_phone_checkbox').prop('checked', false);
                            $('input[name="support_phone"]').prop('disabled', true);
                            $('input[name="whatsapp_no"]').prop('disabled', false);
                        } else {
                            $('input[name="whatsapp_no"]').prop('disabled', true);
                        }
                    });
                });
            </script>


@endsection