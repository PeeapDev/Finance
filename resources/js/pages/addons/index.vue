<template>
    <div class="mb-50">
        <!-- breadcrumbs Start -->
        <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent" />
        <!-- breadcrumbs end -->

        <!-- Modal -->
        <div class="modal fade" id="wooCommerceAddonInstallModel" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form role="form" @submit.prevent="installWooCommerce" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ $t("Install WooCommerce Addon") }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-md-10">
                                <label for="file">{{ $t("WooCommerce File") }}</label>
                                <div class="custom-file">
                                    <input id="file" type="file" class="custom-file-input" name="file" ref="fileInput"
                                        @change="onFileChange" />
                                    <label class="custom-file-label" for="file">{{ selectedFileName ||
            $t("Choose file") }}</label>
                                </div>
                                <has-error :form="form" field="file" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $t("Close") }}</button>
                            <v-button :loading="form.busy" class="btn btn-primary">
                                {{ $t("Install") }}
                            </v-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>




        <div class="row">
            <div class="col-lg-12">
                <div class="card custom-card w-100">
                    <div class="card-header setings-header">
                        <div class="col-xl-4 col-4">
                            <h3 class="card-title">
                                {{ $t("Addons") }}
                            </h3>
                        </div>
                        <div class="col-xl-8 col-8 float-right text-right">
                            <div class="btn-group c-w-100">
                                <a @click="refreshTable()" href="#" v-tooltip="$t('Refresh')" class="btn btn-success">
                                    <i class="fas fa-sync"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <table-loading v-show="loading" />
                    <div class="card-body position-relative">
                        <div class="table-responsive table-custom mt-3">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ $t("SL") }}</th>
                                        <th>{{ $t("Name") }}</th>
                                        <th>{{ $t("Status") }}</th>
                                        <th class="text-right no-print">
                                            {{ $t("Action") }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 1 </td>
                                        <td>{{ $t("Acculance WooCommerce") }}</td>
                                        <td>
                                            <span
                                                v-if="this.isWoocommerceInstall == 'true' && this.isWoocommerceActive == 'true'"
                                                class="badge bg-success">{{ $t("Active") }}</span>
                                            <span
                                                v-if="this.isWoocommerceInstall == 'true' && this.isWoocommerceActive == 'false'"
                                                class="badge bg-danger">{{ $t("Disable") }}</span>
                                            <span
                                                v-if="this.isWoocommerceInstall == 'false' && this.isWoocommerceActive == 'false'"
                                                class="badge bg-info">{{ $t("Not installed yet") }}</span>
                                        </td>
                                        <td class="text-right no-print">
                                            <div class="btn-group">
                                                <button
                                                    v-if="this.isWoocommerceInstall == 'false' && this.isWoocommerceActive == 'false'"
                                                    v-tooltip="$t('Install')" type="button" class="btn btn-primary"
                                                    data-toggle="modal" data-target="#wooCommerceAddonInstallModel">
                                                    <i class="fa fa-plug" aria-hidden="true"></i>
                                                </button>
                                                <a v-if="this.isWoocommerceInstall == 'true' && this.isWoocommerceActive == 'true'"
                                                    v-tooltip="$t('Disable')" href="#" class="btn btn-warning btn-sm"
                                                    @click="manageAddon('disable')">
                                                    <i class="fas fa-ban" />
                                                </a>
                                                <a v-if="this.isWoocommerceInstall == 'true' && this.isWoocommerceActive == 'false'"
                                                    v-tooltip="$t('Enable')" href="#" class="btn btn-info btn-sm"
                                                    @click="manageAddon('enable')">
                                                    <i class="fa fa-rocket" aria-hidden="true"></i>
                                                </a>
                                                <a v-if="this.isWoocommerceInstall == 'true'"
                                                    v-tooltip="$t('Uninstall')" href="#"
                                                    class="btn btn-danger btn-sm" @click="manageAddon('uninstall')">
                                                    <i class="fas fa-trash" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import Form from "vform";
import axios from "axios";

export default {
    middleware: ["auth", "check-permissions"],
    metaInfo() {
        return { title: this.$t("Addons") };
    },
    data: () => ({
        breadcrumbsCurrent: "Addons",
        breadcrumbs: [
            {
                name: "Dashboard",
                url: "home",
            },
            {
                name: "Addons",
                url: "",
            },
        ],

        form: new Form({
            file: "",
        }),
        selectedFileName: "",
        isWoocommerceActive: "",
        isWoocommerceInstall: "",

    }),
    // Map Getters
    computed: {
        ...mapGetters("operations", ["loading", "appInfo"]),
    },
    created() {
        this.getAppInfo();
    },
    methods: {

        getAppInfo() {
            this.$store.state.operations.loading = true;
            axios.get('api/general-settings')
                .then(response => {
                    this.isWoocommerceActive = response.data.isWoocommerceActive;
                    this.isWoocommerceInstall = response.data.isWoocommerceInstall;
                })
            this.$store.state.operations.loading = false;
            this.$store.dispatch('operations/fetchSettingData');
        },

        installWooCommerce() {
            this.form
                .post(window.location.origin + "/api/install/woocommerce")
                .then(() => {
                    this.getAppInfo();
                    toast.fire({
                        type: "success",
                        title: this.$t("Addon Installed Successfully"),
                    });
                    // Close the modal
                    $('#wooCommerceAddonInstallModel').modal('hide');
                })
                .catch(() => {
                    toast.fire({ type: "error", title: this.$t("Opps...something went wrong") });
                });
        },

        manageAddon(action) {
            let text;
            if (action == 'disable') {
                text = 'Addon will be disabled!';
            }
            if (action == 'enable') {
                text = 'Addon will be enabled!';
            }
            Swal.fire({
                title: this.$t("Are you sure?"),
                text: this.$t(text),
                type: "warning",
                showCancelButton: true,
                confirmButtonText: this.$t("Are you sure?"),
            }).then((result) => {
                // Send request to the server
                if (result.value) {
                    axios.post('api/manage/woocommerce/addon', { action: action })
                        .then(response => {
                            toast.fire({
                                type: "success",
                                title: this.$t("Action performed successfully!"),
                            });
                            this.getAppInfo();
                        })
                        .catch(error => {
                            toast.fire({ type: "error", title: this.$t("Opps...something went wrong") });
                        });
                }
            });
        },

        onFileChange(event) {
            let file = event.target.files[0];
            this.form.file = file;
            this.selectedFileName = event.target.files[0].name;
        },

        // refresh table
        refreshTable() {
            this.getAppInfo();
        },
    },
};
</script>