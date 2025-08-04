<template>
  <div>
    <!-- breadcrumbs Start -->
    <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent" />
    <!-- breadcrumbs end -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card custom-card w-100">
          <div class="card-header setings-header">
            <div class="col-xl-4 col-4">
              <h3 class="card-title">
                {{ $t("Non Zero Inventory") }}
              </h3>
            </div>
            <div class="col-xl-8 col-8 float-right text-right">
              <div class="btn-group c-w-100">
                <a
                  @click="refreshTable()"
                  href="#"
                  v-tooltip="$t('Refresh')"
                  class="btn btn-success"
                >
                  <i class="fas fa-sync"></i>
                </a>
                <a :href="exportUrl" v-tooltip="$t('Export to Excel')" class="btn btn-info">
                  <i class="fa fa-arrow-circle-down"></i>
                </a>
                <a
                  href="/non-zero-inventory/pdf"
                  v-tooltip="$t('Export to PDF')"
                  class="btn btn-secondary"
                >
                  <i class="fas fa-download"></i>
                </a>
                <a
                  @click="print"
                  v-tooltip="$t('Print Table')"
                  class="btn btn-info"
                >
                  <i class="fas fa-print"></i>
                </a>
                <router-link
                  v-if="$can('product-create')"
                  :to="{ name: 'products.create' }"
                  class="btn btn-primary"
                >
                  {{ $t("Create") }}
                  <i class="fas fa-plus-circle d-none d-sm-inline-block" />
                </router-link>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body position-relative">
            <div class="row">
              <div class="col-md-3 col-xl-4 mb-2">
                <search
                  v-model="query"
                  @reset-pagination="resetPagination()"
                  @reload="reload"
                />
              </div>
              <div class="card-tools col-md-3 col-xl-2 mb-2">
                <select
                  v-model="filterType"
                  class="form-control"
                  id="filterType"
                  name="filterType"
                >
                  <option value="default" selected>
                    {{ $t("All") }}
                  </option>
                  <option value="active">
                    {{ $t("Filter By Active Status") }}
                  </option>
                  <option value="inactive">
                    {{ $t("Filter By Inactive Status") }}
                  </option>
                </select>
              </div>
            </div>
            <table-loading v-show="loading" />
            <div class="table-responsive table-custom mt-3" id="printMe">
              <table class="table">
                <thead>
                  <tr>
                    <th>{{ $t("SL") }}</th>
                    <th>{{ $t("Image") }}</th>
                    <th>{{ $t("Code") }}</th>
                    <th>{{ $t("Name") }}</th>
                    <th>{{ $t("Item Model") }}</th>
                    <th>{{ $t("Stock") }}</th>
                    <th>{{ $t("Avg. Purchase Price") }}</th>
                    <th>{{ $t("Selling Price") }}</th>
                    <th>{{ $t("Inventory Value") }}</th>
                    <th>{{ $t("Status") }}</th>
                    <th class="no-print">{{ $t("Action") }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-show="items.length" v-for="(data, i) in items" :key="i">
                    <td>
                      <span v-if="pagination && pagination.current_page > 1">
                        {{
                          pagination.per_page * (pagination.current_page - 1) +
                          (i + 1)
                        }}
                      </span>
                      <span v-else>{{ i + 1 }}</span>
                    </td>
                    <td>
                      <a
                        v-if="data.image"
                        href="#"
                        id="show-modal"
                        @click="previewModal(data.image)"
                      >
                        <img
                          :src="data.image"
                          class="rounded preview-sm"
                          loading="lazy"
                        />
                      </a>
                      <div v-else class="bg-secondary rounded no-preview-sm">
                        <small>{{ $t("No Preview") }}</small>
                      </div>
                    </td>
                    <td>{{ data.code | withPrefix(prefix) }}</td>
                    <td>
                      <router-link
                        :to="{
                          name: 'products.show',
                          params: { slug: data.slug },
                        }"
                      >
                        {{ data.name }}
                      </router-link>
                    </td>
                    <td>{{ data.itemModel }}</td>
                    <td>
                      <span
                        v-if="data.availableQty < data.alertQty"
                        v-tooltip="$t('Stock is less than alert qty!')"
                        class="badge badge-danger p-2"
                      >
                        <i class="fas fa-exclamation"></i>
                      </span>
                      <span v-if="data.itemUnit">
                        {{ data.availableQty }} {{ data.itemUnit.code }}
                      </span>
                    </td>
                    <td>{{ data.avgPurchasePrice | withCurrency }}</td>
                    <td>
                      <span v-if="data.discount > 0">
                        <del>{{ data.regularPrice | withCurrency }}</del
                        >{{ data.sellingPrice | withCurrency }} ({{
                          data.discount
                        }}%)
                      </span>
                      <span v-else
                        >{{ data.regularPrice | withCurrency }}
                      </span>
                    </td>
                    <td>
                      {{
                        (data.avgPurchasePrice * data.availableQty)
                          | withCurrency
                      }}
                    </td>
                    <td>
                      <span v-if="data.status === 1" class="badge bg-success">{{
                        $t("Active")
                      }}</span>
                      <span v-else class="badge bg-danger">{{
                        $t("Inactive")
                      }}</span>
                    </td>
                    <td class="text-right no-print">
                      <div class="btn-group">
                        <router-link
                          v-if="$can('inventory-history')"
                          v-tooltip="$t('Inventory History')"
                          :to="{
                            name: 'inventory.history',
                            params: { slug: data.slug },
                          }"
                          class="btn btn-primary btn-sm"
                        >
                          <i class="fas fa-history" />
                        </router-link>
                      </div>
                    </td>
                  </tr>
                  <tr v-show="!loading && !items.length">
                    <td colspan="11">
                      <EmptyTable />
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <div class="dtable-footer">
              <div class="form-group row display-per-page">
                <label>{{ $t("Per Page") }} </label>
                <div>
                  <select
                    @change="updatePerPager"
                    v-model="perPage"
                    class="form-control form-control-sm ml-1"
                  >
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                  </select>
                </div>
              </div>
              <!-- pagination-start -->
              <pagination
                v-if="pagination && pagination.last_page > 1"
                :pagination="pagination"
                :offset="5"
                class="justify-flex-end"
                @paginate="paginate"
              />
              <!-- pagination-end -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <Modal v-if="showModal" @close="previewModal()">
      <h5 slot="header">{{ $t("Attached Image Preview") }}</h5>
      <div class="w-100" slot="body">
        <img :src="imagePath" class="rounded img-fluid" loading="lazy" />
      </div>
    </Modal>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  middleware: ["auth", "check-permissions"],
  metaInfo() {
    return { title: this.$t("Non Zero Inventory") };
  },
  data: () => ({
    breadcrumbsCurrent: "Non Zero Inventory",
    breadcrumbs: [
      {
        name: "Dashboard",
        url: "home",
      },
      {
        name: "Products",
        url: "products.index",
      },
      {
        name: "Non Zero Inventory",
        url: "",
      },
    ],
    query: "",
    filterType: "default",
    showModal: false,
    perPage: 10,
    prefix: "",
  }),
  // Map Getters
  computed: {
    ...mapGetters("operations", ["items", "loading", "pagination", "appInfo"]),
    exportUrl() {
      // Create a dynamic export URL with query parameters
      return `/non-zero-inventory/export/excel?term=${this.query}`;
    },
  },
  watch: {
    // watch search data
    query: function (newQ, oldQ) {
      if (newQ === "") {
        this.getData();
      } else {
        this.searchData();
      }
    },
    filterType: function (newQ, oldQ) {
      if (newQ === "") {
        this.getData();
      } else {
        this.searchData();
      }
    },
  },
  created() {
    this.getData();
    this.prefix = this.appInfo.productPrefix;
  },
  methods: {
    // update per page count
    updatePerPager() {
      this.pagination.current_page = 1;
      this.query === "" ? this.getData() : this.searchData();
    },
    // get data
    async getData() {
      this.$store.state.operations.loading = true;
      let currentPage = this.pagination ? this.pagination.current_page : 1;
      await this.$store.dispatch("operations/fetchData", {
        path: "/api/non-zero-inventory?page=",
        currentPage: currentPage + "&perPage=" + this.perPage,
      });
    },

    // Pagination
    async paginate() {
      this.query === "" ? this.getData() : this.searchData();
    },

    // Reset pagination
    async resetPagination() {
      this.pagination.current_page = 1;
    },

    // search data
    async searchData() {
      this.$store.state.operations.loading = true;
      let currentPage = this.pagination ? this.pagination.current_page : 1;
      await this.$store.dispatch("operations/searchDataWithFilterType", {
        path: "/api/non-zero-inventory/search",
        term: this.query,
        currentPage: currentPage + "&perPage=" + this.perPage,
        filterType: this.filterType,
      });
    },

    // Reload after search
    async reload() {
      this.query = "";
      this.filterType = "default";
    },

    // display modal
    previewModal(image) {
      this.imagePath = image;
      if (this.showModal) {
        return (this.showModal = false);
      }
      return (this.showModal = true);
    },

    // print table
    async print() {
      await this.$htmlToPaper("printMe");
    },

    refreshTable() {
      this.query = "";
      this.filterType = "default";
      this.query === "" ? this.getData() : this.searchData();
    },
  },
};
</script>
