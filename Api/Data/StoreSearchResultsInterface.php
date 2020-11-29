<?php

namespace MGS\StoreLocator\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface StoreSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * Get attributes list.
     *
     * @return \MGS\StoreLocator\Api\Data\StoreInterface[]
     */
    public function getItems();

    /**
     * Set attributes list.
     *
     * @param \MGS\StoreLocator\Api\Data\StoreInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
