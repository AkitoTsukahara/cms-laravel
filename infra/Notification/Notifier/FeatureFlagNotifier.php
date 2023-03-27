<?php

declare(strict_types=1);

namespace Infra\Notification\Notifier;

use Domain\FeatureFlag\FeatureFlag;
use Domain\FeatureFlag\UpdateMessage;
use Illuminate\Contracts\Notifications\Dispatcher;
use Infra\Notification\FeatureFlag\UpdateFeatureFlag;
use Infra\Notification\Notifiable\ProductReleaseChannelNotifiable;

class FeatureFlagNotifier implements \Domain\FeatureFlag\FeatureFlagNotifier
{
    private Dispatcher $dispatcher;
    private ProductReleaseChannelNotifiable $channelNotifiable;

    public function __construct(
        ProductReleaseChannelNotifiable $channelNotifiable,
        Dispatcher $dispatcher
    ) {
        $this->channelNotifiable = $channelNotifiable;
        $this->dispatcher = $dispatcher;
    }

    public function notifyUpdated(FeatureFlag $featureFlag, UpdateMessage $message): void
    {
        $this->dispatcher->sendNow($this->channelNotifiable, new UpdateFeatureFlag($featureFlag, $message));
    }
}
