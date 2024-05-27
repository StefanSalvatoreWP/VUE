<template>
  <div class="manage-committees">
    <h1>Manage Reader</h1>
    <h1 v-if="showNotification">{{ notificationMessage }}</h1>
    <form @submit.prevent="addCommittee">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" v-model="name" id="name" required>
      </div>
      <div class="form-group">
        <label for="email">Username</label>
        <input type="email" v-model="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" v-model="password" required>
      </div>
      <button type="submit">Add Reader</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ManageCommittees',
  data() {
    return {
      name: '',
      email: '',
      password: '',
      role: 'committee',
      showNotification: false,
      notificationMessage: ''
    };
  },
  methods: {
    async addCommittee() {
      try {
        const token = localStorage.getItem('token');
        const response = await axios.post('http://127.0.0.1:8000/api/reader', {
          name: this.name,
          email: this.email,
          password: this.password,
          role: this.role
        }, {
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-type': 'application/json'
          }
        });
        console.log('You added a Reader Successfully');
        this.name = '';
        this.email = '';
        this.password = '';
        setTimeout(() => {
          this.showNotification = true;
          this.notificationMessage = 'You added a Reader Successfully';
        }, 2000);
      } catch (error) {
        console.error('Error adding committee', error);
        setTimeout(() => {
          this.showNotification = true;
          this.notificationMessage = 'Fail to Add';
        }, 2000);
      }
    }
  }
};
</script>

<style scoped>
.manage-committees {
  max-width: 600px;
  margin: 0 auto;
  padding: 2rem;
  border: 1px solid #eaeaea;
  border-radius: 8px;
  background-color: #ffffff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.manage-committees h1 {
  text-align: center;
  color: #333;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: bold;
  color: #333;
}

.form-group input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 1rem;
  box-sizing: border-box;
}

button[type="submit"] {
  width: 100%;
  padding: 0.75rem;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  font-size: 1rem;
  cursor: pointer;
}

button[type="submit"]:hover {
  background-color: #0056b3;
}
</style>
