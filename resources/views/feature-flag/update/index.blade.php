<?php
/** @var \Domain\FeatureFlag\FeatureFlag $featureFlag */
?>
@extends('admin.layouts.admin')

@section('sidebar')
    @include('admin.component.sidebar', ['active' => 'system'])
@endsection

@section('content')
    @include('admin.component.breadcrumb-list', [
        'items' => [
            ['name' => '便利機能', 'url' => route('admin.system.index')],
            ['name' => '機能フラグ', 'url' => route('admin.system.feature_flag.index')],
            ['name' => $featureFlag->displayName() . ' のフラグ変更', 'url' => null],
        ]
    ])
    @include('admin.component.feedback')
    <h1>{{ $featureFlag->displayName() }} のフラグ変更</h1>
    <section class="section">
        <form class="form-horizontal" method="POST"
              action="{{ route('admin.system.feature_flag.edit', ['name' => $featureFlag->keyName()]) }}">
            @csrf
            @include('admin.parts.form.input.radio', [
                'label' => 'ON/OFF',
                'fieldName' => 'is_enabled',
                'optionList' => ['1' => 'ON', '0' => 'OFF'],
                'default' => $featureFlag->isEnabled() ? '1' : '0',
                'required' => true
            ])
            @include('admin.parts.form.input.textarea', [
                'label' => 'Slack通知文言',
                'fieldName' => 'message',
                'description' => 'このフラグ変更によってどんな機能が有効化されて、どんな影響があるのかを記載してください。',
                'required' => true,
            ])
            @if (config('app.env') === 'production')
                @include('admin.parts.form.input.radio', [
                    'label' => 'こちらは本番環境のフラグ変更です。フラグ変更してよろしいですか？',
                    'fieldName' => 'is_flag_change_confirmed',
                    'optionList' => ['0' => 'いいえ', '1' => 'はい'],
                    'optionList' =>  ['いいえ', 'はい'],
                    'default' => '0',
                    'required' => true,
                ])
            @else
                @include('admin.parts.form.input.input_hidden', [
                    'fieldName' => 'is_flag_change_confirmed',
                    'value' => 1
                ])
            @endif
            <button type="submit" class="btn btn-primary"
                    onclick="return confirm('関連するユーザーすべてに対して対象の機能が公開または非公開となります。よろしいですか？');">変更
            </button>
        </form>
    </section>
@endsection
