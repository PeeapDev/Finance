<template>
  <div>
    <!-- Content Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $t("Schools Management") }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{ $t("Home") }}</a></li>
              <li class="breadcrumb-item active">{{ $t("Schools") }}</li>
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
                <h3 class="card-title">{{ $t("School Subscription Services") }}</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-primary btn-sm" @click="openModal">
                    <i class="fas fa-plus"></i> {{ $t("Add School") }}
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" :key="refreshKey">
                    <thead>
                      <tr>
                        <th>{{ $t("School Name") }}</th>
                        <th>{{ $t("Contact Person") }}</th>
                        <th>{{ $t("Email") }}</th>
                        <th>{{ $t("Phone") }}</th>
                        <th>{{ $t("Students Count") }}</th>
                        <th>{{ $t("Subscription Status") }}</th>
                        <th>{{ $t("Yearly Fee") }}</th>
                        <th>{{ $t("Actions") }}</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="school in schools" :key="school.id">
                        <td>{{ school.name }}</td>
                        <td>{{ school.contact_person }}</td>
                        <td>{{ school.email }}</td>
                        <td>{{ school.phone }}</td>
                        <td>{{ school.student_count || 0 }}</td>
                        <td>
                          <span class="badge badge-success">Active</span>
                        </td>
                        <td>${{ school.yearly_fee || 0 }}</td>
                        <td>
                          <button class="btn btn-sm btn-info" @click="editSchool(school)">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button class="btn btn-sm btn-danger ml-1" @click="deleteSchool(school.id)">
                            <i class="fas fa-trash"></i>
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

    <!-- Modal -->
    <div class="modal fade" id="schoolModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{ isEditing ? 'Edit School Subscription' : 'Create New School Subscription' }}</h4>
            <button type="button" class="close" @click="closeModal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Step Indicator -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div :class="['step', { 'active': currentStep >= 1 }]">1. Basic Info</div>
                <div class="flex-grow-1 mx-3"><hr></div>
                <div :class="['step', { 'active': currentStep >= 2 }]">2. Subscription</div>
                <div class="flex-grow-1 mx-3"><hr></div>
                <div :class="['step', { 'active': currentStep === 3 }]">3. Review</div>
            </div>

            <form @submit.prevent="saveSchool">
              <!-- Step 1: Basic Info -->
              <div v-if="currentStep === 1">
                <h5>Basic Information</h5>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>School Name *</label>
                      <input v-model="form.name" type="text" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Contact Person *</label>
                      <input v-model="form.contact_person" type="text" class="form-control" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Email Address *</label>
                      <input v-model="form.email" type="email" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Phone Number</label>
                      <input v-model="form.phone" type="text" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <label>School Address</label>
                    <textarea v-model="form.address" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>School Logo</label>
                    <input @change="handleFileUpload" type="file" class="form-control-file" accept="image/*">
                </div>
              </div>

              <!-- Step 2: Subscription -->
              <div v-if="currentStep === 2">
                <h5>Subscription Details</h5>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Students Count *</label>
                      <input v-model.number="form.student_count" type="number" class="form-control" min="0" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Staff Count</label>
                      <input v-model.number="form.staff_count" type="number" class="form-control" min="0">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Yearly Fee ($) *</label>
                      <input v-model.number="form.yearly_fee" type="number" class="form-control" min="0" step="0.01" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <label>Subscription Type *</label>
                    <select v-model="form.subscription_type" class="form-control" required>
                      <option value="basic">Basic</option>
                      <option value="premium">Premium</option>
                      <option value="enterprise">Enterprise</option>
                    </select>
                </div>
              </div>

              <!-- Step 3: Review -->
              <div v-if="currentStep === 3">
                  <h5>Review Details</h5>
                  <strong>Basic Info:</strong>
                  <ul>
                      <li><strong>School Name:</strong> {{ form.name }}</li>
                      <li><strong>Contact Person:</strong> {{ form.contact_person }}</li>
                      <li><strong>Email:</strong> {{ form.email }}</li>
                      <li><strong>Phone:</strong> {{ form.phone }}</li>
                      <li><strong>Address:</strong> {{ form.address }}</li>
                  </ul>
                  <strong>Subscription Details:</strong>
                  <ul>
                      <li><strong>Students:</strong> {{ form.student_count }}</li>
                      <li><strong>Staff:</strong> {{ form.staff_count }}</li>
                      <li><strong>Yearly Fee:</strong> ${{ form.yearly_fee }}</li>
                      <li><strong>Subscription:</strong> {{ form.subscription_type }}</li>
                  </ul>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="closeModal">Cancel</button>
            <button type="button" class="btn btn-secondary" @click="prevStep" v-if="currentStep > 1">Back</button>
            <button type="button" class="btn btn-primary" @click="nextStep" v-if="currentStep < 3" :disabled="!isCurrentStepValid">Next</button>
            <button type="button" class="btn btn-primary" @click="saveSchool" v-if="currentStep === 3" :disabled="saving">
              <span v-if="saving" class="spinner-border spinner-border-sm mr-2"></span>
              {{ saving ? 'Saving...' : (isEditing ? 'Update School' : 'Save School') }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      schools: [],
      isEditing: false,
      saving: false,
      refreshKey: 0,
      currentStep: 1,
      form: {
        id: null,
        name: '',
        contact_person: '',
        email: '',
        phone: '',
        address: '',
        student_count: 0,
        staff_count: 0,
        yearly_fee: 0,
        subscription_type: 'basic',
        logo: null,
        status: 1
      }
    };
  },
  computed: {
      isCurrentStepValid() {
          if (this.currentStep === 1) {
              return this.form.name && this.form.contact_person && this.form.email;
          }
          if (this.currentStep === 2) {
              return this.form.student_count > 0 && this.form.yearly_fee > 0 && this.form.subscription_type;
          }
          return true; // Step 3 is just a review
      }
  },
  mounted() {
    this.loadSchools();
  },
  
  methods: {
    nextStep() {
        if (this.isCurrentStepValid) {
            this.currentStep++;
        }
    },
    prevStep() {
        this.currentStep--;
    },
    async loadSchools() {
        try {
            const response = await axios.get('/api/education/schools?_=' + new Date().getTime());
            if (response.data && Array.isArray(response.data.data)) {
                this.schools = response.data.data;
            } else if (response.data && Array.isArray(response.data)) {
                this.schools = response.data;
            }
            this.refreshKey++;
        } catch (error) {
            console.error('Error loading schools:', error);
            this.$toast.error('Failed to load schools.');
        }
    },
    openModal() {
      this.isEditing = false;
      this.resetForm();
      this.currentStep = 1;
      $('#schoolModal').modal('show');
    },
    closeModal() {
      $('#schoolModal').modal('hide');
      this.resetForm();
    },
    
    editSchool(school) {
      this.isEditing = true;
      this.editingId = school.id;
      this.form = {
        name: school.name || '',
        contact_person: school.contact_person || '',
        email: school.email || '',
        phone: school.phone || '',
        address: school.address || '',
        student_count: school.student_count || 0,
        staff_count: school.staff_count || 0,
        yearly_fee: school.yearly_fee || 0,
        subscription_type: school.subscription_type || 'basic',
        logo: null
      };
      this.showModal = true;
      $('#schoolModal').modal('show');
    },
    
    resetForm() {
      this.form = {
        name: '',
        contact_person: '',
        email: '',
        phone: '',
        address: '',
        student_count: 0,
        staff_count: 0,
        yearly_fee: 0,
        subscription_type: 'basic',
        logo: null
      };
      
      // Reset form state
      this.isEditing = false;
      this.editingId = null;
    },
    
    handleFileUpload(event) {
      const file = event.target.files[0];
      this.form.logo = file || null;
    },
    
    async saveSchool() {
      if (this.saving) return;
      
      // Basic validation
      if (!this.form.name || !this.form.contact_person || !this.form.email) {
        this.$toast.error('Please fill in all required fields');
        return;
      }
      
      this.saving = true;
      
      try {
        const formData = new FormData();
        formData.append('name', this.form.name);
        formData.append('contact_person', this.form.contact_person);
        formData.append('email', this.form.email);
        formData.append('phone', this.form.phone);
        formData.append('address', this.form.address);
        formData.append('student_count', this.form.student_count);
        formData.append('staff_count', this.form.staff_count);
        formData.append('yearly_fee', this.form.yearly_fee);
        formData.append('subscription_type', this.form.subscription_type);
        
        if (this.form.logo) {
          formData.append('logo', this.form.logo);
        }
        
        let url = '/api/education/schools';
        if (this.isEditing) {
          formData.append('_method', 'PUT');
          url = `/api/education/schools/${this.editingId}`;
        }
        
        const response = await axios.post(url, formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });
        
        console.log('Save response:', response.data);
        
        this.$toast.success(this.isEditing ? 'School updated successfully!' : 'School saved successfully!');
        
        // Reset form and close modal first
        this.resetForm();
        this.closeModal();
        
        // Force refresh the schools list
        await this.loadSchools();
        
        // Force re-render using refreshKey
        this.refreshKey += 1;
        this.$nextTick(() => {
          this.$forceUpdate();
        });
        
      } catch (err) {
        console.error('Save error:', err);
        let message = 'Failed to save school';
        
        if (err && err.response) {
          if (err.response.data && err.response.data.message) {
            message = err.response.data.message;
          } else if (err.response.data && err.response.data.errors) {
            const errors = err.response.data.errors;
            const firstError = Object.values(errors)[0];
            if (Array.isArray(firstError)) {
              message = firstError[0];
            } else {
              message = firstError || message;
            }
          }
        } else if (err && err.message) {
          message = err.message;
        }
        
        this.$toast.error(message);
      } finally {
        this.saving = false;
      }
    },
    
    async deleteSchool(id) {
      if (!confirm('Are you sure you want to delete this school?')) {
        return;
      }
      
      try {
        console.log('Deleting school with ID:', id);
        const response = await axios.delete(`/api/education/schools/${id}`);
        console.log('Delete response:', response.data);
        
        this.$toast.success('School deleted successfully!');
        
        // Immediately remove the deleted school from local state
        this.schools = this.schools.filter(school => school.id !== id);
        
        // Force a complete refresh from server to ensure consistency
        this.refreshKey += 1;
        this.$nextTick(() => {
          this.$forceUpdate();
        });
        
      } catch (err) {
        console.error('Delete error:', err);
        let message = 'Failed to delete school';
        
        if (err && err.response) {
          if (err.response.data && err.response.data.message) {
            message = err.response.data.message;
          }
        } else if (err && err.message) {
          message = err.message;
        }
        
        this.$toast.error(message);
      }
    }
  }
};
</script>

<style scoped>
.table th, .table td {
  vertical-align: middle;
}
.spinner-border-sm {
  width: 1rem;
  height: 1rem;
}
</style>
