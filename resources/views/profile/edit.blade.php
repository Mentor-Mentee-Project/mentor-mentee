@extends('layouts.base')

@section('content')
    <div class="container mt-5">
        <div class="main-body">
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('profile.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ $user->picture }}" alt="Admin" class="rounded-circle" width="150">
                                    <div class="mt-3">
                                        <h4>{{ $user->name }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-github mr-2 icon-inline">
                                            <path
                                                d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path>
                                        </svg>
                                        Github
                                    </h6>
                                    <div class="row">
                                        <span class="text-secondary">
                                            <input type="text" name="github" class="form-control"
                                                   value= {{ $urls['github']->url }}>
                                        </span>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="feather feather-twitter mr-2 icon-inline text-info">
                                            <path
                                                d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                        </svg>
                                        Twitter
                                    </h6>
                                    <div class="row">
                                        <span class="text-secondary">
                                            <input type="text" name="twitter" class="form-control"
                                                   value= {{ $urls['twitter']->url }}>
                                        </span>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-monitor mr-2 icon-inline">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="2" y1="12" x2="22" y2="12"></line>
                                            <path
                                                d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                                        </svg>
                                        Website
                                    </h6>
                                    <div class="row">
                                        <span class="text-secondary">
                                            <input type="text" name="website" class="form-control"
                                                   value= {{ $urls['website']->url }}>
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">名前</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name" class="form-control" value= {{ $user->name }}>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">エンジニア歴</h6>
                                    </div>
                                    <div class="form-group col-sm-9">

                                        <select name="career"
                                                class="form-control text-secondary">
                                            @foreach($careers as $career)
                                                @if($user_career && $career->id === $user_career->id)
                                                    <option name="career" value={{ $career->id }} selected>
                                                @else
                                                    <option name="career" value= {{ $career->id }}>
                                                        @endif
                                                        {{ $career->year}} </option>
                                                    @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">利用目的</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="goal" class="form-control" value={{ $profile->goal}}>
                                    </div>
                                </div>
                                @if(!$user->is_mentor)
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">希望</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary row">
                                            @foreach($purposes as $purpose)
                                                <div class="col-sm-5 text-secondary">
                                                    @foreach($purposes as $old)
                                                        @if($old->id === $purpose->id)
                                                            <input class="form-check-input" name="purpose[]"
                                                                   type="checkbox"
                                                                   value="{{ $purpose->id}}"
                                                                   id="{{ $purpose->id }}"
                                                                   checked>
                                                            @break
                                                        @else
                                                            <input class="form-check-input" name="purpose[]"
                                                                   type="checkbox"
                                                                   value="{{ $purpose->id}}"
                                                                   id="{{ $purpose->id }}"
                                                            >
                                                            @break
                                                        @endif
                                                    @endforeach
                                                    <label class="form-check-label" for="{{ $purpose->id }}">
                                                        {{ $purpose->purpose_name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3 ">
                                        <h6 class="mb-0">スキル </h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @foreach($skills as $skill)
                                            <div class="col-sm-5 text-secondary">
                                                <input class="form-check-input" name="skill[]" type="checkbox"
                                                       value={{ $skill->id }}

                                                       @if($user_skill->isEmpty())
                                                           id="skill_{{ $skill->id }}">
                                                @endif

                                                @foreach($user_skill as $old)
                                                    @if($old->id === $skill->id)

                                                        id="skill_{{ $skill->id }}" checked="checked">
                                                        @break

                                                    @endif

                                                    @if($loop->last)
                                                        id="skill_{{ $skill->id }}">
                                                        @break
                                                    @endif
                                                @endforeach

                                                <label class="form-check-label" for="skill_{{ $skill->id }}">
                                                    {{ $skill->skill_name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">その他URL</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="other" class="form-control"
                                               value={{$urls['other']->url}}>
                                    </div>
                                </div>
                                @if(!$user->is_mentor)
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">ユーザー種別</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            {{ $user->is_mentor ? 'メンター' : 'メンティー' }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">ステータス</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            @if($application)
                                                @if($application->status === config('application.status.applied'))
                                                    申請中（{{ $application->created_at->format("Y/m/d") }}に申請）
                                                @elseif($application->status === config('application.status.approved'))
                                                    {{ "$application->approved_at より開始" }}
                                                @else
                                                    未申請
                                                @endif
                                            @else
                                                未申請
                                            @endif
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">メンター</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            @if($mentor_applied)
                                                {{ $mentor_applied->name }}
                                            @else
                                                未申請
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row justify-content-center px-3">
                            <button type="submit" name="submit" class="btn btn-primary col-md-4"> 更新</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
