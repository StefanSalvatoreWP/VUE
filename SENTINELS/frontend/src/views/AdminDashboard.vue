<template>
  <div class="admin-dashboard">
    <div class="header">
      <img  alt="YourCompany" class="logo" />
      <h1>Admin Dashboard</h1>
    </div>
    <nav class="navigation">
      <router-link to="/admin/books">Manage Books</router-link>
      <router-link to="/admin/reader">Manage Reader</router-link>
      <router-link to="/admin/booklist">Book List</router-link>
      <router-link to="/admin/readerlist">Reader List</router-link>
    </nav>
    <button class="logout-button" @click="logout">Logout</button>
    <router-view></router-view>
  </div>
  </template>
  
  <script>
  export default {
    name: 'AdminDashboard',
    methods:{
      async logout(){
        localStorage.removeItem('token')
        this.$router.push('/')
      }
    }
  }
  </script>
  
  <style scoped>
.admin-dashboard {
  max-width: 600px;
  margin: 0 auto;
  padding: 2rem;
  border: 1px solid #eaeaea;
  border-radius: 8px;
  background-color: #ffffff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.header {
  text-align: center;
  margin-bottom: 1.5rem;
}

.header .logo {
  max-width: 100px;
  margin-bottom: 1rem;
}

.header h1 {
  margin: 0;
  font-size: 1.5rem;
  color: #333;
}

.navigation {
  margin-bottom: 20px;
  display: flex;
  justify-content: center;
  gap: 15px;
  flex-wrap: wrap;
}

.navigation a {
  padding: 0.5rem 1rem;
  border: 1px solid #007bff;
  border-radius: 4px;
  color: #007bff;
  text-decoration: none;
  transition: background-color 0.3s, color 0.3s;
}

.navigation a:hover {
  background-color: #007bff;
  color: #ffffff;
}

.logout-button {
  display: block;
  width: 100%;
  padding: 0.75rem;
  background-color: #dc3545;
  color: #ffffff;
  border: none;
  border-radius: 4px;
  font-size: 1rem;
  cursor: pointer;
  margin-top: 1rem;
  text-align: center;
}

.logout-button:hover {
  background-color: #c82333;
}
</style>