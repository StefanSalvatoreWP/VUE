<template>
    <div class="login-container">
      <h1>Login</h1>
      <div v-if="showNotification" class="notification" :class="{'success': isSuccess, 'error': !isSuccess}">
        {{ notificationMessage }}
      </div>
      <form @submit.prevent="login">
        <input v-model="email" type="email" placeholder="Email" required />
        <input v-model="password" type="password" placeholder="Password" required />
        <button type="submit">Login</button>
      </form>
      <button @click="goToRegister" class="register-button">Register</button>
    </div>
  </template>
  
  <script>
  import axios from '../axios';
  
  export default {
    data() {
      return {
        email: '',
        password: '',
        notificationMessage: '',
        showNotification: false,
        isSuccess: false,
      };
    },
    methods: {
      async login() {
        try {
          const response = await axios.post('/login', {
            email: this.email,
            password: this.password
          });
          localStorage.setItem('token', response.data.token);
          localStorage.setItem('userName', response.data.name);
          this.showNotificationMessage('Login Successful', true);
          setTimeout(() => {
            this.$router.push('/admin');
          }, 2000);
        } catch (error) {
          console.error('Login error:', error);
          this.showNotificationMessage('Invalid Credentials', false);
        }
      },
      showNotificationMessage(message, isSuccess) {
        this.notificationMessage = message;
        this.isSuccess = isSuccess;
        this.showNotification = true;
        setTimeout(() => {
          this.showNotification = false;
        }, 2000);
      },
      goToRegister() {
        this.$router.push('/register');
      }
    }
  };
  </script>
  
  <style scoped>
  .login-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  
  h1 {
    text-align: center;
    margin-bottom: 1.5rem;
  }
  
  form {
    display: flex;
    flex-direction: column;
  }
  
  input {
    margin-bottom: 1rem;
    padding: 0.5rem;
    border: 1px solid #ccc;
    border-radius: 4px;
  }
  
  button {
    padding: 0.75rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #0056b3;
  }
  
  .notification {
    text-align: center;
    padding: 0.5rem;
    margin-bottom: 1rem;
    border-radius: 4px;
  }
  
  .success {
    background-color: #d4edda;
    color: #155724;
  }
  
  .error {
    background-color: #f8d7da;
    color: #721c24;
  }
  
  .register-button {
    margin-top: 1rem;
    background-color: #28a745;
  }
  
  .register-button:hover {
    background-color: #218838;
  }
  </style>
  