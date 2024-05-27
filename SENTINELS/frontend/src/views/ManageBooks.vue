<template>
   <div class="manage-games">
    <h1>Manage Books</h1>
    <h1 v-if="showNotification">{{ notificationMessage }}</h1>
    <form @submit.prevent="addGames">
      <div class="form-group">
        <label for="name">Book Name</label>
        <input type="text" autocomplete="off" v-model="gameName" id="name" placeholder="Book Name" />
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <input type="text" autocomplete="off" v-model="description" id="description" placeholder="Description" />
      </div>
      <div class="form-group">
        <label for="category">Category</label>
        <input type="text" autocomplete="off" v-model="category" id="category" placeholder="Category" />
      </div>
      <div class="form-group">
        <label for="type">Type</label>
        <input type="text" autocomplete="off" v-model="type" id="type" placeholder="Type" />
      </div>
      <button type="submit">Add Book</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios'; // Ensure you import Axios

export default {
  name: 'ManageGames',
  data() {
    return {
      gameName: '',
      description: '',
      category: '',
      type: '',
      showNotification:false,
      notificationMessage:''
    };
  },
  methods: {
    async addGames() {
      try {
        const token = localStorage.getItem('token'); // Get the token from localStorage

        const response = await axios.post('http://127.0.0.1:8000/api/books', {
          name: this.gameName,
          description: this.description,
          category: this.category,
          type: this.type
        }, {
          headers: {
            'Authorization': `Bearer ${token}`, 
            'Content-Type': 'application/json'
          }
        });

        console.log('You added a Book successfully:', response.data);
        this.gameName = '';
        this.description = '';
        this.category = '';
        this.type = '';
        setTimeout(()=>{
          this.showNotification = true
          this.notificationMessage = 'Book Added Successfully'
        },2000)
      } catch (error) {
        console.error('Error adding Book:', error.response ? error.response.data : error.message);
        setTimeout(()=>{
          this.showNotification = true
          this.notificationMessage = 'Fail to Add'
        },2000)
      }
    }
  }
};
</script>

<style scoped>
.manage-games {
  max-width: 600px;
  margin: 0 auto;
  padding: 2rem;
  border: 1px solid #eaeaea;
  border-radius: 8px;
  background-color: #ffffff;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.manage-games h1 {
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

.form-group input::placeholder {
  color: #bbb;
}

.form-group input:focus {
  border-color: #007bff;
  outline: none;
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