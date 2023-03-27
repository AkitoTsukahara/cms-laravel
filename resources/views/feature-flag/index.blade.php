<h1>Feature Flag</h1>
{{-- php-del start 2023_03_27_test --}}
@if(\FeatureFlagManager::isTestFlagEnabled())
{{-- php-del ignore start --}}
<h2>フラグON！！！リリース後の処理です</h2>
{{-- php-del ignore end --}}
@else
<h2>フラグOFF！！！リリース前の処理です</h2>
@endif
{{-- php-del end 2023_03_27_test --}}
<div class="table-wrapper">
    <table class="table">
        <thead>
        <tr>
            <th>フラグ名</th>
            <th>ON/OFF</th>
            <th>フラグ変更</th>
        </tr>
        </thead>
        <tbody>
        @foreach($featureFlagList as $featureFlag)
            @php /** @var \Domain\FeatureFlag\FeatureFlag $featureFlag */ @endphp
            <tr>
                <td>{{ $featureFlag->displayName() }}</td>
                <td>{{ $featureFlag->displayIsEnabled() }}</td>
                <td>
                    <a href="{{ route('feature-flag.update.index', ['name' => $featureFlag->keyName()]) }}">変更</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
