import store from '~/store'

export default async (to, from, next) => {
    const isWoocommerceInstall = store.state.operations.appInfo.isWoocommerceInstall
    const isWoocommerceActive = store.state.operations.appInfo.isWoocommerceActive

    if (isWoocommerceActive == 'false') {
        return next({ name: 'woocommerce-addon-not-active' })
    }

    return next()
}
