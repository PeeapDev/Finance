<template>
    <div>
      <!-- breadcrumbs Start -->
      <breadcrumbs :items="breadcrumbs" :current="breadcrumbsCurrent" />
      <!-- breadcrumbs end -->
      <div class="col-lg-12 col-xl-8 offset-xl-2 h-100">
        <div class="row align-items-center h-100">
          <div class="text-center w-100 mt-5 box-wrapper">
            <h1>
              <code>{{ $t('Addon Not Active') }}</code>
            </h1>
            <hr />
            <h3>{{ $t('Please Activate The Addon') }}</h3>
            <h3>🚫🚫🚫🚫</h3>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    middleware: 'auth',
    metaInfo() {
      return { title: this.$t('Addon Not Active') }
    },
  
    data: () => ({
      breadcrumbsCurrent: 'Addon Not Active',
      breadcrumbs: [
        {
          name: 'Dashboard',
          url: 'home',
        },
        {
          name: 'Addon Not Active',
          url: '',
        },
      ],
    }),
  }
  </script>
  
  <style>
  h1 {
    color: red;
    font-size: 5em;
  }
  
  h6 {
    color: red;
    text-decoration: underline;
  }
  
  hr {
    margin: auto;
    width: 50%;
  }
  </style>
  