<?php

namespace App\Observers;

use App\Models\OrderEvent;
use App\Events\OrderEventUpdated;

class OrderEventObserver
{
    /**
     * Handle the OrderEvent "created" event.
     */
    public function created(OrderEvent $orderEvent): void
    {
        OrderEventUpdated::dispatch('create');
    }

    /**
     * Handle the OrderEvent "updated" event.
     */
    public function updated(OrderEvent $orderEvent): void
    {
        $changes = $orderEvent->getChanges();

        OrderEventUpdated::dispatch([
            'code' => $changes['code']['old'],
            'full_code' => $changes['full_code']['old'],
            'event_created_at' => $changes['event_created_at']['old'],
            'metadata' => $changes['metadata']['old'],
            'created_at' => $changes['created_at']['old'],
            'updated_at' => $changes['updated_at']['old']
        ]);

    }

    /**
     * Handle the OrderEvent "deleted" event.
     */
    public function deleted(OrderEvent $orderEvent): void
    {
        OrderEventUpdated::dispatch('delete');
    }

    /**
     * Handle the OrderEvent "restored" event.
     */
    public function restored(OrderEvent $orderEvent): void
    {
        //
    }

    /**
     * Handle the OrderEvent "force deleted" event.
     */
    public function forceDeleted(OrderEvent $orderEvent): void
    {
        //
    }
}
