<?php

namespace MGS\StoreLocator\Model\Api;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use MGS\StoreLocator\Model\StoreFactory;

class StoreApiRepository
{
    protected $_storeFactory;

    private $_store;

    private $_collection;

    /** @var \MGS\StoreLocator\Api\Data\StoreSearchResultsInterfaceFactory $searchResultsFactory */
    private $searchResultsFactory;

    /** @var CollectionProcessorInterface  */
    private $collectionProcessor;

    public function __construct(
        StoreFactory $storeFactory,
        CollectionProcessorInterface $collectionProcessor,
        \MGS\StoreLocator\Api\Data\StoreSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->_storeFactory = $storeFactory;
    }

    public function getStore(array $store)
    {
        $this->_store = $store;
        $page = isset($this->_store['page']) ? $this->_store['page'] : 1;

        $collection = $this->_storeFactory->create()->getCollection()
            ->setPageSize(10)
            ->setCurPage($page);

        $this->_collection = $collection;

        $this->toFilterLike('country');
        $this->toFilterLike('state');
        $this->toFilterLike('city');
        $this->toFilterEq('zipcode');

        $this->toFilterEq('lat');
        $this->toFilterEq('lng');
        $this->toFilterEq('radius');

        return $collection->getData();
    }

    public function getALLStore()
    {
        $collection = $this->_storeFactory->create()->getCollection();
        return $collection->getData();
    }

    public function toFilterLike(String $field)
    {
        if (isset($this->_store[$field])) {
            $this->_collection->addFieldToFilter($field, ['like' => '%' . $this->_store[$field] . '%']);
        }
    }

    public function toFilterEq(String $field)
    {
        if (isset($this->_store[$field])) {
            $this->_collection->addFieldToFilter($field, ['eq' => $this->_store[$field]]);
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return \MGS\StoreLocator\Api\Data\StoreSearchResultsInterface
     */
    public function getStoreBySearchCriteria(SearchCriteriaInterface $searchCriteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        $collection = $this->_storeFactory->create()->getCollection();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults->setTotalCount($collection->getSize());

        $currentPage = $searchCriteria->getCurrentPage() ?: 1;
        $pageSize = $searchCriteria->getPageSize() ?: 10;
        $collection->setCurPage($currentPage);
        $collection->setPageSize($pageSize);
        $searchResults->setItems($collection->getData());

        return $searchResults;
    }
}
