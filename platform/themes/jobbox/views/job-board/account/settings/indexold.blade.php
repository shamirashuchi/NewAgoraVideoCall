
@extends(JobBoardHelper::viewPath('dashboard.layouts.master'))


@php
    Theme::asset()->add('avatar-css', 'vendor/core/plugins/job-board/css/avatar.css');
    Theme::asset()->add('tagify-css', 'vendor/core/core/base/libraries/tagify/tagify.css');
    Theme::asset()->container('footer')->add('cropper-js', 'vendor/core/plugins/job-board/libraries/cropper.js', ['jquery']);
    Theme::asset()->container('footer')->add('avatar-js', 'vendor/core/plugins/job-board/js/avatar.js');
    Theme::asset()->container('footer')->add('editor-lib-js', config('core.base.general.editor.' . BaseHelper::getRichEditor() . '.js'));
    Theme::asset()->container('footer')->add('editor-js', 'vendor/core/core/base/js/editor.js');
    Theme::asset()->container('footer')->add('tagify-js', 'vendor/core/core/base/libraries/tagify/tagify.js');
    Theme::asset()->container('footer')->usePath()->add('tags-js', 'js/tagify-select.js');

    $url = url()->current();

    $coverImage = '';

    if ($account->getMetaData('cover_image', true)) {
        $coverImage = $account->getMetaData('cover_image', true);
    } else if (theme_option('background_cover_candidate_default')) {
        $coverImage = theme_option('background_cover_candidate_default');
    }
@endphp








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



</style>

