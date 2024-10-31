<?php

namespace OctolizeShippingCostOnProductPageVendor\Octolize\ShippingExtensions\Tracker;

use OctolizeShippingCostOnProductPageVendor\Octolize\ShippingExtensions\Tracker\DataProvider\ShippingExtensionsDataProvider;
use OctolizeShippingCostOnProductPageVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use OctolizeShippingCostOnProductPageVendor\WPDesk_Tracker;
/**
 * .
 */
class Tracker implements Hookable
{
    /**
     * @var ViewPageTracker
     */
    private $view_page_tracker;
    /**
     * @param ViewPageTracker $view_page_tracker
     */
    public function __construct(ViewPageTracker $view_page_tracker)
    {
        $this->view_page_tracker = $view_page_tracker;
    }
    /**
     * Hooks.
     */
    public function hooks(): void
    {
        add_action('wpdesk_tracker_started', [$this, 'register_tracker_provider']);
    }
    public function register_tracker_provider($tracker): void
    {
        if ($tracker instanceof WPDesk_Tracker) {
            $tracker->add_data_provider(new ShippingExtensionsDataProvider($this->view_page_tracker));
        }
    }
}
