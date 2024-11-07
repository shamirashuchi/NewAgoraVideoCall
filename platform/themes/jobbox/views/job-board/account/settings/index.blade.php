
@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))

@section('content')

<style>
    .main {
        margin-top: 42px !important;
    }

    .btn-expanded {

        top: 0px !important;

    }

    .nav-item {
        max-width: 140px !important;

    }

    .custom-dropdown {
    position: relative;
    display: inline-block;
}

.custom-dropdown .dropdown-options {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1;
    list-style: none;
    padding: 0;
    margin: 0;
    background-color: #fff;
    border: 1px solid #ccc;
}

.custom-dropdown.open .dropdown-options {
    display: block;
}

.custom-dropdown .dropdown-options li {
    padding: 5px;
    cursor: pointer;
}

.custom-dropdown .dropdown-options li:hover {
    background-color: #f5f5f5;
}

    .tags.form-control.list-tagify option:checked {
        background-color: blue;
        margin-bottom:10px;
        color: white;
    }


    .cover-photo {
            position: relative;
            width: 100%;
            height: auto;
        }
        .profile-photo-wrapper {
            position: absolute;
            bottom: -8%; /* Adjust as needed */
            left: 10%;
            transform: translateX(-50%);
            width: 45%; /* Responsive width */
            max-width: 150px; /* Maximum size */
            z-index: 1;
        }
        .profile-photo {
            width: 100%;
            height: auto;
            border: 3px solid white;
        }
        .verification-badge {
            position: absolute;
            bottom: 123px;
            right: 14px;
            transform: translate(50%, 50%);
            font-size: 2.5rem; /* Adjust size */
            color: #008b46; /* Primary color */
        }
        @media (max-width: 1024px) {
            .profile-photo-wrapper {
                width: 13%; /* Adjust for smaller screens */
                max-width: 120px;
                bottom: -9%; /* Adjust for smaller screens */
                left: 13%;
            }
            .verification-badge {
                font-size: 1.25rem; /* Smaller badge for smaller screens */
                bottom: 97px;
                right: 13px;
            }
        }
        @media (max-width: 768px) {
            .profile-photo-wrapper {
                width: 13%;
                max-width: 120px;
                bottom: -9%;
                left: 13%;
            }
            .verification-badge {
                font-size: 1.25rem; 
                bottom: 72px;
                right: 10px;
            }
        }
        @media (max-width: 430px) {
            .profile-photo-wrapper {
                width: 13%; 
                max-width: 120px;
                bottom: -9%; 
                left: 13%;
            }
            .verification-badge {
                font-size: .65rem;
                bottom: 38px;
                right: 5px;
            }
        }
</style>

