<template>
  <div>
    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ school.name }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ name: 'home' }">{{ $t("Dashboard") }}</router-link>
              </li>
              <li class="breadcrumb-item">
                <router-link :to="{ name: 'education.schools' }">{{ $t("Schools") }}</router-link>
              </li>
              <li class="breadcrumb-item active">{{ school.name }}</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- School Information Cards -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ school.student_count || 0 }}</h3>
                <p>{{ $t("Students") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-graduate"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ (school.yearly_fee || 0) | withCurrency }}</h3>
                <p>{{ $t("Yearly Fee") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-dollar-sign"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ statistics.total_invoices || 0 }}</h3>
                <p>{{ $t("Total Invoices") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-file-invoice"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ (statistics.due_amount || 0) | withCurrency }}</h3>
                <p>{{ $t("Due Amount") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-exclamation-triangle"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- School Details and Actions -->
        <div class="row">
          <div class="col-md-4">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{ $t("School Information") }}</h3>
              </div>
              <div class="card-body">
                <strong><i class="fas fa-envelope mr-1"></i> {{ $t("Email") }}</strong>
                <p class="text-muted">{{ school.email || 'N/A' }}</p>
                <hr>
                <strong><i class="fas fa-phone mr-1"></i> {{ $t("Phone") }}</strong>
                <p class="text-muted">{{ school.phone || 'N/A' }}</p>
                <hr>
                <strong><i class="fas fa-map-marker-alt mr-1"></i> {{ $t("Address") }}</strong>
                <p class="text-muted">{{ school.address || 'N/A' }}</p>
                <hr>
                <strong><i class="fas fa-crown mr-1"></i> {{ $t("Subscription Type") }}</strong>
                <p class="text-muted">
                  <span class="badge" :class="getSubscriptionClass(school.subscription_type)">
                    {{ school.subscription_type || 'Basic' }}
                  </span>
                </p>
                <hr>
                <strong><i class="fas fa-calendar mr-1"></i> {{ $t("Subscription Period") }}</strong>
                <p class="text-muted">
                  {{ school.subscription_start_date || 'N/A' }} - {{ school.subscription_end_date || 'N/A' }}
                </p>
              </div>
            </div>
          </div>

          <div class="col-md-8">
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
            <h5 class="modal-title">{{ $t("Create Invoice") }}</h5>
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
  name: 'SchoolDetail',
  data() {
    return {
      school: {},
      statistics: {},
      invoices: [],
      loading: true,
      invoiceForm: {
        invoice_date: '',
        due_date: '',
        sub_total: '',
        description: '',
        items: [
          {
            description: 'School Subscription',
            quantity: 1,
            unit_price: 0
          }
        ]
      }
    }
  },
  created() {
    this.fetchSchoolData()
  },
  methods: {
    async fetchSchoolData() {
      try {
        this.loading = true
        const schoolId = this.$route.params.id
        
        // Fetch school details
        const response = await axios.get(`/api/education/schools/${schoolId}`)
        this.school = response.data.school
        this.statistics = response.data.statistics
        
        // Fetch school invoices
        const invoicesResponse = await axios.get(`/api/education/schools/${schoolId}/invoices`)
        this.invoices = invoicesResponse.data.data
        
        // Set default invoice amount to yearly fee
        this.invoiceForm.items[0].unit_price = this.school.yearly_fee || 0
        this.invoiceForm.sub_total = this.school.yearly_fee || 0
        
      } catch (error) {
        console.error('Error fetching school data:', error)
        this.$toast.error('Failed to load school data')
      } finally {
        this.loading = false
      }
    },
    
    showCreateInvoiceModal() {
      // Set default dates
      const today = new Date().toISOString().split('T')[0]
      const dueDate = new Date()
      dueDate.setMonth(dueDate.getMonth() + 1)
      
      this.invoiceForm.invoice_date = today
      this.invoiceForm.due_date = dueDate.toISOString().split('T')[0]
      this.invoiceForm.description = `School subscription invoice for ${this.school.name}`
      
      $('#createInvoiceModal').modal('show')
    },
    
    async createInvoice() {
      try {
        const schoolId = this.$route.params.id
        this.invoiceForm.items[0].unit_price = this.invoiceForm.sub_total
        
        await axios.post(`/api/education/schools/${schoolId}/invoices`, this.invoiceForm)
        
        this.$toast.success('Invoice created successfully')
        $('#createInvoiceModal').modal('hide')
        
        // Refresh data
        this.fetchSchoolData()
        
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
        this.fetchSchoolData()
        
      } catch (error) {
        console.error('Error marking invoice as paid:', error)
        this.$toast.error('Failed to update invoice status')
      }
    },
    
    async sendInvoice(invoice) {
      try {
        await axios.post(`/api/invoices/${invoice.id}/send`, {
          email: this.school.email
        })
        
        this.$toast.success('Invoice sent successfully')
        
      } catch (error) {
        console.error('Error sending invoice:', error)
        this.$toast.error('Failed to send invoice')
      }
    },
    
    async sendPaymentReceipt(invoice) {
      try {
        await axios.post(`/api/invoices/${invoice.id}/receipt`, {
          email: this.school.email
        })
        
      } catch (error) {
        console.error('Error sending receipt:', error)
      }
    },
    
    viewInvoice(invoice) {
      // Navigate to invoice view
      this.$router.push({ name: 'invoices.show', params: { id: invoice.id } })
    },
    
    getSubscriptionClass(type) {
      const classes = {
        basic: 'badge-secondary',
        premium: 'badge-warning',
        enterprise: 'badge-success'
      }
      return classes[type] || 'badge-secondary'
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

.small-box > .small-box-footer {
  background-color: rgba(0,0,0,.1);
  color: rgba(255,255,255,.8);
  display: block;
  padding: 3px 0;
  position: relative;
  text-align: center;
  text-decoration: none;
  z-index: 10;
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
