<div class="form-group">
    <label class="control-label">{{ __('Title') }}</label>
    <input type="text" name="title" value="{{ Arr::get($attributes, 'title') }}" class="form-control" placeholder="{{ __('Title') }}">
</div>

<div class="form-group">
    <label class="control-label">{{ __('Subtitle') }}</label>
    <input type="text" name="subtitle" value="{{ Arr::get($attributes, 'subtitle') }}" class="form-control" placeholder="{{ __('Subtitle') }}">
</div>

<div class="form-group">
    <label class="control-label">{{ __('Job category') }}</label>
    <input name="job_categories" data-member-text=" {{ __('Job categories') }}" data-add-all-text="{{ __('Add all') }}" data-list="{{ $categories }}" class="form-control list-tagify" value="{{ Arr::get($attributes, 'job_categories') }}" placeholder='Select tags from the list'>
</div>

@php($random = Str::random(20))

<div class="form-group">
    <label class="control-label" for="style_{{ $random }}">{{ __('Style') }}</label>
    {!! Form::customSelect('style', [
            'style-1' => __('Style 1'),
            'style-2' => __('Style 2'),
            'style-3' => __('Style 3'),
        ], Arr::get($attributes, 'style'), ['id' => 'style_' . $random]) !!}
</div>


<style>
    .tagify__dropdown.users-list {
        z-index: 9999999;
    }
</style>