@if($account->type == "job-seeker")
{{-- start --}}
<div class="px-4">
<div class="container bg-light rounded-3 px-3">

    <div class="row py-3">
        <!-- Cover Photo -->
        <div class="col-12 cover-photo">
            <img src="https://via.placeholder.com/1248x263" alt="Cover Photo" class="img-fluid w-100">
            <!-- Profile Photo -->
            <div class="profile-photo-wrapper">
                <div class="position-relative">
                    <img src="https://via.placeholder.com/191x191" alt="Profile Photo" class="profile-photo rounded-circle">
                    <i class="bi bi-patch-check-fill verification-badge"></i>
                </div>
            </div>
        </div>
    </div>



    <form action="">
        
    <div class="py-5">
        <div class="div pt-5 px-4 py-4 bg-white rounded-3">
            <h3 class="mt-3">Personal Information</h3>
          
           {{$account->first_name;}}

            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="first_name"></label>
                    <input class="form-control" id="first_name" type="text" name="first_name" required placeholder="{{ __('First Name') }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="last_name"></label>
                    <input class="form-control" id="last_name" type="text" name="last_name" required placeholder="{{ __('Last Name') }}" >
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="first_name"></label>
                    <input class="form-control" id="dob" type="text" name="dob" required placeholder="{{ __('DOB') }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="last_name"></label>
                    <input class="form-control" id="gender" type="text" name="gender" required placeholder="{{ __('Gender') }}" >
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="first_name"></label>
                    <input class="form-control" id="email_address" type="email" name="email_address" required placeholder="{{ __('Email Address') }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="last_name"></label>
                    <input class="form-control" id="cell_number" type="text" name="cell_number" required placeholder="{{ __('Cell Number') }}" >
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="div pt-5 px-4 py-4 bg-white rounded-3">
            <h3 class="mt-3">Address</h3>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="first_name"></label>
                    <input class="form-control" id="present_address" type="text" name="present_address" required placeholder="{{ __('Present Address') }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="last_name"></label>
                    <input class="form-control" id="permanent_address" type="text" name="permanent_address" required placeholder="{{ __('Permanent Address') }}" >
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="first_name"></label>
                    <input class="form-control" id="city" type="text" name="city" required placeholder="{{ __('City') }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="last_name"></label>
                    <input class="form-control" id="province" type="text" name="province" required placeholder="{{ __('Province') }}" >
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="div pt-5 px-4 py-4 bg-white rounded-3">
            <h3 class="mt-3">Work Eligibility and Residency Status in Canada</h3>
            <div class="row mt-2">
                <div class="form-group col-md-6">
                    <label class="form-label" for="first_name">{{ __('Permanent Resident / Citizen of Canada?') }}</label>
                    <select class="form-select" aria-label="Default select example" id="resident_or_not" class="resident_or_not">
                        <option selected class="text-secondary">--Select--</option>
                        <option value="1">Permanent Resident</option>
                        <option value="2">Citizen of Canada</option>
                        <option value="3">Others</option>
                      </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="last_name">{{ __('Legally entitled to work in Canada?') }}</label>
                    <select class="form-select" aria-label="Default select example" id="leagal_or_not" class="leagal_or_not">
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                      </select>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="div pt-5 px-4 py-4 bg-white rounded-3">
            <h3 class="mt-3">Job Skills and Preferences</h3>
            <div class="row mt-2">
                <div class="form-group">
                    <label class="form-label" for="first_name">{{ __('My Job Skills (Press Ctrl and click to select multiple)') }}</label>
                    <select class="form-select" aria-label="Default select example" id="skills" class="skills">
                        <option selected class="text-secondary">--Select--</option>
                        <option value="1">skill 1</option>
                        <option value="2">skill 2</option>
                        <option value="3">skill 3</option>
                      </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="first_name">{{ __('Favorite Job Tags (Press Ctrl and click to select multiple)') }}</label>
                    <select class="form-select" aria-label="Default select example" id="tag" class="tag">
                        <option selected class="text-secondary">--Select--</option>
                        <option value="1">tag 1</option>
                        <option value="2">tag 2</option>
                        <option value="3">tag 3</option>
                      </select>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="div pt-5 px-4 py-4 bg-white rounded-3">
            <h3 class="mt-3">Profile</h3>
            <div class="row mt-2">
                <div class="form-group">
                    <label class="form-label" for="last_name">{{ __('Introduce Yourself') }}</label>
                    <input class="form-control" id="introduce_yourself" type="text" name="introduce_yourself" required placeholder="{{ __('Enter Description') }}" >
                </div>


                <div class="row">
                    <!-- Full Editor -->
                    <div class="col-12">
                    <label class="form-label" for="last_name">{{ __('Career Objectives') }}</label>
                      <div class="card">
                          <div id="full-editor">
                            <input class="form-control" id="career_objectives" type="text" name="career_objectives" required >
                          </div>
                      </div>
                    </div>
                    <!-- /Full Editor -->
                  </div>


            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="div pt-5 px-4 py-4 bg-white rounded-3">
            <h3 class="mt-3">Upload Your Application Materials</h3>
            <div class="row mt-2">
                <div class="form-group">
                    <label class="form-label" for="last_name">{{ __('Attachments CV') }}</label>
                    <input class="form-control" id="attachments_cv" type="file" name="attachments_cv" accept=".pdf,.doc,.docx,.ppt,.pptx" required >
                </div>
                <div class="form-group">
                    <label class="form-label" for="last_name">{{ __('Cover letter') }}</label>
                    <input class="form-control" id="cover_letter" type="file" name="cover_letter" accept=".pdf,.doc,.docx,.ppt,.pptx" required >
                </div>
                <div class="form-group">
                    <label class="form-label" for="last_name">{{ __('Cover image') }}</label>
                    <input class="form-control" id="cover_image" type="file" name="cover_image" required >
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <button class="btn btn-warning w-100 text-white fw-bold" type="submit">Save all the changes</button>
    </div>

