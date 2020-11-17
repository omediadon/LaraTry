@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth.register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <input type="hidden" name="tz" id="tz">

                        <x-input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name"
                                 :label="['text' => __('auth.name')]" placeholder="{{ __('auth.name') }}"
                                 :grid="['col-3', 'col-9']"></x-input>
                        <x-input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                                 :label="['text' => __('auth.email')]" placeholder="{{ __('auth.email') }}"
                                 :grid="['col-3', 'col-9']"></x-input>
                        <x-input id="password" type="password" name="password" required autocomplete="password"
                                 :label="['text' => __('auth.password')]" placeholder="{{ __('auth.password') }}"
                                 :grid="['col-3', 'col-9']"></x-input>
                        <x-input id="password_confirmation" value="" type="password" name="password_confirmation" required
                                 autocomplete="password" :label="['text' => __('auth.confirm_password')]"
                                 :grid="['col-3', 'col-9']" placeholder="{{ __('auth.confirm_password') }}"></x-input>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('auth.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
		$(function(){
			// guess user timezone
			$("#tz")
				.val(moment.tz.guess);
		});
    </script>
@endpush
