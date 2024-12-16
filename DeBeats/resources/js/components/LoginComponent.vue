<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="container p-6 bg-white shadow-md rounded-lg w-full max-w-sm">
      <h3 class="text-center text-xl font-semibold text-gray-700">Login Page</h3>
      <form @submit.prevent="submitForm">
        <div class="my-4">
          <label for="UTMID" class="block text-gray-600">UTM ID</label>
          <input
            type="text"
            id="UTMID"
            v-model="form.UTMID"
            class="w-full p-2 border border-gray-300 rounded-md"
            required
          />
        </div>
        <div class="my-4">
          <label for="password" class="block text-gray-600">Password</label>
          <input
            type="password"
            id="password"
            v-model="form.password"
            class="w-full p-2 border border-gray-300 rounded-md"
            required
          />
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md">
          Login
        </button>
        <div v-if="errors" class="text-red-500 text-sm mt-4">
          <p v-for="(error, index) in errors" :key="index">{{ error }}</p>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'LoginComponent',
  data() {
    return {
      form: {
        UTMID: '', // Matches backend field names
        password: '' // Matches backend field names
      },
      errors: null // To display errors
    };
  },
  methods: {

    async submitForm() {
      try {
        console.log('Form is being submitted'); // Check if the method is called

        axios.defaults.headers.common['X-CSRF-TOKEN'] =
          document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const response = await axios.post('/login', this.form);
        console.log('Response:', response); // Check the response from the server

        if (response.status === 200 && response.data.redirect) {
          console.log("Redirecting to: ", response.data.redirect);
          // Use window.location.href for navigation
          window.location.href = response.data.redirect;
        }
      } catch (error) {
        console.log('Error:', error); // Log the error details
        if (error.response && error.response.data.errors) {
          console.log('Validation Errors:', error.response.data.errors);
          this.errors = Object.values(error.response.data.errors).flat();
        } else {
          this.errors = ['An unexpected error occurred. Please try again.'];
        }
      }
    }
  }
};
</script>

<style scoped>
/* Centering the form in the middle of the screen */
.flex {
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh; /* Full viewport height */
}

.container {
  width: 100%;
  max-width: 400px; /* You can adjust this value */
}
</style>
