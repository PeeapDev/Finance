<template>
    <div class="card settings-card no-print">
        <div class="card-body">
            <ul class="nav flex-column nav-pills m-1">
                <li class="nav-item">
                    <router-link :to="{ name: 'Settings' }" class="nav-link thumb">
                        {{ $t("Instructions") }}
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'woocommerce.apiSettings' }" class="nav-link thumb">
                        {{ $t("API Settings") }}
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'woocommerce.productSyncSettings' }" class="nav-link thumb">
                        {{ $t("Product Sync Settings") }}
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'woocommerce.orderSyncSettings' }" class="nav-link thumb">
                        {{ $t("Order Sync Settings") }}
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
</template>
  
  
<script>
export default {
    name: "WoocommerceSidebar",
};
</script>
  