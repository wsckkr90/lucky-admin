@extends('layouts.admin')

@section('title', 'Social Channels')

@section('content')

<div class="mb-4">

    <h2 class="mb-1">
        Social Channels
    </h2>

    <p class="text-muted mb-0">
        Manage your website's social media and community links.
    </p>

</div>

@if(session('success'))

    <div class="alert alert-success">
        {{ session('success') }}
    </div>

@endif

@if($errors->any())

    <div class="alert alert-danger">

        <strong>Please fix the following:</strong>

        <ul class="mb-0 mt-2">

            @foreach($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

@php

    $values = $settings->keyBy('key');

@endphp

<form
    method="POST"
    action="{{ route('admin.social.update') }}"
>

    @csrf
    @method('PUT')

    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white">

            <h5 class="mb-0">
                Social Media Links
            </h5>

        </div>

        <div class="card-body">

            <div class="row g-4">

                <div class="col-md-6">

                    <label class="form-label">
                        Telegram URL
                    </label>

                    <input
                        type="url"
                        name="telegram_url"
                        class="form-control"
                        placeholder="https://t.me/yourchannel"
                        value="{{ old(
                            'telegram_url',
                            $values->get('social.telegram_url')?->value ?? ''
                        ) }}"
                    >

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        WhatsApp URL
                    </label>

                    <input
                        type="url"
                        name="whatsapp_url"
                        class="form-control"
                        placeholder="https://chat.whatsapp.com/..."
                        value="{{ old(
                            'whatsapp_url',
                            $values->get('social.whatsapp_url')?->value ?? ''
                        ) }}"
                    >

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        YouTube URL
                    </label>

                    <input
                        type="url"
                        name="youtube_url"
                        class="form-control"
                        placeholder="https://youtube.com/@yourchannel"
                        value="{{ old(
                            'youtube_url',
                            $values->get('social.youtube_url')?->value ?? ''
                        ) }}"
                    >

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Instagram URL
                    </label>

                    <input
                        type="url"
                        name="instagram_url"
                        class="form-control"
                        placeholder="https://instagram.com/yourprofile"
                        value="{{ old(
                            'instagram_url',
                            $values->get('social.instagram_url')?->value ?? ''
                        ) }}"
                    >

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Facebook URL
                    </label>

                    <input
                        type="url"
                        name="facebook_url"
                        class="form-control"
                        placeholder="https://facebook.com/yourpage"
                        value="{{ old(
                            'facebook_url',
                            $values->get('social.facebook_url')?->value ?? ''
                        ) }}"
                    >

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Twitter / X URL
                    </label>

                    <input
                        type="url"
                        name="twitter_url"
                        class="form-control"
                        placeholder="https://x.com/yourprofile"
                        value="{{ old(
                            'twitter_url',
                            $values->get('social.twitter_url')?->value ?? ''
                        ) }}"
                    >

                </div>

            </div>

        </div>

        <div class="card-footer bg-white">

            <button
                type="submit"
                class="btn btn-primary"
            >
                Save Social Channels
            </button>

        </div>

    </div>

</form>

@endsection
