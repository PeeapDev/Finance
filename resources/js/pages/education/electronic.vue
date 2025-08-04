<template>
  <div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $t("Electronic Services") }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ name: 'home' }">{{ $t("Dashboard") }}</router-link>
              </li>
              <li class="breadcrumb-item active">{{ $t("Electronic") }}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Service Categories -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ digitalPlatforms.length }}</h3>
                <p>{{ $t("Digital Learning Platforms") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-laptop"></i>
              </div>
              <a href="#digital-platforms" class="small-box-footer">
                {{ $t("More info") }} <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ softwareLicenses.length }}</h3>
                <p>{{ $t("Software Licenses") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-key"></i>
              </div>
              <a href="#software-licenses" class="small-box-footer">
                {{ $t("More info") }} <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ hardwareOrders.length }}</h3>
                <p>{{ $t("Hardware Orders") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-desktop"></i>
              </div>
              <a href="#hardware-orders" class="small-box-footer">
                {{ $t("More info") }} <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>

        <!-- Digital Learning Platforms -->
        <div class="row" id="digital-platforms">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $t("Digital Learning Platforms") }}</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" @click="showAddPlatformModal">
                    <i class="fas fa-plus"></i> {{ $t("Add Platform") }}
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>{{ $t("Platform Name") }}</th>
                        <th>{{ $t("School") }}</th>
                        <th>{{ $t("Users") }}</th>
                        <th>{{ $t("Monthly Cost") }}</th>
                        <th>{{ $t("Status") }}</th>
                        <th>{{ $t("Expiry Date") }}</th>
                        <th>{{ $t("Actions") }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="platform in digitalPlatforms" :key="platform.id">
                        <td>{{ platform.name }}</td>
                        <td>{{ platform.school }}</td>
                        <td>{{ platform.users }}</td>
                        <td>${{ platform.monthly_cost }}</td>
                        <td>
                          <span :class="getStatusClass(platform.status)">
                            {{ platform.status }}
                          </span>
                        </td>
                        <td>{{ formatDate(platform.expiry_date) }}</td>
                        <td>
                          <button class="btn btn-sm btn-info" @click="renewSubscription(platform)">
                            <i class="fas fa-sync"></i>
                          </button>
                          <button class="btn btn-sm btn-warning ml-1" @click="editPlatform(platform)">
                            <i class="fas fa-edit"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Software Licenses -->
        <div class="row mt-4" id="software-licenses">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $t("Software Licenses") }}</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-success btn-sm" @click="showAddLicenseModal">
                    <i class="fas fa-plus"></i> {{ $t("Add License") }}
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>{{ $t("Software") }}</th>
                        <th>{{ $t("School") }}</th>
                        <th>{{ $t("License Type") }}</th>
                        <th>{{ $t("Seats") }}</th>
                        <th>{{ $t("Cost") }}</th>
                        <th>{{ $t("Status") }}</th>
                        <th>{{ $t("Expiry") }}</th>
                        <th>{{ $t("Actions") }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="license in softwareLicenses" :key="license.id">
                        <td>{{ license.software }}</td>
                        <td>{{ license.school }}</td>
                        <td>{{ license.license_type }}</td>
                        <td>{{ license.seats }}</td>
                        <td>${{ license.cost }}</td>
                        <td>
                          <span :class="getStatusClass(license.status)">
                            {{ license.status }}
                          </span>
                        </td>
                        <td>{{ formatDate(license.expiry_date) }}</td>
                        <td>
                          <button class="btn btn-sm btn-primary" @click="downloadLicense(license)">
                            <i class="fas fa-download"></i>
                          </button>
                          <button class="btn btn-sm btn-success ml-1" @click="renewLicense(license)">
                            <i class="fas fa-sync"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Hardware Orders -->
        <div class="row mt-4" id="hardware-orders">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $t("Hardware Orders") }}</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-warning btn-sm" @click="showAddHardwareModal">
                    <i class="fas fa-plus"></i> {{ $t("New Order") }}
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>{{ $t("Order #") }}</th>
                        <th>{{ $t("School") }}</th>
                        <th>{{ $t("Items") }}</th>
                        <th>{{ $t("Total Amount") }}</th>
                        <th>{{ $t("Status") }}</th>
                        <th>{{ $t("Order Date") }}</th>
                        <th>{{ $t("Actions") }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in hardwareOrders" :key="order.id">
                        <td>#{{ order.order_number }}</td>
                        <td>{{ order.school }}</td>
                        <td>{{ order.items }}</td>
                        <td>${{ order.total_amount }}</td>
                        <td>
                          <span :class="getStatusClass(order.status)">
                            {{ order.status }}
                          </span>
                        </td>
                        <td>{{ formatDate(order.order_date) }}</td>
                        <td>
                          <button class="btn btn-sm btn-info" @click="viewOrderDetails(order)">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button class="btn btn-sm btn-success ml-1" @click="updateOrderStatus(order)">
                            <i class="fas fa-edit"></i>
                          </button>
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
    </div>

    <!-- Add Platform Modal -->
    <div class="modal fade" id="platformModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $t("Add Digital Platform") }}</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="savePlatform">
              <div class="form-group">
                <label>{{ $t("Platform Name") }}</label>
                <select v-model="platformForm.name" class="form-control" required>
                  <option value="">{{ $t("Select Platform") }}</option>
                  <option value="Google Classroom">Google Classroom</option>
                  <option value="Microsoft Teams for Education">Microsoft Teams for Education</option>
                  <option value="Zoom for Education">Zoom for Education</option>
                  <option value="Khan Academy">Khan Academy</option>
                  <option value="Coursera for Schools">Coursera for Schools</option>
                </select>
              </div>
              <div class="form-group">
                <label>{{ $t("School") }}</label>
                <select v-model="platformForm.school" class="form-control" required>
                  <option value="">{{ $t("Select School") }}</option>
                  <option value="Sierra Leone Primary School">Sierra Leone Primary School</option>
                  <option value="Freetown Secondary School">Freetown Secondary School</option>
                  <option value="Bo Government School">Bo Government School</option>
                </select>
              </div>
              <div class="form-group">
                <label>{{ $t("Number of Users") }}</label>
                <input v-model="platformForm.users" type="number" class="form-control" required>
              </div>
              <div class="form-group">
                <label>{{ $t("Monthly Cost") }}</label>
                <input v-model="platformForm.monthly_cost" type="number" step="0.01" class="form-control" required>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $t("Cancel") }}</button>
            <button type="button" class="btn btn-primary" @click="savePlatform">{{ $t("Save") }}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Electronic",
  data() {
    return {
      digitalPlatforms: [
        {
          id: 1,
          name: "Google Classroom",
          school: "Sierra Leone Primary School",
          users: 250,
          monthly_cost: 125.00,
          status: "Active",
          expiry_date: "2024-12-31"
        },
        {
          id: 2,
          name: "Microsoft Teams for Education",
          school: "Freetown Secondary School",
          users: 180,
          monthly_cost: 90.00,
          status: "Active",
          expiry_date: "2024-11-30"
        },
        {
          id: 3,
          name: "Zoom for Education",
          school: "Bo Government School",
          users: 120,
          monthly_cost: 60.00,
          status: "Expired",
          expiry_date: "2024-01-15"
        }
      ],
      softwareLicenses: [
        {
          id: 1,
          software: "Microsoft Office 365 Education",
          school: "Sierra Leone Primary School",
          license_type: "Annual",
          seats: 250,
          cost: 1250.00,
          status: "Active",
          expiry_date: "2024-12-31"
        },
        {
          id: 2,
          software: "Adobe Creative Suite",
          school: "Freetown Secondary School",
          license_type: "Monthly",
          seats: 50,
          cost: 250.00,
          status: "Active",
          expiry_date: "2024-02-28"
        },
        {
          id: 3,
          software: "Antivirus Enterprise",
          school: "Bo Government School",
          license_type: "Annual",
          seats: 100,
          cost: 300.00,
          status: "Expiring Soon",
          expiry_date: "2024-02-15"
        }
      ],
      hardwareOrders: [
        {
          id: 1,
          order_number: "HW001",
          school: "Sierra Leone Primary School",
          items: "10x Tablets, 5x Projectors",
          total_amount: 5000.00,
          status: "Delivered",
          order_date: "2024-01-10"
        },
        {
          id: 2,
          order_number: "HW002",
          school: "Freetown Secondary School",
          items: "20x Laptops, 2x Smart Boards",
          total_amount: 15000.00,
          status: "In Transit",
          order_date: "2024-01-20"
        },
        {
          id: 3,
          order_number: "HW003",
          school: "Bo Government School",
          items: "15x Desktop Computers",
          total_amount: 7500.00,
          status: "Processing",
          order_date: "2024-01-25"
        }
      ],
      platformForm: {
        name: "",
        school: "",
        users: 0,
        monthly_cost: 0
      }
    };
  },
  methods: {
    showAddPlatformModal() {
      this.platformForm = {
        name: "",
        school: "",
        users: 0,
        monthly_cost: 0
      };
      $("#platformModal").modal("show");
    },
    showAddLicenseModal() {
      this.$toast.info("License management modal would open here");
    },
    showAddHardwareModal() {
      this.$toast.info("Hardware order modal would open here");
    },
    savePlatform() {
      const newPlatform = {
        ...this.platformForm,
        id: Date.now(),
        status: "Active",
        expiry_date: new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toISOString().split('T')[0]
      };
      this.digitalPlatforms.push(newPlatform);
      $("#platformModal").modal("hide");
      this.$toast.success("Digital platform added successfully!");
    },
    renewSubscription(platform) {
      platform.status = "Active";
      platform.expiry_date = new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toISOString().split('T')[0];
      this.$toast.success(`${platform.name} subscription renewed successfully!`);
    },
    editPlatform(platform) {
      this.$toast.info(`Edit ${platform.name} - Feature coming soon`);
    },
    downloadLicense(license) {
      this.$toast.success(`Downloading ${license.software} license file...`);
    },
    renewLicense(license) {
      license.status = "Active";
      license.expiry_date = new Date(Date.now() + 365 * 24 * 60 * 60 * 1000).toISOString().split('T')[0];
      this.$toast.success(`${license.software} license renewed successfully!`);
    },
    viewOrderDetails(order) {
      alert(`Order Details:\nOrder #: ${order.order_number}\nSchool: ${order.school}\nItems: ${order.items}\nTotal: $${order.total_amount}\nStatus: ${order.status}`);
    },
    updateOrderStatus(order) {
      const statuses = ['Processing', 'Confirmed', 'In Transit', 'Delivered', 'Cancelled'];
      const currentIndex = statuses.indexOf(order.status);
      const nextStatus = statuses[(currentIndex + 1) % statuses.length];
      order.status = nextStatus;
      this.$toast.success(`Order status updated to ${nextStatus}`);
    },
    getStatusClass(status) {
      return {
        'badge badge-success': status === 'Active' || status === 'Delivered',
        'badge badge-warning': status === 'Expiring Soon' || status === 'Processing' || status === 'In Transit',
        'badge badge-danger': status === 'Expired' || status === 'Cancelled',
        'badge badge-info': status === 'Confirmed'
      };
    },
    formatDate(date) {
      return new Date(date).toLocaleDateString();
    }
  }
};
</script>

<style scoped>
.small-box {
  border-radius: 0.25rem;
  box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
  display: block;
  margin-bottom: 20px;
  position: relative;
}

.small-box > .inner {
  padding: 10px;
}

.small-box > .small-box-footer {
  background: rgba(0,0,0,.1);
  color: rgba(255,255,255,.8);
  display: block;
  padding: 3px 0;
  position: relative;
  text-align: center;
  text-decoration: none;
  z-index: 10;
}

.small-box .icon {
  color: rgba(0,0,0,.15);
  z-index: 0;
}

.small-box .icon > i {
  font-size: 70px;
  position: absolute;
  right: 15px;
  top: 15px;
  transition: all .3s linear;
}
</style>
