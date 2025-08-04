<template>
  <div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ $t("Schools Management") }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <router-link :to="{ name: 'home' }">{{ $t("Dashboard") }}</router-link>
              </li>
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
                  <button type="button" class="btn btn-primary btn-sm" @click="showAddSchoolModal">
                    <i class="fas fa-plus"></i> {{ $t("Add School") }}
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
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
                      <tr v-for="school in schools" :key="school.id" class="clickable-row" @click="viewSchool(school.id)">
                        <td>
                          <router-link :to="{ name: 'education.school-detail', params: { id: school.id } }" class="text-primary font-weight-bold">
                            {{ school.name }}
                          </router-link>
                        </td>
                        <td>{{ school.contact_person }}</td>
                        <td>{{ school.email }}</td>
                        <td>{{ school.phone }}</td>
                        <td>{{ school.student_count || school.students_count || 0 }}</td>
                        <td>
                          <span class="badge" :class="getStatusClass(school.subscription_status || school.status)">
                            {{ getStatusText(school.subscription_status || school.status) }}
                          </span>
                        </td>
                        <td>{{ (school.yearly_fee || 0) | withCurrency }}</td>
                        <td @click.stop>
                          <button class="btn btn-sm btn-primary mr-1" @click="viewSchool(school.id)" title="View Details">
                            <i class="fas fa-eye"></i>
                          </button>
                          <button class="btn btn-sm btn-info mr-1" @click="editSchool(school)" title="Edit">
                            <i class="fas fa-edit"></i>
                          </button>
                          <button class="btn btn-sm btn-danger" @click="deleteSchool(school.id)" title="Delete">
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

        <!-- Statistics Cards -->
        <div class="row mt-4">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ totalSchools }}</h3>
                <p>{{ $t("Total Schools") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-school"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ activeSubscriptions }}</h3>
                <p>{{ $t("Active Subscriptions") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-check-circle"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ totalStudents }}</h3>
                <p>{{ $t("Total Students") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-graduate"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>${{ monthlyRevenue }}</h3>
                <p>{{ $t("Monthly Revenue") }}</p>
              </div>
              <div class="icon">
                <i class="fas fa-dollar-sign"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Add/Edit School Modal -->
    <div class="modal fade" id="schoolModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">{{ isEditing ? $t("Edit School") : $t("Add School") }}</h5>
            <button type="button" class="close" data-dismiss="modal">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="saveSchool">
              <div class="form-group">
                <label>{{ $t("School Name") }}</label>
                <input v-model="schoolForm.name" type="text" class="form-control" required>
              </div>
              <div class="form-group">
                <label>{{ $t("Contact Person") }}</label>
                <input v-model="schoolForm.contact_person" type="text" class="form-control" required>
              </div>
              <div class="form-group">
                <label>{{ $t("Email") }}</label>
                <input v-model="schoolForm.email" type="email" class="form-control" required>
              </div>
              <div class="form-group">
                <label>{{ $t("Phone") }}</label>
                <input v-model="schoolForm.phone" type="text" class="form-control" required>
              </div>
              <div class="form-group">
                <label>{{ $t("Address") }}</label>
                <textarea v-model="schoolForm.address" class="form-control" rows="3"></textarea>
              </div>
              <div class="form-group">
                <label>{{ $t("School Logo") }}</label>
                <input type="file" class="form-control" @change="handleLogoUpload" accept="image/*">
              </div>
              <div class="form-group">
                <label>{{ $t("Students Count") }}</label>
                <input v-model="schoolForm.student_count" type="number" class="form-control" required>
              </div>
              <div class="form-group">
                <label>{{ $t("Staff Count") }}</label>
                <input v-model="schoolForm.staff_count" type="number" class="form-control" required>
              </div>
              <div class="form-group">
                <label>{{ $t("Yearly Fee") }}</label>
                <input v-model="schoolForm.yearly_fee" type="number" step="0.01" class="form-control" required>
              </div>
              <div class="form-group">
                <label>{{ $t("Subscription Type") }}</label>
                <select v-model="schoolForm.subscription_type" class="form-control" required>
                  <option value="basic">Basic</option>
                  <option value="premium">Premium</option>
                  <option value="enterprise">Enterprise</option>
                </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ $t("Cancel") }}</button>
            <button type="button" class="btn btn-primary" @click="saveSchool" :disabled="loading">
              <span v-if="loading" class="spinner-border spinner-border-sm me-2" role="status"></span>
              {{ loading ? $t("Saving...") : $t("Save") }}
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: "Schools",
  data() {
    return {
      schools: [],
      loading: false,
      schoolForm: {
        name: "",
        contact_person: "",
        email: "",
        phone: "",
        address: "",
        student_count: 0,
        staff_count: 0,
        yearly_fee: 0,
        subscription_type: "basic",
        logo: null
      },
      isEditing: false,
      editingId: null
    };
  },
  created() {
    this.fetchSchools();
  },
  computed: {
    totalSchools() {
      return this.schools.length;
    },
    activeSubscriptions() {
      return this.schools.filter(school => school.subscription_status === 'Active').length;
    },
    totalStudents() {
      return this.schools.reduce((total, school) => total + (school.student_count || 0), 0);
    },
    totalStaff() {
      return this.schools.reduce((total, school) => total + (school.staff_count || 0), 0);
    },
    yearlyRevenue() {
      return this.schools
        .filter(school => school.status === 1 || school.status === 'active')
        .reduce((total, school) => total + (school.yearly_fee || 0), 0)
        .toFixed(2);
    },
    monthlyRevenue() {
      return (this.yearlyRevenue / 12).toFixed(2);
    }
  },
  methods: {
    async fetchSchools() {
      try {
        this.loading = true;
        const response = await axios.get('/api/education/schools');
        this.schools = response.data.data || response.data;
      } catch (error) {
        console.error('Error fetching schools:', error);
        this.$toast.error('Failed to load schools');
      } finally {
        this.loading = false;
      }
    },
    showAddSchoolModal() {
      this.resetForm();
      $("#schoolModal").modal("show");
    },
    handleLogoUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.schoolForm.logo = file;
      }
    },
    editSchool(school) {
      this.isEditing = true;
      this.editingId = school.id;
      this.schoolForm = { ...school };
      $("#schoolModal").modal("show");
    },
    async saveSchool() {
      // Prevent multiple submissions
      if (this.loading) {
        return;
      }

      // Validate required fields
      if (!this.schoolForm.name || !this.schoolForm.contact_person || !this.schoolForm.email) {
        this.$toast.error('Please fill in all required fields');
        return;
      }

      this.loading = true;

      try {
        // Prepare form data
        const formData = new FormData();
        formData.append('name', this.schoolForm.name);
        formData.append('contact_person', this.schoolForm.contact_person);
        formData.append('email', this.schoolForm.email);
        formData.append('phone', this.schoolForm.phone || '');
        formData.append('address', this.schoolForm.address || '');
        formData.append('student_count', parseInt(this.schoolForm.student_count) || 0);
        formData.append('staff_count', parseInt(this.schoolForm.staff_count) || 0);
        formData.append('yearly_fee', parseFloat(this.schoolForm.yearly_fee) || 0);
        formData.append('subscription_type', this.schoolForm.subscription_type || 'basic');
        
        if (this.schoolForm.logo) {
          formData.append('logo', this.schoolForm.logo);
        }

        // Make API request
        let apiUrl = '/api/education/schools';
        if (this.isEditing) {
          formData.append('_method', 'PUT');
          apiUrl = `/api/education/schools/${this.editingId}`;
        }

        const response = await axios.post(apiUrl, formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });

        // Show success message
        const successMessage = this.isEditing ? 'School updated successfully! 🎓' : 'School saved successfully! 🎓';
        this.$toast.success(successMessage);

        // Reset form and state
        this.resetForm();
        
        // Refresh data and close modal
        await this.fetchSchools();
        $("#schoolModal").modal("hide");
        
      } catch (err) {
        console.error('Save school error:', err);
        
        // Simple error handling
        let errorMessage = 'Failed to save school. Please try again.';
        
        if (err && err.response && err.response.data) {
          if (err.response.data.message) {
            errorMessage = err.response.data.message;
          } else if (err.response.data.errors) {
            const errorList = Object.values(err.response.data.errors).flat();
            errorMessage = errorList.join(', ');
          }
        } else if (err && err.message) {
          errorMessage = err.message;
        }
        
        this.$toast.error(errorMessage);
      } finally {
        this.loading = false;
      }
    },
    
    resetForm() {
      this.schoolForm = {
        name: "",
        contact_person: "",
        email: "",
        phone: "",
        address: "",
        student_count: 0,
        staff_count: 0,
        yearly_fee: 0,
        subscription_type: "basic",
        logo: null
      };
      this.isEditing = false;
      this.editingId = null;
    },
    async deleteSchool(id) {
      if (confirm(this.$t("Are you sure you want to delete this school?"))) {
        try {
          await axios.delete(`/api/education/schools/${id}`);
          this.$toast.success("School deleted successfully!");
          this.fetchSchools();
        } catch (error) {
          console.error('Error deleting school:', error);
          this.$toast.error('Failed to delete school');
        }
      }
    },
    viewSchool(schoolId) {
      this.$router.push({ name: 'education.school-detail', params: { id: schoolId } });
    },
    getStatusClass(status) {
      const statusStr = String(status).toLowerCase();
      if (status === true || status === 1 || statusStr === '1' || statusStr === 'active') {
        return 'badge-success';
      } else if (status === false || status === 0 || statusStr === '0' || statusStr === 'inactive' || statusStr === 'pending') {
        return 'badge-warning';
      } else {
        return 'badge-secondary';
      }
    },
    getStatusText(status) {
      if (status === true || status === 1 || status === '1' || status === 'active') {
        return 'Active';
      } else if (status === false || status === 0 || status === '0' || status === 'inactive') {
        return 'Inactive';
      } else if (status === 'pending') {
        return 'Pending';
      } else {
        return 'Active'; // Default fallback
      }
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
