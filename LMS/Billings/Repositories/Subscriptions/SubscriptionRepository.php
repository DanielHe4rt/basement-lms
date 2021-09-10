<?php

namespace LMS\Billings\Repositories\Subscriptions;

use LMS\Billings\Models\Plan;

class SubscriptionRepository
{

    public function getSubscriptions()
    {
        return Plan::orderBy('interval')->get();
    }
}