<div class="container">
            <div class="banner-hero banner-image-single" style="background: url('{{ RvMedia::getImageUrl($coverImage, null, false, RvMedia::getDefaultImage()) }}') center no-repeat"></div>
            <div class="box-company-profile">
                <div class="image-company"><img src="{{ $account->avatar_url }}" alt="{{ $account->name }}"></div>
                <div class="row mt-30">
                    <div class="col-lg-8 col-md-12">
                        <h5 class="f-18">{{ $account->name }} <span class="card-location font-regular ml-20">{{ $account->address }}</span></h5>
                        <p class="mt-0 font-md color-text-paragraph-2 mb-15">{!! BaseHelper::clean($account->description) !!}</p>
                    </div>
                    @if ($account->is_public_profile)
                        <div class="col-lg-4 col-md-12 text-lg-end">
                            <a class="btn btn-preview-icon btn-apply btn-apply-big" href="{{ $account->url }}"  >{{ __('Previews') }}</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="border-bottom pt-10 pb-10"></div>
        </div>








    <div>
        <h3 class="mt-0 mb-15 color-brand-1">{{ __('My Account') }}</h3>
        {!! Form::open(['route' => 'public.account.post.settings', 'method' => 'POST', 'files' => true]) !!}
        <div class="mt-35 mb-40 box-info-profie avatar-view">
            <div class="image-profile">
                <img src="{{ $account->avatar_url }}" id="profile-img" alt="{{ $account->name }}">
            </div>


            <a class="btn btn-apply" data-bs-toggle="modal" data-bs-target="#avatar-modal">{{ __('Upload Avatar') }}</a>

        </div>
        <div class="row form-contact">
            <div class="col-lg-12 col-md-12">
                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10" for="first_name">{{ __('First Name') }}</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                           name="first_name" value="{{ old('first_name', $account->first_name) }}" required placeholder="{{ __('Enter First Name') }}"/>
                    @error('first_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>



                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10" for="middle_name">{{ __('Middle Name') }}</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="middle_name"
                           name="middle_name" value="{{ old('middle_name', $account->middle_name) }}"  placeholder="{{ __('Enter Middle Name') }}"/>
                    @error('first_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>



                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10" for="last_name" >{{ __('Last Name') }}</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                           id="last_name" name="last_name" value="{{ old('last_name', $account->last_name) }}" required placeholder="{{ __('Enter Last Name') }}"/>
                    @error('last_name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10" for="phone">{{ __('Cell') }}</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                           name="phone" id="phone" value="{{ old('phone', $account->phone) }}" placeholder="{{ __('Enter Phone') }}"/>
                    @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10" for="dob">{{ __('Date of Birth') }}</label>
                    <input type="date" class="form-control @error('dob') is-invalid @enderror"
                           name="dob" id="dob" value="{{ old('dob', $account->dob ? $account->dob->format('Y-m-d') : '') }}"
                           max="{{ now()->format('Y-m-d') }}" pattern="\d{4}-\d{2}-\d{2}"/>
                    @error('dob')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                @if (! $account->type->getKey() && setting('job_board_enabled_register_as_employer'))
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="type" class="form-label required">{{ __('Type') }}</label>
                            {!! Form::select('type', ['' => __('-- select --')] + Botble\JobBoard\Enums\AccountTypeEnum::labels(), old('type', $account->type), [
                                'class' => 'form-select',
                                'required' => true,
                            ]) !!}
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10" for="gender">{{ __('Gender') }}</label>
                    {!! Form::select('gender', ['' => __('-- select --')] + Botble\JobBoard\Enums\AccountGenderEnum::labels(), old('gender', $account->gender), [
                            'class' => 'form-select'
                        ]) !!}
                </div>








                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10" for="address">{{ __('Address') }}</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                           name="address" id="address" value="{{ old('address', $account->address) }}" placeholder="{{ __('Enter Address') }}"/>
                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10" for="address_line_2">{{ __('Address Line 2') }}</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                           name="address_line_2" id="address_line_2" value="{{ old('address_line_2', $account->address_line_2) }}" placeholder="{{ __('Enter Address Line 2') }}"/>
                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10" for="city">{{ __('City') }}</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                           name="city" id="city" value="{{ old('city', $account->city) }}" placeholder="{{ __('Enter City') }}"/>
                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10" for="province">{{ __('Province') }}</label>
                    <input type="text" class="form-control @error('description') is-invalid @enderror"
                           name="province" id="province" value="{{ old('province', $account->province) }}" placeholder="{{ __('Enter Province') }}"/>
                    @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>





                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10" for="permanent_resident">{{ __('Permanent Resident / Citizen of Canada?') }}</label>
                    <select class="form-control @error('permanent_resident') is-invalid @enderror" name="permanent_resident" id="permanent_resident">
                        <option value="" @if(old('permanent_resident', $account->permanent_resident) == "") selected @endif>-- Select --</option>
                        <option value="yes" @if(old('permanent_resident', $account->permanent_resident) == "yes") selected @endif>{{ __('Yes') }}</option>
                        <option value="no" @if(old('permanent_resident', $account->permanent_resident) == "no") selected @endif>{{ __('No') }}</option>
                    </select>
                    @error('permanent_resident')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>




                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10" for="legally_entitled">{{ __('Legally entitled to work in Canada?') }}</label>
                    <select class="form-control @error('legally_entitled') is-invalid @enderror" name="legally_entitled" id="legally_entitled">
                        <option value="yes" @if(old('legally_entitled', $account->legally_entitled) == "yes") selected @endif>{{ __('Yes') }}</option>
                        <option value="no" @if(old('legally_entitled', $account->legally_entitled) == "no") selected @endif>{{ __('No') }}</option>
                    </select>
                    @error('legally_entitled')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>














                @if ($account->isJobSeeker())
                    @if (count($jobSkills) || count($selectedJobSkills))





                   <div class="form-group mb-3" style="display:none">
                        <label for="favorite_skills" class="font-sm color-text-mutted mb-10">{{ __('Favorite Job Skills') }}</label>
                        <input type="text" class="tags form-control list-tagify" id="favorite_skills" name="favorite_skills" value="{{ implode(',', $selectedJobSkills) }}" data-keep-invalid-tags="false" data-list="{{ $jobSkills }}" data-user-input="false" placeholder="{{ __('Select from the list.') }}"/>
                        @error('favorite_skills')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>














<div class="form-group mb-3">
    <label for="favorite_skills" class="font-sm color-text-mutted mb-10">{{ __('My Job Skills (Press Ctrl and click to select multiple)') }}</label>
    <select class="tags form-control list-tagify" name="favorite_skills2[]" multiple>
        @foreach ($jobSkills as $skill)
            <option value="{{ $skill['id'] }}" {{ in_array($skill['id'], $selectedSkillsArray) ? 'selected' : '' }}>
                {{ $skill['name'] }}
            </option>
        @endforeach
    </select>
</div>






                    @endif

                    @if (count($jobTags) || count($selectedJobTags))



                        <div class="form-group mb-3" style="display:none">
                            <label for="favorite_tags" class="form-label">{{ __('Favorite Job Tags') }}</label>
                            <input type="text" class="tags form-control list-tagify" id="favorite_tags" name="favorite_tags" value="{{ implode(',', $selectedJobTags) }}" data-keep-invalid-tags="false" data-list="{{ $jobTags }}" data-user-input="false" placeholder="{{ __('Select from the list.') }}"/>
                            @error('favorite_tags')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>




<div class="form-group mb-3">
    <label for="favorite_skills" class="font-sm color-text-mutted mb-10">{{ __('Favorite Job Tags (Press Ctrl and click to select multiple)') }}</label>
    <select class="tags form-control list-tagify" name="favorite_tags2[]" multiple>
        @foreach ($jobTags as $tag)
            <option value="{{ $tag['id'] }}" {{ in_array($tag['id'], $selectedTagsArray) ? 'selected' : '' }}>
                {{ $tag['name'] }}
            </option>
        @endforeach
    </select>
</div>











                    @endif
                @endif

                <div class="mt-4">
                    <h5  class="fs-17 fw-semibold mb-3">{{ __('Profile') }}</h5>
                    <div class="row">
                        @if ($account->isJobSeeker())
                            <div class="col-lg-12" style="display:none;">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="is_public_profile" value="0">
                                        <input class="form-check-input" name="is_public_profile" value="1" checked type="checkbox"
                                               role="switch" id="is_public_profile" @checked(old('is_public_profile', $account))>
                                        <label class="font-sm color-text-mutted mb-10" for="is_public_profile">{{ __('Is public profile?') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12"  style="display:none;">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input type="hidden" name="available_for_hiring" value="0">
                                        <input class="form-check-input" name="available_for_hiring" value="1" type="checkbox" checked
                                               role="switch" id="available_for_hiring" @checked(old('available_for_hiring', $account))>
                                        <label class="font-sm color-text-mutted mb-10" for="available_for_hiring">{{ __('Available for hiring?') }}</label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="description" class="font-sm color-text-mutted mb-10">{{ __('Introduce Yourself') }}</label>
                                <textarea  @class(['form-control', 'is-invalid' => $errors->has('description')]) name="description"
                                           id="description" placeholder="{{ __('Enter Description') }}"
                                           rows="2">{!! BaseHelper::clean(old('description', $account->description)) !!}</textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="bio"
                                       class="font-sm color-text-mutted mb-10">{{ __('BIO') }}</label>
                                {!! Form::customEditor('bio', old('bio', $account->bio)) !!}
                                @error('bio')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>



                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="description" class="font-sm color-text-mutted mb-10">{{ __('Calendly code to share your calendar (only if you are a consultant)') }}</label>
                                <textarea  @class(['form-control', 'is-invalid' => $errors->has('description')]) name="calendly"
                                           id="description" placeholder="{{ __('Calendly code to share your calendar (only if you are a consultant)') }}"
                                           rows="2">{!! BaseHelper::clean(old('calendly', $account->calendly)) !!}</textarea>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>




                        <!--end col-->
                        @if ($account->isJobSeeker())
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="attachments-cv" class="font-sm color-text-mutted mb-10">{{ __('Attachments CV') }}</label>
                                    <input type="file" class="form-control @error('resume') is-invalid @enderror"
                                           id="attachments-cv" name="resume" accept=".pdf,.doc,.docx,.ppt,.pptx" />
                                    @if ($account->resume)
                                        <div class="mb-4 mt-2">
                                            <p class="job-apply-resume-info"><i class="mdi mdi-information"></i> {!! BaseHelper::clean(__('Your current resume :resume. Just upload a new resume if you want to change it.', ['resume' => Html::link(RvMedia::url($account->resume), $account->resume, ['target' => '_blank'])->toHtml()])) !!}</p>
                                        </div>
                                    @endif
                                    @error('resume')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="attachments-cover-letter" class="font-sm color-text-mutted mb-10">{{ __('Cover letter') }}</label>
                                    <input type="file" @class(['form-control', 'is-invalid' => $errors->has('cover_letter')])
                                    id="attachments-cover-letter" name="cover_letter" accept=".pdf,.doc,.docx,.ppt,.pptx" />
                                    @if ($account->cover_letter)
                                        <div class="mb-4 mt-2">
                                            <p class="job-apply-resume-info"><i class="mdi mdi-information"></i> {!! BaseHelper::clean(__('Your current cover_letter :cover_letter. Just upload a new resume if you want to change it.', ['cover_letter' => Html::link(RvMedia::url($account->cover_letter), $account->cover_letter, ['target' => '_blank'])->toHtml()])) !!}</p>
                                        </div>
                                    @endif
                                    @error('cover_letter')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <!--end col-->
                        @endif
                    </div>
                    <!--end row-->
                    {!! apply_filters('account_settings_page', null, $account) !!}
                </div>
                <div class="border-bottom pt-10 pb-10 mb-30"></div>
                <div class="box-button mt-15">
                    <button class="btn btn-apply-big font-md font-bold">{{ __('Save All Changes') }}</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    {!! Form::close() !!}


    <div class="modal fade" id="avatar-modal" tabindex="-1" role="dialog" aria-labelledby="avatar-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form class="avatar-form" method="post" action="{{ route('public.account.avatar') }}" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title" id="avatar-modal-label">
                            <strong>{{ __('Profile Image') }}</strong>
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <div class="avatar-body">

                            <!-- Upload image and data -->
                            <div class="avatar-upload">
                                <input class="avatar-src" name="avatar_src" type="hidden">

                                <input type="hidden" name="avatar_data" value='{"x":0,"y":0,"height":500,"width":500}'>

                                @csrf
                                <label for="avatarInput">{{ __('New image') }}</label>
                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                            </div>

                            <div class="loading" tabindex="-1" role="img" aria-label="{{ __('Loading') }}"></div>

                            <!-- Crop and preview -->
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                    <div class="error-message text-danger" style="display: none"></div>
                                </div>
                                <div class="col-md-3 avatar-preview-wrapper">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary" type="button" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button class="btn btn-outline-primary avatar-save" type="submit">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
<script>
    'use strict';

    var RV_MEDIA_URL = {
        base: '{{ url('') }}',
        filebrowserImageBrowseUrl: false,
        media_upload_from_editor: '{{ route('public.account.upload-from-editor') }}'
    }

    function setImageValue(file) {
        $('.mce-btn.mce-open').parent().find('.mce-textbox').val(file);
    }
</script>






<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.custom-dropdown').on('click', function() {
        $(this).toggleClass('open');
    });

    $('.dropdown-options li').on('click', function() {
        var value = $(this).text();
        var input = $('#favorite_skills');
        var currentValue = input.val();
        var newValue = '';

        if (currentValue) {
            newValue = currentValue + ', ' + value;
        } else {
            newValue = value;
        }

        input.val(newValue);
    });
});
</script>
















<iframe id="form_target" name="form_target" style="display:none"></iframe>
<form id="tinymce_form" action="{{ route('public.account.upload-from-editor') }}" target="form_target" method="post" enctype="multipart/form-data"
      style="width:0; height:0; overflow:hidden; display: none;">
    @csrf
    <input name="upload" id="upload_file" type="file" onchange="$('#tinymce_form').submit();this.value='';">
    <input type="hidden" value="tinymce" name="upload_type">
</form>



@endpush




@endsection



