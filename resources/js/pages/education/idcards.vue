<template>
  <div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $t("ID Cards Management") }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ name: 'home' }">{{ $t("Dashboard") }}</router-link>
              </li>
              <li class="breadcrumb-item active">{{ $t("ID Cards") }}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $t("ID Card Orders") }}</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" @click="showAddOrderModal">
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
                        <th>{{ $t("Card Type") }}</th>
                        <th>{{ $t("Quantity") }}</th>
                        <th>{{ $t("Unit Price") }}</th>
                        <th>{{ $t("Total Amount") }}</th>
                        <th>{{ $t("Status") }}</th>
                        <th>{{ $t("Order Date") }}</th>
                        <th>{{ $t("Actions") }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in orders" :key="order.id" class="clickable-row" @click="viewOrderDetail(order.id)">
                        <td>
                          <router-link :to="{ name: 'education.idcard-detail', params: { id: order.id } }" class="text-primary font-weight-bold">
                            #{{ order.order_number }}
                          </router-link>
                        </td>
                        <td>{{ order.school_name || order.customer_name }}</td>
                        <td>{{ order.card_type }}</td>
                        <td>{{ order.quantity }}</td>
                        <td>{{ (order.unit_price || 0) | withCurrency }}</td>
                        <td>{{ (order.total_amount || 0) | withCurrency }}</td>
                        <td>
                          <span class="badge" :class="getStatusClass(order.status)">
                            {{ order.status }}
                          </span>
                        </td>
                        <td>{{ formatDate(order.order_date) }}</td>
                        <td @click.stop>
                          <button class="btn btn-sm btn-primary mr-1" @click="viewOrderDetail(order.id)" title="View Details">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button class="btn btn-sm btn-success mr-1" @click="printCards(order)" v-if="order.status === 'completed'" title="Print Cards">
                            <i class="fas fa-print"></i>
                          </button>
                          <button class="btn btn-sm btn-warning" @click="updateStatus(order)" title="Update Status">
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

        <!-- Statistics Cards -->
        <div class="row mt-4">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ totalOrders }}</h3>
                <p>{{ $t("Total Orders") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-id-card"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ completedOrders }}</h3>
                <p>{{ $t("Completed Orders") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-check-circle"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ totalCards }}</h3>
                <p>{{ $t("Total Cards") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-credit-card"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>${{ totalRevenue }}</h3>
                <p>{{ $t("Total Revenue") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-dollar-sign"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Card Types -->
        <div class="row mt-4">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $t("Available Card Types") }}</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-4" v-for="cardType in cardTypes" :key="cardType.id">
                    <div class="card card-outline card-primary">
                      <div class="card-header">
                        <h3 class="card-title">{{ cardType.name }}</h3>
                      </div>
                      <div class="card-body">
                        <p><strong>{{ $t("Price") }}:</strong> ${{ cardType.price }}</p>
                        <p><strong>{{ $t("Material") }}:</strong> {{ cardType.material }}</p>
                        <p><strong>{{ $t("Features") }}:</strong> {{ cardType.features }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Order Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $t("New ID Card Order") }}</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="saveOrder">
              <div class="form-group">
                <label>{{ $t("School") }}</label>
                <select v-model="orderForm.school_id" class="form-control" required>
                  <option value="">{{ $t("Select School") }}</option>
                  <option v-for="school in schools" :key="school.id" :value="school.id">
                    {{ school.name }}
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label>{{ $t("Card Type") }}</label>
                <select v-model="orderForm.card_type" class="form-control" required @change="updatePrice">
                  <option value="">{{ $t("Select Card Type") }}</option>
                  <option v-for="cardType in cardTypes" :key="cardType.id" :value="cardType.name">
                    {{ cardType.name }} - ${{ cardType.price }}
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label>{{ $t("Quantity") }}</label>
                <input v-model="orderForm.quantity" type="number" class="form-control" required @input="calculateTotal">
              </div>
              <div class="form-group">
                <label>{{ $t("Unit Price") }}</label>
                <input v-model="orderForm.unit_price" type="number" step="0.01" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label>{{ $t("Total Amount") }}</label>
                <input v-model="orderForm.total_amount" type="number" step="0.01" class="form-control" readonly>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $t("Cancel") }}</button>
            <button type="button" class="btn btn-primary" @click="saveOrder">{{ $t("Place Order") }}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: "IDCards",
  data() {
    return {
      schools: [],
      orders: [
        {
          id: 1,
          order_number: "ORD001",
          school_name: "Sierra Leone Primary School",
          card_type: "Student ID - Basic",
          quantity: 250,
          unit_price: 2.50,
          total_amount: 625.00,
          status: "Completed",
          order_date: "2024-01-15"
        },
        {
          id: 2,
          order_number: "ORD002",
          school_name: "Freetown Secondary School",
          card_type: "Student ID - Premium",
          quantity: 180,
          unit_price: 3.50,
          total_amount: 630.00,
          status: "In Progress",
          order_date: "2024-01-20"
        },
        {
          id: 3,
          order_number: "ORD003",
          school_name: "Bo Government School",
          card_type: "Staff ID - Premium",
          quantity: 25,
          unit_price: 4.00,
          total_amount: 100.00,
          status: "Approved",
          order_date: "2024-01-22"
        }
      ],
      cardTypes: [
        {
          id: 1,
          name: "Student ID - Basic",
          price: 2.50,
          material: "PVC Plastic",
          features: "Photo, Name, ID Number, School Logo"
        },
        {
          id: 2,
          name: "Student ID - Premium",
          price: 3.50,
          material: "PVC with Magnetic Strip",
          features: "Photo, Name, ID Number, School Logo, Magnetic Strip, Barcode"
        },
        {
          id: 3,
          name: "Staff ID - Basic",
          price: 3.00,
          material: "PVC Plastic",
          features: "Photo, Name, Position, ID Number, School Logo"
        },
        {
          id: 4,
          name: "Staff ID - Premium",
          price: 4.00,
          material: "PVC with RFID Chip",
          features: "Photo, Name, Position, ID Number, School Logo, RFID Chip, Access Control"
        }
      ],
      orderForm: {
        school_id: "",
        card_type: "",
        quantity: 0,
        unit_price: 0,
        total_amount: 0
      }
    };
  },
  computed: {
    totalOrders() {
      return this.orders.length;
    },
    completedOrders() {
      return this.orders.filter(order => order.status === 'Completed').length;
    },
    totalCards() {
      return this.orders.reduce((total, order) => total + order.quantity, 0);
    },
    totalRevenue() {
      return this.orders
        .filter(order => order.status === 'Completed')
        .reduce((total, order) => total + order.total_amount, 0)
        .toFixed(2);
    }
  },
  created() {
    this.fetchSchools();
  },
  methods: {
    async fetchSchools() {
      try {
        const response = await axios.get('/api/education/schools');
        this.schools = response.data.data || response.data;
      } catch (error) {
        console.error('Error fetching schools:', error);
        this.$toast.error('Failed to load schools');
      }
    },
    showAddOrderModal() {
      this.orderForm = {
        school_id: "",
        card_type: "",
        quantity: 0,
        unit_price: 0,
        total_amount: 0
      };
      $("#orderModal").modal("show");
    },
    updatePrice() {
      const selectedCardType = this.cardTypes.find(ct => ct.name === this.orderForm.card_type);
      if (selectedCardType) {
        this.orderForm.unit_price = selectedCardType.price;
        this.calculateTotal();
      }
    },
    calculateTotal() {
      this.orderForm.total_amount = (this.orderForm.quantity * this.orderForm.unit_price).toFixed(2);
    },
    saveOrder() {
      const newOrder = {
        ...this.orderForm,
        id: Date.now(),
        order_number: `ORD${String(this.orders.length + 1).padStart(3, '0')}`,
        status: "Pending",
        order_date: new Date().toISOString().split('T')[0]
      };
      this.orders.push(newOrder);
      $("#orderModal").modal("hide");
      this.$toast.success("Order placed successfully!");
    },
    viewOrder(order) {
      alert(`Order Details:\nOrder #: ${order.order_number}\nSchool: ${order.school_name}\nCard Type: ${order.card_type}\nQuantity: ${order.quantity}\nTotal: $${order.total_amount}`);
    },
    viewOrderDetail(orderId) {
      this.$router.push({ name: 'education.idcard-detail', params: { id: orderId } });
    },
    printCards(order) {
      this.$toast.success(`Printing ${order.quantity} cards for ${order.school_name}...`);
    },
    updateStatus(order) {
      const statuses = ['pending', 'processing', 'completed', 'cancelled'];
      const currentIndex = statuses.indexOf(order.status.toLowerCase());
      const nextStatus = statuses[(currentIndex + 1) % statuses.length];
      order.status = nextStatus;
      this.$toast.success(`Order status updated to ${nextStatus}`);
    },
    getStatusClass(status) {
      const statusLower = (status || 'pending').toLowerCase();
      if (statusLower === 'completed') {
        return 'badge-success';
      } else if (statusLower === 'processing' || statusLower === 'in progress') {
        return 'badge-info';
      } else if (statusLower === 'pending') {
        return 'badge-warning';
      } else if (statusLower === 'cancelled') {
        return 'badge-danger';
      } else {
        return 'badge-secondary';
      }
    },
    formatDate(date) {
      return new Date(date).toLocaleDateString();
    }
  }
};
</script>

<style scoped>
.clickable-row {
  cursor: pointer;
  transition: background-color 0.2s;
}

.clickable-row:hover {
  background-color: #f8f9fa;
}

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