</form>

</div>
</div>



@elseif($account->type == "employer")
{{-- start --}}
<div class="px-4">
<div class="container bg-light rounded-3 px-3">

    <div class="row py-3">
        <!-- Cover Photo -->
        <div class="col-12 cover-photo">
            <img src="https://via.placeholder.com/1248x263" alt="Cover Photo" class="img-fluid w-100">
            <!-- Profile Photo -->
            <div class="profile-photo-wrapper">
                <div class="position-relative">
                    <img src="https://via.placeholder.com/191x191" alt="Profile Photo" class="profile-photo rounded-circle">
                    <i class="bi bi-patch-check-fill verification-badge"></i>
                </div>
            </div>
        </div>
    </div>



    <form action="">
        
    <div class="py-5">
        <div class="div pt-5 px-4 py-4 bg-white rounded-3">
            <h3 class="mt-3">Personal Information</h3>
          
           {{$account->first_name;}}

            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="first_name"></label>
                    <input class="form-control" id="first_name" type="text" name="first_name" required placeholder="{{ __('First Name') }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="last_name"></label>
                    <input class="form-control" id="last_name" type="text" name="last_name" required placeholder="{{ __('Last Name') }}" >
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="first_name"></label>
                    <input class="form-control" id="dob" type="text" name="dob" required placeholder="{{ __('DOB') }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="last_name"></label>
                    <input class="form-control" id="gender" type="text" name="gender" required placeholder="{{ __('Gender') }}" >
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="first_name"></label>
                    <input class="form-control" id="email_address" type="email" name="email_address" required placeholder="{{ __('Email Address') }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="last_name"></label>
                    <input class="form-control" id="cell_number" type="text" name="cell_number" required placeholder="{{ __('Cell Number') }}" >
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="div pt-5 px-4 py-4 bg-white rounded-3">
            <h3 class="mt-3">Address</h3>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="first_name"></label>
                    <input class="form-control" id="present_address" type="text" name="present_address" required placeholder="{{ __('Present Address') }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="last_name"></label>
                    <input class="form-control" id="permanent_address" type="text" name="permanent_address" required placeholder="{{ __('Permanent Address') }}" >
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label class="form-label" for="first_name"></label>
                    <input class="form-control" id="city" type="text" name="city" required placeholder="{{ __('City') }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="last_name"></label>
                    <input class="form-control" id="province" type="text" name="province" required placeholder="{{ __('Province') }}" >
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="div pt-5 px-4 py-4 bg-white rounded-3">
            <h3 class="mt-3">Work Eligibility and Residency Status in Canada</h3>
            <div class="row mt-2">
                <div class="form-group col-md-6">
                    <label class="form-label" for="first_name">{{ __('Permanent Resident / Citizen of Canada?') }}</label>
                    <select class="form-select" aria-label="Default select example" id="resident_or_not" class="resident_or_not">
                        <option selected class="text-secondary">--Select--</option>
                        <option value="1">Permanent Resident</option>
                        <option value="2">Citizen of Canada</option>
                        <option value="3">Others</option>
                      </select>
                </div>
                <div class="form-group col-md-6">
                    <label class="form-label" for="last_name">{{ __('Legally entitled to work in Canada?') }}</label>
                    <select class="form-select" aria-label="Default select example" id="leagal_or_not" class="leagal_or_not">
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                      </select>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="div pt-5 px-4 py-4 bg-white rounded-3">
            <h3 class="mt-3">Job Skills and Preferences</h3>
            <div class="row mt-2">
                <div class="form-group">
                    <label class="form-label" for="first_name">{{ __('My Job Skills (Press Ctrl and click to select multiple)') }}</label>
                    <select class="form-select" aria-label="Default select example" id="skills" class="skills">
                        <option selected class="text-secondary">--Select--</option>
                        <option value="1">skill 1</option>
                        <option value="2">skill 2</option>
                        <option value="3">skill 3</option>
                      </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="first_name">{{ __('Favorite Job Tags (Press Ctrl and click to select multiple)') }}</label>
                    <select class="form-select" aria-label="Default select example" id="tag" class="tag">
                        <option selected class="text-secondary">--Select--</option>
                        <option value="1">tag 1</option>
                        <option value="2">tag 2</option>
                        <option value="3">tag 3</option>
                      </select>
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="div pt-5 px-4 py-4 bg-white rounded-3">
            <h3 class="mt-3">Profile</h3>
            <div class="row mt-2">
                <div class="form-group">
                    <label class="form-label" for="last_name">{{ __('Introduce Yourself') }}</label>
                    <input class="form-control" id="introduce_yourself" type="text" name="introduce_yourself" required placeholder="{{ __('Enter Description') }}" >
                </div>


                <div class="row">
                    <!-- Full Editor -->
                    <div class="col-12">
                    <label class="form-label" for="last_name">{{ __('Career Objectives') }}</label>
                      <div class="card">
                          <div id="full-editor">
                            <input class="form-control" id="career_objectives" type="text" name="career_objectives" required >
                          </div>
                      </div>
                    </div>
                    <!-- /Full Editor -->
                  </div>


            </div>
        </div>
    </div>

    <div class="py-3">
        <div class="div pt-5 px-4 py-4 bg-white rounded-3">
            <h3 class="mt-3">Upload Your Application Materials</h3>
            <div class="row mt-2">
                <div class="form-group">
                    <label class="form-label" for="last_name">{{ __('Attachments CV') }}</label>
                    <input class="form-control" id="attachments_cv" type="file" name="attachments_cv" accept=".pdf,.doc,.docx,.ppt,.pptx" required >
                </div>
                <div class="form-group">
                    <label class="form-label" for="last_name">{{ __('Cover letter') }}</label>
                    <input class="form-control" id="cover_letter" type="file" name="cover_letter" accept=".pdf,.doc,.docx,.ppt,.pptx" required >
                </div>
                <div class="form-group">
                    <label class="form-label" for="last_name">{{ __('Cover image') }}</label>
                    <input class="form-control" id="cover_image" type="file" name="cover_image" required >
                </div>
            </div>
        </div>
    </div>

    <div class="py-3">
        <button class="btn btn-primary w-100 text-white fw-bold" type="submit">Save all the changes</button>
    </div>

</form>

</div>
</div>

@endif



<!-- Initialize Quill editors -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
      // Snow Theme
      var snowEditor = new Quill('#snow-editor', {
        theme: 'snow',
        modules: {
          toolbar: '#snow-toolbar'
        }
      });

      // Bubble Theme
      var bubbleEditor = new Quill('#bubble-editor', {
        theme: 'bubble',
        modules: {
          toolbar: '#bubble-toolbar'
        }
      });

      // Full Editor (with Snow Theme)
      var fullEditor = new Quill('#full-editor', {
        theme: 'snow',
        modules: {
          toolbar: [
            [{ 'font': [] }, { 'size': [] }],
            [{ 'header': '1'}, { 'header': '2' }, 'blockquote', 'code-block'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'align': [] }],
            ['link', 'image']
          ]
        }
      });
    });
  </script>
@endsection



