<template>
  <div>
    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $t("ID Card Order") }} #{{ idCard.order_number }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ name: 'home' }">{{ $t("Dashboard") }}</router-link>
              </li>
              <li class="breadcrumb-item">
                <router-link :to="{ name: 'education.idcards' }">{{ $t("ID Cards") }}</router-link>
              </li>
              <li class="breadcrumb-item active">#{{ idCard.order_number }}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Order Information Cards -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ idCard.quantity || 0 }}</h3>
                <p>{{ $t("Cards Ordered") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-id-card"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ (idCard.total_amount || 0) | withCurrency }}</h3>
                <p>{{ $t("Total Amount") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-dollar-sign"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ idCard.card_type || 'Standard' }}</h3>
                <p>{{ $t("Card Type") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-credit-card"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box" :class="getStatusClass(idCard.status)">
              <div class="inner">
                <h3>{{ idCard.status || 'Pending' }}</h3>
                <p>{{ $t("Status") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-info-circle"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Order Details and School Info -->
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{ $t("Order Details") }}</h3>
              </div>
              <div class="card-body">
                <strong><i class="fas fa-hashtag mr-1"></i> {{ $t("Order Number") }}</strong>
                <p class="text-muted">{{ idCard.order_number || 'N/A' }}</p>
                <hr>
                <strong><i class="fas fa-user mr-1"></i> {{ $t("Customer Name") }}</strong>
                <p class="text-muted">{{ idCard.customer_name || 'N/A' }}</p>
                <hr>
                <strong><i class="fas fa-envelope mr-1"></i> {{ $t("Customer Email") }}</strong>
                <p class="text-muted">{{ idCard.customer_email || 'N/A' }}</p>
                <hr>
                <strong><i class="fas fa-phone mr-1"></i> {{ $t("Customer Phone") }}</strong>
                <p class="text-muted">{{ idCard.customer_phone || 'N/A' }}</p>
                <hr>
                <strong><i class="fas fa-calendar mr-1"></i> {{ $t("Order Date") }}</strong>
                <p class="text-muted">{{ idCard.order_date | moment }}</p>
                <hr>
                <strong><i class="fas fa-truck mr-1"></i> {{ $t("Delivery Date") }}</strong>
                <p class="text-muted">{{ idCard.delivery_date | moment }}</p>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">{{ $t("Associated School") }}</h3>
                <div class="card-tools" v-if="associatedSchool">
                  <router-link :to="{ name: 'education.school-detail', params: { id: associatedSchool.id } }" 
                               class="btn btn-primary btn-sm">
                    <i class="fas fa-eye"></i> {{ $t("View School") }}
                  </router-link>
                </div>
              </div>
              <div class="card-body">
                <div v-if="associatedSchool">
                  <strong><i class="fas fa-school mr-1"></i> {{ $t("School Name") }}</strong>
                  <p class="text-muted">{{ associatedSchool.name }}</p>
                  <hr>
                  <strong><i class="fas fa-envelope mr-1"></i> {{ $t("School Email") }}</strong>
                  <p class="text-muted">{{ associatedSchool.email }}</p>
                  <hr>
                  <strong><i class="fas fa-phone mr-1"></i> {{ $t("School Phone") }}</strong>
                  <p class="text-muted">{{ associatedSchool.phone }}</p>
                  <hr>
                  <strong><i class="fas fa-users mr-1"></i> {{ $t("Students") }}</strong>
                  <p class="text-muted">{{ associatedSchool.student_count || 0 }}</p>
                </div>
                <div v-else>
                  <p class="text-muted">{{ $t("No associated school found") }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Invoice Management -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{ $t("Invoice Management") }}</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" @click="showCreateInvoiceModal">
                    <i class="fas fa-plus"></i> {{ $t("Create Invoice") }}
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>{{ $t("Invoice No") }}</th>
                        <th>{{ $t("Date") }}</th>
                        <th>{{ $t("Due Date") }}</th>
                        <th>{{ $t("Amount") }}</th>
                        <th>{{ $t("Status") }}</th>
                        <th>{{ $t("Actions") }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="invoice in invoices" :key="invoice.id">
                        <td>{{ invoice.invoice_no }}</td>
                        <td>{{ invoice.invoice_date | moment }}</td>
                        <td>{{ invoice.due_date | moment }}</td>
                        <td>{{ invoice.calculated_total | withCurrency }}</td>
                        <td>
                          <span class="badge" :class="getInvoiceStatusClass(invoice)">
                            {{ getInvoiceStatusText(invoice) }}
                          </span>
                        </td>
                        <td>
                          <button v-if="invoice.due_amount > 0" 
                                  class="btn btn-success btn-xs mr-1" 
                                  @click="markAsPaid(invoice)">
                            <i class="fas fa-check"></i> {{ $t("Mark Paid") }}
                          </button>
                          <button class="btn btn-info btn-xs mr-1" @click="sendInvoice(invoice)">
                            <i class="fas fa-envelope"></i> {{ $t("Send") }}
                          </button>
                          <button class="btn btn-secondary btn-xs" @click="viewInvoice(invoice)">
                            <i class="fas fa-eye"></i> {{ $t("View") }}
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

    <!-- Create Invoice Modal -->
    <div class="modal fade" id="createInvoiceModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ $t("Create Invoice for ID Card Order") }}</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="createInvoice">
              <div class="form-group">
                <label>{{ $t("Invoice Date") }}</label>
                <input type="date" class="form-control" v-model="invoiceForm.invoice_date" required>
              </div>
              <div class="form-group">
                <label>{{ $t("Due Date") }}</label>
                <input type="date" class="form-control" v-model="invoiceForm.due_date" required>
              </div>
              <div class="form-group">
                <label>{{ $t("Amount") }}</label>
                <input type="number" class="form-control" v-model="invoiceForm.sub_total" step="0.01" required>
              </div>
              <div class="form-group">
                <label>{{ $t("Description") }}</label>
                <textarea class="form-control" v-model="invoiceForm.description" rows="3"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $t("Cancel") }}</button>
            <button type="button" class="btn btn-primary" @click="createInvoice">{{ $t("Create Invoice") }}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'IdCardDetail',
  data() {
    return {
      idCard: {},
      associatedSchool: null,
      invoices: [],
      loading: true,
      invoiceForm: {
        invoice_date: '',
        due_date: '',
        sub_total: '',
        description: '',
        items: [
          {
            description: 'ID Card Order',
            quantity: 1,
            unit_price: 0
          }
        ]
      }
    }
  },
  created() {
    this.fetchIdCardData()
  },
  methods: {
    async fetchIdCardData() {
      try {
        this.loading = true
        const idCardId = this.$route.params.id
        
        // Fetch ID card details
        const response = await axios.get(`/api/education/idcards/${idCardId}`)
        this.idCard = response.data
        
        // Fetch associated school
        try {
          const schoolResponse = await axios.get(`/api/education/idcards/${idCardId}/school`)
          this.associatedSchool = schoolResponse.data
        } catch (error) {
          console.log('No associated school found')
        }
        
        // Fetch related invoices
        try {
          const invoicesResponse = await axios.get(`/api/invoices?search=${this.idCard.order_number}`)
          this.invoices = invoicesResponse.data.data || []
        } catch (error) {
          console.log('No invoices found')
        }
        
        // Set default invoice amount to total amount
        this.invoiceForm.items[0].unit_price = this.idCard.total_amount || 0
        this.invoiceForm.sub_total = this.idCard.total_amount || 0
        
      } catch (error) {
        console.error('Error fetching ID card data:', error)
        this.$toast.error('Failed to load ID card data')
      } finally {
        this.loading = false
      }
    },
    
    showCreateInvoiceModal() {
      // Set default dates
      const today = new Date().toISOString().split('T')[0]
      const dueDate = new Date()
      dueDate.setDate(dueDate.getDate() + 30)
      
      this.invoiceForm.invoice_date = today
      this.invoiceForm.due_date = dueDate.toISOString().split('T')[0]
      this.invoiceForm.description = `ID Card order invoice for ${this.idCard.customer_name} - Order #${this.idCard.order_number}`
      
      $('#createInvoiceModal').modal('show')
    },
    
    async createInvoice() {
      try {
        const idCardId = this.$route.params.id
        this.invoiceForm.items[0].unit_price = this.invoiceForm.sub_total
        this.invoiceForm.items[0].quantity = this.idCard.quantity || 1
        
        await axios.post(`/api/education/idcards/${idCardId}/invoice`, this.invoiceForm)
        
        this.$toast.success('Invoice created successfully')
        $('#createInvoiceModal').modal('hide')
        
        // Refresh data
        this.fetchIdCardData()
        
      } catch (error) {
        console.error('Error creating invoice:', error)
        this.$toast.error('Failed to create invoice')
      }
    },
    
    async markAsPaid(invoice) {
      try {
        // Update invoice status to paid
        await axios.put(`/api/invoices/${invoice.id}`, {
          ...invoice,
          due_amount: 0,
          status: 1
        })
        
        // Send payment receipt email
        await this.sendPaymentReceipt(invoice)
        
        this.$toast.success('Invoice marked as paid and receipt sent')
        this.fetchIdCardData()
        
      } catch (error) {
        console.error('Error marking invoice as paid:', error)
        this.$toast.error('Failed to update invoice status')
      }
    },
    
    async sendInvoice(invoice) {
      try {
        const email = this.idCard.customer_email || (this.associatedSchool && this.associatedSchool.email)
        
        await axios.post(`/api/invoices/${invoice.id}/send`, {
          email: email
        })
        
        this.$toast.success('Invoice sent successfully')
        
      } catch (error) {
        console.error('Error sending invoice:', error)
        this.$toast.error('Failed to send invoice')
      }
    },
    
    async sendPaymentReceipt(invoice) {
      try {
        const email = this.idCard.customer_email || (this.associatedSchool && this.associatedSchool.email)
        
        await axios.post(`/api/invoices/${invoice.id}/receipt`, {
          email: email
        })
        
      } catch (error) {
        console.error('Error sending receipt:', error)
      }
    },
    
    viewInvoice(invoice) {
      // Navigate to invoice view
      this.$router.push({ name: 'invoices.show', params: { id: invoice.id } })
    },
    
    getStatusClass(status) {
      const classes = {
        pending: 'bg-warning',
        processing: 'bg-info',
        completed: 'bg-success',
        cancelled: 'bg-danger'
      }
      return classes[status] || 'bg-secondary'
    },
    
    getInvoiceStatusClass(invoice) {
      if (invoice.due_amount === 0) {
        return 'badge-success'
      } else if (new Date(invoice.due_date) < new Date()) {
        return 'badge-danger'
      } else {
        return 'badge-warning'
      }
    },
    
    getInvoiceStatusText(invoice) {
      if (invoice.due_amount === 0) {
        return 'Paid'
      } else if (new Date(invoice.due_date) < new Date()) {
        return 'Overdue'
      } else {
        return 'Pending'
      }
    }
  }
}
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

.small-box .icon {
  color: rgba(255,255,255,.15);
  z-index: 0;
}

.small-box .icon > i {
  font-size: 70px;
  position: absolute;
  right: 15px;
  top: 15px;
  transition: transform .3s linear;
}

.small-box:hover .icon > i {
  transform: scale(1.1);
}

.btn-xs {
  padding: 0.25rem 0.4rem;
  font-size: 0.75rem;
  line-height: 1.5;
  border-radius: 0.2rem;
}
</style>
