<?php

namespace MGS\StoreLocator\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface StoreApiRepositoryInterface
{

  /**
     Lấy key của admin Role Administrators hoặc admin có Role Rources Store Locator->Get Stores
   http://127.0.0.1/magento/rest/V1/integration/admin/token?username=admin&password=pass

     - Để lấy toàn bộ store

   http://127.0.0.1/magento/rest/getallstore/

     - Tạo API để lấy về các store được lưu trong bảng của extension StoreLocator (10 kết quả), truyền thêm param để lấy thêm cho các page khác (p=2, p=3...)

          + store[page] = Số trang;
          Không nhập store[page], store[page]page = 1;

   * http://127.0.0.1/getBySearchCriteria/

        + searchCriteria[currentPage] = Số trang
            Không nhập loi
        +setItemsPerPage: searchCriteria[pageSize] = length
       EX:     http://127.0.0.1/getBySearchCriteria/?searchCriteria[currentPage]=1&searchCriteria[pageSize]=20
   * Url bên trên thực hiên lấy 20 store bắt đầu từ trang 1

  http://127.0.0.1/magento/rest/getstore/?store[page]=1

       - Lấy về các stores dựa theo các params truyền lên (country, state, city, zipcode)
          + store[country] = country;
          + store[state] = state;
          + store[city] = city;
          + store[zipcode] = zipcode;
       Muốn lấy về store theo param nào thì thêm param đó vào url sau dấu &;
       EX
          http://127.0.0.1/magento/rest/getstore/?store[page]=1&store[country]=VN

          http://127.0.0.1/magento/rest/getstore/?store[page]=1&store[country]=VN&store[city]=Hà Nội

   http://127.0.0.1/getBySearchCriteria/
        - Lấy về các stores dựa theo các params truyền lên (country, state, city, zipcode,name)
  ?searchCriteria[filter_groups][0][filters][0][field]=name&
  searchCriteria[filter_groups][0][filters][0][value]=%25lqtam%25&
  searchCriteria[filter_groups][0][filters][0][condition_type]=like&
  searchCriteria[filter_groups][0][filters][1][field]=name&
  searchCriteria[filter_groups][0][filters][1][value]=%25store%25&
  searchCriteria[filter_groups][0][filters][1][condition_type]=like

   * Tren lay tat ca cac store co name chua 'lqtam' or 'store'
   *Tim hieu them: https://devdocs.magento.com/guides/v2.4/rest/performing-searches.html
   *
       - Lấy về các stores dựa theo các params (location, radius)

          + store[lat] = lat; Vĩ độ
          + store[lng] = lng; Kinh độ
          + store[radius] = radius;
        EX
          http://127.0.0.1/magento/rest/getstore/?store[page]=1&store[country]=VN&store[lat]=21.019914

      Phải có 1 params store trên url khi get store có filter
   */

    /**
     * GET for GET api
     *
     * @param string[] $store
     * @return null
     */

    public function getStore(array $store);

    /**
     * GET for GET api
     * @param null
     * @return null
     */

    public function getALLStore();

    /**
     * Get store list by search criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return  \MGS\StoreLocator\Api\Data\StoreSearchResultsInterface
     */
    public function getStoreBySearchCriteria(SearchCriteriaInterface $searchCriteria);
}
