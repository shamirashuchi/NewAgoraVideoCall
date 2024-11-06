<?php

namespace Botble\JobBoard\Http\Controllers\Fronts;

use Auth;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Botble\JobBoard\Http\Requests\AccountExperienceRequest;
use Botble\JobBoard\Models\Account;
use Botble\JobBoard\Models\AccountExperience;
use JobBoardHelper;

class AccountExperienceController extends BaseController
{
    public function index()
    {
        $account = auth('account')->user();
        $experiences = AccountExperience::where('account_id', $account->id)->get();

        return JobBoardHelper::scope('account.experiences.index', compact('account', 'experiences'));
    }

    public function create()
    {
        $account = auth('account')->user();

        return JobBoardHelper::scope('account.experiences.create', compact('account'));
    }

    public function store(AccountExperienceRequest $request, BaseHttpResponse $response)
    {
        $account = Account::findOrFail(auth('account')->id());

        if ($account->isJobSeeker()) {
            AccountExperience::create([
                ...$request->validated(),
                'account_id' => $account->id,
            ]);
        }

        return $response
            ->setNextUrl(route('public.account.experiences.index'))
            ->setMessage(trans('plugins/job-board::account.experiences.store'));
    }

    public function edit($id)
    {
        $account = auth('account')->user();
        $experience = AccountExperience::query()
            ->where('account_id', $account->id)
            ->where('id', $id)
            ->firstOrFail();

        return JobBoardHelper::scope('account.experiences.edit', compact('account', 'experience'));
    }

    public function update(AccountExperienceRequest $request, $id, BaseHttpResponse $response)
    {
        $experience = AccountExperience::query()
            ->where('id', $id)
            ->where('account_id', Auth::guard('account')->id())
            ->firstOrFail();

        $experience->update($request->validated());

        return $response
            ->setNextUrl(route('public.account.experiences.index'))
            ->setMessage(trans('plugins/job-board::account.experiences.update'));
    }

    public function destroy($id, BaseHttpResponse $response)
    {
        $experience = AccountExperience::query()
            ->where('id', $id)
            ->where('account_id', Auth::guard('account')->id())
            ->firstOrFail();

        $experience->delete();

        return $response
            ->setNextUrl(route('public.account.experiences.index'))
            ->setMessage(trans('plugins/job-board::account.experiences.delete'));
    }
}
